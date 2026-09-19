<?php
/**
 * Site search: indexes every page, service, CCTV topic and FAQ from config.php,
 * then ranks results with synonyms, light stemming, prefix matching and typo tolerance.
 * Also returns an instant "answer" when a question matches an FAQ.
 */
require_once __DIR__ . '/config.php';

const SEARCH_STOP = ['a', 'an', 'the', 'and', 'or', 'for', 'to', 'of', 'in', 'on', 'at', 'is', 'are', 'do', 'does', 'you', 'your',
    'i', 'me', 'my', 'we', 'our', 'can', 'how', 'what', 'which', 'who', 'with', 'it', 'be', 'get', 'need', 'want', 'there', 'this', 'that',
    'best', 'top', 'good', 'company', 'companie', 'firm', 'please', 'from', 'by', 'about', 'any', 'some', 'will', 'am', 'have', 'has', 'offer', 'provide'];

const SEARCH_SYNONYMS = [
    'camera' => ['cctv', 'surveillance'], 'kamera' => ['camera', 'cctv'], 'cam' => ['camera', 'cctv'], 'cctv' => ['camera', 'surveillance'],
    'surveillance' => ['cctv', 'camera'], 'security' => ['cctv', 'surveillance', 'access'], 'monitor' => ['monitoring', 'surveillance'],
    'install' => ['installation'], 'installer' => ['installation'], 'installation' => ['install'], 'setup' => ['installation', 'configuration'],
    'fix' => ['repair', 'troubleshooting'], 'broken' => ['repair', 'troubleshooting'], 'repair' => ['troubleshooting', 'maintenance'],
    'maintain' => ['maintenance'], 'service' => ['maintenance', 'support'], 'upgrade' => ['upgrades'],
    'price' => ['cost', 'quotation', 'quote'], 'cost' => ['price', 'quotation'], 'much' => ['cost'], 'cheap' => ['affordable', 'cost'],
    'affordable' => ['cost', 'quotation'], 'quote' => ['quotation', 'cost'], 'charge' => ['cost'],
    'wifi' => ['wireless', 'network', 'networking'], 'internet' => ['wifi', 'network', 'connectivity'], 'network' => ['networking', 'lan'],
    'networking' => ['network'], 'lan' => ['network'], 'cable' => ['cabling'], 'cabling' => ['cable'], 'router' => ['network'],
    'fingerprint' => ['biometric', 'access'], 'biometric' => ['fingerprint', 'access', 'attendance'], 'attendance' => ['biometric'],
    'door' => ['access'], 'gate' => ['access', 'cctv'], 'face' => ['facial'], 'card' => ['rfid'], 'lock' => ['magnetic', 'access'],
    'computer' => ['desktop', 'laptop', 'hardware'], 'laptop' => ['computer', 'hardware'], 'pc' => ['computer', 'desktop'],
    'desktop' => ['computer'], 'printer' => ['printers'], 'ups' => ['power'],
    'website' => ['web', 'digital'], 'web' => ['website'], 'domain' => ['hosting'], 'hosting' => ['domain', 'website'],
    'email' => ['mail'], 'mail' => ['email'],
    'virus' => ['antivirus', 'cybersecurity'], 'hack' => ['cybersecurity', 'firewall'], 'hacker' => ['cybersecurity', 'firewall'],
    'cyber' => ['cybersecurity'], 'antivirus' => ['virus', 'endpoint'], 'firewall' => ['cybersecurity'],
    'server' => ['windows', 'infrastructure'], 'backup' => ['storage'], 'data' => ['backup', 'storage'],
    'phone' => ['mobile', 'remote', 'smartphone'], 'mobile' => ['phone', 'remote'], 'app' => ['mobile'], 'online' => ['remote'],
    'solar' => ['power'], 'night' => ['infrared', 'vision'], 'dark' => ['night'], 'color' => ['colorvu'], 'colour' => ['colorvu', 'color'],
    'near' => ['kampala', 'area'], 'location' => ['kampala', 'located'], 'where' => ['location', 'located', 'kampala'], 'area' => ['kampala'],
    'call' => ['phone', 'contact'], 'contact' => ['phone', 'whatsapp', 'email'], 'whatsapp' => ['contact', 'chat'], 'number' => ['phone', 'contact'],
    'home' => ['house', 'residential'], 'house' => ['home', 'residential'], 'shop' => ['business', 'supermarket'], 'store' => ['shop', 'business'],
    'office' => ['business', 'corporate'], 'hotel' => ['hotels'], 'school' => ['institution'], 'farm' => ['poultry', 'remote'],
    'construction' => ['site'], 'warehouse' => ['stock'], 'hikvision' => ['brand'], 'dahua' => ['brand'], 'brand' => ['hikvision', 'dahua'],
];

function search_normalise($text)
{
    $t = mb_strtolower((string) $text, 'UTF-8');
    $t = str_replace(['wi-fi', 'wi fi', 'e-mail', 'solar-powered', 'night-vision', 'full-color', 'full-colour', '4g/lte', 'nvr/dvr', 'dvr/nvr', 'rfid/card', 'pin/keypad'],
                     ['wifi', 'wifi', 'email', 'solar powered', 'night vision', 'full color', 'full colour', '4g lte', 'nvr dvr', 'dvr nvr', 'rfid card', 'pin keypad'], $t);
    return preg_replace('/[^a-z0-9\s]+/u', ' ', $t);
}

function search_stem($w)
{
    if (strlen($w) > 4 && substr($w, -3) === 'ies') {
        return substr($w, 0, -3) . 'y';
    }
    if (strlen($w) > 3 && substr($w, -1) === 's' && substr($w, -2) !== 'ss' && substr($w, -2) !== 'us') {
        return substr($w, 0, -1);
    }
    return $w;
}

function search_tokens($text, $keep_stop = false)
{
    $out = [];
    foreach (preg_split('/\s+/', search_normalise($text), -1, PREG_SPLIT_NO_EMPTY) as $w) {
        $w = search_stem($w);
        if ($keep_stop || !in_array($w, SEARCH_STOP, true)) {
            $out[] = $w;
        }
    }
    return $out;
}

/** Every searchable thing on the site. */
function search_documents()
{
    static $docs = null;
    if ($docs !== null) {
        return $docs;
    }
    global $SITE, $SERVICES, $FAQS, $FAQ_ICT, $FAQ_GENERAL, $INDUSTRIES, $CCTV_TECH, $CCTV_ENVIRONMENTS, $CCTV_SERVICES, $CCTV_PROCESS, $CLIENTS, $AREAS, $VALUES, $WHY;
    $docs = [];
    $add = function ($type, $title, $url, $body, $kw = '', $boost = 1.0, $answer = '') use (&$docs) {
        $docs[] = [
            'type' => $type, 'title' => $title, 'url' => $url, 'body' => $body, 'answer' => $answer, 'boost' => $boost,
            't' => array_flip(search_tokens($title)), 'k' => array_flip(search_tokens($kw)), 'b' => array_flip(search_tokens($body)),
            'norm_title' => ' ' . trim(preg_replace('/\s+/', ' ', search_normalise($title))) . ' ',
            'norm_body'  => ' ' . trim(preg_replace('/\s+/', ' ', search_normalise($body))) . ' ',
        ];
    };

    // CCTV (primary service)
    $add('Service', 'CCTV Installation in Kampala & Uganda', 'cctv.php',
        'Professional CCTV installation for homes, businesses, offices, warehouses, farms, schools and construction sites. ' . implode('. ', $CCTV_SERVICES) . '. Site assessment, remote viewing on your phone, maintenance and repair.',
        'cctv camera cameras security surveillance install installation installer kampala uganda near me price cost', 1.35);
    foreach ($CCTV_TECH as $t) {
        $add('CCTV', $t[1], 'cctv.php#' . $t[0], $t[2], 'cctv camera ' . $t[0], 1.15);
    }
    foreach ($CCTV_ENVIRONMENTS as $t) {
        $add('CCTV', $t[0], 'cctv.php#environments', $t[1], 'cctv camera surveillance', 1.1);
    }
    $add('CCTV', 'Our 7-Step CCTV Installation Process', 'cctv.php#process',
        implode('. ', array_map(function ($p) { return $p[0] . ': ' . $p[1]; }, $CCTV_PROCESS)), 'cctv process steps how installation', 1.0);
    $add('CCTV', 'CCTV Maintenance, Repair & Upgrades', 'cctv.php#maintenance',
        'CCTV troubleshooting, maintenance, upgrades and reconfiguration for existing systems. Cameras offline, no recording or poor picture? Camera relocation, hard disk replacement, NVR/DVR settings and mobile app setup.',
        'cctv repair fix broken not working troubleshooting maintenance upgrade hard disk', 1.2);
    $add('CCTV', 'Request a CCTV Site Assessment & Free Quote', 'cctv.php#site-assessment',
        'Tell us about your property and what you want to monitor. We assess your requirements and prepare a quotation based on the proposed solution.',
        'cctv quote quotation price cost site assessment visit survey free', 1.1);
    $add('CCTV', 'CCTV Installers Near You — Areas We Serve', 'cctv.php#areas',
        'Based in Kampala, serving ' . implode(', ', $AREAS) . ' and other locations in Uganda on request.', 'near me location area where kampala cctv installer', 1.05);

    // other services
    foreach ($SERVICES as $key => $s) {
        if ($key === 'cctv') {
            continue;
        }
        $extra = !empty($s['extra']) ? ' ' . $s['extra']['title'] . ': ' . $s['extra']['text'] . ' ' . implode(', ', $s['extra']['tags']) : '';
        $add('Service', $s['h1'], $s['page'], $s['excerpt'] . ' ' . implode(' ', $s['intro']) . ' ' . implode('. ', $s['list']) . '.' . $extra,
            $s['title'] . ' ' . $s['nav'] . ' ' . $s['option'], 1.15);
    }

    // FAQs (with instant answers)
    foreach (array_merge($FAQS, $FAQ_ICT, $FAQ_GENERAL) as $f) {
        $add('FAQ', $f[0], 'faq.php#' . faq_slug_for_search($f[0]), $f[1], '', 1.0, $f[1]);
    }
    foreach ($INDUSTRIES as $ind) {
        $add('Industry', $ind[0], 'services.php#industries', $ind[1], 'industry sector', 0.9);
    }

    // pages
    $add('Page', 'Contact H.Tubman Solutions', 'contact.php',
        "Call {$SITE['phones'][0]} or {$SITE['phones'][1]}, WhatsApp {$SITE['whatsapp_display']}, email {$SITE['email']}. Located in Kampala, Uganda. Request a quote.",
        'contact phone call number whatsapp email address location office talk quote reach', 1.0,
        "Call {$SITE['phones'][0]} / {$SITE['phones'][1]}, WhatsApp {$SITE['whatsapp_display']} or email {$SITE['email']}. We are based in Kampala, Uganda.");
    $add('Page', 'About H.Tubman Solutions Limited', 'about.php',
        'A Ugandan technology solutions company providing professional CCTV, security, networking, IT support and digital technology services. ' . implode('. ', array_column($VALUES, 0)) . '. ' . implode('. ', array_column($WHY, 0)) . '.',
        'about company who mission vision values team', 0.9);
    $add('Page', 'Projects, Experience & Clients', 'projects.php',
        'Selected clients: ' . implode(', ', $CLIENTS) . '. CCTV installation, network infrastructure, IT support, biometric installation, access control and server configuration projects.',
        'projects clients portfolio experience work references', 0.9);
    $add('Page', 'All ICT Services in Uganda', 'services.php', 'CCTV, networking, access control, IT support, servers, cybersecurity, hardware supply and website solutions.', 'services all solutions', 0.8);
    $add('Page', 'Frequently Asked Questions', 'faq.php', 'Answers about CCTV installation cost, remote viewing, solar CCTV, repairs, IT support, Wi-Fi, biometrics and quotes.', 'faq questions answers help', 0.8);
    return $docs;
}

function faq_slug_for_search($q)
{
    return function_exists('faq_slug') ? faq_slug($q) : 'q-' . trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($q)), '-');
}

/** Global vocabulary for typo correction. */
function search_vocab()
{
    static $v = null;
    if ($v === null) {
        $v = [];
        foreach (search_documents() as $d) {
            $v += $d['t'] + $d['k'] + $d['b'];
        }
    }
    return $v;
}

function search_fuzzy_fix($term)
{
    $len = strlen($term);
    if ($len < 4 || ctype_digit($term)) {
        return null;
    }
    $max = $len >= 7 ? 2 : 1;
    $best = null;
    $bestd = 99;
    foreach (search_vocab() as $w => $_) {
        $w = (string) $w;
        if (abs(strlen($w) - $len) > $max) {
            continue;
        }
        $d = levenshtein($term, $w);
        if ($d <= $max && $d < $bestd) {
            $best = $w;
            $bestd = $d;
        }
    }
    return $best;
}

/**
 * @return array ['query','did_you_mean','answer','results','total']
 */
function search_run($query, $limit = 20)
{
    $query = trim(mb_substr((string) $query, 0, 120));
    $terms = array_values(array_unique(search_tokens($query)));
    $out = ['query' => $query, 'did_you_mean' => null, 'answer' => null, 'results' => [], 'total' => 0];
    if (!$terms) {
        return $out;
    }

    $vocab = search_vocab();
    $groups = [];
    $corrected = [];
    $changed = false;
    foreach ($terms as $t) {
        $g = [$t => 1.0];
        if (!isset($vocab[$t]) && !isset(SEARCH_SYNONYMS[$t])) {
            if ($fix = search_fuzzy_fix($t)) {
                $g[$fix] = 0.6;
                $corrected[] = $fix;
                $changed = true;
            } else {
                $corrected[] = $t;
            }
        } else {
            $corrected[] = $t;
        }
        foreach (SEARCH_SYNONYMS[$t] ?? [] as $syn) {
            $g[search_stem($syn)] = $g[search_stem($syn)] ?? 0.75;
        }
        $groups[] = $g;
    }
    if ($changed) {
        $out['did_you_mean'] = implode(' ', $corrected);
    }

    $phrase = ' ' . trim(preg_replace('/\s+/', ' ', search_normalise($query))) . ' ';
    $scored = [];
    foreach (search_documents() as $doc) {
        $score = 0;
        $hit_groups = 0;
        $hits = [];
        foreach ($groups as $g) {
            $best = 0;
            foreach ($g as $word => $wq) {
                $word = (string) $word;
                foreach (['t' => 6, 'k' => 4, 'b' => 1.5] as $field => $fw) {
                    if (isset($doc[$field][$word])) {
                        $m = $fw * $wq;
                    } elseif (strlen($word) >= 4 && search_prefix_hit($word, $doc[$field])) {
                        $m = $fw * $wq * 0.7;
                    } else {
                        continue;
                    }
                    if ($m > $best) {
                        $best = $m;
                    }
                    $hits[$word] = true;
                }
            }
            if ($best > 0) {
                $hit_groups++;
                $score += $best;
            }
        }
        if (!$hit_groups) {
            continue;
        }
        $coverage = $hit_groups / count($groups);
        $score *= pow($coverage, 1.5) * $doc['boost'];
        if (strlen(trim($phrase)) > 3) {
            if (strpos($doc['norm_title'], $phrase) !== false || strpos($doc['norm_title'], trim($phrase)) !== false) {
                $score += 8;
            } elseif (strpos($doc['norm_body'], trim($phrase)) !== false) {
                $score += 3;
            }
        }
        $scored[] = ['doc' => $doc, 'score' => $score, 'coverage' => $coverage, 'hits' => array_keys($hits)];
    }
    usort($scored, function ($a, $b) { return $b['score'] <=> $a['score']; });

    // keep one result per URL (best scoring), then trim weak tail
    $seen = [];
    $top = $scored ? $scored[0]['score'] : 0;
    foreach ($scored as $r) {
        if (isset($seen[$r['doc']['url']]) || $r['score'] < $top * 0.12) {
            continue;
        }
        $seen[$r['doc']['url']] = true;
        $out['results'][] = [
            'title'   => $r['doc']['title'],
            'url'     => $r['doc']['url'],
            'type'    => $r['doc']['type'],
            'snippet' => search_snippet($r['doc']['body'], $r['hits']),
            'score'   => round($r['score'], 2),
        ];
    }
    $out['total'] = count($out['results']);
    $out['results'] = array_slice($out['results'], 0, $limit);

    // instant answer: best result is an FAQ / contact card that clearly matches the question
    if ($scored && $scored[0]['doc']['answer'] !== '' && $scored[0]['coverage'] >= 0.6) {
        $second = $scored[1]['score'] ?? 0;
        if ($scored[0]['coverage'] == 1 || $scored[0]['score'] >= $second * 1.25) {
            $out['answer'] = ['question' => $scored[0]['doc']['title'], 'text' => $scored[0]['doc']['answer'], 'url' => $scored[0]['doc']['url']];
        }
    }
    return $out;
}

function search_prefix_hit($word, array $field)
{
    foreach ($field as $w => $_) {
        $w = (string) $w;
        if (strlen($w) >= 4 && (strpos($w, $word) === 0 || strpos($word, $w) === 0)) {
            return true;
        }
    }
    return false;
}

/** Short excerpt around the matched words, with <mark> highlighting (returned HTML-escaped). */
function search_snippet($body, array $hits)
{
    $sentences = preg_split('/(?<=[.!?])\s+/', $body);
    $best = $sentences[0] ?? '';
    $bestn = -1;
    foreach ($sentences as $s) {
        $toks = array_flip(search_tokens($s));
        $n = 0;
        foreach ($hits as $h) {
            if (isset($toks[$h])) {
                $n++;
            }
        }
        if ($n > $bestn) {
            $best = $s;
            $bestn = $n;
        }
    }
    if (mb_strlen($best) > 190) {
        $best = mb_substr($best, 0, 187) . '…';
    }
    $html = htmlspecialchars($best, ENT_QUOTES, 'UTF-8');
    $hits = array_filter($hits, function ($h) { return strlen($h) >= 3; });
    if ($hits) {
        usort($hits, function ($a, $b) { return strlen($b) - strlen($a); });
        $re = '/\b(' . implode('|', array_map(function ($h) { return preg_quote($h, '/'); }, $hits)) . ')([a-z]*)/i';
        $html = preg_replace($re, '<mark>$1$2</mark>', $html);
    }
    return $html;
}
