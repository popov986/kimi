<?php
/**
 * SEO helpers: canonical URL, default OG image.
 */

if (!defined('SITE_CANONICAL_URL')) {
    require_once __DIR__ . '/config.php';
}

/**
 * Absolute canonical URL for the current request (path only, no query string).
 */
function seo_canonical_url(): string
{
    $base = rtrim((string)SITE_CANONICAL_URL, '/');
    $path = '/';
    if (!empty($_SERVER['REQUEST_URI'])) {
        $path = (string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    if ($path === '' || $path === false) {
        $path = '/';
    }
    $path = '/' . ltrim($path, '/');
    if ($path !== '/' && substr($path, -1) === '/') {
        $path = rtrim($path, '/');
    }

    return $base . $path;
}

/**
 * Default Open Graph / Twitter image (absolute URL).
 */
function seo_default_og_image_url(): string
{
    $base = rtrim((string)SITE_CANONICAL_URL, '/');

    return $base . '/images/gallery/logo.png';
}
