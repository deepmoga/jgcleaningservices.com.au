<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/bootstrap.php';
$admin = require_admin();
$adminTitle = 'Pages & SEO';
$adminSection = 'pages';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $id = (int) ($_POST['id'] ?? 0);
    $statement = db()->prepare('UPDATE pages SET title=?, nav_title=?, hero_title=?, hero_subtitle=?, content=?, meta_title=?, meta_keywords=?, meta_description=?, status=? WHERE id=?');
    $statement->execute([
        trim((string) $_POST['title']), trim((string) $_POST['nav_title']), trim((string) $_POST['hero_title']), trim((string) $_POST['hero_subtitle']),
        sanitize_content((string) $_POST['content']), trim((string) $_POST['meta_title']), trim((string) $_POST['meta_keywords']), trim((string) $_POST['meta_description']),
        in_array($_POST['status'] ?? '', ['published','draft'], true) ? $_POST['status'] : 'draft', $id,
    ]);
    flash('success', 'Page content and SEO data were updated.');
    redirect(url('admin/pages.php?edit=' . $id));
}

$editId = (int) ($_GET['edit'] ?? 0);
$editPage = null;
if ($editId) { $stmt = db()->prepare('SELECT * FROM pages WHERE id=?'); $stmt->execute([$editId]); $editPage = $stmt->fetch(); }
$pages = db()->query('SELECT * FROM pages ORDER BY FIELD(slug,"home","about","services","contact","privacy-policy"), title')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<?php if ($editPage): ?>
<div class="admin-page-head"><div><a href="<?= e(url('admin/pages.php')) ?>">← All pages</a><h2>Edit <?= e($editPage['title']) ?></h2><p>Update visible copy and search-engine metadata for this page.</p></div><a class="admin-button admin-button--secondary" href="<?= e($editPage['slug'] === 'home' ? url() : url($editPage['slug'])) ?>" target="_blank">Preview page ↗</a></div>
<form class="admin-form" method="post"><input type="hidden" name="id" value="<?= (int) $editPage['id'] ?>"><?= csrf_field() ?>
    <section class="admin-panel"><div class="admin-panel__head"><div><span>Page content</span><h2>Hero and body copy</h2></div><span class="admin-slug">/<?= e($editPage['slug']) ?></span></div><div class="admin-form-grid"><label>Page title<input type="text" name="title" value="<?= e($editPage['title']) ?>" required></label><label>Navigation label<input type="text" name="nav_title" value="<?= e($editPage['nav_title']) ?>" required></label><label class="full">Hero heading<input type="text" name="hero_title" value="<?= e($editPage['hero_title']) ?>" required></label><label class="full">Hero description<textarea name="hero_subtitle" rows="3"><?= e($editPage['hero_subtitle']) ?></textarea></label><label class="full">Page content<textarea name="content" rows="16" data-editor><?= e($editPage['content']) ?></textarea></label></div></section>
    <section class="admin-panel seo-panel"><div class="admin-panel__head"><div><span>Search visibility</span><h2>SEO metadata</h2></div><span class="seo-score">Editable per page</span></div><div class="admin-form-grid"><label class="full">Meta title <small>Recommended: about 50–60 characters</small><input type="text" name="meta_title" maxlength="255" value="<?= e($editPage['meta_title']) ?>" data-countable></label><label class="full">Meta keywords <small>Comma-separated phrases relevant to this page</small><textarea name="meta_keywords" rows="3"><?= e($editPage['meta_keywords']) ?></textarea></label><label class="full">Meta description <small>Recommended: about 140–160 characters</small><textarea name="meta_description" rows="4" maxlength="320" data-countable><?= e($editPage['meta_description']) ?></textarea></label><label>Status<select name="status"><option value="published" <?= $editPage['status']==='published'?'selected':'' ?>>Published</option><option value="draft" <?= $editPage['status']==='draft'?'selected':'' ?>>Draft</option></select></label></div></section>
    <div class="admin-form-actions"><a href="<?= e(url('admin/pages.php')) ?>">Cancel</a><button class="admin-button" type="submit">Save page changes</button></div>
</form>
<?php else: ?>
<div class="admin-page-head"><div><span>Content management</span><h2>Website pages</h2><p>Edit every public page, including its title, keywords and meta description.</p></div></div>
<section class="admin-panel"><div class="admin-table-wrap"><table class="admin-table admin-table--pages"><thead><tr><th>Page</th><th>Clean URL</th><th>SEO description</th><th>Status</th><th></th></tr></thead><tbody><?php foreach ($pages as $page): ?><tr><td><strong><?= e($page['title']) ?></strong><small>Updated <?= e(date('d M Y', strtotime($page['updated_at']))) ?></small></td><td><code>/<?= $page['slug']==='home'?'':e($page['slug']) ?></code></td><td><?= e(mb_strimwidth((string)$page['meta_description'],0,90,'…')) ?></td><td><span class="status status--<?= $page['status']==='published'?'read':'archived' ?>"><?= e($page['status']) ?></span></td><td><a class="table-action" href="<?= e(url('admin/pages.php?edit=' . $page['id'])) ?>">Edit →</a></td></tr><?php endforeach; ?></tbody></table></div></section>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
