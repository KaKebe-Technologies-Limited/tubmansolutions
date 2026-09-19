<?php
/** WhatsApp band + footer + floating actions + scripts. */
?>
</main>

<?php if (empty($hide_wa_band)): ?>
<section class="wa-band">
    <div class="container wa-band-inner">
        <div class="wa-band-icon"><i class="fa-brands fa-whatsapp"></i></div>
        <div class="wa-band-text">
            <h3>Looking for CCTV installation?</h3>
            <p>Don’t wait until something happens. Chat with <?= e($SITE['name']) ?> on WhatsApp and get assistance with your CCTV or security requirements.</p>
        </div>
        <a class="btn btn-white" href="<?= e(wa('Hello H.Tubman Solutions, I am looking for CCTV installation.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
    </div>
</section>
<?php endif; ?>

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="f-col f-about">
            <a class="brand brand-light" href="<?= e(u('index.php')) ?>">
                <img src="assets/img/logo-mark-light.png" alt="" width="54" height="54" loading="lazy">
                <span class="brand-text"><strong>H.TUBMAN</strong><small>SOLUTIONS</small></span>
            </a>
            <p class="f-tagline"><?= e($SITE['tagline']) ?></p>
            <p>From a single CCTV camera installation to complete business IT infrastructure, we provide practical technology solutions designed to protect, connect and support your organization.</p>
            <div class="f-social">
                <a href="<?= e(wa()) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="<?= e(tel($SITE['phones'][0])) ?>" aria-label="Call"><i class="fa-solid fa-phone"></i></a>
                <a href="mailto:<?= e($SITE['email']) ?>" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                <?php foreach (['facebook' => 'fa-facebook-f', 'instagram' => 'fa-instagram', 'linkedin' => 'fa-linkedin-in', 'x' => 'fa-x-twitter', 'tiktok' => 'fa-tiktok', 'youtube' => 'fa-youtube'] as $net => $ico): ?>
                    <?php if (!empty($SITE['social'][$net])): ?><a href="<?= e($SITE['social'][$net]) ?>" target="_blank" rel="noopener me" aria-label="<?= e(ucfirst($net)) ?>"><i class="fa-brands <?= $ico ?>"></i></a><?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="f-col">
            <h4>Quick Links</h4>
            <ul class="f-links">
                <li><a href="<?= e(u('index.php')) ?>">Home</a></li>
                <li><a href="<?= e(u('about.php')) ?>">About Us</a></li>
                <li><a href="<?= e(u('cctv.php')) ?>">CCTV Solutions</a></li>
                <li><a href="<?= e(u('networking.php')) ?>">Networking</a></li>
                <li><a href="<?= e(u('access-control.php')) ?>">Access Control</a></li>
                <li><a href="<?= e(u('it-support.php')) ?>">IT Support</a></li>
                <li><a href="<?= e(u('projects.php')) ?>">Projects</a></li>
                <li><a href="<?= e(u('contact.php')) ?>">Contact</a></li>
            </ul>
        </div>

        <div class="f-col">
            <h4>Our Services</h4>
            <ul class="f-links">
                <?php foreach ($SERVICES as $s): ?>
                    <li><a href="<?= e(u($s['page'])) ?>"><?= e($s['nav']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="f-col">
            <h4>Contact</h4>
            <ul class="f-contact">
                <li><i class="fa-solid fa-location-dot"></i><span><?= e($SITE['location']) ?></span></li>
                <li><i class="fa-solid fa-phone"></i><span><a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a> / <a href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a></span></li>
                <li><i class="fa-brands fa-whatsapp"></i><span><a href="<?= e(wa()) ?>" target="_blank" rel="noopener">WhatsApp: <?= e($SITE['whatsapp_display']) ?></a></span></li>
                <li><i class="fa-solid fa-envelope"></i><span><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></span></li>
                <li><i class="fa-solid fa-globe"></i><span><?= e($SITE['website']) ?></span></li>
            </ul>
            <div class="btn-row f-btns">
                <a class="btn btn-primary btn-sm" href="<?= e(u('contact.php#quote')) ?>">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                <?php if ($SITE['google_review']): ?>
                    <a class="btn btn-outline-light btn-sm" href="<?= e($SITE['google_review']) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-google"></i> Review us</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="footer-popular">
        <div class="container">
            <span>Popular searches:</span>
            <a href="<?= e(u('cctv.php')) ?>">CCTV installation Kampala</a>
            <a href="<?= e(u('cctv.php#solar-cctv')) ?>">Solar CCTV Uganda</a>
            <a href="<?= e(u('cctv.php#maintenance')) ?>">CCTV repair Kampala</a>
            <a href="<?= e(u('cctv.php#remote-monitoring')) ?>">CCTV remote viewing</a>
            <a href="<?= e(u('access-control.php')) ?>">Biometric attendance Uganda</a>
            <a href="<?= e(u('networking.php')) ?>">Wi-Fi installation Kampala</a>
            <a href="<?= e(u('it-support.php')) ?>">IT support Kampala</a>
            <a href="<?= e(u('digital-solutions.php')) ?>">Website design Kampala</a>
            <a href="<?= e(u('faq.php')) ?>">CCTV &amp; IT FAQs</a>
        </div>
    </div>
    <div class="footer-lines">
        <div class="container"><p>CCTV <i>|</i> SECURITY <i>|</i> NETWORKING <i>|</i> IT <i>|</i> ACCESS CONTROL <i>|</i> INFRASTRUCTURE</p></div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>&copy; <?= date('Y') ?> <?= e($SITE['name']) ?>. All Rights Reserved.</p>
            <p class="f-motto">Technology<span>.</span> Innovation<span>.</span> Solutions<span>.</span></p>
        </div>
    </div>
</footer>

<a class="wa-float" href="<?= e(wa()) ?>" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp"><i class="fa-brands fa-whatsapp"></i><span>Chat with us</span></a>
<button class="to-top" type="button" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>

<script type="application/ld+json"><?= seo_jsonld($meta_title, $meta_desc) ?></script>
<script>window.SITE_WA = <?= json_encode($SITE['whatsapp']) ?>; window.SITE_SEARCH = <?= json_encode(u('search.php')) ?>;</script>
<script src="assets/js/main.js?v=<?= filemtime(dirname(__DIR__) . '/assets/js/main.js') ?>" defer></script>
</body>
</html>
