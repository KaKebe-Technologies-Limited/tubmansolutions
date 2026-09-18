<?php
$page_key   = 'about';
$meta_title = 'About H.Tubman Solutions Limited | CCTV & ICT Company in Kampala, Uganda';
$meta_desc  = 'H.Tubman Solutions Limited is a Ugandan technology solutions company providing professional CCTV, security, networking, IT support and digital technology services.';
$canonical  = 'about.php';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

page_banner('About <span class="hl">H.Tubman Solutions</span>', ['About Us'], 'team-desk', $SITE['tagline']);
?>

<section class="sec">
    <div class="container about-grid">
        <div class="about-media" data-reveal>
            <div class="about-img-main"><img src="<?= e(img('team-desk', 900)) ?>" alt="Technology team working together at computers" loading="lazy"></div>
            <div class="about-img-sub"><img src="<?= e(img('technician-2', 600)) ?>" alt="Technician on site" loading="lazy"></div>
            <div class="exp-badge"><strong>8</strong><span>Core solution areas</span></div>
            <div class="dots-pattern" aria-hidden="true"></div>
        </div>
        <div data-reveal>
            <?= sub_title('About Us') ?>
            <h2 class="sec-title">About H.Tubman Solutions <span class="hl">Limited</span></h2>
            <p>H.Tubman Solutions Limited is a Ugandan technology solutions company providing professional CCTV, security, networking, IT support and digital technology services.</p>
            <p>We work with businesses, institutions, organizations and individuals to design, implement and maintain technology systems that improve security, connectivity and operational efficiency.</p>
            <p><strong style="color:var(--heading)">Our approach is simple:</strong></p>
            <div class="flow">
                <span>Understand the problem</span><i class="fa-solid fa-arrow-right"></i>
                <span>Design the solution</span><i class="fa-solid fa-arrow-right"></i>
                <span>Install it professionally</span><i class="fa-solid fa-arrow-right"></i>
                <span>Support it afterwards</span>
            </div>
            <p>We aim to build long-term relationships with our clients by providing dependable technology solutions and responsive technical support.</p>
            <a class="btn btn-primary" href="contact.php">Talk to Our Team <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<section class="sec sec-soft" id="mission">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Mission & Vision') ?>
            <h2 class="sec-title">Where We Are <span class="hl">Going</span></h2>
        </div>
        <div class="mv-grid">
            <div class="mv-card blue" data-reveal>
                <span class="mv-icon"><i class="fa-solid fa-bullseye"></i></span>
                <h3>Our Mission</h3>
                <p>To deliver dependable, future-ready technology and integrated business solutions that empower organizations through innovation, trust and operational excellence.</p>
            </div>
            <div class="mv-card" data-reveal>
                <span class="mv-icon"><i class="fa-solid fa-eye"></i></span>
                <h3>Our Vision</h3>
                <p>To become East Africa’s most trusted force in transformative technology and enterprise solutions, shaping smarter businesses and connected communities.</p>
            </div>
        </div>
    </div>
</section>

<section class="sec" id="values">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Our Values') ?>
            <h2 class="sec-title">What We <span class="hl">Stand For</span></h2>
        </div>
        <div class="values-grid">
            <?php foreach ($VALUES as $v): ?>
                <div class="value-card" data-reveal>
                    <i class="fa-solid <?= e($v[2]) ?>"></i>
                    <h3><?= e($v[0]) ?></h3>
                    <p><?= e($v[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="sec sec-soft why">
    <div class="container why-grid">
        <div data-reveal>
            <?= sub_title('Why H.Tubman Solutions?') ?>
            <h2 class="sec-title">Technology. Security. <span class="hl">Reliability.</span></h2>
            <p>We believe technology should solve problems, not create them. Our approach combines technical expertise, quality equipment and practical implementation to provide solutions that work in real-world environments.</p>
            <div class="why-list">
                <?php foreach ($WHY as $w): ?>
                    <div class="why-item">
                        <span class="wi-icon"><i class="fa-solid <?= e($w[2]) ?>"></i></span>
                        <div><h4><?= e($w[0]) ?></h4><p><?= e($w[1]) ?></p></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="why-media" data-reveal>
            <div class="wm"><img src="<?= e(img('server-woman', 700)) ?>" alt="Technician in a server room" loading="lazy"></div>
            <div class="wm"><img src="<?= e(img('cctv-pole', 700)) ?>" alt="Outdoor CCTV cameras" loading="lazy"></div>
            <div class="ring"><img src="assets/img/logo-mark.png" alt="H.Tubman Solutions logo mark" loading="lazy"></div>
        </div>
    </div>
</section>

<section class="sec">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Selected Clients') ?>
            <h2 class="sec-title">Organizations We Have <span class="hl">Supported</span></h2>
        </div>
        <div class="clients-light"><?php clients_grid(); ?></div>
    </div>
</section>

<?php cta_band(); ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
