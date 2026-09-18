<?php
/** Reusable page fragments. */
require_once __DIR__ . '/config.php';

function sub_title($text, $light = false)
{
    return '<span class="sub-title' . ($light ? ' light' : '') . '"><i class="px" aria-hidden="true"></i>' . e($text) . '</span>';
}

function page_banner($title, $crumb, $img_key, $lead = '')
{
    ?>
    <section class="page-banner" style="--bg:url('<?= e(img($img_key, 1800)) ?>')">
        <div class="container">
            <h1><?= $title ?></h1>
            <?php if ($lead): ?><p class="lead"><?= e($lead) ?></p><?php endif; ?>
            <ol class="breadcrumb" aria-label="Breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <?php foreach ((array) $crumb as $href => $label): ?>
                    <?php if (is_string($href)): ?>
                        <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
                    <?php else: ?>
                        <li aria-current="page"><?= e($label) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>
    <?php
}

/**
 * Full enquiry form. Posts to contact.php which validates, stores and emails it.
 */
function quote_form($preselect = '', $button = 'Request a Quote', $source = '')
{
    global $SERVICE_OPTIONS;
    $old = $GLOBALS['form_old'] ?? [];
    $val = function ($k) use ($old) { return e($old[$k] ?? ''); };
    $selected = $old['service'] ?? $preselect;
    ?>
    <form class="quote-form" action="contact.php#quote" method="post" data-wa-form novalidate>
        <input type="hidden" name="source" value="<?= e($source) ?>">
        <div class="hp" aria-hidden="true"><label>Leave this empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
        <div class="form-grid">
            <label class="field"><span>Name <em>*</em></span>
                <input type="text" name="name" required autocomplete="name" placeholder="Your full name" value="<?= $val('name') ?>"></label>
            <label class="field"><span>Phone Number <em>*</em></span>
                <input type="tel" name="phone" required autocomplete="tel" placeholder="e.g. 0789 977 270" value="<?= $val('phone') ?>"></label>
            <label class="field"><span>Email</span>
                <input type="email" name="email" autocomplete="email" placeholder="you@company.com" value="<?= $val('email') ?>"></label>
            <label class="field"><span>Service Required</span>
                <select name="service">
                    <option value="">Choose a service</option>
                    <?php foreach ($SERVICE_OPTIONS as $opt): ?>
                        <option<?= $opt === $selected ? ' selected' : '' ?>><?= e($opt) ?></option>
                    <?php endforeach; ?>
                </select></label>
            <label class="field full"><span>Location</span>
                <input type="text" name="location" autocomplete="address-level2" placeholder="e.g. Ntinda, Kampala" value="<?= $val('location') ?>"></label>
            <label class="field full"><span>Message</span>
                <textarea name="message" rows="4" placeholder="Tell us about your property, number of cameras, or the problem you need solved"><?= $val('message') ?></textarea></label>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit"><?= e($button) ?> <i class="fa-solid fa-arrow-right"></i></button>
            <button class="btn btn-wa" type="button" data-wa-send><i class="fa-brands fa-whatsapp"></i> Send via WhatsApp</button>
        </div>
    </form>
    <?php
}

function faq_list($faqs, $group = 'faq')
{
    foreach ($faqs as $i => $f): ?>
        <details class="faq-item" name="<?= e($group) ?>"<?= $i === 0 ? ' open' : '' ?>>
            <summary><span class="q-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span><?= e($f[0]) ?><i class="fa-solid fa-plus" aria-hidden="true"></i></summary>
            <div class="faq-body"><p><?= e($f[1]) ?></p></div>
        </details>
    <?php endforeach;
}

function initials($name)
{
    $words = preg_split('/[\s\-]+/', preg_replace('/[^A-Za-z\s\-]/', '', $name));
    $out = '';
    foreach ($words as $w) {
        if ($w !== '' && strlen($out) < 2 && !in_array(strtolower($w), ['limited', 'uganda', 'of'], true)) {
            $out .= strtoupper($w[0]);
        }
    }
    return $out;
}

function clients_grid()
{
    global $CLIENTS;
    ?>
    <div class="clients-grid">
        <?php foreach ($CLIENTS as $c): ?>
            <div class="client-card" data-reveal>
                <span class="client-mono"><?= e(initials($c)) ?></span>
                <span class="client-name"><?= e($c) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function brands_strip()
{
    ?>
    <section class="brands">
        <div class="container brands-inner">
            <p class="brands-label">Technology we work with</p>
            <ul class="brand-list">
                <li>HIKVISION</li><li>dahua</li><li>tp-link</li><li>UBIQUITI</li><li class="more">+ other professional equipment</li>
            </ul>
        </div>
    </section>
    <?php
}

/** Dark call-to-action band used across pages (section 20 of the brief). */
function cta_band($title = null, $text = null, $with_counters = false)
{
    global $SITE;
    $title = $title ?? 'Need CCTV or IT <span class="hl">Solutions?</span>';
    $text  = $text ?? 'Tell us what you need and our technical team will help you identify the right solution.';
    ?>
    <section class="cta-band<?= $with_counters ? '' : ' no-counters' ?>" style="--bg:url('<?= e(img('server-rack', 1800)) ?>')">
        <div class="container cta-band-inner" data-reveal>
            <?= sub_title('Get Started', true) ?>
            <h2><?= $title ?></h2>
            <p><?= e($text) ?></p>
            <div class="cta-phone"><i class="fa-solid fa-phone-volume"></i>
                <a href="<?= e(tel($SITE['phones'][0])) ?>">0789 977 270</a><span>/</span><a href="<?= e(tel($SITE['phones'][1])) ?>">0784 801 913</a></div>
            <div class="btn-row center">
                <a class="btn btn-primary" href="contact.php#quote">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                <a class="btn btn-wa" href="<?= e(wa()) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp</a>
                <a class="btn btn-outline-light" href="<?= e(tel($SITE['phones'][0])) ?>"><i class="fa-solid fa-phone"></i> Call Us Now</a>
            </div>
        </div>
    </section>
    <?php
}
