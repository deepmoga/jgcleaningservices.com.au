<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/app.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    $sessionDirectory = APP_ROOT . '/storage/sessions';
    if (!is_dir($sessionDirectory)) {
        mkdir($sessionDirectory, 0755, true);
    }
    session_save_path($sessionDirectory);
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_name('jg_cleaning_session');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function db(): PDO
{
    static $pdo;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $exception) {
        if (PHP_SAPI === 'cli') {
            throw $exception;
        }
        http_response_code(503);
        exit('<!doctype html><meta charset="utf-8"><title>Website setup required</title><style>body{font:16px Arial;display:grid;place-items:center;min-height:100vh;margin:0;background:#f5f8fb;color:#10137e}.box{max-width:620px;padding:40px;border-radius:20px;background:#fff;box-shadow:0 20px 60px #10137e22}.box p{color:#566}</style><div class="box"><h1>Website setup required</h1><p>The database is not available yet. Run <code>php scripts/install.php</code> from the project directory, then reload this page.</p></div>');
    }
    return $pdo;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function app_base_url(): string
{
    static $base;
    if ($base !== null) {
        return $base;
    }

    $configured = '';
    try {
        $configured = trim((string) setting('site_url', ''));
    } catch (Throwable) {
        // The installer uses this helper before the settings table exists.
    }
    if ($configured !== '') {
        return $base = rtrim($configured, '/');
    }

    $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    if (str_contains($script, '/admin/')) {
        $path = dirname(dirname($script));
    } else {
        $path = dirname($script);
    }
    $path = str_replace('\\', '/', $path);
    $path = $path === '/' || $path === '.' ? '' : rtrim($path, '/');
    return $base = $scheme . '://' . $host . $path;
}

function url(string $path = ''): string
{
    $path = ltrim($path, '/');
    return app_base_url() . ($path !== '' ? '/' . $path : '/');
}

function asset(string $path): string
{
    return url(ltrim($path, '/'));
}

function settings_all(): array
{
    if (isset($GLOBALS['jg_settings_cache']) && is_array($GLOBALS['jg_settings_cache'])) {
        return $GLOBALS['jg_settings_cache'];
    }
    $rows = db()->query('SELECT setting_key, setting_value FROM settings')->fetchAll();
    $GLOBALS['jg_settings_cache'] = array_column($rows, 'setting_value', 'setting_key');
    return $GLOBALS['jg_settings_cache'];
}

function setting(string $key, mixed $default = ''): mixed
{
    $settings = settings_all();
    return array_key_exists($key, $settings) ? $settings[$key] : $default;
}

function update_setting(string $key, ?string $value): void
{
    $statement = db()->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');
    $statement->execute([$key, $value]);
    $GLOBALS['jg_settings_cache'] = null;
}

function get_services(bool $activeOnly = true): array
{
    $sql = 'SELECT * FROM services' . ($activeOnly ? ' WHERE active = 1' : '') . ' ORDER BY sort_order ASC, title ASC';
    return db()->query($sql)->fetchAll();
}

function get_service_by_slug(string $slug): ?array
{
    $statement = db()->prepare('SELECT * FROM services WHERE slug = ? AND active = 1 LIMIT 1');
    $statement->execute([$slug]);
    $service = $statement->fetch();
    return $service ?: null;
}

function get_page(string $slug, bool $publishedOnly = true): ?array
{
    $sql = 'SELECT * FROM pages WHERE slug = ?' . ($publishedOnly ? " AND status = 'published'" : '') . ' LIMIT 1';
    $statement = db()->prepare($sql);
    $statement->execute([$slug]);
    $page = $statement->fetch();
    return $page ?: null;
}

function slugify(string $value): string
{
    $value = mb_strtolower(trim($value));
    $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';
    return trim($value, '-') ?: 'item-' . time();
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return (string) $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void
{
    $submitted = (string) ($_POST['csrf_token'] ?? '');
    if ($submitted === '' || !hash_equals(csrf_token(), $submitted)) {
        http_response_code(419);
        exit('Your session expired. Please go back, refresh the page and try again.');
    }
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function consume_flashes(): array
{
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return is_array($messages) ? $messages : [];
}

function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function admin_user(): ?array
{
    $id = (int) ($_SESSION['admin_user_id'] ?? 0);
    if ($id < 1) {
        return null;
    }
    $statement = db()->prepare('SELECT id, name, username, email, must_change_password FROM users WHERE id = ? LIMIT 1');
    $statement->execute([$id]);
    return $statement->fetch() ?: null;
}

function require_admin(): array
{
    $user = admin_user();
    if (!$user) {
        flash('error', 'Please sign in to continue.');
        redirect(url('admin/login.php'));
    }
    return $user;
}

function encrypt_secret(string $plainText): string
{
    if ($plainText === '') {
        return '';
    }
    $key = hash('sha256', APP_KEY, true);
    $iv = random_bytes(12);
    $tag = '';
    $cipher = openssl_encrypt($plainText, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);
    if ($cipher === false) {
        throw new RuntimeException('Could not encrypt the secret value.');
    }
    return base64_encode($iv . $tag . $cipher);
}

function decrypt_secret(?string $encoded): string
{
    if (!$encoded) {
        return '';
    }
    $decoded = base64_decode($encoded, true);
    if ($decoded === false || strlen($decoded) < 29) {
        return '';
    }
    $iv = substr($decoded, 0, 12);
    $tag = substr($decoded, 12, 16);
    $cipher = substr($decoded, 28);
    $plain = openssl_decrypt($cipher, 'aes-256-gcm', hash('sha256', APP_KEY, true), OPENSSL_RAW_DATA, $iv, $tag);
    return $plain === false ? '' : $plain;
}

function sanitize_content(string $html): string
{
    $allowedTags = '<p><br><strong><b><em><i><u><h2><h3><h4><ul><ol><li><a><blockquote><hr><table><thead><tbody><tr><th><td>';
    $html = strip_tags($html, $allowedTags);
    $html = preg_replace('/\s+on[a-z]+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? $html;
    $html = preg_replace('/\s+(?:style|class|id)\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? $html;
    $html = preg_replace_callback('/<a\s+([^>]*?)href\s*=\s*(["\'])(.*?)\2([^>]*)>/i', static function (array $matches): string {
        $href = trim($matches[3]);
        if (!preg_match('#^(?:https?://|mailto:|tel:|/)#i', $href)) {
            $href = '#';
        }
        return '<a href="' . e($href) . '" rel="noopener">';
    }, $html) ?? $html;
    return trim($html);
}

function sanitize_map_embed(string $html): string
{
    if (!preg_match('/<iframe\b[^>]*\bsrc=["\']([^"\']+)["\'][^>]*><\/iframe>/i', $html, $match)) {
        return '';
    }
    $src = filter_var(html_entity_decode($match[1]), FILTER_VALIDATE_URL);
    $host = $src ? strtolower((string) parse_url($src, PHP_URL_HOST)) : '';
    if (!$src || (!str_ends_with($host, 'google.com') && !str_ends_with($host, 'google.com.au'))) {
        return '';
    }
    return '<iframe src="' . e($src) . '" width="600" height="450" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="JG Cleaning Services location map"></iframe>';
}

function upload_image(string $field, ?string $existing = null): ?string
{
    if (empty($_FILES[$field]) || (int) $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $existing;
    }
    $file = $_FILES[$field];
    if ((int) $file['error'] !== UPLOAD_ERR_OK || (int) $file['size'] > 5 * 1024 * 1024) {
        throw new RuntimeException('Image upload failed or exceeded the 5 MB limit.');
    }

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($extensions[$mime])) {
        throw new RuntimeException('Only JPG, PNG and WebP images are allowed.');
    }
    if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0755, true) && !is_dir(UPLOAD_DIR)) {
        throw new RuntimeException('The upload directory is not writable.');
    }
    $filename = date('Ymd') . '-' . bin2hex(random_bytes(8)) . '.' . $extensions[$mime];
    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . '/' . $filename)) {
        throw new RuntimeException('Could not save the uploaded image.');
    }
    return UPLOAD_WEB_PATH . '/' . $filename;
}

function service_faqs(array $service): array
{
    $faqs = json_decode((string) ($service['faqs_json'] ?? ''), true);
    return is_array($faqs) ? array_values(array_filter($faqs, static fn ($faq) => !empty($faq['question']) && !empty($faq['answer']))) : [];
}

function handle_enquiry_submission(string $type = 'quote'): array
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit_enquiry'])) {
        return ['submitted' => false, 'success' => false, 'message' => ''];
    }

    verify_csrf();
    if (!empty($_POST['website'])) {
        return ['submitted' => true, 'success' => true, 'message' => 'Thank you. Your enquiry has been received.'];
    }
    if (isset($_SESSION['last_enquiry_at']) && time() - (int) $_SESSION['last_enquiry_at'] < 20) {
        return ['submitted' => true, 'success' => false, 'message' => 'Please wait a moment before submitting another enquiry.'];
    }

    $name = trim((string) ($_POST['name'] ?? ''));
    $phone = trim((string) ($_POST['phone'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $suburb = trim((string) ($_POST['suburb'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));
    $serviceId = (int) ($_POST['service_id'] ?? 0);

    if ($name === '' || mb_strlen($name) > 160 || $phone === '' || mb_strlen($phone) > 60) {
        return ['submitted' => true, 'success' => false, 'message' => 'Please enter your name and phone number.'];
    }
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['submitted' => true, 'success' => false, 'message' => 'Please enter a valid email address.'];
    }
    if ($serviceId > 0) {
        $check = db()->prepare('SELECT id FROM services WHERE id = ? AND active = 1');
        $check->execute([$serviceId]);
        if (!$check->fetchColumn()) {
            $serviceId = 0;
        }
    }

    $statement = db()->prepare('INSERT INTO enquiries (enquiry_type, name, email, phone, suburb, service_id, message, source_url, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $statement->execute([
        $type,
        $name,
        $email ?: null,
        $phone,
        mb_substr($suburb, 0, 140),
        $serviceId ?: null,
        mb_substr($message, 0, 5000),
        mb_substr((string) ($_SERVER['HTTP_REFERER'] ?? $_SERVER['REQUEST_URI'] ?? ''), 0, 500),
        mb_substr((string) ($_SERVER['REMOTE_ADDR'] ?? ''), 0, 64),
    ]);
    $enquiryId = (int) db()->lastInsertId();
    $_SESSION['last_enquiry_at'] = time();

    $mailStatus = 'disabled';
    if (setting('mail_enabled', '1') === '1') {
        try {
            require_once APP_ROOT . '/lib/mailer.php';
            $mailStatus = send_enquiry_emails($enquiryId) ? 'sent' : 'failed';
        } catch (Throwable $exception) {
            $mailStatus = 'failed';
            error_log('JG mail error: ' . $exception->getMessage());
        }
    }
    $update = db()->prepare('UPDATE enquiries SET mail_status = ? WHERE id = ?');
    $update->execute([$mailStatus, $enquiryId]);

    return ['submitted' => true, 'success' => true, 'message' => 'Thank you! Your enquiry has been received. Our team will contact you shortly.'];
}
