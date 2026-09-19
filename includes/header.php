<?php
/**
 * Page head + top bar + main navigation.
 * Expects (optional): $page_key, $meta_title, $meta_desc, $og_title, $og_desc, $robots, $preload_image, $body_class
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/seo.php';

$this_file = current_file();

/* 301: old ".php" addresses and trailing slashes -> clean SEO URLs (GET/HEAD only, so form POSTs are untouched) */
if (empty($use_base) && isset($ROUTES[$this_file]) && in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true)) {
    $req_path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
    $base     = rtrim(str_replace(chr(92), '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
    $target   = null;
    if (substr($req_path, -strlen('/' . $this_file)) === '/' . $this_file) {
        $target = $base . $ROUTES[$this_file];
    } elseif ($ROUTES[$this_file] !== '' && substr($req_path, -1) === '/') {
        $target = $base . $ROUTES[$this_file];
    }
    if ($target !== null && $target !== $req_path) {
        $qs = $_SERVER['QUERY_STRING'] ?? '';
        header('Location: ' . $target . ($qs !== '' ? '?' . $qs : ''), true, 301);
        exit;
    }
}

$page_key   = $page_key ?? '';
$meta_title = $meta_title ?? 'CCTV Installation Kampala | ICT & Networking Solutions Uganda';
$meta_desc  = $meta_desc ?? 'Trusted CCTV installers in Kampala. Genuine security cameras, quality installation, networking, access control & IT support across Uganda. Free quote!';
$og_title   = $og_title ?? $meta_title;
$og_desc    = $og_desc ?? $meta_desc;
$robots     = $robots ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1';
$canonical  = abs_url(isset($ROUTES[$this_file]) ? $this_file : 'index.php');
$og_image   = og_image_for($this_file);
$body_class = $body_class ?? '';

$service_pages = array_column($SERVICES, 'page');
$is_services   = $page_key === 'services' || (in_array($page_key, $service_pages, true) && $page_key !== 'cctv.php');

function nav_active($cond)
{
    return $cond ? ' class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="en-UG">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (!empty($use_base)): ?>
    <base href="<?= e(rtrim(str_replace(chr(92), '/', dirname($_SERVER['SCRIPT_NAME'])), '/')) ?>/">
<?php endif; ?>
    <title><?= e($meta_title) ?></title>
    <meta name="description" content="<?= e($meta_desc) ?>">
    <meta name="robots" content="<?= e($robots) ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta name="theme-color" content="#0A4AA3">
    <meta name="author" content="<?= e($SITE['name']) ?>">
    <meta name="geo.region" content="UG-102">
    <meta name="geo.placename" content="Kampala, Uganda">
    <meta name="format-detection" content="telephone=yes">

    <!-- Open Graph (WhatsApp, Facebook, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_GB">
    <meta property="og:site_name" content="<?= e($SITE['name']) ?>">
    <meta property="og:title" content="<?= e($og_title) ?>">
    <meta property="og:description" content="<?= e($og_desc) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($og_image) ?>">
    <meta property="og:image:secure_url" content="<?= e($og_image) ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= e($og_title) ?>">
    <!-- X / Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($og_title) ?>">
    <meta name="twitter:description" content="<?= e($og_desc) ?>">
    <meta name="twitter:image" content="<?= e($og_image) ?>">
    <meta name="twitter:image:alt" content="<?= e($og_title) ?>">

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="sitemap" type="application/xml" href="sitemap.xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
<?php if (!empty($preload_image)): ?>
    <link rel="preload" as="image" href="<?= e($preload_image) ?>" fetchpriority="high">
<?php endif; ?>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(dirname(__DIR__) . '/assets/css/style.css') ?>">
</head>
<body class="<?= e($body_class) ?>">
<a class="skip-link" href="#main">Skip to content</a>

<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-left">
            <span>Talk to us:</span>
            <a class="tb-icon" href="<?= e(wa()) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            <a class="tb-icon" href="<?= e(tel($SITE['phones'][0])) ?>" aria-label="Call us"><i class="fa-solid fa-phone"></i></a>
            <a class="tb-icon" href="mailto:<?= e($SITE['email']) ?>" aria-label="Email us"><i class="fa-solid fa-envelope"></i></a>
        </div>
        <ul class="topbar-info">
            <li><i class="fa-solid fa-phone-volume"></i>
                <a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a><span class="tb-2">&nbsp;/&nbsp;<a href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a></span></li>
            <li class="hide-sm"><i class="fa-solid fa-envelope-open-text"></i><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></li>
            <li class="hide-md"><i class="fa-solid fa-location-dot"></i><?= e($SITE['location']) ?></li>
        </ul>
    </div>
</div>

<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <a class="brand" href="<?= e(u('index.php')) ?>" aria-label="<?= e($SITE['name']) ?> — Home">
            <img src="assets/img/logo-mark.png" alt="" width="54" height="54">
            <span class="brand-text"><strong>H.TUBMAN</strong><small>SOLUTIONS</small></span>
        </a>

        <nav class="main-nav" id="mainNav" aria-label="Main navigation">
            <div class="nav-head">
                <a class="brand" href="<?= e(u('index.php')) ?>"><img src="assets/img/logo-mark.png" alt="" width="44" height="44"><span class="brand-text"><strong>H.TUBMAN</strong><small>SOLUTIONS</small></span></a>
                <button class="nav-close" type="button" aria-label="Close menu"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <ul class="nav-list">
                <li><a href="<?= e(u('index.php')) ?>"<?= nav_active($page_key === 'home') ?>>Home</a></li>
                <li><a href="<?= e(u('about.php')) ?>"<?= nav_active($page_key === 'about') ?>>About</a></li>
                <li class="has-dd">
                    <a href="<?= e(u('cctv.php')) ?>"<?= nav_active($page_key === 'cctv.php') ?>><i class="fa-solid fa-video nav-cam"></i>CCTV &amp; Security</a>
                    <button class="dd-toggle" type="button" aria-label="Toggle CCTV menu" aria-expanded="false"><i class="fa-solid fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="<?= e(u('cctv.php')) ?>">CCTV Installation Kampala</a></li>
                        <li><a href="<?= e(u('cctv.php#environments')) ?>">Home &amp; Business CCTV</a></li>
                        <li><a href="<?= e(u('cctv.php#technology')) ?>">Solar, 4G &amp; PTZ Cameras</a></li>
                        <li><a href="<?= e(u('cctv.php#technology')) ?>">Night Vision &amp; Remote Viewing</a></li>
                        <li><a href="<?= e(u('cctv.php#maintenance')) ?>">CCTV Maintenance &amp; Repair</a></li>
                        <li><a href="<?= e(u('cctv.php#site-assessment')) ?>">Request a Site Assessment</a></li>
                    </ul>
                </li>
                <li class="has-dd">
                    <a href="<?= e(u('services.php')) ?>"<?= nav_active($is_services) ?>>Services</a>
                    <button class="dd-toggle" type="button" aria-label="Toggle services menu" aria-expanded="false"><i class="fa-solid fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <?php foreach ($SERVICES as $s): ?>
                            <li><a href="<?= e(u($s['page'])) ?>"><i class="fa-solid <?= e($s['icon']) ?>"></i><?= e($s['nav']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="<?= e(u('projects.php')) ?>"<?= nav_active($page_key === 'projects') ?>>Projects</a></li>
                <li><a href="<?= e(u('contact.php')) ?>"<?= nav_active($page_key === 'contact') ?>>Contact</a></li>
            </ul>
            <div class="nav-mobile-cta">
                <a class="btn btn-primary" href="<?= e(u('contact.php#quote')) ?>">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                <a class="btn btn-wa" href="<?= e(wa()) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
            </div>
        </nav>

        <div class="header-actions">
            <button class="icon-btn search-btn" type="button" aria-label="Search the website" aria-controls="searchOverlay" aria-expanded="false"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a class="icon-btn" href="<?= e(wa()) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            <a class="btn btn-primary header-cta" href="<?= e(u('contact.php#quote')) ?>">Free CCTV Quote <i class="fa-solid fa-arrow-right"></i></a>
            <button class="nav-toggle" type="button" aria-label="Open menu" aria-controls="mainNav" aria-expanded="false"><i class="fa-solid fa-bars-staggered"></i></button>
        </div>
    </div>
</header>
<div class="nav-overlay" hidden></div>

<div class="search-overlay" id="searchOverlay" role="dialog" aria-modal="true" aria-label="Search the website" hidden>
    <div class="search-panel">
        <form class="search-form" action="<?= e(u('search.php')) ?>" method="get" role="search">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            <input type="search" name="q" id="siteSearchInput" placeholder="Search CCTV, Wi-Fi, biometrics, IT support…" autocomplete="off" aria-label="Search" maxlength="120">
            <button class="btn btn-primary btn-sm" type="submit">Search</button>
            <button class="search-close" type="button" aria-label="Close search"><i class="fa-solid fa-xmark"></i></button>
        </form>
        <div class="search-live" aria-live="polite"></div>
        <div class="search-popular">
            <span>Popular:</span>
            <?php foreach (['CCTV installation', 'Solar CCTV', 'CCTV repair', 'Remote viewing on phone', 'Fingerprint attendance', 'Wi-Fi installation', 'IT support', 'CCTV price'] as $pq): ?>
                <a href="<?= e(u('search.php')) ?>?q=<?= rawurlencode($pq) ?>"><?= e($pq) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<main id="main">
