<?php
/**
 * Run at the very start of the router (index.php) so no output is sent before redirect.
 * Sets session + cookie and redirects to current path without ?lang=.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$supported = ['en' => true, 'de' => true];
if (!empty($_GET['lang']) && isset($supported[$_GET['lang']])) {
    $_SESSION['lang'] = $_GET['lang'];
    setcookie('site_lang', $_GET['lang'], time() + (86400 * 365), '/', '', false, true);
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    if ($path === null || $path === '') {
        $path = '/';
    }
    if (!headers_sent()) {
        header('Location: ' . $path, true, 302);
        exit;
    }
}
