<?php
declare(strict_types=1);

require __DIR__ . '/lib/bootstrap.php';

$slug = slugify((string) ($_GET['slug'] ?? ''));
$allowed = ['about', 'services', 'contact', 'privacy-policy'];
if (!in_array($slug, $allowed, true) || !($page = get_page($slug))) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$services = get_services();
$enquiryResult = $slug === 'contact' ? handle_enquiry_submission('contact') : ['submitted' => false];
$pageTitle = (string) ($page['meta_title'] ?: $page['title'] . ' | ' . setting('site_name'));
$pageDescription = (string) ($page['meta_description'] ?: $page['hero_subtitle']);
$pageKeywords = (string) $page['meta_keywords'];
$canonicalUrl = url($slug);
$currentPage = $slug;
require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
    <section class="page-hero"><div class="container page-hero__inner"><div><nav class="breadcrumbs" aria-label="Breadcrumb"><a href="<?= e(url()) ?>">Home</a><span>›</span><span><?= e($page['title']) ?></span></nav><span class="eyebrow eyebrow--light"><?= $slug === 'services' ? 'Professional solutions' : 'JG Cleaning Services' ?></span><h1><?= e($page['hero_title']) ?></h1><p><?= e($page['hero_subtitle']) ?></p></div></div></section>

    <?php if ($slug === 'services'): ?>
    <section class="section inner-services"><div class="container"><div class="content-prose content-prose--intro"><?= sanitize_content((string) $page['content']) ?></div><div class="services-grid services-grid--images">
        <?php foreach ($services as $index => $service): ?><article class="service-card service-card--image reveal"><a class="service-card__image" href="<?= e(url('services/' . $service['slug'])) ?>"><img src="<?= e(asset((string) ($service['card_image'] ?: 'assets/images/jg-cleaning-team-hero.webp'))) ?>" alt="<?= e($service['title']) ?> Melbourne" loading="lazy"><span><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span></a><div class="service-card__body"><h2><a href="<?= e(url('services/' . $service['slug'])) ?>"><?= e($service['title']) ?></a></h2><p><?= e($service['short_description']) ?></p><a href="<?= e(url('services/' . $service['slug'])) ?>">Read service details <span>↗</span></a></div></article><?php endforeach; ?>
    </div></div></section>
    <?php elseif ($slug === 'contact'): ?>
    <section class="section contact-page" id="quote"><div class="container contact-page__grid"><div class="contact-page__info"><span class="eyebrow">Contact our team</span><div class="content-prose"><?= sanitize_content((string) $page['content']) ?></div><div class="contact-cards"><a href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>"><span>☎</span><div><small>Phone</small><strong><?= e((string) setting('phone_1')) ?></strong><?php if (setting('phone_2')): ?><b><?= e((string) setting('phone_2')) ?></b><?php endif; ?></div></a><a href="mailto:<?= e((string) setting('email_1')) ?>"><span>✉</span><div><small>Email</small><strong><?= e((string) setting('email_1')) ?></strong><?php if (setting('email_2')): ?><b><?= e((string) setting('email_2')) ?></b><?php endif; ?></div></a><div><span>⌖</span><div><small>Address</small><strong><?= e((string) setting('address')) ?></strong></div></div><div><span>◷</span><div><small>Opening hours</small><strong><?= e((string) setting('opening_hours')) ?></strong></div></div></div></div><div><?php $formServices = $services; $formTitle = 'Tell us what you need'; require __DIR__ . '/includes/enquiry-form.php'; ?></div></div>
        <?php if (setting('map_embed')): ?><div class="container map-embed"><?= sanitize_map_embed((string) setting('map_embed')) ?></div><?php endif; ?>
    </section>
    <?php else: ?>
    <section class="section generic-page"><div class="container generic-page__grid"><article class="content-prose"><?= sanitize_content((string) $page['content']) ?></article><aside class="side-cta"><span>Need a professional cleaner?</span><h2>Let’s discuss your property.</h2><p>Call our friendly Melbourne team or request a tailored quote online.</p><a class="btn btn--primary" href="<?= e(url('contact')) ?>">Get a Free Quote <span>↗</span></a><a class="side-cta__phone" href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>">☎ <?= e((string) setting('phone_1')) ?></a></aside></div></section>
    <?php endif; ?>

    <?php if ($slug !== 'contact'): ?><section class="simple-cta"><div class="container"><div><span>Professional cleaning across Melbourne</span><h2>Ready to make your space feel cleaner?</h2></div><a class="btn btn--white" href="<?= e(url('contact')) ?>">Request Your Quote <span>↗</span></a></div></section><?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

