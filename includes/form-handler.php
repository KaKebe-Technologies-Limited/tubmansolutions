<?php
/**
 * Handles every enquiry form (homepage quick quote, CCTV site assessment, contact page).
 * Each valid enquiry is emailed to info@htubmansolutions.com (see includes/mail-config.php)
 * and a backup copy is appended to storage/enquiries.csv, so nothing is lost if email fails.
 * Sets $form_errors / $GLOBALS['form_old'] for redisplay, or redirects with ?sent=1 on success.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mailer.php';

$form_errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $storage = dirname(__DIR__) . '/storage';
    if (!is_dir($storage)) {
        @mkdir($storage, 0750, true);
    }
    $done = function () {
        header('Location: ' . u('contact.php') . '?sent=1#quote', true, 303);
        exit;
    };

    $clean = function ($key, $max = 200) {
        $v = trim((string) ($_POST[$key] ?? ''));
        $v = str_replace(["\r", "\0"], '', $v);
        return mb_substr($v, 0, $max);
    };
    $data = [
        'name'     => $clean('name', 100),
        'phone'    => $clean('phone', 40),
        'email'    => $clean('email', 120),
        'service'  => $clean('service', 80),
        'location' => $clean('location', 120),
        'message'  => $clean('message', 3000),
        'source'   => $clean('source', 60),
        'page'     => $clean('page', 200),
    ];

    // --- spam protection: honeypot + "filled in faster than a human" + per-IP rate limit ---
    $ts = (int) ($_POST['ts'] ?? 0);
    if (!empty($_POST['website']) || ($ts && time() - $ts < 3)) {
        $done(); // silently pretend success
    }
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0';
    $rl_file = $storage . '/ratelimit.json';
    $rl = is_file($rl_file) ? (json_decode((string) @file_get_contents($rl_file), true) ?: []) : [];
    $key = hash('sha256', $ip);
    $rl[$key] = array_values(array_filter($rl[$key] ?? [], function ($t) { return $t > time() - 600; }));
    if (count($rl[$key]) >= 5) {
        $form_errors[] = 'Too many requests from your connection. Please call or WhatsApp us instead.';
    }

    if ($data['name'] === '') {
        $form_errors[] = 'Please enter your name.';
    }
    if (!preg_match('/^[0-9+\s()\-]{7,20}$/', $data['phone'])) {
        $form_errors[] = 'Please enter a valid phone number.';
    }
    if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $form_errors[] = 'Please enter a valid email address, or leave it blank.';
    }
    if ($data['service'] !== '' && !in_array($data['service'], $SERVICE_OPTIONS, true)) {
        $data['service'] = 'Other';
    }

    if ($form_errors) {
        $GLOBALS['form_old'] = $data;
    } else {
        $rl[$key][] = time();
        @file_put_contents($rl_file, json_encode(array_filter($rl)), LOCK_EX);

        // 1) backup copy on the server (folder is blocked from the web by .htaccess)
        $row = array_merge([date('Y-m-d H:i:s')], array_values($data), [$ip]);
        $row = array_map(function ($v) { return preg_match('/^[=+\-@]/', $v) ? "'" . $v : $v; }, $row); // CSV formula injection
        $file = $storage . '/enquiries.csv';
        $new = !is_file($file);
        if ($fh = @fopen($file, 'a')) {
            if ($new) {
                fputcsv($fh, ['date', 'name', 'phone', 'email', 'service', 'location', 'message', 'source', 'page', 'ip']);
            }
            fputcsv($fh, $row);
            fclose($fh);
        }

        // 2) email to info@htubmansolutions.com
        $cfg     = mail_settings();
        $to_list = array_merge([$cfg['to'] ?? $SITE['email']], (array) ($cfg['cc'] ?? []));
        $service = $data['service'] ?: 'General enquiry';
        $subject = "New enquiry: {$service} - {$data['name']}";
        $labels  = ['name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'service' => 'Service', 'location' => 'Location', 'message' => 'Message', 'source' => 'Form', 'page' => 'Page'];

        $text = "New enquiry from the H.Tubman Solutions website\n\n";
        foreach ($labels as $k => $label) {
            if ($data[$k] !== '') {
                $text .= str_pad($label . ':', 10) . $data[$k] . "\n";
            }
        }
        $phone_digits = preg_replace('/\D/', '', $data['phone']);
        $wa_client = 'https://wa.me/' . (strpos($phone_digits, '0') === 0 ? '256' . substr($phone_digits, 1) : $phone_digits);
        $text .= "\nReply on WhatsApp: {$wa_client}\nReceived: " . date('D j M Y, H:i') . " (Kampala time)\n";

        $rows = '';
        foreach ($labels as $k => $label) {
            if ($data[$k] === '') {
                continue;
            }
            $val = nl2br(e($data[$k]));
            if ($k === 'phone') {
                $val = '<a href="tel:' . e($data['phone']) . '" style="color:#0A4AA3">' . e($data['phone']) . '</a>';
            } elseif ($k === 'email') {
                $val = '<a href="mailto:' . e($data['email']) . '" style="color:#0A4AA3">' . e($data['email']) . '</a>';
            }
            $rows .= '<tr><td style="padding:10px 14px;background:#F3F6FB;font-weight:bold;color:#0E1A33;width:110px;vertical-align:top;border-bottom:1px solid #E2E8F3">' . $label . '</td>'
                   . '<td style="padding:10px 14px;color:#2E3036;border-bottom:1px solid #E2E8F3">' . $val . '</td></tr>';
        }
        $html = '<div style="font-family:Arial,Helvetica,sans-serif;background:#EEF2F8;padding:24px">'
              . '<table role="presentation" width="100%" style="max-width:620px;margin:0 auto;background:#fff;border-radius:12px;overflow:hidden;border-collapse:collapse">'
              . '<tr><td style="background:#06173A;padding:22px 24px;color:#fff"><div style="font-size:12px;letter-spacing:2px;color:#5B93FF;text-transform:uppercase">New website enquiry</div>'
              . '<div style="font-size:22px;font-weight:bold;margin-top:4px">' . e($service) . '</div></td></tr>'
              . '<tr><td style="padding:18px 24px 6px"><table role="presentation" width="100%" style="border-collapse:collapse;font-size:15px">' . $rows . '</table></td></tr>'
              . '<tr><td style="padding:14px 24px 24px">'
              . '<a href="tel:' . e($data['phone']) . '" style="display:inline-block;background:#0A4AA3;color:#fff;text-decoration:none;padding:12px 20px;border-radius:8px;font-weight:bold;margin:0 8px 8px 0">Call ' . e($data['name']) . '</a>'
              . '<a href="' . e($wa_client) . '" style="display:inline-block;background:#1FAF5A;color:#fff;text-decoration:none;padding:12px 20px;border-radius:8px;font-weight:bold;margin:0 8px 8px 0">Reply on WhatsApp</a>'
              . '</td></tr>'
              . '<tr><td style="background:#F3F6FB;padding:14px 24px;font-size:12px;color:#8A93A6">Received ' . date('D j M Y, H:i') . ' (Kampala time) from ' . e($SITE['website']) . '. A backup copy is saved in storage/enquiries.csv.</td></tr>'
              . '</table></div>';

        foreach ($to_list as $to) {
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                continue;
            }
            [$ok, $err] = send_mail($to, $subject, $text, $html, $data['email'], $data['name']);
            if (!$ok) {
                @file_put_contents($storage . '/mail-errors.log', date('c') . " to {$to}: {$err}\n", FILE_APPEND | LOCK_EX);
            }
        }

        $done();
    }
}
