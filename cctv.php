<?php
$page_key   = 'cctv.php';
$meta_title = 'CCTV Installation in Kampala & Uganda | CCTV Cameras & Security Systems';
$meta_desc  = 'Get professional CCTV installation in Kampala and across Uganda. We supply and install IP cameras, DVR/NVR systems, PTZ, night vision, solar CCTV and remote monitoring solutions.';
$canonical  = 'cctv.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

$cctv_services = ['CCTV camera installation', 'Indoor & outdoor CCTV systems', 'IP cameras', 'HD analog cameras', 'PTZ cameras', 'Dome cameras', 'Bullet cameras', 'Turret cameras', 'Night-vision cameras', 'ColorVu / full-color surveillance', 'Solar-powered CCTV systems', '4G/LTE CCTV solutions', 'NVR & DVR installation', 'Hard disk installation & configuration', 'Remote CCTV viewing', 'CCTV mobile app configuration', 'CCTV system upgrades', 'CCTV troubleshooting', 'CCTV maintenance', 'Camera relocation & reconfiguration', 'CCTV network design', 'Commercial surveillance systems'];

$env_tiles = [
    ['Home CCTV', 'Monitor entrances, compounds, garages and other important areas of your home, apartment or private property.', 'fa-house', 'home'],
    ['Business & Office CCTV', 'Protect offices, shops, restaurants, supermarkets and commercial premises.', 'fa-building', 'office'],
    ['Warehouse CCTV', 'Monitor stock areas, loading zones, entrances and sensitive sections.', 'fa-warehouse', 'warehouse'],
    ['Farm CCTV', 'Monitor large compounds, gates, equipment and remote areas — with solar and 4G options.', 'fa-tractor', 'farm'],
    ['School & Institution CCTV', 'Improve visibility around classrooms, entrances, compounds and facilities.', 'fa-school', 'school'],
    ['Construction Site CCTV', 'Monitor equipment, materials, workers and site access — temporary or permanent.', 'fa-helmet-safety', 'construction'],
];

$tech = [
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

$process = [
    ['Site Assessment', 'We inspect your property and identify important areas that require surveillance.'],
    ['Security Design', 'We determine suitable camera types, positions, recording requirements, storage and network infrastructure.'],
    ['Equipment Selection', 'We recommend equipment based on your requirements and budget.'],
    ['Professional Installation', 'Our technicians install cameras, cabling, NVR/DVR systems, power equipment and network components.'],
    ['Configuration', 'We configure recording, motion detection, remote access, mobile viewing and other required features.'],
    ['Testing & Handover', 'We test the system and demonstrate how to monitor and manage your cameras.'],
    ['After-Sales Support', 'We provide technical support, maintenance, troubleshooting and system upgrades.'],
];
?>

<!-- ===================== CCTV HERO ===================== -->
<section class="page-banner cctv-hero" style="--bg:url('<?= e(img('cctv-wall', 1920)) ?>')">
    <div class="container">
        <span class="hero-tag">CCTV &amp; Video Surveillance</span>
        <h1>CCTV Installation in Kampala &amp; <span class="hl">Uganda</span></h1>
        <p class="lead">H.Tubman Solutions Limited provides end-to-end CCTV surveillance solutions designed to give you visibility, security and peace of mind — from site assessment and camera selection to installation, remote viewing and maintenance.</p>
        <div class="btn-row">
            <a class="btn btn-primary" href="#site-assessment">Get a Free CCTV Quote <i class="fa-solid fa-arrow-right"></i></a>
            <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I need CCTV installation.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Talk to an Expert</a>
        </div>
        <ul class="hero-trust">
            <li><i class="fa-solid fa-circle-check"></i>Homes &amp; Businesses</li>
            <li><i class="fa-solid fa-circle-check"></i>Remote Phone Viewing</li>
            <li><i class="fa-solid fa-circle-check"></i>Solar &amp; 4G Options</li>
            <li><i class="fa-solid fa-circle-check"></i>Maintenance &amp; Repair</li>
        </ul>
        <ol class="breadcrumb" aria-label="Breadcrumb">
            <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
            <li aria-current="page">CCTV &amp; Security</li>
        </ol>
    </div>
</section>

<div class="trust-strip-wrap">
    <div class="container">
        <div class="trust-strip">
            <div><i class="fa-solid fa-clipboard-check"></i><div><h4>Site Assessment</h4><p>We inspect your property before recommending a system.</p></div></div>
            <div><i class="fa-solid fa-award"></i><div><h4>Quality Equipment</h4><p>Hikvision, Dahua, TP-Link, Ubiquiti and more.</p></div></div>
            <div><i class="fa-solid fa-mobile-screen-button"></i><div><h4>Remote Viewing</h4><p>Watch your cameras from your phone or computer.</p></div></div>
            <div><i class="fa-solid fa-screwdriver-wrench"></i><div><h4>After-Sales Support</h4><p>Maintenance, troubleshooting and upgrades.</p></div></div>
        </div>
    </div>
</div>

<!-- ===================== INTRO ===================== -->
<section class="sec">
    <div class="container spot-grid">
        <div data-reveal>
            <?= sub_title('CCTV Installation Kampala') ?>
            <h2 class="sec-title">Looking for CCTV Installation in Kampala or Anywhere in <span class="hl">Uganda?</span></h2>
            <p>Keep an eye on your home, business, office, warehouse, farm or institution with professionally designed CCTV surveillance systems.</p>
            <p>We provide complete CCTV solutions from site assessment and camera selection to installation, configuration, remote viewing and maintenance — for a single camera at home or a complete commercial surveillance system.</p>
            <ul class="check-grid two">
                <li><i class="fa-solid fa-circle-check"></i>Professional CCTV installation</li>
                <li><i class="fa-solid fa-circle-check"></i>Indoor &amp; outdoor systems</li>
                <li><i class="fa-solid fa-circle-check"></i>Remote viewing on your phone</li>
                <li><i class="fa-solid fa-circle-check"></i>Maintenance, repair &amp; upgrades</li>
            </ul>
            <div class="btn-row">
                <a class="btn btn-primary" href="#site-assessment">Request a Site Assessment <i class="fa-solid fa-arrow-right"></i></a>
                <a class="btn btn-outline" href="<?= e(tel($SITE['phones'][0])) ?>"><i class="fa-solid fa-phone"></i> 0789 977 270</a>
            </div>
        </div>
        <div class="cam-view" data-reveal>
            <img src="<?= e(img('cctv-pole', 1100)) ?>" alt="Outdoor CCTV cameras installed on a pole" loading="lazy">
            <span class="scan" aria-hidden="true"></span>
            <div class="cam-hud" aria-hidden="true">
                <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
                <span class="rec">REC</span>
                <span class="cam-id">CAM 02 · IP</span>
                <span class="cam-loc">GATE · OUTDOOR</span>
                <span class="cam-time" data-cam-clock></span>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CCTV SERVICES ===================== -->
<section class="sec sec-soft" id="services">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Our CCTV Services') ?>
            <h2 class="sec-title">Complete CCTV Solutions, <span class="hl">End to End</span></h2>
            <p>Everything you need to plan, install, view and maintain a reliable surveillance system.</p>
        </div>
        <ul class="chip-grid">
            <?php foreach ($cctv_services as $c): ?>
                <li data-reveal><i class="fa-solid fa-check"></i><?= e($c) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- ===================== ENVIRONMENTS ===================== -->
<section class="sec" id="environments">
    <div class="container">
        <div class="sec-head-split" data-reveal>
            <div>
                <?= sub_title('CCTV for Every Environment') ?>
                <h2 class="sec-title">Home, Business &amp; <span class="hl">Commercial CCTV</span></h2>
            </div>
            <p>Every property is different. We design coverage, camera types and recording around how your site is actually used.</p>
        </div>
        <div class="env-tiles">
            <?php foreach ($env_tiles as $t): ?>
                <article class="env-tile" data-reveal>
                    <img src="<?= e(img($t[3], 700, 525)) ?>" alt="" loading="lazy">
                    <div class="et-body">
                        <h3><i class="fa-solid <?= e($t[2]) ?>"></i><?= e($t[0]) ?></h3>
                        <p><?= e($t[1]) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== TECHNOLOGY ===================== -->
<section class="sec sec-soft" id="technology">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Cameras & Technology') ?>
            <h2 class="sec-title">Solar, 4G, PTZ, Night Vision &amp; <span class="hl">Remote Monitoring</span></h2>
            <p>We match the camera technology to your lighting, power, connectivity and coverage requirements.</p>
        </div>
        <div class="tech-grid">
            <?php foreach ($tech as $t): ?>
                <div class="tech-card" id="<?= e($t[0]) ?>" data-reveal>
                    <span class="t-icon"><i class="fa-solid <?= e($t[3]) ?>"></i></span>
                    <h3><?= e($t[1]) ?></h3>
                    <p><?= e($t[2]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== PROCESS ===================== -->
<section class="sec sec-dark" id="process">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Our CCTV Installation Process', true) ?>
            <h2 class="sec-title">From Site Visit to <span class="hl">After-Sales Support</span></h2>
            <p>A clear, seven-step process so you know exactly what happens at every stage.</p>
        </div>
        <div class="process">
            <?php foreach ($process as $i => $p): ?>
                <div class="process-step" data-reveal>
                    <span class="p-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    <h3><?= e($p[0]) ?></h3>
                    <p><?= e($p[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== WHY PROFESSIONAL ===================== -->
<section class="sec">
    <div class="container spot-grid">
        <div class="cam-view" data-reveal>
            <img src="<?= e(img('control-room', 1100)) ?>" alt="CCTV monitoring screens in a control room" loading="lazy">
            <span class="scan" aria-hidden="true"></span>
            <div class="cam-hud" aria-hidden="true">
                <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
                <span class="rec">LIVE</span>
                <span class="cam-id">16 CH · NVR</span>
                <span class="cam-loc">MONITORING</span>
                <span class="cam-time" data-cam-clock></span>
            </div>
        </div>
        <div data-reveal>
            <?= sub_title('Why Professional Installation?') ?>
            <h2 class="sec-title">A CCTV System is Only as Good as its <span class="hl">Installation</span></h2>
            <p>A CCTV system is only as effective as its installation and configuration. Our technicians consider:</p>
            <ul class="check-grid">
                <?php foreach (['Camera positioning', 'Lighting conditions', 'Night visibility', 'Coverage requirements', 'Network infrastructure', 'Storage requirements', 'Remote access', 'Power availability', 'Future expansion'] as $c): ?>
                    <li><i class="fa-solid fa-circle-check"></i><?= e($c) ?></li>
                <?php endforeach; ?>
            </ul>
            <a class="btn btn-primary" href="#site-assessment">Get a CCTV Site Assessment <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ===================== MAINTENANCE ===================== -->
<section class="sec sec-soft" id="maintenance">
    <div class="container about-grid">
        <div data-reveal>
            <?= sub_title('CCTV Maintenance & Repair') ?>
            <h2 class="sec-title">Existing System Not Working? <span class="hl">We Can Help.</span></h2>
            <p>We provide CCTV troubleshooting, maintenance, upgrades and reconfiguration for existing systems — whether we installed them or not.</p>
            <div class="about-item">
                <span class="ai-icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                <div><h4>CCTV Troubleshooting &amp; Maintenance</h4><p>Cameras offline, no recording or poor picture? We diagnose and fix the problem.</p></div>
            </div>
            <div class="about-item">
                <span class="ai-icon"><i class="fa-solid fa-arrow-up-right-dots"></i></span>
                <div><h4>CCTV Upgrades</h4><p>Move to HD or IP cameras, add storage and expand coverage as your needs grow.</p></div>
            </div>
            <div class="about-item">
                <span class="ai-icon"><i class="fa-solid fa-arrows-rotate"></i></span>
                <div><h4>Relocation, Reconfiguration &amp; Mobile App Setup</h4><p>Camera relocation, hard disk replacement, NVR/DVR settings and remote viewing on your phone.</p></div>
            </div>
            <a class="btn btn-primary" href="contact.php?service=<?= rawurlencode('CCTV Repair / Maintenance') ?>#quote">Request CCTV Repair <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="about-media" data-reveal>
            <div class="about-img-main"><img src="<?= e(img('technician', 900)) ?>" alt="Technician working on a wall-mounted installation" loading="lazy"></div>
            <div class="about-img-sub"><img src="<?= e(img('cctv-sign', 600)) ?>" alt="CCTV in operation sign" loading="lazy"></div>
            <div class="exp-badge"><strong>7</strong><span>Step installation process</span></div>
            <div class="dots-pattern" aria-hidden="true"></div>
        </div>
    </div>
</section>

<!-- ===================== BRANDS ===================== -->
<section class="sec" style="padding-bottom:60px">
    <div class="container">
        <div class="sec-head" data-reveal style="margin-bottom:36px">
            <?= sub_title('CCTV Brands & Technology') ?>
            <h2 class="sec-title">Recognized Surveillance <span class="hl">Technologies</span></h2>
            <p>We work with recognized surveillance technologies and equipment, including solutions from brands such as Hikvision, Dahua, TP-Link, Ubiquiti and other compatible professional surveillance equipment.</p>
        </div>
        <ul class="brand-list" style="justify-content:center" data-reveal>
            <li>HIKVISION</li><li>dahua</li><li>tp-link</li><li>UBIQUITI</li>
        </ul>
        <p class="note center" style="margin-top:24px">Equipment recommendations depend on the project requirements and availability.</p>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section class="sec sec-soft">
    <div class="container faq-grid">
        <div data-reveal>
            <?= sub_title('CCTV FAQ') ?>
            <h2 class="sec-title">CCTV Questions, <span class="hl">Answered</span></h2>
            <div class="faq-list">
                <?php faq_list($FAQS, 'cctv-faq'); ?>
            </div>
        </div>
        <div class="faq-media" data-reveal>
            <img src="<?= e(img('cctv-wall', 800)) ?>" alt="Rows of CCTV cameras" loading="lazy">
            <div class="faq-help">
                <i class="fa-brands fa-whatsapp"></i>
                <div><strong>Ask us on WhatsApp</strong><a href="<?= e(wa('Hello H.Tubman Solutions, I have a question about CCTV.')) ?>" target="_blank" rel="noopener">Chat with a CCTV expert</a></div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== SITE ASSESSMENT FORM ===================== -->
<section class="sec" id="site-assessment">
    <div class="container contact-layout">
        <div class="form-card" data-reveal>
            <?= sub_title('Request a CCTV Site Assessment') ?>
            <h2>Get a Free CCTV <span class="hl">Quote</span></h2>
            <p>Tell us about your property and what you want to monitor. We’ll assess your requirements and prepare a quotation based on the proposed solution.</p>
            <?php quote_form('CCTV Site Assessment', 'Request Site Assessment', 'CCTV page'); ?>
        </div>
        <aside class="contact-aside" data-reveal>
            <div class="aside-dark">
                <h3>What happens next?</h3>
                <ul class="next-list">
                    <li><span class="wi-icon"><i class="fa-solid fa-phone"></i></span><div><h4>We call you back</h4><p>to understand your property and requirements.</p></div></li>
                    <li><span class="wi-icon"><i class="fa-solid fa-magnifying-glass-location"></i></span><div><h4>We assess the site</h4><p>and identify areas that require surveillance.</p></div></li>
                    <li><span class="wi-icon"><i class="fa-solid fa-file-invoice"></i></span><div><h4>You get a quotation</h4><p>for a system designed around your needs and budget.</p></div></li>
                </ul>
                <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I would like a CCTV site assessment.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
                <a class="btn btn-outline-light" href="<?= e(tel($SITE['phones'][0])) ?>"><i class="fa-solid fa-phone"></i> 0789 977 270</a>
                <a class="btn btn-outline-light" href="<?= e(tel($SITE['phones'][1])) ?>"><i class="fa-solid fa-phone"></i> 0784 801 913</a>
            </div>
        </aside>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
