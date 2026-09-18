<?php
$page_key   = 'home';
$meta_title = 'CCTV Installation Kampala Uganda | H.Tubman Solutions Limited';
$meta_desc  = 'Professional CCTV installation in Kampala and Uganda. H.Tubman Solutions provides CCTV cameras, security systems, networking, access control, IT support and technology solutions.';
$canonical  = '';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

$slides = [
    [
        'img'   => 'cctv-wall',
        'tag'   => 'CCTV & ICT Solutions in Uganda',
        'title' => 'CCTV &amp; ICT Solutions You Can <span class="hl">Trust</span>',
        'text'  => 'Protect your property, connect your business, and keep your technology working with professional solutions from H.Tubman Solutions Limited.',
    ],
    [
        'img'   => 'technician',
        'tag'   => 'Design · Install · Maintain',
        'title' => 'Professional CCTV <span class="hl">Installation</span> in Kampala',
        'text'  => 'From CCTV camera installation and access control to networking, IT support and infrastructure, we design, install and maintain technology systems built around your needs.',
    ],
    [
        'img'   => 'fiber-rack',
        'tag'   => 'Networking · IT Support · Infrastructure',
        'title' => 'Smart Technology. Secure <span class="hl">Businesses.</span>',
        'text'  => 'Reliable networks, access control, servers and responsive IT support for homes, businesses, institutions and organizations across Uganda.',
    ],
];
?>

<!-- ===================== HERO ===================== -->
<section class="hero" data-hero aria-label="Featured">
    <?php foreach ($slides as $i => $s): ?>
        <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>">
            <div class="hero-bg" style="--bg:url('<?= e(img($s['img'], 1920)) ?>')"></div>
            <div class="container">
                <div class="hero-content">
                    <span class="hero-tag"><?= e($s['tag']) ?></span>
                    <?php if ($i === 0): ?>
                        <h1><?= $s['title'] ?></h1>
                    <?php else: ?>
                        <p class="h1" role="heading" aria-level="2"><?= $s['title'] ?></p>
                    <?php endif; ?>
                    <p><?= e($s['text']) ?></p>
                    <div class="btn-row">
                        <a class="btn btn-primary" href="contact.php#quote">Get a Free CCTV Quote <i class="fa-solid fa-arrow-right"></i></a>
                        <a class="btn btn-outline-light" href="<?= e(wa('Hello H.Tubman Solutions, I would like to talk to an expert.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Talk to an Expert</a>
                    </div>
                    <ul class="hero-trust">
                        <li><i class="fa-solid fa-circle-check"></i>Professional Installation</li>
                        <li><i class="fa-solid fa-circle-check"></i>Quality Equipment</li>
                        <li><i class="fa-solid fa-circle-check"></i>Reliable Technical Support</li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <button class="hero-arrow hero-prev" type="button" aria-label="Previous slide"><i class="fa-solid fa-arrow-left"></i></button>
    <button class="hero-arrow hero-next" type="button" aria-label="Next slide"><i class="fa-solid fa-arrow-right"></i></button>
    <div class="hero-dots"></div>
</section>

<!-- quick quote bar -->
<div class="quick-quote-wrap">
    <div class="container">
        <form class="quick-quote" action="contact.php#quote" method="post" aria-label="Quick quote request">
            <input type="hidden" name="source" value="Homepage quick quote">
            <div class="hp" aria-hidden="true"><label>Leave empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <div class="qq-grid">
                <input type="text" name="name" placeholder="Your Name *" aria-label="Your name" required autocomplete="name">
                <input type="tel" name="phone" placeholder="Phone Number *" aria-label="Phone number" required autocomplete="tel">
                <input type="email" name="email" placeholder="Email Address" aria-label="Email address" autocomplete="email">
                <select name="service" aria-label="Service required">
                    <option value="">Choose Service</option>
                    <?php foreach ($SERVICE_OPTIONS as $opt): ?><option><?= e($opt) ?></option><?php endforeach; ?>
                </select>
                <input type="text" name="location" placeholder="Location (e.g. Kampala)" aria-label="Location" autocomplete="address-level2">
                <button class="btn btn-dark" type="submit">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </form>
    </div>
</div>

<!-- ===================== FEATURE CARDS ===================== -->
<section class="features">
    <div class="container">
        <div class="feature-grid">
            <div class="feature-card" data-reveal>
                <span class="f-icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                <div><h3>Professional Installation</h3><p>Correct positioning, cabling and configuration by experienced technicians.</p></div>
            </div>
            <div class="feature-card" data-reveal>
                <span class="f-icon"><i class="fa-solid fa-award"></i></span>
                <div><h3>Quality Equipment</h3><p>Recognized surveillance and ICT technologies selected for your needs and budget.</p></div>
            </div>
            <div class="feature-card" data-reveal>
                <span class="f-icon"><i class="fa-solid fa-headset"></i></span>
                <div><h3>Reliable Technical Support</h3><p>Maintenance, troubleshooting and upgrades long after installation day.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== ABOUT ===================== -->
<section class="sec about">
    <div class="container about-grid">
        <div class="about-media" data-reveal>
            <div class="about-img-main"><img src="<?= e(img('technician-2', 900)) ?>" alt="H.Tubman technician at an equipment installation" loading="lazy"></div>
            <div class="about-img-sub"><img src="<?= e(img('cctv-pole', 600)) ?>" alt="Outdoor CCTV cameras mounted on a pole" loading="lazy"></div>
            <div class="exp-badge"><strong>10+</strong><span>Notable organizations served</span></div>
            <div class="dots-pattern" aria-hidden="true"></div>
        </div>
        <div class="about-content" data-reveal>
            <?= sub_title('About Us') ?>
            <h2 class="sec-title">Smart Technology. Secure <span class="hl">Businesses.</span></h2>
            <p>H.Tubman Solutions Limited is a technology and security solutions company based in Kampala, Uganda, providing reliable CCTV surveillance, access control, networking, IT support, infrastructure, and technology solutions for businesses, institutions, homes, and organizations.</p>
            <div class="about-item">
                <span class="ai-icon"><i class="fa-solid fa-pen-ruler"></i></span>
                <div><h4>Customized Security &amp; ICT Solutions</h4><p>We design every solution around your property, business and budget.</p></div>
            </div>
            <div class="about-item">
                <span class="ai-icon"><i class="fa-solid fa-house-laptop"></i></span>
                <div><h4>Solutions for Homes &amp; Businesses</h4><p>From a single camera at home to complete business IT infrastructure.</p></div>
            </div>
            <a class="btn btn-primary" href="about.php">Discover More <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- ===================== SERVICES (dark) ===================== -->
<section class="sec services-dark">
    <div class="container">
        <div class="svc-grid">
            <div class="svc-intro" data-reveal>
                <?= sub_title('Our Main Services', true) ?>
                <h2 class="sec-title">CCTV &amp; ICT Solutions Built Around <span class="hl">Your Needs</span></h2>
                <p>From CCTV camera installation and access control to networking, IT support and infrastructure — we design, install and maintain technology systems for homes, businesses and institutions across Uganda.</p>
                <a class="btn btn-primary" href="services.php">View All Services <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <?php $n = 0; foreach ($SERVICES as $key => $s): $n++; ?>
                <div class="svc-card<?= $key === 'cctv' ? ' featured' : '' ?>" data-reveal>
                    <?php if ($key === 'cctv'): ?><span class="svc-badge">Most Requested</span><?php endif; ?>
                    <span class="svc-num"><?= str_pad($n, 2, '0', STR_PAD_LEFT) ?></span>
                    <span class="svc-icon"><i class="fa-solid <?= e($s['icon']) ?>"></i></span>
                    <h3><a href="<?= e($s['page']) ?>"><?= e($s['title']) ?></a></h3>
                    <p><?= e($s['excerpt']) ?></p>
                    <a class="svc-arrow" href="<?= e($s['page']) ?>" aria-label="Learn more about <?= e($s['title']) ?>"><i class="fa-solid fa-arrow-right"></i></a>
                </div>
            <?php endforeach; ?>
            <div class="svc-cta-card" data-reveal>
                <div>
                    <h3>Not sure what you need?</h3>
                    <p>Tell us about your property or problem and we’ll recommend the right solution.</p>
                </div>
                <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I need help choosing the right solution.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Talk to an Expert</a>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CCTV SPOTLIGHT ===================== -->
<section class="sec spotlight">
    <div class="container spot-grid">
        <div data-reveal>
            <?= sub_title('CCTV & Video Surveillance') ?>
            <h2 class="sec-title">Professional CCTV Installation in <span class="hl">Uganda</span></h2>
            <p>Keep an eye on your home, business, office, warehouse, farm or institution with professionally designed CCTV surveillance systems. We provide complete CCTV solutions from site assessment and camera selection to installation, configuration, remote viewing and maintenance.</p>
            <p><strong style="color:var(--heading)">A CCTV system is only as effective as its installation and configuration.</strong> Our technicians consider:</p>
            <ul class="check-grid">
                <?php foreach (['Camera positioning', 'Lighting conditions', 'Night visibility', 'Coverage requirements', 'Network infrastructure', 'Storage requirements', 'Remote access', 'Power availability', 'Future expansion'] as $c): ?>
                    <li><i class="fa-solid fa-circle-check"></i><?= e($c) ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="btn-row">
                <a class="btn btn-primary" href="cctv.php#site-assessment">Get a CCTV Site Assessment <i class="fa-solid fa-arrow-right"></i></a>
                <a class="btn btn-outline" href="cctv.php">Explore CCTV Solutions</a>
            </div>
        </div>
        <div class="cam-view" data-reveal>
            <img src="<?= e(img('control-room', 1100)) ?>" alt="Security monitoring room with multiple CCTV screens" loading="lazy">
            <span class="scan" aria-hidden="true"></span>
            <div class="cam-hud" aria-hidden="true">
                <span class="corner tl"></span><span class="corner tr"></span><span class="corner bl"></span><span class="corner br"></span>
                <span class="rec">REC</span>
                <span class="cam-id">CAM 01 · HD</span>
                <span class="cam-loc">KAMPALA</span>
                <span class="cam-time" data-cam-clock></span>
            </div>
            <a class="cam-play" href="cctv.php" aria-label="Explore our CCTV solutions"><i class="fa-solid fa-video"></i></a>
        </div>
    </div>
</section>

<!-- ===================== ENVIRONMENTS ===================== -->
<section class="sec sec-soft">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('CCTV for Every Environment') ?>
            <h2 class="sec-title">Surveillance Designed for <span class="hl">Your Property</span></h2>
            <p>Every site is different. We plan camera types, positions and recording around how your property is actually used.</p>
        </div>
        <div class="env-grid">
            <?php foreach ($ENVIRONMENTS as $i => $env): ?>
                <div class="env-card" data-reveal>
                    <span class="env-corner"><i class="fa-solid <?= e($env[2]) ?>"></i></span>
                    <span class="env-label">CCTV for</span>
                    <h3><?= e($env[0]) ?></h3>
                    <p><?= e($env[1]) ?></p>
                    <hr>
                    <a class="btn btn-outline btn-sm" href="cctv.php#site-assessment">Get a Quote <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== WHY US ===================== -->
<section class="sec why">
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
            <div class="wm"><img src="<?= e(img('team-desk', 700)) ?>" alt="IT support team working at computers" loading="lazy"></div>
            <div class="wm"><img src="<?= e(img('network-cables', 700)) ?>" alt="Network cabling in a switch" loading="lazy"></div>
            <div class="ring"><img src="assets/img/logo-mark.png" alt="H.Tubman Solutions logo mark" loading="lazy"></div>
        </div>
    </div>
</section>

<!-- ===================== CTA + COUNTERS ===================== -->
<?php cta_band(null, null, true); ?>
<div class="counter-wrap">
    <div class="container">
        <div class="counter-bar">
            <div class="counter"><span class="c-icon"><i class="fa-solid fa-layer-group"></i></span><div><strong data-count="8">8</strong><span>Core Solution Areas</span></div></div>
            <div class="counter"><span class="c-icon"><i class="fa-solid fa-building-shield"></i></span><div><strong data-count="10" data-suffix="+">10+</strong><span>Notable Organizations Served</span></div></div>
            <div class="counter"><span class="c-icon"><i class="fa-solid fa-list-check"></i></span><div><strong data-count="7">7</strong><span>Step CCTV Installation Process</span></div></div>
            <div class="counter"><span class="c-icon"><i class="fa-solid fa-sliders"></i></span><div><strong data-count="100" data-suffix="%">100%</strong><span>Customized to Your Site</span></div></div>
        </div>
    </div>
</div>

<!-- ===================== INDUSTRIES ===================== -->
<section class="sec industries">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Solutions by Industry') ?>
            <h2 class="sec-title">Technology Designed Around <span class="hl">Your Environment</span></h2>
        </div>
        <div class="ind-grid">
            <?php foreach ($INDUSTRIES as $i => $ind): ?>
                <article class="ind-tile<?= $i === 0 ? ' tall' : '' ?>" data-reveal tabindex="0">
                    <img src="<?= e(img($ind[3], $i === 0 ? 700 : 600)) ?>" alt="" loading="lazy">
                    <div class="ind-body">
                        <span class="ind-icon"><i class="fa-solid <?= e($ind[2]) ?>"></i></span>
                        <h3><?= e($ind[0]) ?></h3>
                        <p><?= e($ind[1]) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== APPROACH ===================== -->
<section class="sec sec-soft">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('How We Work') ?>
            <h2 class="sec-title">Our Approach is <span class="hl">Simple</span></h2>
            <p>Understand the problem → Design the solution → Install it professionally → Support it afterwards.</p>
        </div>
        <div class="approach-grid">
            <?php foreach ($APPROACH as $i => $a): ?>
                <div class="step-card" data-reveal>
                    <div class="s-icon"><i class="fa-solid <?= e($a[2]) ?>"></i><span class="s-num"><?= $i + 1 ?></span></div>
                    <h3><?= e($a[0]) ?></h3>
                    <p><?= e($a[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section class="sec faq">
    <div class="container faq-grid">
        <div class="faq-media" data-reveal>
            <img src="<?= e(img('server-woman', 800)) ?>" alt="Technician checking server infrastructure with a tablet" loading="lazy">
            <div class="faq-help">
                <i class="fa-solid fa-phone-volume"></i>
                <div><strong>Still have questions?</strong><a href="<?= e(tel($SITE['phones'][0])) ?>">Call 0789 977 270</a></div>
            </div>
        </div>
        <div data-reveal>
            <?= sub_title('FAQ') ?>
            <h2 class="sec-title">Frequently Asked <span class="hl">Questions</span></h2>
            <div class="faq-list">
                <?php faq_list(array_slice($FAQS, 0, 6), 'home-faq'); ?>
            </div>
        </div>
    </div>
</section>

<!-- ===================== CLIENTS ===================== -->
<section class="sec sec-dark">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Selected Clients', true) ?>
            <h2 class="sec-title">Trusted by Leading <span class="hl">Organizations</span></h2>
            <p>We have supported technology and infrastructure requirements across different business environments.</p>
        </div>
        <?php clients_grid(); ?>
        <div class="center" style="margin-top:44px"><a class="btn btn-primary" href="projects.php">View Our Projects <i class="fa-solid fa-arrow-right"></i></a></div>
    </div>
</section>

<!-- ===================== MISSION / VISION / VALUES ===================== -->
<section class="sec">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('Who We Are') ?>
            <h2 class="sec-title">Built on Trust &amp; <span class="hl">Innovation</span></h2>
        </div>
        <div class="mvv-grid">
            <article class="mvv-card" data-reveal>
                <div class="mvv-img"><img src="<?= e(img('professional', 700)) ?>" alt="" loading="lazy"><span class="mvv-tag">Mission</span></div>
                <div class="mvv-body"><h3>Our Mission</h3><p>To deliver dependable, future-ready technology and integrated business solutions that empower organizations through innovation, trust and operational excellence.</p><a class="link-more" href="about.php#mission">Read More <i class="fa-solid fa-arrow-right"></i></a></div>
            </article>
            <article class="mvv-card" data-reveal>
                <div class="mvv-img"><img src="<?= e(img('city', 700)) ?>" alt="" loading="lazy"><span class="mvv-tag">Vision</span></div>
                <div class="mvv-body"><h3>Our Vision</h3><p>To become East Africa’s most trusted force in transformative technology and enterprise solutions, shaping smarter businesses and connected communities.</p><a class="link-more" href="about.php#mission">Read More <i class="fa-solid fa-arrow-right"></i></a></div>
            </article>
            <article class="mvv-card" data-reveal>
                <div class="mvv-img"><img src="<?= e(img('team-desk', 700)) ?>" alt="" loading="lazy"><span class="mvv-tag">Values</span></div>
                <div class="mvv-body"><h3>Our Values</h3><p>Reliability, professionalism, innovation, integrity and customer focus guide every consultation, installation and support call.</p><a class="link-more" href="about.php#values">Read More <i class="fa-solid fa-arrow-right"></i></a></div>
            </article>
        </div>
    </div>
</section>

<?php brands_strip(); ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
