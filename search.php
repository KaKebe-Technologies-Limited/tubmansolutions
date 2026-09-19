<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/partials.php';
require_once __DIR__ . '/includes/search-engine.php';

$q   = trim((string) ($_GET['q'] ?? ''));
$res = $q !== '' ? search_run($q, 15) : null;

// JSON for the live search box in the header
if (($_GET['format'] ?? '') === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    header('X-Robots-Tag: noindex');
    if ($res) {
        foreach ($res['results'] as &$r) {
            $r['url'] = u($r['url']);
        }
        unset($r);
        $res['results'] = array_slice($res['results'], 0, 6);
        if ($res['answer']) {
            $res['answer']['url'] = u($res['answer']['url']);
        }
    }
    echo json_encode($res ?: ['query' => '', 'results' => []], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

// learn what customers look for: storage/searches.csv (query + result count, no personal data)
if ($q !== '') {
    $dir = __DIR__ . '/storage';
    if (is_dir($dir) && ($fh = @fopen($dir . '/searches.csv', 'a'))) {
        fputcsv($fh, [date('Y-m-d H:i:s'), preg_replace('/^[=+\-@]/', "'$0", $q), $res['total']]);
        fclose($fh);
    }
}

$page_key   = 'search';
$meta_title = $q !== '' ? 'Search: ' . $q . ' | H.Tubman Solutions' : 'Search | H.Tubman Solutions';
$meta_desc  = 'Search CCTV, networking, access control, IT support and other ICT solutions from H.Tubman Solutions Limited, Kampala.';
$robots     = 'noindex, follow';
require __DIR__ . '/includes/header.php';

page_banner($q !== '' ? 'Results for “<span class="hl">' . e($q) . '</span>”' : 'Search <span class="hl">Our Solutions</span>', ['Search'], 'fiber-rack');
?>

<section class="sec search-page">
    <div class="container search-wrap">
        <form class="search-big" action="<?= e(u('search.php')) ?>" method="get" role="search">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            <input type="search" name="q" value="<?= e($q) ?>" placeholder="e.g. solar CCTV for a farm, fingerprint attendance, Wi-Fi for office" aria-label="Search" maxlength="120" autofocus>
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <?php if ($res && $res['did_you_mean']): ?>
            <p class="dym">Did you mean <a href="<?= e(u('search.php')) ?>?q=<?= rawurlencode($res['did_you_mean']) ?>"><strong><?= e($res['did_you_mean']) ?></strong></a>?</p>
        <?php endif; ?>

        <?php if ($res && $res['answer']): ?>
            <div class="answer-card" data-reveal>
                <span class="answer-badge"><i class="fa-solid fa-bolt"></i> Quick answer</span>
                <h2><?= e($res['answer']['question']) ?></h2>
                <p><?= e($res['answer']['text']) ?></p>
                <div class="btn-row">
                    <a class="btn btn-primary btn-sm" href="<?= e(u('contact.php#quote')) ?>">Get a Free Quote <i class="fa-solid fa-arrow-right"></i></a>
                    <a class="btn btn-wa btn-sm" href="<?= e(wa('Hello H.Tubman Solutions, ' . $res['answer']['question'])) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Ask on WhatsApp</a>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($res && $res['results']): ?>
            <p class="result-count"><?= count($res['results']) ?> best match<?= count($res['results']) === 1 ? '' : 'es' ?></p>
            <ol class="results">
                <?php foreach ($res['results'] as $r): ?>
                    <li class="result" data-reveal>
                        <span class="r-type r-<?= e(strtolower($r['type'])) ?>"><?= e($r['type']) ?></span>
                        <h3><a href="<?= e(u($r['url'])) ?>"><?= e($r['title']) ?></a></h3>
                        <p><?= $r['snippet'] /* already escaped + highlighted */ ?></p>
                        <a class="r-url" href="<?= e(u($r['url'])) ?>"><?= e(rtrim($SITE['website'] . '/' . u($r['url']), './')) ?></a>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php elseif ($q !== ''): ?>
            <div class="no-results">
                <i class="fa-solid fa-magnifying-glass-minus"></i>
                <h2>No exact matches for “<?= e($q) ?>”</h2>
                <p>Try a simpler word such as <em>CCTV</em>, <em>Wi-Fi</em>, <em>biometric</em> or <em>IT support</em> — or just ask us directly.</p>
                <div class="btn-row center">
                    <a class="btn btn-wa" href="<?= e(wa('Hello H.Tubman Solutions, I am looking for: ' . $q)) ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Ask on WhatsApp</a>
                    <a class="btn btn-outline" href="<?= e(u('contact.php#quote')) ?>">Request a Quote</a>
                </div>
            </div>
        <?php endif; ?>

        <div class="search-suggest">
            <h3>Popular searches</h3>
            <div class="tag-list">
                <?php foreach (['CCTV installation Kampala', 'How much does CCTV cost', 'Solar CCTV for farm', 'CCTV repair', 'View cameras on phone', 'Fingerprint attendance', 'Wi-Fi installation', 'IT support for business', 'Website design'] as $pq): ?>
                    <a href="<?= e(u('search.php')) ?>?q=<?= rawurlencode($pq) ?>"><i class="fa-solid fa-magnifying-glass"></i><?= e($pq) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
