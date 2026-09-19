<?php
/** XML sitemap, served at /sitemap.xml (rewritten in .htaccess / router.php). Always in sync with $ROUTES. */
require_once __DIR__ . '/includes/config.php';

$priority = ['index.php' => '1.0', 'cctv.php' => '0.95', 'services.php' => '0.8', 'contact.php' => '0.8', 'faq.php' => '0.7'];
$config_time = filemtime(__DIR__ . '/includes/config.php');

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";
foreach ($ROUTES as $file => $slug) {
    if ($file === 'search.php' || !is_file(__DIR__ . '/' . $file)) {
        continue;
    }
    $lastmod = date('Y-m-d', max(filemtime(__DIR__ . '/' . $file), $config_time));
    $og = 'assets/img/og/' . ($slug === '' ? 'home' : $slug) . '.png';
    echo "  <url>\n";
    echo '    <loc>' . htmlspecialchars(abs_url($file), ENT_XML1) . "</loc>\n";
    echo "    <lastmod>{$lastmod}</lastmod>\n";
    echo '    <changefreq>' . ($file === 'index.php' || $file === 'cctv.php' ? 'weekly' : 'monthly') . "</changefreq>\n";
    echo '    <priority>' . ($priority[$file] ?? (isset($SERVICES) && in_array($file, array_column($SERVICES, 'page'), true) ? '0.85' : '0.6')) . "</priority>\n";
    if (is_file(__DIR__ . '/' . $og)) {
        echo '    <image:image><image:loc>' . htmlspecialchars($SITE['url'] . '/' . $og, ENT_XML1) . "</image:loc></image:image>\n";
    }
    echo "  </url>\n";
}
echo "</urlset>\n";
