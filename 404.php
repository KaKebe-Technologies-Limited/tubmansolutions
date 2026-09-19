<?php
http_response_code(404);
$page_key   = '';
$meta_title = 'Page Not Found | H.Tubman Solutions Limited';
$meta_desc  = 'The page you are looking for could not be found.';
$robots     = 'noindex, follow';
$use_base   = true; // served from any URL depth, so resolve assets from the site root
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/partials.php';
?>
<section class="nf">
    <div class="container">
        <div class="code">404</div>
        <h1>Page not found</h1>
        <p>The page you are looking for may have moved. Try one of these instead:</p>
        <div class="btn-row center">
            <a class="btn btn-primary" href="<?= e(u('index.php')) ?>">Back to Home <i class="fa-solid fa-arrow-right"></i></a>
            <a class="btn btn-outline" href="<?= e(u('cctv.php')) ?>">CCTV Installation</a>
            <a class="btn btn-outline" href="<?= e(u('contact.php')) ?>">Contact Us</a>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
