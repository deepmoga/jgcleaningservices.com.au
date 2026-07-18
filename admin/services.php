<?php

declare(strict_types=1);
require dirname(__DIR__) . '/lib/bootstrap.php';
$admin = require_admin();
$adminTitle = 'Services';
$adminSection = 'services';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    try {
        $id = (int) ($_POST['id'] ?? 0);
        $existing = null;
        if ($id) {
            $stmt = db()->prepare('SELECT * FROM services WHERE id=?');
            $stmt->execute([$id]);
            $existing = $stmt->fetch();
        }
        $cardImage = upload_image('card_image', $existing['card_image'] ?? null);
        $detailImage = upload_image('detail_image', $existing['detail_image'] ?? null);
        $faqs = [];
        foreach ((array) ($_POST['faq_question'] ?? []) as $index => $question) {
            $question = trim((string) $question);
            $answer = trim((string) (($_POST['faq_answer'][$index] ?? '')));
            if ($question !== '' && $answer !== '') $faqs[] = ['question' => $question, 'answer' => $answer];
        }
        $data = [trim((string) $_POST['title']), slugify((string) $_POST['slug']), trim((string) $_POST['short_description']), sanitize_content((string) $_POST['content']), $cardImage, $detailImage, json_encode($faqs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), trim((string) $_POST['meta_title']), trim((string) $_POST['meta_keywords']), trim((string) $_POST['meta_description']), (int)$_POST['sort_order'], isset($_POST['active']) ? 1 : 0];
        if ($id) {
            $stmt = db()->prepare('UPDATE services SET title=?,slug=?,short_description=?,content=?,card_image=?,detail_image=?,faqs_json=?,meta_title=?,meta_keywords=?,meta_description=?,sort_order=?,active=? WHERE id=?');
            $data[] = $id;
            $stmt->execute($data);
        } else {
            $stmt = db()->prepare('INSERT INTO services (title,slug,short_description,content,card_image,detail_image,faqs_json,meta_title,meta_keywords,meta_description,sort_order,active) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute($data);
            $id = (int)db()->lastInsertId();
        }
        flash('success', 'Service content, images and SEO data were saved.');
        redirect(url('admin/services.php?edit=' . $id));
    } catch (Throwable $exception) {
        $error = str_contains($exception->getMessage(), 'Duplicate') ? 'That URL slug is already used by another service.' : $exception->getMessage();
    }
}

$editId = (int)($_GET['edit'] ?? 0);
$isNew = ($_GET['action'] ?? '') === 'new';
$editService = null;
if ($editId) {
    $stmt = db()->prepare('SELECT * FROM services WHERE id=?');
    $stmt->execute([$editId]);
    $editService = $stmt->fetch();
}
if ($isNew) $editService = ['id' => 0, 'title' => '', 'slug' => '', 'short_description' => '', 'content' => '', 'card_image' => '', 'detail_image' => '', 'faqs_json' => '[]', 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => '', 'sort_order' => 10, 'active' => 1];
$services = db()->query('SELECT * FROM services ORDER BY sort_order,title')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<?php if ($editService): $faqs = service_faqs($editService);
    while (count($faqs) < 4) $faqs[] = ['question' => '', 'answer' => '']; ?>
    <div class="admin-page-head">
        <div><a href="<?= e(url('admin/services.php')) ?>">← All services</a>
            <h2><?= $editService['id'] ? 'Edit ' . e($editService['title']) : 'Add a new service' ?></h2>
            <p>Manage long-form content, two images, FAQs and search metadata.</p>
        </div><?php if ($editService['id']): ?><a class="admin-button admin-button--secondary" href="<?= e(url('services/' . $editService['slug'])) ?>" target="_blank">Preview service ↗</a><?php endif; ?>
    </div>
    <?php if ($error): ?><div class="admin-alert admin-alert--error"><?= e($error) ?></div><?php endif; ?>
    <form class="admin-form" method="post" enctype="multipart/form-data"><input type="hidden" name="id" value="<?= (int)$editService['id'] ?>"><?= csrf_field() ?>
        <section class="admin-panel">
            <div class="admin-panel__head">
                <div><span>Service details</span>
                    <h2>Content and publishing</h2>
                </div><label class="switch"><input type="checkbox" name="active" value="1" <?= $editService['active'] ? 'checked' : '' ?>><span></span>Active</label>
            </div>
            <div class="admin-form-grid"><label>Service title<input type="text" name="title" value="<?= e($editService['title']) ?>" required data-slug-source></label><label>Clean URL slug<input type="text" name="slug" value="<?= e($editService['slug']) ?>" required data-slug-target><small>Example: office-cleaning</small></label><label class="full">Card description<textarea name="short_description" rows="4" maxlength="500" required><?= e($editService['short_description']) ?></textarea></label><label class="full">Detailed service content <small>Target 600–1,000 words using headings, paragraphs and lists.</small><textarea name="content" rows="22" data-editor required><?= e($editService['content']) ?></textarea><span class="word-count" data-word-count>Content word count will appear here</span></label><label>Display order<input type="number" name="sort_order" value="<?= (int)$editService['sort_order'] ?>" min="0"></label></div>
        </section>
        <section class="admin-panel">
            <div class="admin-panel__head">
                <div><span>Visuals</span>
                    <h2>Service images</h2>
                </div><small>JPG, PNG, WebP or AVIF · maximum 5 MB each</small>
            </div>
            <div class="image-upload-grid"><label><strong>Service card image</strong><span>JPG, PNG, WebP or AVIF up to 5 MB.</span><?php if ($editService['card_image']): ?><img src="<?= e(asset($editService['card_image'])) ?>" alt="Current card image"><?php endif; ?><input type="file" name="card_image" accept="image/jpeg,image/png,image/webp,image/avif"></label><label><strong>Single service page image</strong><span>JPG, PNG, WebP or AVIF up to 5 MB.</span><?php if ($editService['detail_image']): ?><img src="<?= e(asset($editService['detail_image'])) ?>" alt="Current detail image"><?php endif; ?><input type="file" name="detail_image" accept="image/jpeg,image/png,image/webp,image/avif"></label></div>
        </section>
        <section class="admin-panel">
            <div class="admin-panel__head">
                <div><span>Customer questions</span>
                    <h2>Frequently asked questions</h2>
                </div><small>Displayed with FAQ schema for search engines</small>
            </div>
            <div class="faq-admin-list"><?php foreach ($faqs as $index => $faq): ?><div><span><?= $index + 1 ?></span><label>Question<input type="text" name="faq_question[]" value="<?= e($faq['question']) ?>"></label><label>Answer<textarea name="faq_answer[]" rows="3"><?= e($faq['answer']) ?></textarea></label></div><?php endforeach; ?></div>
        </section>
        <section class="admin-panel seo-panel">
            <div class="admin-panel__head">
                <div><span>Search visibility</span>
                    <h2>Service SEO metadata</h2>
                </div><span class="seo-score">Unique for this service</span>
            </div>
            <div class="admin-form-grid"><label class="full">Meta title<input type="text" name="meta_title" maxlength="255" value="<?= e($editService['meta_title']) ?>" data-countable></label><label class="full">Meta keywords<textarea name="meta_keywords" rows="3"><?= e($editService['meta_keywords']) ?></textarea></label><label class="full">Meta description<textarea name="meta_description" rows="4" maxlength="320" data-countable><?= e($editService['meta_description']) ?></textarea></label></div>
        </section>
        <div class="admin-form-actions"><a href="<?= e(url('admin/services.php')) ?>">Cancel</a><button class="admin-button" type="submit">Save service</button></div>
    </form>
<?php else: ?>
    <div class="admin-page-head">
        <div><span>Service management</span>
            <h2>All cleaning services</h2>
            <p>Update content, upload two images and control SEO for each service.</p>
        </div><a class="admin-button" href="<?= e(url('admin/services.php?action=new')) ?>">＋ Add service</a>
    </div>
    <section class="admin-panel">
        <div class="service-admin-grid"><?php foreach ($services as $service): ?><article><img src="<?= e(asset((string)($service['card_image'] ?: 'assets/images/jg-cleaning-team-hero.webp'))) ?>" alt="">
                    <div><span class="status status--<?= $service['active'] ? 'read' : 'archived' ?>"><?= $service['active'] ? 'active' : 'hidden' ?></span>
                        <h2><?= e($service['title']) ?></h2>
                        <p>/services/<?= e($service['slug']) ?></p>
                        <div><a href="<?= e(url('services/' . $service['slug'])) ?>" target="_blank">View ↗</a><a class="table-action" href="<?= e(url('admin/services.php?edit=' . $service['id'])) ?>">Edit service →</a></div>
                    </div>
                </article><?php endforeach; ?></div>
    </section>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
