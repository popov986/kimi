<?php
/**
 * Router + domain landing page.
 * Run from project root: php -S localhost:8000 public/index.php
 *
 * Routes: / -> home.php, /about -> about.php, etc. (no .php in browser)
 * Static files (HTWF, images, etc.) are served from project root so CSS/JS load.
 */
if (ob_get_level() === 0) {
    ob_start();
}
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$uri = parse_url($requestUri, PHP_URL_PATH);
$uri = trim((string) $uri, '/');
$uri = str_replace(['../', '..\\'], '', $uri);
if ($uri === 'public/index.php' || $uri === 'index.php' || strpos($uri, 'index.php') === 0) {
    $uri = '';
}

$projectRoot = dirname(__DIR__) . DIRECTORY_SEPARATOR;
$isStatic = $uri !== '' && (
    strpos($uri, 'HTWF/') === 0 || strpos($uri, 'images/') === 0 || strpos($uri, 'scripts/') === 0 || strpos($uri, 'videos/') === 0 ||
    preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot|map|mp4|webm)(\?|$)/', $uri)
);
if ($isStatic) {
    $decoded = rawurldecode($uri);
    $file = $projectRoot . str_replace('/', DIRECTORY_SEPARATOR, $decoded);
    if (!is_file($file) && strpos($uri, 'videos/') === 0) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $decoded);
    }
    if (is_file($file)) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png',
            'gif' => 'image/gif', 'ico' => 'image/x-icon', 'svg' => 'image/svg+xml',
            'woff' => 'font/woff', 'woff2' => 'font/woff2', 'ttf' => 'font/ttf', 'eot' => 'application/vnd.ms-fontobject',
            'map' => 'application/json',
            'mp4' => 'video/mp4', 'webm' => 'video/webm',
        ];
        if (isset($types[$ext])) {
            header('Content-Type: ' . $types[$ext]);
        }
        readfile($file);
        return true;
    }
    return false;
}

// Language switch first (no output yet) – set session + cookie and redirect
require_once __DIR__ . '/../includes/lang_switch.php';

// Base path for assets (root-relative)
if (!defined('BASE_PATH')) {
    define('BASE_PATH', '/');
}

$baseDir = __DIR__ . DIRECTORY_SEPARATOR;

// robots.txt (project root)
if ($uri === 'robots.txt') {
    $robotsFile = $projectRoot . 'robots.txt';
    if (is_file($robotsFile)) {
        header('Content-Type: text/plain; charset=utf-8');
        readfile($robotsFile);
        return true;
    }
}

// XML sitemap
if ($uri === 'sitemap.xml' && is_file($baseDir . 'sitemap.php')) {
    require $baseDir . 'sitemap.php';
    return true;
}

// Domain landing page: / or /index -> home.php
if ($uri === '' || $uri === 'index') {
    $homeFile = $baseDir . 'home.php';
    if (is_file($homeFile)) {
        require $homeFile;
        return true;
    }
}

$allowed = ['about', 'contact', 'portfolio', 'galery', 'search', 'contact-form', 'admin'];
if (in_array($uri, $allowed, true) && is_file($baseDir . $uri . '.php')) {
    require $baseDir . $uri . '.php';
    return true;
}

// 404 – use 404.php (same layout as other pages)
http_response_code(404);
require $baseDir . '404.php';
return true;
