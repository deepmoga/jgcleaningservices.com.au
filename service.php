<?php
declare(strict_types=1);

require __DIR__ . '/lib/bootstrap.php';

$slug = slugify((string) ($_GET['slug'] ?? ''));
$service = get_service_by_slug($slug);
if (!$service) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$services = get_services();
$faqs = service_faqs($service);
$enquiryResult = handle_enquiry_submission('service_quote');
$pageTitle = (string) ($service['meta_title'] ?: $service['title'] . ' Melbourne | ' . setting('site_name'));
$pageDescription = (string) ($service['meta_description'] ?: $service['short_description']);
$pageKeywords = (string) $service['meta_keywords'];
$canonicalUrl = url('services/' . $service['slug']);
$currentPage = 'service';
require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
    <section class="service-hero"><img src="<?= e(asset((string) ($service['detail_image'] ?: 'assets/images/jg-cleaning-team-hero.webp'))) ?>" alt="Professional <?= e($service['title']) ?> in Melbourne"><div class="service-hero__overlay"></div><div class="container service-hero__content"><nav class="breadcrumbs" aria-label="Breadcrumb"><a href="<?= e(url()) ?>">Home</a><span>›</span><a href="<?= e(url('services')) ?>">Services</a><span>›</span><span><?= e($service['title']) ?></span></nav><span class="eyebrow eyebrow--light">Professional Melbourne cleaning</span><h1><?= e($service['title']) ?></h1><p><?= e($service['short_description']) ?></p><div><a class="btn btn--white" href="#service-quote">Get a Free Quote <span>↗</span></a><a class="service-hero__phone" href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>">☎ <?= e((string) setting('phone_1')) ?></a></div></div></section>

    <section class="section service-detail"><div class="container service-detail__grid"><article class="content-prose service-content"><div class="service-intro-badge"><span>JG</span><p><strong>Professional service</strong><br>Tailored to your property and cleaning goals.</p></div><?= sanitize_content((string) $service['content']) ?>
        <?php if ($faqs): ?><section class="faq-section" aria-labelledby="faq-title"><span class="eyebrow">Frequently asked questions</span><h2 id="faq-title"><?= e($service['title']) ?> FAQs</h2><div class="faq-list"><?php foreach ($faqs as $index => $faq): ?><details <?= $index === 0 ? 'open' : '' ?>><summary><?= e($faq['question']) ?><span>+</span></summary><p><?= e($faq['answer']) ?></p></details><?php endforeach; ?></div></section><?php endif; ?>
    </article><aside class="service-sidebar"><div class="service-nav"><h2>Our Services</h2><?php foreach ($services as $navService): ?><a class="<?= $navService['id'] === $service['id'] ? 'is-active' : '' ?>" href="<?= e(url('services/' . $navService['slug'])) ?>"><?= e($navService['title']) ?><span>›</span></a><?php endforeach; ?></div><div id="service-quote"><?php $formServices = $services; $selectedServiceId = (int) $service['id']; $formTitle = 'Get a ' . $service['title'] . ' quote'; require __DIR__ . '/includes/enquiry-form.php'; ?></div></aside></div></section>

    <section class="simple-cta simple-cta--cyan"><div class="container"><div><span>Professional service. Practical advice.</span><h2>Ready to discuss your <?= e(mb_strtolower($service['title'])) ?>?</h2></div><a class="btn btn--white" href="#service-quote">Request Your Quote <span>↗</span></a></div></section>
</main>
<?php if ($faqs): ?><script type="application/ld+json"><?= json_encode(['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>array_map(static fn($faq)=>['@type'=>'Question','name'=>$faq['question'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$faq['answer']]],$faqs)], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script><?php endif; ?>
<script type="application/ld+json"><?= json_encode(['@context'=>'https://schema.org','@type'=>'Service','name'=>$service['title'],'description'=>$service['meta_description'],'provider'=>['@type'=>'CleaningService','name'=>setting('site_name'),'telephone'=>setting('phone_1')],'areaServed'=>'Melbourne, Victoria','url'=>$canonicalUrl], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php require __DIR__ . '/includes/footer.php'; ?>

