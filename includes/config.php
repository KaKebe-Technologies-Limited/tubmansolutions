<?php
/**
 * H.Tubman Solutions Limited — site configuration & shared content.
 * Edit contact details, images and service content here; every page reads from this file.
 */

date_default_timezone_set('Africa/Kampala');

$SITE = [
    'name'      => 'H.Tubman Solutions Limited',
    'short'     => 'H.Tubman Solutions',
    'tagline'   => 'Smart Technology. Secure Businesses. Connected Futures.',
    'location'  => 'Kampala, Uganda',
    'phones'    => ['0789977270', '0784801913'],
    'whatsapp'  => '256768743419',               // international format, no "+" (0768 743 419)
    'whatsapp_display' => '0768 743 419',
    'email'     => 'info@htubmansolutions.com',
    'website'   => 'www.htubmansolutions.com',
    'url'       => 'https://www.htubmansolutions.com',    // production base URL (canonical, sitemap, schema, share images)
    'lines'     => 'CCTV & Security | Networking | IT Support | Access Control | Servers | Digital Solutions',

    /* --- Local SEO / NAP: keep these IDENTICAL on Google Business Profile, directories and social pages --- */
    'alt_name'    => 'H.Tubman Solutions',
    'street'      => '',                 // e.g. 'Plot 12, Ntinda Road' - add once the Google Business Profile address is set
    'region'      => 'Central Region',
    'price_range' => '$$',
    'hours'       => [],                 // e.g. ['Mo-Fr 08:00-18:00', 'Sa 09:00-14:00'] (schema.org openingHours format)
    'social'      => [                   // paste full profile URLs; empty ones are ignored
        'facebook'  => '',
        'instagram' => '',
        'linkedin'  => '',
        'x'         => '',
        'tiktok'    => '',
        'youtube'   => '',
    ],
    'google_business' => '',             // Google Maps / Business Profile URL
    'google_review'   => '',             // "Write a review" short link from Google Business Profile
];

/* ---------------------------------------------------------------
 * SEO-friendly URLs: PHP file => public slug ('' = site root).
 * Apache maps them in .htaccess; router.php does it for `php -S`.
 * ------------------------------------------------------------- */
$ROUTES = [
    'index.php'             => '',
    'cctv.php'              => 'cctv-installation-uganda',
    'services.php'          => 'ict-services-uganda',
    'networking.php'        => 'networking-structured-cabling-kampala',
    'access-control.php'    => 'access-control-biometrics-uganda',
    'it-support.php'        => 'it-support-kampala',
    'servers.php'           => 'server-installation-uganda',
    'cybersecurity.php'     => 'cybersecurity-services-uganda',
    'hardware.php'          => 'computer-hardware-supply-uganda',
    'digital-solutions.php' => 'website-design-kampala',
    'about.php'             => 'about-us',
    'projects.php'          => 'projects',
    'faq.php'               => 'faq',
    'contact.php'           => 'contact-us',
    'search.php'            => 'search',
];

/** Public (relative) URL for a page file, keeping any ?query or #hash: u('contact.php#quote'). */
function u($file)
{
    global $ROUTES;
    if (preg_match('/^([a-z0-9-]+\.php)(.*)$/', $file, $m) && isset($ROUTES[$m[1]])) {
        return ($ROUTES[$m[1]] === '' ? './' : $ROUTES[$m[1]]) . $m[2];
    }
    return $file;
}

/** Absolute canonical URL for a page file. */
function abs_url($file = 'index.php')
{
    global $ROUTES, $SITE;
    return $SITE['url'] . '/' . ($ROUTES[$file] ?? $file);
}

/* ---------------------------------------------------------------
 * Images. Values are Unsplash photo IDs (hot-linked) or a local
 * path such as "assets/img/projects/site-1.jpg" — replace with
 * real H.Tubman project photos whenever they are available.
 * ------------------------------------------------------------- */
$IMAGES = [
    // no people
    'cctv-wall'       => '1557597774-9d273605dfa9',
    'cctv-pole'       => '1589935447067-5531094415d1',
    'cctv-sign'       => '1590856029826-c7a73142bbf1',
    'network-cables'  => '1544197150-b99a580bb7a8',
    'network-switch'  => '1551703599-6b3e8379aa8c',
    'fiber-rack'      => '1520869562399-e772f042f422',
    'server-rack'     => '1558494949-ef010cbdcc31',
    'vault'           => '1582139329536-e7284fece509',
    'padlock'         => '1614064641938-3bbee52942c7',
    'circuit'         => '1550751827-4bd374c3f58b',
    'circuit-green'   => '1517077304055-6e89abbf09b0',
    'printer'         => '1612815154858-60aa4c59eaa6',
    'cpu'             => '1591799264318-7e6ef8ddb7ea',
    'web-design'      => '1547658719-da2b51169166',
    'analytics'       => '1460925895917-afdab827c52f',
    'dashboard'       => '1551288049-bebda4e38f71',
    'home'            => '1600585154340-be6161a56a0c',
    'shop'            => '1604719312566-8912e9227c6a',
    'office'          => '1497366216548-37526070297c',
    'school'          => '1580582932707-520aed937b7b',
    'warehouse'       => '1553413077-190dd305871c',
    'farm'            => '1535379453347-1ffd615e2e08',
    'construction'    => '1535732759880-bbd5c7265e3f',
    'city'            => '1486406146926-c627a92ad1ab',
    // people (Black professionals)
    'technician'      => '1621905251189-08b45d6a269e',
    'technician-2'    => '1621905252507-b35492cc74b4',
    'team-desk'       => '1531482615713-2afd69097998',
    'server-woman'    => '1573164713988-8665fc963095',
    'meeting'         => '1573496267526-08a69e46a409',
    'professional'    => '1573497019418-b400bb3ab074',
];

function img($key, $w = 1200, $h = null)
{
    global $IMAGES;
    $src = $IMAGES[$key] ?? $key;
    if (strpos($src, '/') !== false) {
        return $src; // local file
    }
    $url = 'https://images.unsplash.com/photo-' . $src . '?auto=format&fit=crop&q=75&w=' . (int) $w;
    if ($h) {
        $url .= '&h=' . (int) $h;
    }
    return $url;
}

/* ---------------- helpers ---------------- */
function e($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

function tel($phone)
{
    return 'tel:+256' . ltrim(preg_replace('/\D/', '', $phone), '0');
}

function wa($message = 'Hello H.Tubman Solutions, I would like to enquire about your services.')
{
    global $SITE;
    return 'https://wa.me/' . $SITE['whatsapp'] . '?text=' . rawurlencode($message);
}

/* ---------------- services (homepage priority order) ---------------- */
$SERVICES = [
    'cctv' => [
        'h1'      => 'Professional CCTV Installation in Kampala & Uganda',
        'option'  => 'CCTV Installation',
        'title'   => 'CCTV & Security Systems',
        'nav'     => 'CCTV Installation',
        'page'    => 'cctv.php',
        'icon'    => 'fa-video',
        'img'     => 'cctv-pole',
        'excerpt' => 'Professional CCTV design, installation, remote viewing and maintenance for homes, businesses and institutions.',
    ],
    'networking' => [
        'h1'      => 'Networking, Wi-Fi & Structured Cabling in Kampala',
        'option'  => 'Networking & Wi-Fi',
        'title'   => 'Networking & Infrastructure',
        'nav'     => 'Networking',
        'page'    => 'networking.php',
        'icon'    => 'fa-network-wired',
        'img'     => 'network-switch',
        'banner'  => 'fiber-rack',
        'excerpt' => 'Wired and wireless networks, structured cabling and Wi-Fi designed, installed and maintained for reliability.',
        'seo_title' => 'Networking, Wi-Fi & Structured Cabling Kampala | H.Tubman',
        'seo_desc'  => 'Reliable networking, structured cabling & Wi-Fi installation for offices and homes in Kampala. Quality installation and quick support. Get a free quote today.',
        'headline'  => ['Reliable Networks for', 'Connected Businesses'],
        'intro'     => [
            'Your business depends on a stable network.',
            'We design, install, configure and maintain wired and wireless networks for homes, offices, businesses and institutions.',
        ],
        'list_title' => 'Networking Services',
        'list'      => ['LAN installation', 'Wi-Fi installation', 'Structured cabling', 'Network configuration', 'Router configuration', 'Switch configuration', 'Wireless access points', 'VLAN configuration', 'Network troubleshooting', 'Internet sharing', 'Network expansion', 'Network optimization', 'Point-to-point wireless links', 'Network security', 'Rack installation and organization', 'Network documentation'],
        'extra'     => [
            'title' => 'Enterprise & Business Networking',
            'text'  => 'We help businesses build reliable infrastructure that supports:',
            'tags'  => ['Computers', 'Printers', 'Servers', 'CCTV systems', 'VoIP', 'Wi-Fi', 'Access control', 'Internet connectivity', 'Business applications'],
        ],
        'cta'       => 'Talk to a Network Specialist',
    ],
    'access-control' => [
        'h1'      => 'Access Control & Biometric Systems in Uganda',
        'option'  => 'Access Control & Biometrics',
        'title'   => 'Access Control & Biometrics',
        'nav'     => 'Access Control & Biometrics',
        'page'    => 'access-control.php',
        'icon'    => 'fa-fingerprint',
        'img'     => 'vault',
        'excerpt' => 'Fingerprint, facial recognition, card and PIN access with attendance and visitor management.',
        'seo_title' => 'Access Control & Fingerprint Attendance Uganda | H.Tubman',
        'seo_desc'  => 'Fingerprint & facial recognition, RFID card access, magnetic locks and biometric time attendance for offices, schools, hotels and warehouses in Uganda. Free quote.',
        'headline'  => ['Control Who Enters', 'Your Premises'],
        'intro'     => [
            'Improve physical security and manage access to your premises using modern access control technology.',
        ],
        'list_title' => 'Access Control Solutions',
        'list'      => ['Fingerprint biometric systems', 'Facial recognition', 'RFID/card access', 'PIN/keypad access', 'Door access control', 'Magnetic locks', 'Exit buttons', 'Attendance systems', 'Visitor management', 'Access control software', 'Biometric time attendance', 'Access control integration'],
        'extra'     => [
            'title' => 'Suitable For',
            'text'  => 'Our access control and biometric systems are deployed across a wide range of premises:',
            'tags'  => ['Offices', 'Schools', 'Hotels', 'Warehouses', 'Apartments', 'Construction sites', 'Institutions', 'Commercial buildings'],
        ],
        'cta'       => 'Request an Access Control Quote',
    ],
    'it-support' => [
        'h1'      => 'IT Support & Managed IT Services in Kampala',
        'option'  => 'IT Support',
        'title'   => 'IT Support & Managed Services',
        'nav'     => 'IT Support',
        'page'    => 'it-support.php',
        'icon'    => 'fa-headset',
        'img'     => 'team-desk',
        'excerpt' => 'On-site and remote IT support, maintenance and managed services that keep your team productive.',
        'seo_title' => 'IT Support Kampala | Business IT Services Uganda | H.Tubman Solutions',
        'seo_desc'  => 'Quick, reliable IT support for businesses in Kampala: computers, printers, email, backups, networks and servers - on-site, remote or managed. Contact us today.',
        'headline'  => ['Technology Support That Keeps', 'Your Business Moving'],
        'intro'     => [
            'Technical problems can interrupt business operations.',
            'H.Tubman Solutions provides professional IT support to help organizations maintain reliable and productive technology environments.',
        ],
        'list_title' => 'IT Support Services',
        'list'      => ['Computer troubleshooting', 'Windows installation & configuration', 'Software installation', 'Hardware troubleshooting', 'Printer configuration', 'Network troubleshooting', 'Server support', 'User support', 'Email configuration', 'Backup solutions', 'System maintenance', 'IT infrastructure support', 'Remote technical support', 'On-site technical support'],
        'extra'     => [
            'title' => 'Managed IT Support',
            'text'  => 'For organizations that need continuous technical assistance, we can provide scheduled or ongoing IT support services.',
            'tags'  => [],
        ],
        'cta'       => 'Request IT Support',
    ],
    'servers' => [
        'h1'      => 'Server Installation & Data Solutions in Uganda',
        'option'  => 'Servers & Infrastructure',
        'title'   => 'Servers & Data Solutions',
        'nav'     => 'Servers & Infrastructure',
        'page'    => 'servers.php',
        'icon'    => 'fa-server',
        'img'     => 'server-woman',
        'banner'  => 'server-rack',
        'excerpt' => 'Windows Server, Active Directory, file servers, storage and backups built for your operations.',
        'seo_title' => 'Server Installation & Backup Solutions Uganda | H.Tubman',
        'seo_desc'  => 'Windows Server, Active Directory, DNS & DHCP, file servers, network storage and backup solutions for organizations in Uganda. Talk to an infrastructure expert.',
        'headline'  => ['Build a Reliable', 'IT Infrastructure'],
        'intro'     => [
            'We help organizations deploy and maintain server and data infrastructure suitable for their operational requirements.',
        ],
        'list_title' => 'Server & Data Services',
        'list'      => ['Windows Server deployment', 'Active Directory', 'DNS & DHCP', 'File servers', 'User and group management', 'Network storage', 'Backup solutions', 'Server maintenance', 'Server configuration', 'Data management', 'Access permissions', 'Infrastructure troubleshooting'],
        'cta'       => 'Talk to an Infrastructure Expert',
    ],
    'cybersecurity' => [
        'h1'      => 'Cybersecurity Services for Businesses in Uganda',
        'option'  => 'Cybersecurity',
        'title'   => 'Cybersecurity',
        'nav'     => 'Cybersecurity',
        'page'    => 'cybersecurity.php',
        'icon'    => 'fa-shield-halved',
        'img'     => 'padlock',
        'banner'  => 'circuit',
        'excerpt' => 'Endpoint protection, firewalls, access controls and practical security for your digital environment.',
        'seo_title' => 'Cybersecurity Services Uganda | Firewall & Antivirus | H.Tubman',
        'seo_desc'  => 'Practical cybersecurity for Ugandan businesses: endpoint security, antivirus, firewall configuration, network security, backup planning and security assessments.',
        'headline'  => ['Protect Your', 'Digital Environment'],
        'intro'     => [
            'Modern businesses face increasing digital security risks.',
            'We help organizations strengthen their IT environments through practical security solutions.',
        ],
        'list_title' => 'Cybersecurity Services',
        'list'      => ['Endpoint security', 'Antivirus deployment', 'Firewall configuration', 'Network security', 'User access controls', 'Password security', 'Security policy configuration', 'System updates', 'Backup planning', 'Security monitoring', 'Basic security assessments'],
        'cta'       => 'Strengthen Your Security',
    ],
    'hardware' => [
        'h1'      => 'Computer & Hardware Supply in Uganda',
        'option'  => 'Hardware / Equipment Supply',
        'title'   => 'Hardware & Technology Supply',
        'nav'     => 'Hardware Solutions',
        'page'    => 'hardware.php',
        'icon'    => 'fa-computer',
        'img'     => 'cpu',
        'banner'  => 'circuit-green',
        'excerpt' => 'Supply, installation and maintenance of computers, printers, networking, CCTV and UPS equipment.',
        'seo_title' => 'Computer, Laptop & Printer Supply Uganda | H.Tubman',
        'seo_desc'  => 'Genuine desktops, laptops, servers, printers, networking, CCTV & access control equipment and UPS systems in Uganda - supplied, installed and maintained.',
        'headline'  => ['Technology Supply', '& Maintenance'],
        'intro'     => [
            'We supply, install and maintain a range of technology equipment for businesses and organizations.',
        ],
        'list_title' => 'Products & Equipment',
        'list'      => ['Desktop computers', 'Laptops', 'Servers', 'Printers', 'Networking equipment', 'CCTV equipment', 'Access control equipment', 'Storage devices', 'UPS systems', 'Wi-Fi equipment', 'Computer accessories', 'Structured cabling materials'],
        'extra'     => [
            'title' => 'Maintenance',
            'text'  => 'We provide hardware diagnostics, repairs, upgrades, preventive maintenance and replacement recommendations.',
            'tags'  => [],
        ],
        'cta'       => 'Request Equipment Quote',
    ],
    'digital-solutions' => [
        'h1'      => 'Website Design & Digital Solutions in Kampala',
        'option'  => 'Website & Digital Solutions',
        'title'   => 'Website & Digital Solutions',
        'nav'     => 'Website & Digital Solutions',
        'page'    => 'digital-solutions.php',
        'icon'    => 'fa-laptop-code',
        'img'     => 'web-design',
        'banner'  => 'analytics',
        'excerpt' => 'Business websites, domains, hosting, business email and ongoing updates for a strong online presence.',
        'seo_title' => 'Website Design Kampala | Business Websites & Email | H.Tubman',
        'seo_desc'  => 'Affordable, professional business websites in Kampala: design, development, hosting & domain support, business email setup, maintenance and basic SEO.',
        'headline'  => ['Build a Strong', 'Digital Presence'],
        'intro'     => [
            'Your website is often the first place potential customers encounter your business.',
            'We provide practical digital solutions designed to help businesses establish and maintain their online presence.',
        ],
        'list_title' => 'Digital Services',
        'list'      => ['Business websites', 'Website design', 'Website development', 'Website maintenance', 'Domain & hosting support', 'Business email setup', 'Website updates', 'Basic SEO setup', 'Digital business solutions'],
        'cta'       => 'Start Your Website Project',
    ],
];

/* ---------------- industries ---------------- */
$INDUSTRIES = [
    ['Residential', 'CCTV, Wi-Fi, networking and smart security solutions for homes.', 'fa-house', 'home'],
    ['Small & Medium Businesses', 'Complete IT, CCTV, networking and access control solutions.', 'fa-store', 'sme'],
    ['Corporate Offices', 'Network infrastructure, CCTV, access control, IT support and server solutions.', 'fa-building', 'office'],
    ['Schools & Institutions', 'CCTV surveillance, access control, networking and IT infrastructure.', 'fa-school', 'school'],
    ['Warehouses', 'Surveillance, access control, networking and security monitoring.', 'fa-warehouse', 'warehouse'],
    ['Farms & Remote Sites', 'Solar CCTV, wireless connectivity and remote surveillance solutions.', 'fa-tractor', 'farm'],
    ['Construction Sites', 'Temporary or permanent CCTV, access control and network solutions.', 'fa-helmet-safety', 'construction'],
];

/* ---------------- CCTV environments ---------------- */
$ENVIRONMENTS = [
    ['Homes', 'Monitor entrances, compounds, garages and other important areas.', 'fa-house'],
    ['Businesses', 'Protect offices, shops, restaurants, supermarkets and commercial premises.', 'fa-store'],
    ['Warehouses', 'Monitor stock areas, loading zones, entrances and sensitive sections.', 'fa-warehouse'],
    ['Farms', 'Monitor large compounds, gates, equipment and remote areas.', 'fa-tractor'],
    ['Schools & Institutions', 'Improve visibility around classrooms, entrances, compounds and facilities.', 'fa-school'],
    ['Construction Sites', 'Monitor equipment, materials, workers and site access.', 'fa-helmet-safety'],
];

/* ---------------- FAQ ---------------- */
$FAQS = [
    ['How much does CCTV installation cost in Uganda?', 'CCTV installation costs depend on the number and type of cameras, recording requirements, cabling, storage, network infrastructure and site conditions. Contact us for a customized quotation.'],
    ['Can I monitor my CCTV cameras from my phone?', 'Yes. Compatible CCTV systems can be configured for remote viewing through a smartphone or computer, subject to internet connectivity and system compatibility.'],
    ['Do you install CCTV outside Kampala?', 'Yes. We can support CCTV and ICT projects in different locations depending on project requirements.'],
    ['Can you repair an existing CCTV system?', 'Yes. We provide CCTV troubleshooting, maintenance, upgrades and reconfiguration.'],
    ['Can you install solar CCTV cameras?', 'Yes. We provide solar-powered surveillance solutions for locations where conventional power may be unavailable or unreliable.'],
    ['Do you provide maintenance?', 'Yes. We provide technical support and maintenance for CCTV, networking, IT and other technology systems.'],
    ['Can you install CCTV for a home?', 'Yes. We provide residential CCTV solutions for homes, apartments and private properties.'],
    ['Do you provide quotations before installation?', 'Yes. We can assess your requirements and prepare a quotation based on the proposed solution.'],
    ['Where can I get CCTV installation near me in Kampala?', 'H.Tubman Solutions Limited installs CCTV cameras for homes, businesses and institutions in Kampala and surrounding areas, and supports projects in other parts of Uganda depending on requirements. Call ' . $SITE['phones'][0] . ' or WhatsApp ' . $SITE['whatsapp_display'] . ' to book a site assessment.'],
    ['Which CCTV camera brands do you install?', 'We work with recognized surveillance brands such as Hikvision, Dahua, TP-Link and Ubiquiti, as well as other compatible professional equipment. Recommendations depend on your requirements, budget and equipment availability.'],
    ['Do you sell CCTV cameras or only install them?', 'Both. We supply genuine CCTV equipment - cameras, NVR/DVR recorders, hard disks and accessories - and we also install, configure and maintain complete systems.'],
    ['What is the difference between IP and HD analog CCTV cameras?', 'IP cameras send digital video over a network to an NVR and generally offer higher resolution and easier remote access. HD analog cameras send video over coaxial cable to a DVR and can be a cost-effective way to upgrade an existing system. We recommend the right option after assessing your site.'],
    ['How long does CCTV installation take?', 'It depends on the number of cameras, cabling distances and site conditions. We confirm the timeline together with your quotation after the site assessment.'],
];

/* ICT, networking, access control & IT support questions */
$FAQ_ICT = [
    ['Do you offer IT support for businesses in Kampala?', 'Yes. We provide on-site and remote IT support - computer and printer troubleshooting, Windows and software installation, email setup, backups, network troubleshooting and server support - as well as scheduled or ongoing managed IT support.'],
    ['Can you install Wi-Fi and networking for my office or home?', 'Yes. We design, install and configure LAN and Wi-Fi networks, structured cabling, routers, switches and wireless access points, and we troubleshoot and optimize existing networks.'],
    ['Do you install biometric fingerprint and attendance systems?', 'Yes. We install fingerprint and facial recognition systems, RFID card and PIN access, magnetic locks, and biometric time attendance and visitor management systems for offices, schools, hotels, warehouses and other premises.'],
    ['Can you set up servers and data backups?', 'Yes. We deploy and maintain Windows Server, Active Directory, DNS & DHCP, file servers, network storage and backup solutions suited to your operations.'],
    ['Can you protect my business from viruses and cyber threats?', 'We provide practical cybersecurity: endpoint security and antivirus deployment, firewall configuration, network security, user access controls, password and security policies, system updates, backup planning and basic security assessments.'],
    ['Do you supply computers, laptops, printers and UPS systems?', 'Yes. We supply desktops, laptops, servers, printers, networking and Wi-Fi equipment, CCTV and access control equipment, storage devices, UPS systems, accessories and structured cabling materials - and we provide diagnostics, repairs and upgrades.'],
    ['Do you design websites for businesses in Uganda?', 'Yes. We offer business website design and development, website maintenance and updates, domain and hosting support, business email setup and basic SEO.'],
];

/* working with H.Tubman */
$FAQ_GENERAL = [
    ['How do I get a quote from H.Tubman Solutions?', 'Use the quote form on this website, call ' . $SITE['phones'][0] . ' or ' . $SITE['phones'][1] . ', or WhatsApp ' . $SITE['whatsapp_display'] . '. Tell us what you need and where, and we will assess your requirements and prepare a quotation.'],
    ['Where is H.Tubman Solutions located?', 'We are based in Kampala, Uganda, and work with clients in Kampala and other locations depending on project requirements.'],
    ['What does H.Tubman Solutions do?', 'H.Tubman Solutions Limited is a Ugandan technology and security company providing CCTV installation, access control and biometrics, networking, IT support, servers, cybersecurity, hardware supply and website solutions for homes, businesses and institutions.'],
    ['Why choose a professional CCTV and ICT installer?', 'A system is only as effective as its installation and configuration. We consider camera positioning, lighting, coverage, network infrastructure, storage, remote access, power availability and future expansion - and we support the system after installation.'],
];

/* ---------------- clients ---------------- */
$CLIENTS = [
    'Pinnacle Integrated Resources', 'Hass Petroleum', 'Belo Energies', 'Yoacel Poultry Farm',
    'Cloudvill Hotels', 'SAMCO Construction Company', 'World Choice Interiors',
];
/* ---------------- values / why us ---------------- */
$WHY = [
    ['Professional Expertise', 'Our team has experience in IT support, networking, infrastructure, security systems and technology deployment.', 'fa-user-gear'],
    ['Customized Solutions', 'We don’t believe every client needs the same setup. We design solutions around your property, business and budget.', 'fa-pen-ruler'],
    ['Quality Installation', 'Correct installation is essential for reliable CCTV, networking and security systems.', 'fa-screwdriver-wrench'],
    ['Responsive Support', 'Our relationship with a client does not end when installation is completed. We provide ongoing technical support and maintenance.', 'fa-headset'],
    ['Scalable Systems', 'We consider future expansion so your technology infrastructure can grow with your organization.', 'fa-arrow-up-right-dots'],
];

$VALUES = [
    ['Reliability', 'We strive to deliver solutions our clients can depend on.', 'fa-circle-check'],
    ['Professionalism', 'We maintain professional standards from consultation through installation and support.', 'fa-user-tie'],
    ['Innovation', 'We continuously explore better technologies and smarter ways to solve problems.', 'fa-lightbulb'],
    ['Integrity', 'We believe in transparent communication and responsible business practices.', 'fa-scale-balanced'],
    ['Customer Focus', 'We design solutions around the actual needs of our clients.', 'fa-handshake'],
];

$APPROACH = [
    ['Understand the Problem', 'We listen, assess your site and clarify exactly what you need to protect, connect or fix.', 'fa-magnifying-glass'],
    ['Design the Solution', 'We plan the right equipment, layout and configuration around your property and budget.', 'fa-pen-ruler'],
    ['Install it Professionally', 'Our technicians install, configure and test everything to a professional standard.', 'fa-screwdriver-wrench'],
    ['Support it Afterwards', 'We stay with you through maintenance, troubleshooting and future upgrades.', 'fa-headset'],
];

/* ---------------- CCTV landing page data ---------------- */
$CCTV_SERVICES = ['CCTV camera installation', 'Indoor & outdoor CCTV systems', 'IP cameras', 'HD analog cameras', 'PTZ cameras', 'Dome cameras', 'Bullet cameras', 'Turret cameras', 'Night-vision cameras', 'ColorVu / full-color surveillance', 'Solar-powered CCTV systems', '4G/LTE CCTV solutions', 'NVR & DVR installation', 'Hard disk installation & configuration', 'Remote CCTV viewing', 'CCTV mobile app configuration', 'CCTV system upgrades', 'CCTV troubleshooting', 'CCTV maintenance', 'Camera relocation & reconfiguration', 'CCTV network design', 'Commercial surveillance systems'];

$CCTV_ENVIRONMENTS = [
    ['Home CCTV', 'Monitor entrances, compounds, garages and other important areas of your home, apartment or private property.', 'fa-house', 'home'],
    ['Business & Office CCTV', 'Protect offices, shops, restaurants, supermarkets and commercial premises.', 'fa-building', 'shop'],
    ['Warehouse CCTV', 'Monitor stock areas, loading zones, entrances and sensitive sections.', 'fa-warehouse', 'warehouse'],
    ['Farm CCTV', 'Monitor large compounds, gates, equipment and remote areas — with solar and 4G options.', 'fa-tractor', 'farm'],
    ['School & Institution CCTV', 'Improve visibility around classrooms, entrances, compounds and facilities.', 'fa-school', 'school'],
    ['Construction Site CCTV', 'Monitor equipment, materials, workers and site access — temporary or permanent.', 'fa-helmet-safety', 'construction'],
];

$CCTV_TECH = [
    ['ip-cameras', 'IP Cameras', 'High-resolution network cameras that record to an NVR and integrate with your network for remote viewing.', 'fa-video'],
    ['hd-analog', 'HD Analog Cameras', 'Cost-effective HD cameras paired with DVR recorders — a practical way to upgrade existing installations.', 'fa-film'],
    ['ptz-cameras', 'PTZ Cameras', 'Pan, tilt and zoom cameras that cover wide areas such as compounds, parking and yards from a single point.', 'fa-arrows-up-down-left-right'],
    ['camera-types', 'Dome, Bullet & Turret', 'The right housing for every position — discreet domes indoors, long-range bullets and versatile turrets outdoors.', 'fa-circle-dot'],
    ['night-vision', 'Night-Vision Cameras', 'Infrared cameras that keep recording clear footage in low light and complete darkness.', 'fa-moon'],
    ['colorvu', 'ColorVu / Full-Color', 'Full-color surveillance solutions that capture color detail at night for better identification.', 'fa-palette'],
    ['solar-cctv', 'Solar-Powered CCTV', 'Surveillance for locations where conventional power may be unavailable or unreliable.', 'fa-solar-panel'],
    ['4g-cctv', '4G/LTE CCTV', 'Cameras connected over mobile data for farms, construction sites and remote locations without fixed internet.', 'fa-tower-cell'],
    ['nvr-dvr', 'NVR & DVR Installation', 'Recorder setup with hard disk installation and configuration, recording schedules and motion detection.', 'fa-hard-drive'],
    ['remote-monitoring', 'Remote CCTV Viewing', 'Watch your cameras live from your smartphone or computer, with CCTV mobile app configuration.', 'fa-mobile-screen-button'],
    ['network-design', 'CCTV Network Design', 'Cabling, switches, power and storage planned so your cameras stay online and recordings stay available.', 'fa-diagram-project'],
    ['commercial', 'Commercial Surveillance', 'Multi-camera systems for offices, warehouses, institutions and large commercial premises.', 'fa-building-shield'],
];

$CCTV_PROCESS = [
    ['Site Assessment', 'We inspect your property and identify important areas that require surveillance.'],
    ['Security Design', 'We determine suitable camera types, positions, recording requirements, storage and network infrastructure.'],
    ['Equipment Selection', 'We recommend equipment based on your requirements and budget.'],
    ['Professional Installation', 'Our technicians install cameras, cabling, NVR/DVR systems, power equipment and network components.'],
    ['Configuration', 'We configure recording, motion detection, remote access, mobile viewing and other required features.'],
    ['Testing & Handover', 'We test the system and demonstrate how to monitor and manage your cameras.'],
    ['After-Sales Support', 'We provide technical support, maintenance, troubleshooting and system upgrades.'],
];

/* service areas (local "near me" searches). Kampala divisions & neighbourhoods + nearby towns */
$AREAS = ['Kampala Central', 'Nakawa', 'Kawempe', 'Makindye', 'Rubaga', 'Ntinda', 'Kololo', 'Nakasero', 'Bugolobi', 'Muyenga', 'Kansanga', 'Naalya', 'Kira', 'Najjera', 'Wakiso', 'Entebbe', 'Mukono', 'Kajjansi'];

/* options for every enquiry form */
$SERVICE_OPTIONS = [
    'CCTV Installation', 'CCTV Repair / Maintenance', 'CCTV Site Assessment', 'Access Control & Biometrics',
    'Networking & Wi-Fi', 'IT Support', 'Servers & Infrastructure', 'Cybersecurity',
    'Hardware / Equipment Supply', 'Website & Digital Solutions', 'Other',
];
