<?php
declare(strict_types=1);

require __DIR__ . '/lib/bootstrap.php';

$home = get_page('home') ?? [];
$services = get_services();
$enquiryResult = handle_enquiry_submission('homepage_quote');
$pageTitle = (string) ($home['meta_title'] ?? 'Best Professional Cleaning Services in Melbourne');
$pageDescription = (string) ($home['meta_description'] ?? setting('tagline'));
$pageKeywords = (string) ($home['meta_keywords'] ?? '');
$canonicalUrl = url();
$currentPage = 'home';
require __DIR__ . '/includes/header.php';
?>
<main id="main-content">
    <section class="hero" aria-labelledby="hero-title">
        <div class="container">
            <div class="hero__shell">
                <img class="hero__image" src="<?= e(asset('assets/images/jg-cleaning-team-hero.webp')) ?>" width="1792" height="896" alt="Professional JG cleaners in a bright modern Melbourne property" fetchpriority="high">
                <div class="hero__wash"></div>
                <div class="hero__content reveal is-visible">
                    <span class="hero__kicker"><i></i> Melbourne’s trusted cleaning team</span>
                    <h1 id="hero-title"><?= nl2br(e((string) ($home['hero_title'] ?? 'A cleaner space. A better day.'))) ?></h1>
                    <p><?= e((string) ($home['hero_subtitle'] ?? 'Professional cleaning across Melbourne.')) ?></p>
                    <div class="hero__actions"><a class="btn btn--primary btn--large" href="#quote">Get a Free Quote <span aria-hidden="true">↗</span></a><a class="btn btn--ghost btn--large" href="<?= e(url('services')) ?>">Explore Services</a></div>
                    <div class="hero__proof"><div class="avatar-stack" aria-hidden="true"><span>JG</span><span>5★</span><span>VIC</span></div><div><strong>Professional care</strong><small>Trusted by Melbourne clients</small></div></div>
                </div>
                <div class="hero__badge"><strong><?= count($services) ?></strong><span>specialist<br>cleaning services</span></div>
            </div>
            <div class="trust-strip">
                <div><strong data-counter="100">0</strong><span>%</span><p>Quality-focused service</p></div><div><strong data-counter="6">0</strong><span>+</span><p>Specialist services</p></div><div><strong data-counter="6">0</strong><span> days</span><p>Open every week</p></div>
                <div class="trust-strip__promise"><span class="trust-check">✓</span><p><strong>Reliable &amp; careful</strong><br>Cleaning you can feel good about</p></div>
            </div>
        </div>
    </section>

    <section class="section services" id="services" aria-labelledby="services-title">
        <div class="container">
            <div class="section-heading section-heading--split reveal"><div><span class="eyebrow">Our cleaning services</span><h2 id="services-title">The professional clean<br>your space deserves.</h2></div><div><?= sanitize_content((string) ($home['content'] ?? '')) ?><a class="text-link" href="<?= e(url('services')) ?>">View all cleaning services <span>↗</span></a></div></div>
            <div class="services-grid services-grid--images">
                <?php foreach ($services as $index => $service): ?>
                <article class="service-card service-card--image reveal" style="--delay: <?= $index * 70 ?>ms">
                    <a class="service-card__image" href="<?= e(url('services/' . $service['slug'])) ?>"><img src="<?= e(asset((string) ($service['card_image'] ?: 'assets/images/jg-cleaning-team-hero.webp'))) ?>" alt="<?= e($service['title']) ?> service in Melbourne" loading="lazy"></a>
                    <div class="service-card__body"><h3><a href="<?= e(url('services/' . $service['slug'])) ?>"><?= e($service['title']) ?></a></h3><p><?= e($service['short_description']) ?></p><a href="<?= e(url('services/' . $service['slug'])) ?>">Explore service</a></div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="cta-ribbon reveal" aria-label="Fast quote call to action">
        <div class="container cta-ribbon__inner"><div><span>Need a cleaner soon?</span><h2>Tell us about your space and preferred timing.</h2></div><div class="cta-ribbon__actions"><a class="btn btn--white" href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>">Call <?= e((string) setting('phone_1')) ?></a><a class="btn btn--outline-white" href="#quote">Request a Quote ↗</a></div></div>
    </section>

    <section class="section about" id="about" aria-labelledby="about-title">
        <div class="container about__grid">
            <div class="about__visual reveal"><div class="about__image-wrap"><img src="<?= e(asset('assets/images/jg-cleaning-team-hero.webp')) ?>" width="1792" height="896" alt="JG Cleaning Services professional team" loading="lazy"></div><div class="about__experience"><strong>Local</strong><span>Melbourne cleaning professionals</span></div><div class="about__dots" aria-hidden="true"></div></div>
            <div class="about__content reveal"><span class="eyebrow">About JG Cleaning</span><h2 id="about-title">Top-quality cleaning, built around your space.</h2><p class="lead">We believe a professional clean should make your property feel easier to use, healthier to work in and ready to make the right impression.</p><p>Our team provides dependable builders, office, window, carpet, pressure and curtain cleaning across Melbourne. Every service is approached with care, clear communication and a focus on consistent results.</p><ul class="check-list"><li><span>✓</span>Flexible cleaning tailored to your property</li><li><span>✓</span>Professional equipment and proven methods</li><li><span>✓</span>Friendly, punctual and detail-focused team</li><li><span>✓</span>Convenient hours Monday to Saturday</li></ul><div class="about__actions"><a class="btn btn--primary" href="<?= e(url('about')) ?>">Learn About Us <span>↗</span></a><a class="phone-link" href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>"><i>☎</i><span><small>Have a question?</small><?= e((string) setting('phone_1')) ?></span></a></div></div>
        </div>
    </section>

    <section class="section why" id="why-us" aria-labelledby="why-title"><div class="why__shape" aria-hidden="true"></div><div class="container"><div class="section-heading section-heading--center reveal"><span class="eyebrow eyebrow--light">Why choose us</span><h2 id="why-title">A smarter choice for<br>professional cleaning.</h2><p>Personal service and professional standards for a cleaner, fresher and more welcoming space.</p></div><div class="feature-grid">
        <article class="feature-card reveal"><div class="feature-card__icon">✓</div><span>01</span><h3>Reliable Team</h3><p>We respect your time, property and the trust placed in our cleaning professionals.</p></article><article class="feature-card feature-card--accent reveal"><div class="feature-card__icon">✦</div><span>02</span><h3>Detailed Results</h3><p>Our methodical approach targets visible areas and often-missed finishing details.</p></article><article class="feature-card reveal"><div class="feature-card__icon">♧</div><span>03</span><h3>Responsible Care</h3><p>Methods are selected carefully for the surface, setting and cleaning task.</p></article><article class="feature-card reveal"><div class="feature-card__icon">◷</div><span>04</span><h3>Flexible Hours</h3><p>Open six days with extended hours to make cleaning easier to schedule.</p></article>
    </div></div></section>

    <section class="section process" id="process" aria-labelledby="process-title"><div class="container"><div class="section-heading section-heading--center reveal"><span class="eyebrow">How it works</span><h2 id="process-title">Four simple steps to a<br>beautifully clean space.</h2></div><div class="process-grid"><article class="process-step reveal"><span class="process-step__number">1</span><div class="process-step__icon">✦</div><h3>Tell us what you need</h3><p>Choose a service and share details about the property.</p></article><article class="process-step reveal"><span class="process-step__number">2</span><div class="process-step__icon">◷</div><h3>Receive your quote</h3><p>We discuss the scope and provide clear, practical pricing.</p></article><article class="process-step reveal"><span class="process-step__number">3</span><div class="process-step__icon">✓</div><h3>We complete the clean</h3><p>Our professional team arrives prepared and gets to work.</p></article><article class="process-step reveal"><span class="process-step__number">4</span><div class="process-step__icon">☀</div><h3>Enjoy the result</h3><p>Step back into a fresher, more welcoming space.</p></article></div></div></section>

    <section class="cta-showcase reveal"><div class="container cta-showcase__shell"><div class="cta-showcase__copy"><span class="eyebrow eyebrow--light">One team. More possibilities.</span><h2>Combine services for a complete property refresh.</h2><p>Window glass, carpets, curtains, exterior surfaces and detailed builders cleaning can be planned together around your property and timeline.</p><a class="btn btn--white" href="<?= e(url('contact')) ?>">Plan My Cleaning Project <span>↗</span></a></div><div class="cta-showcase__list"><?php foreach (array_slice($services, 0, 4) as $service): ?><a href="<?= e(url('services/' . $service['slug'])) ?>"><span>✓</span><?= e($service['title']) ?><b>↗</b></a><?php endforeach; ?></div></div></section>

    <section class="section reviews" aria-labelledby="reviews-title"><div class="container reviews__grid"><div class="reviews__intro reveal"><span class="eyebrow">Customer feedback</span><h2 id="reviews-title">Trusted service.<br>Noticeable results.</h2><p>We aim to make every clean straightforward, professional and worth recommending.</p><div class="rating-card"><strong>5.0</strong><div><span>★★★★★</span><small>Customer satisfaction focus</small></div></div><div class="slider-controls"><button type="button" data-review-prev aria-label="Previous review">←</button><button type="button" data-review-next aria-label="Next review">→</button></div></div><div class="reviews__slider reveal" aria-live="polite">
        <?php $reviews = [['JG Cleaning Services left our office looking immaculate. The team was punctual, respectful and paid attention to the small details that make a big difference.','Michael R.','Office Manager, Clayton','MR'],['We booked a builders clean after a major renovation. They removed the fine dust from everywhere and handed back a space that finally felt ready to enjoy.','Sarah T.','Property Owner, Melbourne','ST'],['Friendly service, clear communication and excellent results on our carpets and windows. I would happily recommend the JG team.','Daniel K.','Local Business Owner','DK']]; foreach ($reviews as $index => $review): ?><blockquote class="review-card <?= $index === 0 ? 'is-active' : '' ?>" data-review-card><div class="review-card__quote">“</div><p><?= e($review[0]) ?></p><footer><span class="review-card__avatar"><?= e($review[3]) ?></span><div><cite><?= e($review[1]) ?></cite><small><?= e($review[2]) ?></small></div><span class="review-card__stars">★★★★★</span></footer></blockquote><?php endforeach; ?>
    </div></div></section>

    <section class="section quote" id="quote" aria-labelledby="quote-title"><div class="container"><div class="quote__shell"><div class="quote__content reveal"><span class="eyebrow eyebrow--light">Get your free quote</span><h2 id="quote-title">Let’s make your space feel brilliantly clean.</h2><p>Tell us what you need and a friendly member of the JG Cleaning Services team will get back to you.</p><div class="quote__contact"><a href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>"><span>☎</span><div><small>Call us</small><?= e((string) setting('phone_1')) ?></div></a><a href="mailto:<?= e((string) setting('email_1')) ?>"><span>✉</span><div><small>Email us</small><?= e((string) setting('email_1')) ?></div></a></div></div><div class="reveal"><?php $formServices = $services; $formTitle = 'Request your free quote'; require __DIR__ . '/includes/enquiry-form.php'; ?></div></div></div></section>
</main>
<script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org','@type' => 'CleaningService','name' => setting('site_name'),'url' => url(),'logo' => asset((string) setting('logo_main')),'image' => asset('assets/images/jg-cleaning-team-hero.webp'),'telephone' => setting('phone_1'),'email' => setting('email_1'),'address' => ['@type' => 'PostalAddress','streetAddress' => setting('address'),'addressLocality' => 'Clayton','addressRegion' => 'VIC','postalCode' => '3169','addressCountry' => 'AU'],'areaServed' => 'Melbourne, Victoria','openingHours' => 'Mo-Sa 08:00-22:00','priceRange' => '$$'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php require __DIR__ . '/includes/footer.php'; ?>
