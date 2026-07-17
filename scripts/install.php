<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('This installer can only be run from the command line.');
}

require dirname(__DIR__) . '/config/app.php';

if (!preg_match('/^[a-zA-Z0-9_]+$/', DB_NAME)) {
    throw new RuntimeException('The configured database name is invalid.');
}

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$databaseDsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);

try {
    // Existing hosted databases normally grant access only to one database.
    $pdo = new PDO($databaseDsn, DB_USER, DB_PASS, $pdoOptions);
} catch (PDOException) {
    // Local development may start without a database, so create it when permitted.
    $serverDsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', DB_HOST, DB_PORT);
    $pdo = new PDO($serverDsn, DB_USER, DB_PASS, $pdoOptions);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $pdo->exec('USE `' . DB_NAME . '`');
}

$schema = file_get_contents(dirname(__DIR__) . '/database/schema.sql');
if ($schema === false) {
    throw new RuntimeException('Could not read database/schema.sql.');
}
foreach (preg_split('/;\s*(?:\r?\n|$)/', trim($schema)) as $statement) {
    $statement = trim($statement);
    if ($statement !== '') {
        $pdo->exec($statement);
    }
}

$seed = require dirname(__DIR__) . '/database/seed-content.php';
$pdo->beginTransaction();

$settingStatement = $pdo->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_key = VALUES(setting_key)');
foreach ($seed['settings'] as $key => $value) {
    $settingStatement->execute([$key, $value]);
}

$smtpPassword = preg_replace('/\s+/', '', (string) getenv('JG_SMTP_PASSWORD')) ?: '';
if ($smtpPassword !== '') {
    $key = hash('sha256', APP_KEY, true);
    $iv = random_bytes(12);
    $tag = '';
    $cipher = openssl_encrypt($smtpPassword, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);
    if ($cipher === false) {
        throw new RuntimeException('Could not encrypt the SMTP password.');
    }
    $encrypted = base64_encode($iv . $tag . $cipher);
    $statement = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'smtp_password_enc'");
    $statement->execute([$encrypted]);
}

$pageStatement = $pdo->prepare('INSERT INTO pages (slug, title, nav_title, hero_title, hero_subtitle, content, meta_title, meta_keywords, meta_description, status) VALUES (:slug, :title, :nav_title, :hero_title, :hero_subtitle, :content, :meta_title, :meta_keywords, :meta_description, :status) ON DUPLICATE KEY UPDATE title=VALUES(title), nav_title=VALUES(nav_title), hero_title=VALUES(hero_title), hero_subtitle=VALUES(hero_subtitle), content=VALUES(content), meta_title=VALUES(meta_title), meta_keywords=VALUES(meta_keywords), meta_description=VALUES(meta_description), status=VALUES(status)');
foreach ($seed['pages'] as $page) {
    $pageStatement->execute($page);
}

$serviceStatement = $pdo->prepare('INSERT INTO services (title, slug, short_description, content, card_image, detail_image, faqs_json, meta_title, meta_keywords, meta_description, sort_order, active) VALUES (:title, :slug, :short_description, :content, :card_image, :detail_image, :faqs_json, :meta_title, :meta_keywords, :meta_description, :sort_order, 1) ON DUPLICATE KEY UPDATE title=VALUES(title), short_description=VALUES(short_description), content=VALUES(content), faqs_json=VALUES(faqs_json), meta_title=VALUES(meta_title), meta_keywords=VALUES(meta_keywords), meta_description=VALUES(meta_description), sort_order=VALUES(sort_order)');
foreach ($seed['services'] as $service) {
    $service['card_image'] = 'assets/images/jg-cleaning-team-hero.webp';
    $service['detail_image'] = 'assets/images/jg-cleaning-team-hero.webp';
    $service['faqs_json'] = json_encode($service['faqs'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    unset($service['faqs']);
    $serviceStatement->execute($service);
}

$adminPassword = (string) getenv('JG_ADMIN_PASSWORD');
if ($adminPassword === '') {
    $adminPassword = 'JG-' . substr(bin2hex(random_bytes(8)), 0, 12);
    $generatedPassword = true;
} else {
    $generatedPassword = false;
}
$adminEmail = (string) ($seed['settings']['admin_email'] ?? 'admin@example.com');
$userStatement = $pdo->prepare('INSERT INTO users (name, username, email, password_hash, must_change_password) VALUES (?, ?, ?, ?, 1) ON DUPLICATE KEY UPDATE email = VALUES(email)');
$userStatement->execute(['Website Administrator', 'admin', $adminEmail, password_hash($adminPassword, PASSWORD_DEFAULT)]);

$pdo->commit();

echo "JG Cleaning CMS installed successfully.\n";
echo "Database: " . DB_NAME . "\n";
echo "Admin username: admin\n";
if ($generatedPassword) {
    echo "Generated admin password: " . $adminPassword . "\n";
} else {
    echo "Admin password: supplied through JG_ADMIN_PASSWORD\n";
}
echo $smtpPassword !== '' ? "SMTP password encrypted and stored.\n" : "SMTP password not supplied; add it in Admin > Settings.\n";
