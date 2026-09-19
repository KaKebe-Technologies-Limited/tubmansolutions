<?php
/**
 * Minimal SMTP mailer (no external libraries).
 * Sends through the SMTP server in includes/mail-config.php (Titan Email on Hostinger by default);
 * falls back to PHP mail() when SMTP is not configured.
 */
require_once __DIR__ . '/config.php';

function mail_settings()
{
    static $cfg = null;
    if ($cfg === null) {
        $file = __DIR__ . '/mail-config.php';
        $cfg = is_file($file) ? (array) require $file : [];
    }
    return $cfg;
}

/**
 * @return array [bool $ok, string $error]
 */
function send_mail($to, $subject, $text, $html = '', $reply_to = '', $reply_name = '')
{
    global $SITE;
    $cfg       = mail_settings();
    $from      = $cfg['from_email'] ?? $SITE['email'];
    $from_name = $cfg['from_name'] ?? $SITE['name'];
    $clean     = function ($v) { return trim(str_replace(["\r", "\n"], ' ', (string) $v)); };

    // --- build a MIME message (plain text + optional HTML) ---
    $boundary = 'b' . bin2hex(random_bytes(12));
    $enc_name = function ($name) { return '=?UTF-8?B?' . base64_encode($name) . '?='; };
    $headers = [
        'Date: ' . date('r'),
        'From: ' . $enc_name($from_name) . ' <' . $clean($from) . '>',
        'To: <' . $clean($to) . '>',
        'Subject: ' . $enc_name($clean($subject)),
        'Message-ID: <' . bin2hex(random_bytes(10)) . '@' . (explode('@', $from)[1] ?? 'localhost') . '>',
        'MIME-Version: 1.0',
    ];
    if ($reply_to && filter_var($reply_to, FILTER_VALIDATE_EMAIL)) {
        $headers[] = 'Reply-To: ' . ($reply_name ? $enc_name($clean($reply_name)) . ' ' : '') . '<' . $clean($reply_to) . '>';
    }
    if ($html) {
        $headers[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';
        $body = "--$boundary\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n"
              . chunk_split(base64_encode($text))
              . "--$boundary\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n"
              . chunk_split(base64_encode($html))
              . "--$boundary--\r\n";
    } else {
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'Content-Transfer-Encoding: base64';
        $body = chunk_split(base64_encode($text));
    }

    // --- no SMTP password yet: use the server's mail() ---
    if (empty($cfg['host']) || !isset($cfg['password']) || $cfg['password'] === '') {
        $extra = implode("\r\n", array_filter($headers, function ($h) {
            return stripos($h, 'To:') !== 0 && stripos($h, 'Subject:') !== 0;
        }));
        $ok = @mail($to, '=?UTF-8?B?' . base64_encode($clean($subject)) . '?=', $body, $extra, '-f' . $from);
        return [$ok, $ok ? '' : 'mail() failed (SMTP not configured in includes/mail-config.php)'];
    }

    return smtp_send($cfg, $from, $to, implode("\r\n", $headers) . "\r\n\r\n" . $body);
}

function smtp_send(array $cfg, $from, $to, $message)
{
    $secure  = $cfg['secure'] ?? 'ssl';            // ssl (465) | tls (587, STARTTLS) | none
    $host    = $cfg['host'];
    $port    = (int) ($cfg['port'] ?? ($secure === 'ssl' ? 465 : 587));
    $timeout = (int) ($cfg['timeout'] ?? 20);
    $remote  = ($secure === 'ssl' ? 'ssl://' : 'tcp://') . $host . ':' . $port;
    $ctx     = stream_context_create(['ssl' => ['verify_peer' => true, 'verify_peer_name' => true, 'SNI_enabled' => true]]);

    $fp = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $ctx);
    if (!$fp) {
        return [false, "SMTP connect to $remote failed: $errstr ($errno)"];
    }
    stream_set_timeout($fp, $timeout);

    $read = function () use ($fp) {
        $data = '';
        while (($line = fgets($fp, 1024)) !== false) {
            $data .= $line;
            if (strlen($line) < 4 || $line[3] === ' ') {
                break;
            }
        }
        return $data;
    };
    $cmd = function ($line, $expect) use ($fp, $read) {
        if ($line !== null) {
            fwrite($fp, $line . "\r\n");
        }
        $resp = $read();
        if (!in_array((int) substr($resp, 0, 3), (array) $expect, true)) {
            throw new RuntimeException(trim(($line !== null && stripos($line, 'AUTH') === false ? $line . ' -> ' : '') . $resp));
        }
        return $resp;
    };

    try {
        $cmd(null, 220);
        $ehlo = 'EHLO ' . (parse_url($GLOBALS['SITE']['url'], PHP_URL_HOST) ?: 'localhost');
        $cmd($ehlo, 250);
        if ($secure === 'tls') {
            $cmd('STARTTLS', 220);
            if (!stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new RuntimeException('STARTTLS negotiation failed');
            }
            $cmd($ehlo, 250);
        }
        $cmd('AUTH LOGIN', 334);
        $cmd(base64_encode($cfg['username'] ?? $from), 334);
        $cmd(base64_encode($cfg['password']), 235);
        $cmd('MAIL FROM:<' . $from . '>', 250);
        $cmd('RCPT TO:<' . $to . '>', [250, 251]);
        $cmd('DATA', 354);
        // dot-stuffing + normalised line endings
        $data = preg_replace("/\r?\n/", "\r\n", $message);
        $data = preg_replace('/^\./m', '..', $data);
        $cmd($data . "\r\n.", 250);
        $cmd('QUIT', 221);
        fclose($fp);
        return [true, ''];
    } catch (RuntimeException $e) {
        @fwrite($fp, "QUIT\r\n");
        fclose($fp);
        return [false, 'SMTP: ' . $e->getMessage()];
    }
}
