<?php
/**
 * Template configuration - include this at the top of every PHP page.
 * Sets base path for assets and common site settings.
 */

require_once __DIR__ . '/lang.php';

// Base path for CSS, JS, images (relative to the current page)
// When PHP files are in /pages/, use '../'. When in root, use '' or './'
if (!defined('BASE_PATH')) {
    define('BASE_PATH', '../');
}

// Site settings (customize as needed)
$site_name   = 'Ki-Mi Construction';
$site_tagline = 'Ki-Mi Construction';

// Page title - set before including header, e.g. $page_title = 'About Us';
if (!isset($page_title)) {
    $page_title = $site_name;
}
$page_description = isset($page_description) ? $page_description : $site_tagline;

// Optional: show the top mini bar (phone, email, etc.) in header. Set to true in page if needed.
if (!isset($header_mini_bar)) {
    $header_mini_bar = true;
}

// Contact form - email that receives messages (used by contact-form.php)
$contact_email = 'ki-mi@outlook.de';
$contact_phone = '+49 176 40486454';
$contact_address = 'Maria-Terwiel str.15 51377 Leverkusen';

// Google Maps (contact page). Get a key at https://console.cloud.google.com/apis/credentials
// Enable "Maps JavaScript API" for the key. Leave empty if you don't use the map.
$google_maps_api_key = 'AIzaSyBc3rovxkZo13Z1VSud38Wn3drzM3EMKlY';
