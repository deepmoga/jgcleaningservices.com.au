<?php
declare(strict_types=1);
require_once dirname(__DIR__, 2) . '/lib/bootstrap.php';
$admin = $admin ?? require_admin();
$adminTitle = $adminTitle ?? 'Dashboard';
$adminSection = $adminSection ?? 'dashboard';
$newCount = (int) db()->query("SELECT COUNT(*) FROM enquiries WHERE status='new'")->fetchColumn();
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title><?= e($adminTitle) ?> | JG Cleaning CMS</title><link rel="stylesheet" href="<?= e(asset('admin/assets/css/admin.css')) ?>"><link rel="stylesheet" href="<?= e(asset('admin/assets/css/admin-fixes.css')) ?>"></head><body class="admin-body">
<div class="admin-shell">
<aside class="admin-sidebar" id="admin-sidebar"><a class="admin-brand" href="<?= e(url('admin/index.php')) ?>"><img src="<?= e(asset((string) setting('logo_main', 'assets/images/main-logo.png'))) ?>" alt="JG Cleaning Services"><span>Website CMS</span></a><nav>
<a class="<?= $adminSection === 'dashboard' ? 'is-active' : '' ?>" href="<?= e(url('admin/index.php')) ?>"><i>⌂</i>Dashboard</a>
<a class="<?= $adminSection === 'pages' ? 'is-active' : '' ?>" href="<?= e(url('admin/pages.php')) ?>"><i>▤</i>Pages &amp; SEO</a>
<a class="<?= $adminSection === 'services' ? 'is-active' : '' ?>" href="<?= e(url('admin/services.php')) ?>"><i>✦</i>Services</a>
<a class="<?= $adminSection === 'enquiries' ? 'is-active' : '' ?>" href="<?= e(url('admin/enquiries.php')) ?>"><i>✉</i>Enquiries<?php if ($newCount): ?><b><?= $newCount ?></b><?php endif; ?></a>
<a class="<?= $adminSection === 'settings' ? 'is-active' : '' ?>" href="<?= e(url('admin/settings.php')) ?>"><i>⚙</i>Settings</a>
<a class="<?= $adminSection === 'profile' ? 'is-active' : '' ?>" href="<?= e(url('admin/profile.php')) ?>"><i>●</i>My Profile</a>
</nav><div class="admin-sidebar__bottom"><a href="<?= e(url()) ?>" target="_blank">↗ View website</a><a href="<?= e(url('admin/logout.php')) ?>">⇥ Sign out</a></div></aside>
<div class="admin-main"><header class="admin-topbar"><button class="admin-menu-toggle" type="button" aria-label="Toggle admin menu">☰</button><div><span>JG Cleaning Services</span><h1><?= e($adminTitle) ?></h1></div><div class="admin-user"><span><?= e(mb_strtoupper(mb_substr($admin['name'], 0, 1))) ?></span><div><strong><?= e($admin['name']) ?></strong><small>Administrator</small></div></div></header><main class="admin-content">
<?php foreach (consume_flashes() as $flash): ?><div class="admin-alert admin-alert--<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div><?php endforeach; ?>
