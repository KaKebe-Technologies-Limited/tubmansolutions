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
            <a class="brand brand-light" href="index.php">
                <img src="assets/img/logo-mark-light.png" alt="" width="54" height="54" loading="lazy">
                <span class="brand-text"><strong>H.TUBMAN</strong><small>SOLUTIONS</small></span>
            </a>
            <p class="f-tagline"><?= e($SITE['tagline']) ?></p>
            <p>From a single CCTV camera installation to complete business IT infrastructure, we provide practical technology solutions designed to protect, connect and support your organization.</p>
            <div class="f-social">
                <a href="<?= e(wa()) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="<?= e(tel($SITE['phones'][0])) ?>" aria-label="Call"><i class="fa-solid fa-phone"></i></a>
                <a href="mailto:<?= e($SITE['email']) ?>" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
            </div>
        </div>

        <div class="f-col">
            <h4>Quick Links</h4>
            <ul class="f-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="cctv.php">CCTV Solutions</a></li>
                <li><a href="networking.php">Networking</a></li>
                <li><a href="access-control.php">Access Control</a></li>
                <li><a href="it-support.php">IT Support</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <div class="f-col">
            <h4>Our Services</h4>
            <ul class="f-links">
                <?php foreach ($SERVICES as $s): ?>
                    <li><a href="<?= e($s['page']) ?>"><?= e($s['nav']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="f-col">
            <h4>Contact</h4>
            <ul class="f-contact">
                <li><i class="fa-solid fa-location-dot"></i><span><?= e($SITE['location']) ?></span></li>
                <li><i class="fa-solid fa-phone"></i><span><a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a> / <a href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a></span></li>
                <li><i class="fa-solid fa-envelope"></i><span><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></span></li>
                <li><i class="fa-solid fa-globe"></i><span><?= e($SITE['website']) ?></span></li>
            </ul>
            <a class="btn btn-primary btn-sm" href="contact.php#quote">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
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

<script>window.SITE_WA = <?= json_encode($SITE['whatsapp']) ?>;</script>
<script src="assets/js/main.js?v=1.0" defer></script>
</body>
</html>
