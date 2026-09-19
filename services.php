<?php
$page_key   = 'services';
$meta_title = 'ICT Services Uganda | CCTV, Networking & IT Support | H.Tubman';
$meta_desc  = 'CCTV & security systems, networking, access control, IT support, servers, cybersecurity, hardware and websites in Kampala & across Uganda. Free quote.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';

page_banner('ICT &amp; Security Services <span class="hl">in Uganda</span>', ['Services'], 'server-rack', 'CCTV & Security | Networking | IT Support | Access Control | Servers | Digital Solutions');
?>

<section class="sec">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('What We Do') ?>
            <h2 class="sec-title">Technology That Protects, Connects &amp; <span class="hl">Supports</span></h2>
            <p>From a single CCTV camera installation to complete business IT infrastructure, we provide practical technology solutions designed around your needs.</p>
        </div>
        <div class="svc-overview">
            <?php $n = 0; foreach ($SERVICES as $key => $s): $n++;
                $items = $key === 'cctv'
                    ? ['CCTV camera installation', 'IP, PTZ & night-vision cameras', 'Solar & 4G CCTV', 'NVR & DVR installation', 'Remote viewing on your phone', 'Maintenance & upgrades']
                    : array_slice($s['list'], 0, 4); ?>
                <article class="svc-ov-card<?= $key === 'cctv' ? ' featured' : '' ?>" data-reveal>
                    <div class="ov-img">
                        <img src="<?= e(img($s['img'], $key === 'cctv' ? 900 : 500)) ?>" alt="<?= e($s['title']) ?>" loading="lazy">
                        <span class="ov-icon"><i class="fa-solid <?= e($s['icon']) ?>"></i></span>
                    </div>
                    <div class="ov-body">
                        <?php if ($key === 'cctv'): ?><?= sub_title('Most Requested') ?><?php endif; ?>
                        <h3><a href="<?= e(u($s['page'])) ?>" style="color:inherit"><?= str_pad($n, 2, '0', STR_PAD_LEFT) ?> — <?= e($s['title']) ?></a></h3>
                        <p><?= e($s['excerpt']) ?></p>
                        <ul><?php foreach ($items as $it): ?><li><?= e($it) ?></li><?php endforeach; ?></ul>
                        <?php if ($key === 'cctv'): ?>
                            <div class="btn-row">
                                <a class="btn btn-primary" href="<?= e(u('cctv.php')) ?>">Explore CCTV Solutions <i class="fa-solid fa-arrow-right"></i></a>
                                <a class="btn btn-outline" href="<?= e(u('cctv.php#site-assessment')) ?>">Get a CCTV Quote</a>
                            </div>
                        <?php else: ?>
                            <a class="link-more" href="<?= e(u($s['page'])) ?>">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="sec sec-soft" id="industries">
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

<section class="sec">
    <div class="container">
        <div class="sec-head" data-reveal>
            <?= sub_title('How We Work') ?>
            <h2 class="sec-title">Our Approach is <span class="hl">Simple</span></h2>
        </div>
        <div class="approach-grid">
            <?php foreach ($APPROACH as $i => $a): ?>
                <div class="step-card" data-reveal style="box-shadow:none;border:1px solid var(--border)">
                    <div class="s-icon"><i class="fa-solid <?= e($a[2]) ?>"></i><span class="s-num"><?= $i + 1 ?></span></div>
                    <h3><?= e($a[0]) ?></h3>
                    <p><?= e($a[1]) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php cta_band(); ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
