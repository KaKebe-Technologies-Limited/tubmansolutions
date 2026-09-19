<?php
/** Emits the text for every share (Open Graph) image as JSON. Used by tools/make-og-images.py. */
require_once dirname(__DIR__) . '/includes/config.php';

$short = function ($s, $max) { // cut on a word boundary
    if (mb_strlen($s) <= $max) {
        return $s;
    }
    $cut = mb_substr($s, 0, $max);
    return rtrim(mb_substr($cut, 0, (int) mb_strrpos($cut, ' ')), ' ,.;') . '…';
};
$fmt = function ($p) { return preg_replace('/^(\d{4})(\d{3})(\d{3})$/', '$1 $2 $3', $p); };
$pages = [
    '' => ['KAMPALA · UGANDA', 'CCTV & ICT Solutions You Can Trust in Uganda', 'Genuine equipment · Quality installation · Reliable support', ['CCTV', 'Networking', 'Access Control', 'IT Support']],
    'cctv-installation-uganda' => ['CCTV INSTALLATION', 'Professional CCTV Installation in Kampala & Uganda', 'Homes · Businesses · Solar & 4G · View cameras on your phone', ['Site Assessment', 'IP & PTZ', 'Solar CCTV', 'Repairs']],
    'ict-services-uganda' => ['ICT SERVICES', 'CCTV, Networking, Access Control & IT Support', 'One trusted partner for security & technology in Uganda', ['CCTV', 'Wi-Fi & LAN', 'Biometrics', 'Servers']],
    'about-us' => ['ABOUT US', 'Smart Technology. Secure Businesses. Connected Futures.', 'A Ugandan technology & security solutions company', ['Reliability', 'Integrity', 'Innovation']],
    'projects' => ['PROJECTS & CLIENTS', 'Trusted by Businesses Across Uganda', 'CCTV · Networks · Biometrics · IT infrastructure', ['Energy', 'Hospitality', 'Agriculture', 'Construction']],
    'faq' => ['FAQ', 'CCTV & IT Questions, Answered', 'Cost · Installation · Repairs · Remote viewing · Support', ['CCTV', 'Wi-Fi', 'Biometrics', 'IT Support']],
    'contact-us' => ['GET A FREE QUOTE', 'Let’s Secure & Connect Your Business', 'Call, WhatsApp or email our technical team today', ['Call', 'WhatsApp', 'Email']],
];
foreach ($SERVICES as $key => $s) {
    if ($key === 'cctv') {
        continue;
    }
    $chips = array_map(function ($c) use ($short) { return $short($c, 22); }, array_slice($s['list'], 0, 4));
    $pages[$ROUTES[$s['page']]] = [mb_strtoupper($s['title']), $s['h1'], $short(end($s['intro']), 105), $chips];
}

$out = ['brand' => [
    'phones'   => array_map($fmt, $SITE['phones']),
    'whatsapp' => $SITE['whatsapp_display'],
    'domain'   => preg_replace('#^https?://(www\.)?#', '', $SITE['url']),
], 'pages' => []];
foreach ($pages as $slug => $p) {
    $out['pages'][] = ['file' => ($slug === '' ? 'home' : $slug) . '.png', 'eyebrow' => $p[0], 'headline' => $p[1], 'sub' => $p[2], 'chips' => $p[3]];
}
echo json_encode($out, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
