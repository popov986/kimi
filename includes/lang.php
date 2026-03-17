<?php
/**
 * Multilingual support: English (default) and German.
 * Use tr('key') to output a translated string.
 * Switch language via ?lang=en or ?lang=de (stored in session).
 * Translation strings are in includes/lang/en.php and includes/lang/de.php.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('LANG_DEFAULT', 'de');
$supported_languages = ['en' => 'English', 'de' => 'Deutsch'];

// Get/set language: ?lang=de or session/cookie, default
if (!empty($_GET['lang']) && isset($supported_languages[$_GET['lang']])) {
    $_SESSION['lang'] = $_GET['lang'];
    setcookie('site_lang', $_GET['lang'], time() + (86400 * 365), '/', '', false, true);
    $redirect_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    if ($redirect_path === null || $redirect_path === '') {
        $redirect_path = '/';
    }
    if (headers_sent() === false) {
        header('Location: ' . $redirect_path, true, 302);
        exit;
    }
}
// Prefer session, then cookie (fallback), then default
if (isset($_SESSION['lang']) && isset($supported_languages[$_SESSION['lang']])) {
    $current_lang = $_SESSION['lang'];
} elseif (!empty($_COOKIE['site_lang']) && isset($supported_languages[$_COOKIE['site_lang']])) {
    $current_lang = $_COOKIE['site_lang'];
    $_SESSION['lang'] = $current_lang;
} else {
    $current_lang = LANG_DEFAULT;
}

$lang_dir = __DIR__ . '/lang';
$translations = [];
foreach (array_keys($supported_languages) as $code) {
    $file = $lang_dir . '/' . $code . '.php';
    if (is_file($file)) {
        $translations[$code] = (array) require $file;
    }
}

/**
 * Translate a key. Returns the key if translation missing.
 * When current language is 'en' and no en.php exists, the key (English) is shown.
 * @param string $key
 * @return string
 */
function tr($key) {
    global $current_lang, $translations;
    if (isset($translations[$current_lang][$key])) {
        return $translations[$current_lang][$key];
    }
    // English: keys are the source strings, so show key when no en.php entry
    if ($current_lang === 'en') {
        return $key;
    }
    if (isset($translations[LANG_DEFAULT][$key])) {
        return $translations[LANG_DEFAULT][$key];
    }
    return $key;
}

