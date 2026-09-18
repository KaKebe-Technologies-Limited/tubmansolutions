<?php
/**
 * Page head + top bar + main navigation.
 * Expects (optional): $page_key, $meta_title, $meta_desc, $canonical, $body_class
 */
require_once __DIR__ . '/config.php';

$page_key   = $page_key ?? '';
$meta_title = $meta_title ?? 'CCTV Installation Kampala Uganda | H.Tubman Solutions Limited';
$meta_desc  = $meta_desc ?? 'Professional CCTV installation in Kampala and Uganda. H.Tubman Solutions provides CCTV cameras, security systems, networking, access control, IT support and technology solutions.';
$canonical  = $SITE['url'] . '/' . ($canonical ?? '');
$body_class = $body_class ?? '';

$service_pages = array_column($SERVICES, 'page');
$is_services   = $page_key === 'services' || (in_array($page_key, $service_pages, true) && $page_key !== 'cctv.php');

function nav_active($cond)
{
    return $cond ? ' class="active"' : '';
}

$schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'LocalBusiness',
    'name'        => $SITE['name'],
    'description' => 'H.Tubman Solutions Limited provides professional CCTV installation, security systems, networking, access control, IT support and technology solutions in Kampala, Uganda.',
    'url'         => $SITE['url'],
    'logo'        => $SITE['url'] . '/assets/img/logo-full.png',
    'image'       => $SITE['url'] . '/assets/img/og-image.jpg',
    'email'       => $SITE['email'],
    'telephone'   => ['+256789977270', '+256784801913'],
    'address'     => ['@type' => 'PostalAddress', 'addressLocality' => 'Kampala', 'addressCountry' => 'UG'],
    'areaServed'  => 'Uganda',
    'slogan'      => $SITE['tagline'],
    'knowsAbout'  => ['CCTV installation', 'Security systems', 'Access control', 'Biometric systems', 'Networking', 'IT support', 'Servers', 'Cybersecurity', 'Website design'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (!empty($use_base)): ?>
    <base href="<?= e(rtrim(strtr(dirname($_SERVER['SCRIPT_NAME']), '\\', '/'), '/')) ?>/">
<?php endif; ?>
    <title><?= e($meta_title) ?></title>
    <meta name="description" content="<?= e($meta_desc) ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta name="theme-color" content="#0A4AA3">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e($SITE['name']) ?>">
    <meta property="og:title" content="<?= e($meta_title) ?>">
    <meta property="og:description" content="<?= e($meta_desc) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($SITE['url']) ?>/assets/img/og-image.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="assets/css/style.css?v=1.0">

    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
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
        <a class="brand" href="index.php" aria-label="<?= e($SITE['name']) ?> — Home">
            <img src="assets/img/logo-mark.png" alt="" width="54" height="54">
            <span class="brand-text"><strong>H.TUBMAN</strong><small>SOLUTIONS</small></span>
        </a>

        <nav class="main-nav" id="mainNav" aria-label="Main navigation">
            <div class="nav-head">
                <a class="brand" href="index.php"><img src="assets/img/logo-mark.png" alt="" width="44" height="44"><span class="brand-text"><strong>H.TUBMAN</strong><small>SOLUTIONS</small></span></a>
                <button class="nav-close" type="button" aria-label="Close menu"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <ul class="nav-list">
                <li><a href="index.php"<?= nav_active($page_key === 'home') ?>>Home</a></li>
                <li><a href="about.php"<?= nav_active($page_key === 'about') ?>>About</a></li>
                <li class="has-dd">
                    <a href="cctv.php"<?= nav_active($page_key === 'cctv.php') ?>><i class="fa-solid fa-video nav-cam"></i>CCTV &amp; Security</a>
                    <button class="dd-toggle" type="button" aria-label="Toggle CCTV menu" aria-expanded="false"><i class="fa-solid fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <li><a href="cctv.php">CCTV Installation Kampala</a></li>
                        <li><a href="cctv.php#environments">Home &amp; Business CCTV</a></li>
                        <li><a href="cctv.php#technology">Solar, 4G &amp; PTZ Cameras</a></li>
                        <li><a href="cctv.php#technology">Night Vision &amp; Remote Viewing</a></li>
                        <li><a href="cctv.php#maintenance">CCTV Maintenance &amp; Repair</a></li>
                        <li><a href="cctv.php#site-assessment">Request a Site Assessment</a></li>
                    </ul>
                </li>
                <li class="has-dd">
                    <a href="services.php"<?= nav_active($is_services) ?>>Services</a>
                    <button class="dd-toggle" type="button" aria-label="Toggle services menu" aria-expanded="false"><i class="fa-solid fa-chevron-down"></i></button>
                    <ul class="dropdown">
                        <?php foreach ($SERVICES as $s): ?>
                            <li><a href="<?= e($s['page']) ?>"><i class="fa-solid <?= e($s['icon']) ?>"></i><?= e($s['nav']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="projects.php"<?= nav_active($page_key === 'projects') ?>>Projects</a></li>
                <li><a href="contact.php"<?= nav_active($page_key === 'contact') ?>>Contact</a></li>
            </ul>
            <div class="nav-mobile-cta">
                <a class="btn btn-primary" href="contact.php#quote">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                <a class="btn btn-wa" href="<?= e(wa()) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
            </div>
        </nav>

        <div class="header-actions">
            <a class="icon-btn" href="<?= e(wa()) ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            <a class="btn btn-primary header-cta" href="contact.php#quote">Free CCTV Quote <i class="fa-solid fa-arrow-right"></i></a>
            <button class="nav-toggle" type="button" aria-label="Open menu" aria-controls="mainNav" aria-expanded="false"><i class="fa-solid fa-bars-staggered"></i></button>
        </div>
    </div>
</header>
<div class="nav-overlay" hidden></div>

<main id="main">
