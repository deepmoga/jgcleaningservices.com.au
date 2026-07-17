<?php
declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));
define('UPLOAD_DIR', APP_ROOT . '/assets/uploads');
define('UPLOAD_WEB_PATH', 'assets/uploads');

$localConfigFile = __DIR__ . '/local.php';
if (!is_file($localConfigFile)) {
    throw new RuntimeException('Missing config/local.php. Copy config/local.example.php and enter the database settings.');
}

$localConfig = require $localConfigFile;
define('APP_KEY', (string) ($localConfig['app_key'] ?? ''));
define('DB_HOST', (string) ($localConfig['db_host'] ?? '127.0.0.1'));
define('DB_PORT', (string) ($localConfig['db_port'] ?? '3306'));
define('DB_NAME', (string) ($localConfig['db_name'] ?? 'jg_cleaning_cms'));
define('DB_USER', (string) ($localConfig['db_user'] ?? 'root'));
define('DB_PASS', (string) ($localConfig['db_pass'] ?? ''));

if (strlen(APP_KEY) < 32) {
    throw new RuntimeException('APP_KEY must contain at least 32 characters.');
}

