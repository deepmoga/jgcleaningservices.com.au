<?php
/** Development router for `php -S`. Apache production routing is in .htaccess. */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$file = __DIR__ . $path;
if ($path !== '/' && is_file($file)) {
    return false;
}
if ($path === '/' || $path === '') {
    require __DIR__ . '/index.php';
    return true;
}
if (preg_match('#^/services/([a-z0-9-]+)/?$#i', $path, $match)) {
    $_GET['slug'] = $match[1];
    require __DIR__ . '/service.php';
    return true;
}
if (preg_match('#^/(about|services|contact|privacy-policy)/?$#i', $path, $match)) {
    $_GET['slug'] = strtolower($match[1]);
    require __DIR__ . '/page.php';
    return true;
}
http_response_code(404);
require __DIR__ . '/404.php';
return true;
