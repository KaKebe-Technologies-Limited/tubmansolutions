<?php
/**
 * /llms.txt — a plain-language summary of the business for AI assistants and answer engines
 * (ChatGPT, Perplexity, Gemini, Claude, Copilot). Generated from config.php so it never goes stale.
 */
require_once __DIR__ . '/includes/config.php';
header('Content-Type: text/plain; charset=utf-8');

$L = [];
$L[] = '# ' . $SITE['name'];
$L[] = '';
$L[] = '> ' . $SITE['name'] . ' is a technology and security solutions company based in Kampala, Uganda. It provides professional CCTV camera installation, access control and biometric systems, networking and structured cabling, IT support, servers, cybersecurity, computer hardware supply and website design for homes, businesses, institutions and organizations across Uganda.';
$L[] = '';
$L[] = 'Tagline: ' . $SITE['tagline'];
$L[] = '';
$L[] = '## Contact (NAP)';
$L[] = '- Business name: ' . $SITE['name'];
$L[] = '- Location: ' . ($SITE['street'] ? $SITE['street'] . ', ' : '') . 'Kampala, Uganda';
$L[] = '- Phone: +256 ' . substr($SITE['phones'][0], 1) . ' / +256 ' . substr($SITE['phones'][1], 1);
$L[] = '- WhatsApp: +' . $SITE['whatsapp'] . ' (https://wa.me/' . $SITE['whatsapp'] . ')';
$L[] = '- Email: ' . $SITE['email'];
$L[] = '- Website: ' . $SITE['url'];
$L[] = '- Free quote: ' . abs_url('contact.php');
$L[] = '';
$L[] = '## Services';
foreach ($SERVICES as $s) {
    $L[] = '- [' . ($s['h1'] ?? $s['title']) . '](' . abs_url($s['page']) . '): ' . $s['excerpt'];
}
$L[] = '';
$L[] = '## CCTV capabilities';
$L[] = implode(', ', $CCTV_SERVICES) . '.';
$L[] = '';
$L[] = 'CCTV brands: Hikvision, Dahua, TP-Link, Ubiquiti and other compatible professional equipment (recommendations depend on requirements and availability).';
$L[] = '';
$L[] = '## Areas served';
$L[] = 'Kampala and surrounding areas including ' . implode(', ', $AREAS) . '; other locations in Uganda depending on project requirements.';
$L[] = '';
$L[] = '## Who it serves';
foreach ($INDUSTRIES as $i) {
    $L[] = '- ' . $i[0] . ': ' . $i[1];
}
$L[] = '';
$L[] = '## Selected clients';
$L[] = implode(', ', $CLIENTS) . '.';
$L[] = '';
$L[] = '## Frequently asked questions';
foreach (array_merge($FAQS, $FAQ_ICT, $FAQ_GENERAL) as $f) {
    $L[] = '### ' . $f[0];
    $L[] = $f[1];
    $L[] = '';
}
$L[] = '## Key pages';
foreach (['index.php' => 'Home', 'cctv.php' => 'CCTV installation in Kampala & Uganda', 'services.php' => 'All services', 'faq.php' => 'FAQ', 'about.php' => 'About', 'projects.php' => 'Projects & clients', 'contact.php' => 'Contact & free quote'] as $f => $label) {
    $L[] = '- [' . $label . '](' . abs_url($f) . ')';
}
echo implode("\n", $L) . "\n";
