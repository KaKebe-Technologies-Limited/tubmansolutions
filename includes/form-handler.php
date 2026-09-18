<?php
/**
 * Handles enquiry form posts (quick quote, CCTV site assessment, contact page).
 * Every valid enquiry is appended to storage/enquiries.csv and emailed to $SITE['email'].
 * Sets $form_errors / $GLOBALS['form_old'] for redisplay, or redirects with ?sent=1 on success.
 */
require_once __DIR__ . '/config.php';

$form_errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    ];

    // honeypot: bots fill every field; silently pretend success
    if (!empty($_POST['website'])) {
        header('Location: contact.php?sent=1#quote', true, 303);
        exit;
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
        // 1) keep a copy on the server (folder is protected by .htaccess)
        $dir = dirname(__DIR__) . '/storage';
        if (!is_dir($dir)) {
            @mkdir($dir, 0750, true);
        }
        $row = array_merge([date('Y-m-d H:i:s')], array_values($data), [$_SERVER['REMOTE_ADDR'] ?? '']);
        // neutralise spreadsheet formula injection
        $row = array_map(function ($v) { return preg_match('/^[=+\-@]/', $v) ? "'" . $v : $v; }, $row);
        $file = $dir . '/enquiries.csv';
        $new = !file_exists($file);
        if ($fh = @fopen($file, 'a')) {
            if ($new) {
                fputcsv($fh, ['date', 'name', 'phone', 'email', 'service', 'location', 'message', 'source', 'ip']);
            }
            fputcsv($fh, $row);
            fclose($fh);
        }

        // 2) email the enquiry (works on hosts with PHP mail() configured)
        $subject = 'New website enquiry: ' . ($data['service'] ?: 'General') . ' — ' . $data['name'];
        $body  = "New enquiry from the H.Tubman Solutions website\n\n";
        foreach ($data as $k => $v) {
            if ($v !== '') {
                $body .= str_pad(ucfirst($k) . ':', 11) . $v . "\n";
            }
        }
        $host = preg_replace('/^www\./', '', parse_url($SITE['url'], PHP_URL_HOST));
        $headers = "From: H.Tubman Website <no-reply@{$host}>\r\n";
        if ($data['email'] !== '') {
            $headers .= 'Reply-To: ' . $data['email'] . "\r\n";
        }
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        @mail($SITE['email'], $subject, $body, $headers);

        header('Location: contact.php?sent=1#quote', true, 303);
        exit;
    }
}
