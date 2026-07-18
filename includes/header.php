<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/lib/bootstrap.php';

$pageTitle = $pageTitle ?? (string) setting('site_name', 'JG Cleaning Services');
$pageDescription = $pageDescription ?? (string) setting('tagline');
$pageKeywords = $pageKeywords ?? '';
$canonicalUrl = $canonicalUrl ?? url(trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/'));
$currentPage = $currentPage ?? '';
$headerServices = get_services();
$mainLogo = (string) setting('logo_main', 'assets/images/main-logo.png');
$phoneOne = (string) setting('phone_1');
$phoneTwo = (string) setting('phone_2');
$emailOne = (string) setting('email_1');
$assetVersion = static fn (string $path): string => (string) (filemtime(APP_ROOT . '/' . $path) ?: 1);
?>
<!doctype html>
<html lang="en-AU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <?php if ($pageKeywords !== ''): ?><meta name="keywords" content="<?= e($pageKeywords) ?>"><?php endif; ?>
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="theme-color" content="#10137e">
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:url" content="<?= e($canonicalUrl) ?>">
    <meta property="og:image" content="<?= e(asset('assets/images/jg-cleaning-team-hero.webp')) ?>">
    <link rel="icon" href="<?= e(asset($mainLogo)) ?>" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?= e(asset('assets/css/style.css') . '?v=' . $assetVersion('assets/css/style.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('assets/css/cms.css') . '?v=' . $assetVersion('assets/css/cms.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('assets/css/cms-fixes.css') . '?v=' . $assetVersion('assets/css/cms-fixes.css')) ?>">
</head>
<body>
<a class="skip-link" href="#main-content">Skip to content</a>

<div class="topbar">
    <div class="container topbar__inner">
        <div class="topbar__details">
            <a href="mailto:<?= e($emailOne) ?>" aria-label="Email JG Cleaning Services">
                <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M3 5h18v14H3V5Zm2 2v.4l7 4.8 7-4.8V7H5Zm14 10V9.8l-7 4.8-7-4.8V17h14Z"/></svg>
                <?= e($emailOne) ?>
            </a>
            <span class="topbar__divider"></span>
            <span>
                <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2a9 9 0 1 0 0 18 9 9 0 0 0 0-18Zm1 4v5.5l3.7 2.2-1 1.7-4.7-2.9V6h2Z"/></svg>
                <?= e((string) setting('opening_hours')) ?>
            </span>
        </div>
        <a class="topbar__location" href="<?= e(url('contact')) ?>">
            <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5Z"/></svg>
            Clayton, Victoria
        </a>
    </div>
</div>

<header class="site-header" id="site-header">
    <div class="container site-header__inner">
        <a class="brand" href="<?= e(url()) ?>" aria-label="JG Cleaning Services home">
            <img src="<?= e(asset($mainLogo)) ?>" alt="JG Cleaning Services" width="400" height="145">
        </a>
        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Open navigation menu"><span></span><span></span><span></span></button>
        <nav class="primary-nav" id="primary-nav" aria-label="Primary navigation">
            <a class="<?= $currentPage === 'home' ? 'is-active' : '' ?>" href="<?= e(url()) ?>">Home</a>
            <a class="<?= $currentPage === 'about' ? 'is-active' : '' ?>" href="<?= e(url('about')) ?>">About</a>
            <div class="nav-dropdown">
                <a class="<?= in_array($currentPage, ['services', 'service'], true) ? 'is-active' : '' ?>" href="<?= e(url('services')) ?>">
                    <span>Services</span>
                    <svg class="nav-dropdown__chevron" aria-hidden="true" viewBox="0 0 12 8" fill="none">
                        <path d="M1 1.25 6 6.25l5-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <div class="nav-dropdown__menu">
                    <?php foreach ($headerServices as $headerService): ?>
                        <a href="<?= e(url('services/' . $headerService['slug'])) ?>"><?= e($headerService['title']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <a class="<?= $currentPage === 'contact' ? 'is-active' : '' ?>" href="<?= e(url('contact')) ?>">Contact</a>
        </nav>
        <div class="header-actions">
            <a class="header-phone" href="tel:<?= e(preg_replace('/\D+/', '', $phoneOne)) ?>">
                <span class="header-phone__icon"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="m7.2 3 3 5-2 2c1.3 2.7 3.4 4.8 6.1 6.1l2-2 5 3c.3.2.5.5.4.9-.4 2.1-2.3 3.7-4.5 3.7C9 21.7 2.3 15 2.3 6.8 2.3 4.6 4 2.7 6 2.3c.5-.1.9.2 1.2.7Z"/></svg></span>
                <span><small>Call us today</small><?= e($phoneOne) ?></span>
            </a>
            <a class="btn btn--primary header-quote" href="<?= e(url('contact#quote')) ?>">Get a Free Quote <span aria-hidden="true">↗</span></a>
        </div>
    </div>
</header>
