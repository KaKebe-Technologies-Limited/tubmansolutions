<?php
$page_key   = 'projects';
$meta_title = 'Projects & Clients | CCTV & ICT Projects in Uganda | H.Tubman';
$meta_desc  = 'CCTV installation, network infrastructure, IT support, biometrics, access control and server projects for organizations across Uganda.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

$areas = [
    ['CCTV Installation', 'fa-video'],
    ['Network Infrastructure', 'fa-network-wired'],
    ['IT Support', 'fa-headset'],
    ['Biometric Installation', 'fa-fingerprint'],
    ['Access Control', 'fa-door-closed'],
    ['Printer & Computer Deployment', 'fa-print'],
    ['Server & Network Configuration', 'fa-server'],
    ['Security Infrastructure', 'fa-shield-halved'],
];

page_banner('Projects &amp; <span class="hl">Experience</span>', ['Projects'], 'cctv-wall', 'We have supported technology and infrastructure requirements across different business environments.');
?>

<section class="sec">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Areas of Experience') ?>
            <h2 class="sec-title">Selected Projects &amp; <span class="hl">Experience</span></h2>
            <p>Our experience spans energy and petroleum, hospitality, agriculture, construction, interiors and business services.</p>
        </div>
        <div class="exp-grid">
            <?php foreach ($areas as $a): ?>
                <div class="exp-card" data-reveal>
                    <i class="fa-solid <?= e($a[1]) ?>"></i>
                    <h3><?= e($a[0]) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="sec sec-dark">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Selected Clients / Organizations', true) ?>
            <h2 class="sec-title">Trusted by Leading <span class="hl">Organizations</span></h2>
        </div>
        <?php clients_grid(); ?>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Project Gallery') ?>
            <h2 class="sec-title">The Kind of Work <span class="hl">We Do</span></h2>
        </div>
        <div class="ind-grid">
            <?php
            $gallery = [
                ['CCTV Surveillance', 'Indoor and outdoor camera systems with recording and remote viewing.', 'fa-video', 'cctv-pole'],
                ['Network Infrastructure', 'Structured cabling, switches, racks and Wi-Fi.', 'fa-network-wired', 'network-cables'],
                ['Monitoring & Control', 'Surveillance monitoring and system configuration.', 'fa-display', 'dashboard'],
                ['Servers & Data', 'Server deployment, storage and backups.', 'fa-server', 'server-woman'],
                ['Access Control', 'Biometric, card and PIN door access.', 'fa-fingerprint', 'vault'],
                ['On-site IT Support', 'Troubleshooting, deployment and maintenance.', 'fa-headset', 'technician'],
                ['Hardware Deployment', 'Computers, printers, UPS and accessories.', 'fa-computer', 'printer'],
            ];
            foreach ($gallery as $i => $g): ?>
                <article class="ind-tile<?= $i === 0 ? ' tall' : '' ?>" data-reveal tabindex="0">
                    <img src="<?= e(img($g[3], $i === 0 ? 700 : 600)) ?>" alt="" loading="lazy">
                    <div class="ind-body">
                        <span class="ind-icon"><i class="fa-solid <?= e($g[2]) ?>"></i></span>
                        <h3><?= e($g[0]) ?></h3>
                        <p><?= e($g[1]) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php cta_band('Have a Project in <span class="hl">Mind?</span>', 'From a single CCTV camera to complete business IT infrastructure — tell us what you need and we’ll help you plan it.'); ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
