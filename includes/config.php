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
    'whatsapp'  => '256789977270',               // international format, no "+"
    'email'     => 'htubmansolutions@gmail.com',
    'website'   => 'www.htubmansolutionslimited.com',
    'url'       => 'https://www.htubmansolutionslimited.com', // production base URL (canonical/SEO)
    'lines'     => 'CCTV & Security | Networking | IT Support | Access Control | Servers | Digital Solutions',
];

/* ---------------------------------------------------------------
 * Images. Values are Unsplash photo IDs (hot-linked) or a local
 * path such as "assets/img/projects/site-1.jpg" — replace with
 * real H.Tubman project photos whenever they are available.
 * ------------------------------------------------------------- */
$IMAGES = [
    'cctv-wall'       => '1557597774-9d273605dfa9',
    'cctv-pole'       => '1589935447067-5531094415d1',
    'cctv-sign'       => '1590856029826-c7a73142bbf1',
    'control-room'    => '1581092795360-fd1ca04f0952',
    'technician'      => '1621905251189-08b45d6a269e',
    'technician-2'    => '1621905252507-b35492cc74b4',
    'team-desk'       => '1531482615713-2afd69097998',
    'network-cables'  => '1544197150-b99a580bb7a8',
    'network-switch'  => '1551703599-6b3e8379aa8c',
    'fiber-rack'      => '1520869562399-e772f042f422',
    'server-rack'     => '1558494949-ef010cbdcc31',
    'server-woman'    => '1573164713988-8665fc963095',
    'datacenter'      => '1586772002130-b0f3daa6288b',
    'smart-lock'      => '1558002038-1055907df827',
    'padlock'         => '1614064641938-3bbee52942c7',
    'circuit'         => '1550751827-4bd374c3f58b',
    'hardware-repair' => '1581092918056-0c4c3acd3789',
    'printer'         => '1612815154858-60aa4c59eaa6',
    'cpu'             => '1591799264318-7e6ef8ddb7ea',
    'web-design'      => '1547658719-da2b51169166',
    'dev-desk'        => '1563986768609-322da13575f3',
    'home'            => '1600585154340-be6161a56a0c',
    'sme'             => '1522071820081-009f0129c71c',
    'office'          => '1504384308090-c894fdcc538d',
    'office-team'     => '1600880292203-757bb62b4baf',
    'professional'    => '1573497019940-1c28c88b4f3e',
    'school'          => '1580582932707-520aed937b7b',
    'warehouse'       => '1553413077-190dd305871c',
    'farm'            => '1535379453347-1ffd615e2e08',
    'construction'    => '1541888946425-d81bb19240f5',
    'city'            => '1486406146926-c627a92ad1ab',
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
        'option'  => 'CCTV Installation',
        'title'   => 'CCTV & Security Systems',
        'nav'     => 'CCTV Installation',
        'page'    => 'cctv.php',
        'icon'    => 'fa-video',
        'img'     => 'cctv-pole',
        'excerpt' => 'Professional CCTV design, installation, remote viewing and maintenance for homes, businesses and institutions.',
    ],
    'networking' => [
        'option'  => 'Networking & Wi-Fi',
        'title'   => 'Networking & Infrastructure',
        'nav'     => 'Networking',
        'page'    => 'networking.php',
        'icon'    => 'fa-network-wired',
        'img'     => 'network-switch',
        'banner'  => 'fiber-rack',
        'excerpt' => 'Wired and wireless networks, structured cabling and Wi-Fi designed, installed and maintained for reliability.',
        'seo_title' => 'Networking Company in Kampala | LAN, Wi-Fi & Structured Cabling | H.Tubman Solutions',
        'seo_desc'  => 'LAN and Wi-Fi installation, structured cabling, router and switch configuration, VLANs and network troubleshooting for homes, offices and institutions in Kampala and Uganda.',
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
        'option'  => 'Access Control & Biometrics',
        'title'   => 'Access Control & Biometrics',
        'nav'     => 'Access Control & Biometrics',
        'page'    => 'access-control.php',
        'icon'    => 'fa-fingerprint',
        'img'     => 'smart-lock',
        'excerpt' => 'Fingerprint, facial recognition, card and PIN access with attendance and visitor management.',
        'seo_title' => 'Access Control & Biometric Systems in Uganda | H.Tubman Solutions',
        'seo_desc'  => 'Fingerprint biometric systems, facial recognition, RFID card access, magnetic locks, time attendance and visitor management for offices, schools, hotels and warehouses in Uganda.',
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
        'option'  => 'IT Support',
        'title'   => 'IT Support & Managed Services',
        'nav'     => 'IT Support',
        'page'    => 'it-support.php',
        'icon'    => 'fa-headset',
        'img'     => 'team-desk',
        'excerpt' => 'On-site and remote IT support, maintenance and managed services that keep your team productive.',
        'seo_title' => 'IT Support in Kampala | Managed IT Services Uganda | H.Tubman Solutions',
        'seo_desc'  => 'Professional IT support in Kampala: computer and printer troubleshooting, Windows and software installation, email setup, backups, server support and managed IT services.',
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
        'option'  => 'Servers & Infrastructure',
        'title'   => 'Servers & Data Solutions',
        'nav'     => 'Servers & Infrastructure',
        'page'    => 'servers.php',
        'icon'    => 'fa-server',
        'img'     => 'server-woman',
        'banner'  => 'datacenter',
        'excerpt' => 'Windows Server, Active Directory, file servers, storage and backups built for your operations.',
        'seo_title' => 'Server Installation & Data Solutions in Uganda | H.Tubman Solutions',
        'seo_desc'  => 'Windows Server deployment, Active Directory, DNS & DHCP, file servers, network storage, backup solutions and server maintenance for organizations in Uganda.',
        'headline'  => ['Build a Reliable', 'IT Infrastructure'],
        'intro'     => [
            'We help organizations deploy and maintain server and data infrastructure suitable for their operational requirements.',
        ],
        'list_title' => 'Server & Data Services',
        'list'      => ['Windows Server deployment', 'Active Directory', 'DNS & DHCP', 'File servers', 'User and group management', 'Network storage', 'Backup solutions', 'Server maintenance', 'Server configuration', 'Data management', 'Access permissions', 'Infrastructure troubleshooting'],
        'cta'       => 'Talk to an Infrastructure Expert',
    ],
    'cybersecurity' => [
        'option'  => 'Cybersecurity',
        'title'   => 'Cybersecurity',
        'nav'     => 'Cybersecurity',
        'page'    => 'cybersecurity.php',
        'icon'    => 'fa-shield-halved',
        'img'     => 'padlock',
        'banner'  => 'circuit',
        'excerpt' => 'Endpoint protection, firewalls, access controls and practical security for your digital environment.',
        'seo_title' => 'Cybersecurity Services in Uganda | Firewall & Endpoint Security | H.Tubman Solutions',
        'seo_desc'  => 'Practical cybersecurity for Ugandan businesses: endpoint security, antivirus deployment, firewall configuration, network security, backup planning and security assessments.',
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
        'option'  => 'Hardware / Equipment Supply',
        'title'   => 'Hardware & Technology Supply',
        'nav'     => 'Hardware Solutions',
        'page'    => 'hardware.php',
        'icon'    => 'fa-computer',
        'img'     => 'hardware-repair',
        'banner'  => 'cpu',
        'excerpt' => 'Supply, installation and maintenance of computers, printers, networking, CCTV and UPS equipment.',
        'seo_title' => 'Computer & Hardware Supply in Uganda | Laptops, Printers, UPS | H.Tubman Solutions',
        'seo_desc'  => 'We supply, install and maintain desktops, laptops, servers, printers, networking, CCTV and access control equipment, UPS systems and accessories in Uganda.',
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
        'option'  => 'Website & Digital Solutions',
        'title'   => 'Website & Digital Solutions',
        'nav'     => 'Website & Digital Solutions',
        'page'    => 'digital-solutions.php',
        'icon'    => 'fa-laptop-code',
        'img'     => 'web-design',
        'banner'  => 'dev-desk',
        'excerpt' => 'Business websites, domains, hosting, business email and ongoing updates for a strong online presence.',
        'seo_title' => 'Website Design in Kampala | Business Websites & Email | H.Tubman Solutions',
        'seo_desc'  => 'Business website design and development, website maintenance, domain and hosting support, business email setup and basic SEO for companies in Kampala and Uganda.',
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
];

/* ---------------- clients ---------------- */
$CLIENTS = [
    'UMEME Uganda Limited', 'Diamond Trust Bank', 'British High Commission', 'European Union', 'Jubilee Insurance',
    'M-KOPA Uganda', 'Mogo Uganda', 'Rwenzori Bottling', 'World Choice Interiors', 'Pinnacle Integrated Resource',
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

/* options for every enquiry form */
$SERVICE_OPTIONS = [
    'CCTV Installation', 'CCTV Repair / Maintenance', 'CCTV Site Assessment', 'Access Control & Biometrics',
    'Networking & Wi-Fi', 'IT Support', 'Servers & Infrastructure', 'Cybersecurity',
    'Hardware / Equipment Supply', 'Website & Digital Solutions', 'Other',
];
