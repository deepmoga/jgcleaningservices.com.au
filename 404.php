<?php
declare(strict_types=1);
require_once __DIR__ . '/lib/bootstrap.php';
http_response_code(404);
$pageTitle = 'Page Not Found | ' . setting('site_name');
$pageDescription = 'The requested page could not be found.';
$currentPage = '';
require __DIR__ . '/includes/header.php';
?>
<main id="main-content"><section class="not-found"><div class="container"><span>404</span><h1>This page has moved or does not exist.</h1><p>Return to the homepage or explore our professional Melbourne cleaning services.</p><div><a class="btn btn--primary" href="<?= e(url()) ?>">Back to Home <span>↗</span></a><a class="btn btn--ghost" href="<?= e(url('services')) ?>">View Services</a></div></div></section></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
