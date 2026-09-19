<?php
/**
 * Shared layout for individual service pages (template "service details").
 * Usage: $slug = 'networking'; require __DIR__ . '/includes/service-page.php';
 */
require_once __DIR__ . '/config.php';

$svc        = $SERVICES[$slug];
$page_key   = $svc['page'];
$meta_title = $svc['seo_title'];
$meta_desc  = $svc['seo_desc'];
$og_title   = $svc['h1'] . ' | H.Tubman Solutions';
require __DIR__ . '/header.php';
require __DIR__ . '/partials.php';

page_banner(e($svc['h1']), ['services.php' => 'Services', $svc['nav']], $svc['banner'] ?? $svc['img'], $svc['excerpt']);
$SEO_EXTRA[] = service_node($svc['h1'], implode(' ', $svc['intro']) . ' ' . $svc['excerpt'], $svc['page'], $svc['list'], $svc['title']);
?>

<section class="sec">
    <div class="container svc-layout">
        <aside class="svc-sidebar">
            <div class="side-box">
                <h3>All Services</h3>
                <nav class="side-links" aria-label="Services">
                    <?php foreach ($SERVICES as $k => $s): ?>
                        <a href="<?= e(u($s['page'])) ?>"<?= $k === $slug ? ' class="active" aria-current="page"' : '' ?>><?= e($s['title']) ?><i class="fa-solid fa-arrow-right"></i></a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="side-help" style="--bg:url('<?= e(img('technician', 600)) ?>')">
                <span class="sh-icon"><i class="fa-solid fa-headset"></i></span>
                <h3>Need Help?</h3>
                <p>Talk to our technical team about your requirements.</p>
                <a class="sh-phone" href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a>
                <a class="sh-phone" href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a>
                <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I need help with ' . $svc['title'] . '.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp Us</a>
            </div>
        </aside>

        <div class="svc-main">
            <div class="svc-hero-img" data-reveal><img src="<?= e(img($svc['img'], 1200, 600)) ?>" alt="<?= e($svc['title']) ?> by H.Tubman Solutions" loading="lazy"></div>
            <div data-reveal>
                <?= sub_title($svc['title']) ?>
                <h2><?= e($svc['headline'][0]) ?> <span class="hl"><?= e($svc['headline'][1]) ?></span></h2>
                <div class="intro">
                    <?php foreach ($svc['intro'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
                </div>
            </div>

            <h3 data-reveal><?= e($svc['list_title']) ?></h3>
            <ul class="check-list">
                <?php foreach ($svc['list'] as $item): ?>
                    <li data-reveal><i class="fa-solid fa-check"></i><?= e($item) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php if (!empty($svc['extra'])): $x = $svc['extra']; ?>
                <?php if ($x['tags']): ?>
                    <h3 data-reveal><?= e($x['title']) ?></h3>
                    <p data-reveal><?= e($x['text']) ?></p>
                    <ul class="tag-list" data-reveal>
                        <?php foreach ($x['tags'] as $t): ?><li><i class="fa-solid fa-circle-check"></i><?= e($t) ?></li><?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="info-box" data-reveal>
                        <span class="ib-icon"><i class="fa-solid <?= e($svc['icon']) ?>"></i></span>
                        <div><h3><?= e($x['title']) ?></h3><p><?= e($x['text']) ?></p></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <h3 data-reveal>How We Deliver</h3>
            <div class="mini-steps">
                <?php foreach ($APPROACH as $i => $a): ?>
                    <div class="mini-step" data-reveal><i class="fa-solid <?= e($a[2]) ?>"></i><h4><?= e($a[0]) ?></h4></div>
                <?php endforeach; ?>
            </div>

            <div class="svc-cta-row" data-reveal>
                <div>
                    <h3><?= e($svc['cta']) ?></h3>
                    <p>Tell us what you need and we’ll recommend the right solution.</p>
                </div>
                <div class="btn-row">
                    <a class="btn btn-primary" href="<?= e(u('contact.php')) ?>?service=<?= rawurlencode($svc['option']) ?>#quote">Request a Quote <i class="fa-solid fa-arrow-right"></i></a>
                    <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I am interested in ' . $svc['title'] . '.')) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php cta_band(); ?>
<?php require __DIR__ . '/footer.php'; ?>
