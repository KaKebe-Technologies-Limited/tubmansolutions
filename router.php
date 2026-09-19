<?php
/**
 * Router for PHP's built-in server only (php -S localhost:8090 router.php).
 * On Apache/Hostinger the same clean URLs are handled by .htaccess.
 */
if (PHP_SAPI !== 'cli-server') {
    http_response_code(404);
    exit;
}
require_once __DIR__ . '/includes/config.php';

$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$rel  = ltrim($path, '/');

if (preg_match('#^(includes|storage|tools|\.claude|\.git)(/|$)#', $rel)) {
    http_response_code(403);
    exit('Forbidden');
}

$special = ['sitemap.xml' => 'sitemap.php', 'llms.txt' => 'llms.php'];
$slugs   = array_flip(array_filter($ROUTES, 'strlen'));
$slug    = rtrim($rel, '/');

if ($rel !== '' && is_file(__DIR__ . '/' . $rel)) {
    return false; // static file or direct .php request (header.php 301s .php to the clean URL)
}
$file = $special[$rel] ?? ($rel === '' ? 'index.php' : ($slugs[$slug] ?? '404.php'));

$_SERVER['SCRIPT_NAME']     = '/' . $file;
$_SERVER['PHP_SELF']        = '/' . $file;
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/' . $file;
chdir(__DIR__);
require __DIR__ . '/' . $file;
