<?php
require __DIR__ . '/includes/form-handler.php';

$page_key   = 'contact';
$meta_title = 'Contact H.Tubman Solutions | CCTV & IT Company in Kampala, Uganda';
$meta_desc  = 'Free quote for CCTV, networking, access control & IT support in Kampala. Call 0789977270, WhatsApp 0768743419 or email info@htubmansolutions.com.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

$preselect = in_array($_GET['service'] ?? '', $SERVICE_OPTIONS, true) ? $_GET['service'] : '';

page_banner('Let’s Secure &amp; Connect <span class="hl">Your Business</span>', ['Contact'], 'office', 'Whether you need CCTV installation, networking, access control, IT support or another technology solution, our team is ready to help.');
?>

<section class="sec">
    <div class="container">
        <div class="contact-cards">
            <div class="contact-card" data-reveal>
                <span class="cc-icon"><i class="fa-solid fa-location-dot"></i></span>
                <h3>Location</h3>
                <p><?= e($SITE['location']) ?></p>
            </div>
            <div class="contact-card" data-reveal>
                <span class="cc-icon"><i class="fa-solid fa-phone-volume"></i></span>
                <h3>Phone</h3>
                <p><a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a><br><a href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a><br><a href="<?= e(wa()) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> <?= e($SITE['whatsapp_display']) ?></a></p>
            </div>
            <div class="contact-card" data-reveal>
                <span class="cc-icon"><i class="fa-solid fa-envelope-open-text"></i></span>
                <h3>Email</h3>
                <p><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></p>
            </div>
            <div class="contact-card" data-reveal>
                <span class="cc-icon"><i class="fa-solid fa-globe"></i></span>
                <h3>Website</h3>
                <p><a href="<?= e($SITE['url']) ?>"><?= e($SITE['website']) ?></a></p>
            </div>
        </div>

        <div class="contact-layout" id="quote">
            <div class="form-card" data-reveal>
                <?= sub_title('Request a Quote') ?>
                <h2>Tell Us What <span class="hl">You Need</span></h2>
                <p>Fill in the form and our technical team will get back to you. Prefer chatting? Send the same details straight to WhatsApp.</p>

                <?php if (isset($_GET['sent'])): ?>
                    <div class="alert alert-success" role="status"><i class="fa-solid fa-circle-check"></i>
                        <div><strong>Thank you — your request has been received.</strong><br>Our team will contact you shortly. For urgent requests call <a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a> or <a href="<?= e(wa()) ?>" target="_blank" rel="noopener">WhatsApp us</a>.</div>
                    </div>
                <?php endif; ?>
                <?php if ($form_errors): ?>
                    <div class="alert alert-error" role="alert"><i class="fa-solid fa-triangle-exclamation"></i>
                        <div><strong>Please check the form:</strong><ul><?php foreach ($form_errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul></div>
                    </div>
                <?php endif; ?>

                <?php quote_form($preselect, 'Request a Quote', 'Contact page'); ?>
            </div>

            <aside class="contact-aside" data-reveal>
                <div class="aside-dark">
                    <?= sub_title('Talk to an Expert', true) ?>
                    <h3>Need CCTV or IT Solutions?</h3>
                    <p>Tell us what you need and our technical team will help you identify the right solution.</p>
                    <a class="btn btn-primary" href="#quote">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                    <a class="btn btn-wa" href="<?= e(wa()) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp</a>
                    <a class="btn btn-outline-light" href="<?= e(tel($SITE['phones'][0])) ?>"><i class="fa-solid fa-phone"></i> Call Us Now</a>
                </div>
                <div class="map">
                    <iframe title="Map of Kampala, Uganda" src="https://maps.google.com/maps?q=Kampala%2C%20Uganda&amp;z=12&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="sec sec-soft">
    <div class="container faq-grid">
        <div class="faq-media" data-reveal>
            <img src="<?= e(img('technician-2', 800)) ?>" alt="Technician ready to help" loading="lazy">
            <div class="faq-help">
                <i class="fa-solid fa-phone-volume"></i>
                <div><strong>Call us directly</strong><a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a> / <a href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a></div>
            </div>
        </div>
        <div data-reveal>
            <?= sub_title('FAQ') ?>
            <h2 class="sec-title">Frequently Asked <span class="hl">Questions</span></h2>
            <div class="faq-list"><?php faq_list($FAQS, 'contact-faq'); ?></div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
