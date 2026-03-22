<?php
// Pages included without config (e.g. admin) still need asset URLs.
if (!isset($base)) {
    $base = defined('BASE_PATH') ? BASE_PATH : '../';
}
if (!isset($seo_noindex)) {
    $seo_noindex = false;
}
if (!isset($seo_jsonld_localbusiness)) {
    $seo_jsonld_localbusiness = false;
}
require_once __DIR__ . '/seo.php';

$html_lang = isset($current_lang) ? (string)$current_lang : 'de';
$canonical = seo_canonical_url();
$og_image = isset($seo_og_image) && is_string($seo_og_image) && $seo_og_image !== ''
    ? $seo_og_image
    : seo_default_og_image_url();
?>

<!DOCTYPE html>
<!--[if lt IE 10]> <html lang="<?php echo htmlspecialchars($html_lang); ?>" class="iex"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="<?php echo htmlspecialchars($html_lang); ?>">
<!--<![endif]-->


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
    <?php if ($seo_noindex) : ?>
        <meta name="robots" content="noindex, nofollow">
    <?php else : ?>
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <?php endif; ?>
    <meta property="og:locale" content="<?php echo $html_lang === 'de' ? 'de_DE' : 'en_US'; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars(isset($site_name) ? $site_name : 'Ki Mi Innenausbau'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta name="twitter:domain" content="kimi-trockenbau-innenausbau.de">
    <?php
    if ($seo_jsonld_localbusiness && !$seo_noindex && isset($contact_phone, $contact_email, $contact_address)) {
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Ki-Mi Innenausbau',
            'alternateName' => 'Ki Mi Innenausbau',
            'url' => rtrim(SITE_CANONICAL_URL, '/') . '/',
            'telephone' => $contact_phone,
            'email' => $contact_email,
            'image' => seo_default_og_image_url(),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Maria-Terwiel Str. 15',
                'addressLocality' => 'Leverkusen',
                'postalCode' => '51377',
                'addressCountry' => 'DE',
            ],
            'areaServed' => [
                '@type' => 'City',
                'name' => 'Leverkusen',
            ],
            'priceRange' => '€€',
        ];
        echo '<script type="application/ld+json">' . json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
    ?>
    <script src="<?php echo $base; ?>HTWF/scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/bootstrap/css/bootstrap.css">
    <script src="<?php echo $base; ?>HTWF/scripts/script.js"></script>
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/style.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/content-box.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/image-box.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/animations.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/components.css">

    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/php/contact-form.css">

    <link rel="icon" href="<?php echo $base; ?>images/<?php echo rawurlencode('gallery'); ?>/logo.png">
    <link rel="stylesheet" href="<?php echo $base; ?>skin.css">
    <?php if (!empty($header_extra_css)) { echo $header_extra_css; } ?>
</head>




