<?php
/**
 * SEO helpers: canonical/OG data and the schema.org JSON-LD graph that Google,
 * Bing and AI assistants (ChatGPT, Perplexity, Gemini, Claude) read to understand the business.
 */
require_once __DIR__ . '/config.php';

$SEO_FAQ    = [];   // questions rendered on the page (faq_list) -> FAQPage
$SEO_EXTRA  = [];   // page-specific nodes (Service, ItemList ...)
$SEO_CRUMBS = [];   // [[name, file], ...] set by page_banner()

function current_file()
{
    return basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
}

/** Absolute URL of the share (Open Graph) image for a page. */
function og_image_for($file)
{
    global $ROUTES, $SITE;
    $slug = $ROUTES[$file] ?? '';
    $rel  = 'assets/img/og/' . ($slug === '' ? 'home' : $slug) . '.png';
    if (!is_file(dirname(__DIR__) . '/' . $rel)) {
        $rel = 'assets/img/og/home.png';
    }
    return $SITE['url'] . '/' . $rel;
}

function business_id()
{
    return $GLOBALS['SITE']['url'] . '/#business';
}

function business_node()
{
    global $SITE, $SERVICES;
    $base = $SITE['url'];

    $address = ['@type' => 'PostalAddress', 'addressLocality' => 'Kampala', 'addressRegion' => $SITE['region'], 'addressCountry' => 'UG'];
    if ($SITE['street'] !== '') {
        $address['streetAddress'] = $SITE['street'];
    }

    $catalog = [];
    foreach ($SERVICES as $s) {
        $catalog[] = ['@type' => 'Offer', 'itemOffered' => [
            '@type' => 'Service', 'name' => $s['title'], 'description' => $s['excerpt'], 'url' => abs_url($s['page']),
        ]];
    }

    $node = [
        '@type'         => 'LocalBusiness',
        '@id'           => business_id(),
        'name'          => $SITE['name'],
        'alternateName' => $SITE['alt_name'],
        'description'   => 'H.Tubman Solutions Limited provides professional CCTV installation, security systems, networking, access control, IT support and technology solutions in Kampala, Uganda. We install and maintain CCTV cameras for homes, offices, businesses, warehouses, farms, schools and institutions.',
        'slogan'        => $SITE['tagline'],
        'url'           => $base . '/',
        'logo'          => ['@type' => 'ImageObject', 'url' => $base . '/assets/img/logo-full.png', 'width' => 560, 'height' => 437],
        'image'         => $base . '/assets/img/og/home.png',
        'email'         => $SITE['email'],
        'telephone'     => '+256' . substr($SITE['phones'][0], 1),
        'priceRange'    => $SITE['price_range'],
        'currenciesAccepted' => 'UGX',
        'address'       => $address,
        'areaServed'    => [
            ['@type' => 'City', 'name' => 'Kampala'],
            ['@type' => 'AdministrativeArea', 'name' => 'Wakiso'],
            ['@type' => 'Country', 'name' => 'Uganda'],
        ],
        'contactPoint'  => [
            ['@type' => 'ContactPoint', 'contactType' => 'sales', 'telephone' => '+256' . substr($SITE['phones'][0], 1), 'email' => $SITE['email'], 'areaServed' => 'UG', 'availableLanguage' => ['English']],
            ['@type' => 'ContactPoint', 'contactType' => 'customer support', 'telephone' => '+256' . substr($SITE['phones'][1], 1), 'areaServed' => 'UG', 'availableLanguage' => ['English']],
            ['@type' => 'ContactPoint', 'contactType' => 'customer service', 'name' => 'WhatsApp', 'telephone' => '+' . $SITE['whatsapp'], 'url' => 'https://wa.me/' . $SITE['whatsapp'], 'areaServed' => 'UG'],
        ],
        'knowsAbout'    => ['CCTV installation', 'Security cameras', 'IP cameras', 'PTZ cameras', 'Solar CCTV', '4G CCTV', 'NVR and DVR systems', 'Remote CCTV monitoring', 'Access control', 'Biometric attendance systems', 'Networking', 'Structured cabling', 'Wi-Fi installation', 'IT support', 'Windows Server', 'Cybersecurity', 'Computer hardware supply', 'Website design'],
        'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => 'CCTV, Security & ICT Services', 'itemListElement' => $catalog],
    ];
    if ($SITE['hours']) {
        $node['openingHours'] = $SITE['hours'];
    }
    $same = array_values(array_filter(array_merge(array_values($SITE['social']), [$SITE['google_business']])));
    if ($same) {
        $node['sameAs'] = $same;
    }
    return $node;
}

/** Service node for a service page. */
function service_node($name, $description, $file, array $items, $type = null)
{
    global $SITE;
    $offers = [];
    foreach ($items as $it) {
        $offers[] = ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $it]];
    }
    return [
        '@type'       => 'Service',
        '@id'         => abs_url($file) . '#service',
        'name'        => $name,
        'serviceType' => $type ?: $name,
        'description' => $description,
        'url'         => abs_url($file),
        'image'       => og_image_for($file),
        'provider'    => ['@id' => business_id()],
        'areaServed'  => [['@type' => 'City', 'name' => 'Kampala'], ['@type' => 'Country', 'name' => 'Uganda']],
        'availableChannel' => ['@type' => 'ServiceChannel', 'servicePhone' => ['@type' => 'ContactPoint', 'telephone' => '+256' . substr($SITE['phones'][0], 1)], 'serviceUrl' => abs_url('contact.php')],
        'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => $name, 'itemListElement' => $offers],
    ];
}

/** Full JSON-LD graph for the current page (printed in the footer, after FAQs have been collected). */
function seo_jsonld($title, $desc)
{
    global $SITE, $SEO_FAQ, $SEO_EXTRA, $SEO_CRUMBS;
    $file = current_file();
    $url  = abs_url($file);
    $base = $SITE['url'];

    $graph = [business_node()];
    $graph[] = [
        '@type'      => 'WebSite',
        '@id'        => $base . '/#website',
        'url'        => $base . '/',
        'name'       => $SITE['name'],
        'alternateName' => $SITE['alt_name'],
        'inLanguage' => 'en-UG',
        'publisher'  => ['@id' => business_id()],
        'potentialAction' => ['@type' => 'SearchAction', 'target' => ['@type' => 'EntryPoint', 'urlTemplate' => abs_url('search.php') . '?q={search_term_string}'], 'query-input' => 'required name=search_term_string'],
    ];
    $page = [
        '@type'      => $file === 'about.php' ? 'AboutPage' : ($file === 'contact.php' ? 'ContactPage' : 'WebPage'),
        '@id'        => $url . '#webpage',
        'url'        => $url,
        'name'       => $title,
        'description' => $desc,
        'inLanguage' => 'en-UG',
        'isPartOf'   => ['@id' => $base . '/#website'],
        'about'      => ['@id' => business_id()],
        'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => og_image_for($file), 'width' => 1200, 'height' => 630],
        'dateModified' => date('c', filemtime($_SERVER['SCRIPT_FILENAME'] ?? __FILE__)),
    ];
    if ($SEO_CRUMBS) {
        $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $base . '/']];
        foreach ($SEO_CRUMBS as $i => $c) {
            $items[] = ['@type' => 'ListItem', 'position' => $i + 2, 'name' => $c[0], 'item' => abs_url($c[1])];
        }
        $graph[] = ['@type' => 'BreadcrumbList', '@id' => $url . '#breadcrumb', 'itemListElement' => $items];
        $page['breadcrumb'] = ['@id' => $url . '#breadcrumb'];
    }
    $graph[] = $page;
    foreach ($SEO_EXTRA as $node) {
        $graph[] = $node;
    }
    if ($SEO_FAQ) {
        $qs = [];
        foreach ($SEO_FAQ as $q => $a) {
            $qs[] = ['@type' => 'Question', 'name' => $q, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $a]];
        }
        $graph[] = ['@type' => 'FAQPage', '@id' => $url . '#faq', 'url' => $url, 'isPartOf' => ['@id' => $base . '/#website'], 'mainEntity' => $qs];
    }
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
