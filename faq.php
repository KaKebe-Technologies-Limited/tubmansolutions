<?php
$page_key   = 'faq';
$meta_title = 'CCTV & IT FAQs Uganda | Cost, Repair & Support | H.Tubman';
$meta_desc  = 'Answers to common questions about CCTV installation cost in Uganda, remote phone viewing, solar CCTV, repairs, IT support, Wi-Fi, biometrics and getting a free quote.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

page_banner('Frequently Asked <span class="hl">Questions</span>', ['FAQ'], 'cctv-wall', 'Straight answers about CCTV, networking, access control, IT support and working with H.Tubman Solutions.');

$groups = [
    ['cctv-questions', 'CCTV Installation & Security Cameras', 'fa-video', $FAQS],
    ['ict-questions', 'Networking, IT Support, Access Control & More', 'fa-network-wired', $FAQ_ICT],
    ['working-with-us', 'Working With H.Tubman Solutions', 'fa-handshake', $FAQ_GENERAL],
];
?>

<section class="sec">
    <div class="container faq-page">
        <aside class="faq-nav">
            <div class="side-box">
                <h3>Topics</h3>
                <nav class="side-links" aria-label="FAQ topics">
                    <?php foreach ($groups as $g): ?>
                        <a href="#<?= e($g[0]) ?>"><?= e($g[1]) ?><i class="fa-solid fa-arrow-down"></i></a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="side-help" style="--bg:url('<?= e(img('technician', 600)) ?>')">
                <span class="sh-icon"><i class="fa-brands fa-whatsapp"></i></span>
                <h3>Still have a question?</h3>
                <p>Chat with our technical team.</p>
                <a class="sh-phone" href="<?= e(wa()) ?>" target="_blank" rel="noopener"><?= e($SITE['whatsapp_display']) ?></a>
                <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I have a question.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
            </div>
        </aside>
        <div class="faq-groups">
            <?php foreach ($groups as $g): ?>
                <div class="faq-group" id="<?= e($g[0]) ?>">
                    <h2><span><i class="fa-solid <?= e($g[2]) ?>"></i></span><?= e($g[1]) ?></h2>
                    <div class="faq-list"><?php faq_list($g[3], $g[0], false); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php cta_band(); ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
