<?php
/**
 * XML sitemap for search engines. Served as /sitemap.xml
 */
require_once __DIR__ . '/../includes/config.php';

header('Content-Type: application/xml; charset=utf-8');

$base = rtrim((string)SITE_CANONICAL_URL, '/');
$lastmod = date('Y-m-d');

$paths = [
    ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
    ['loc' => '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/portfolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/galery', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/search', 'priority' => '0.3', 'changefreq' => 'monthly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($paths as $row) {
    $loc = $base . $row['loc'];
    echo "  <url>\n";
    echo '    <loc>' . htmlspecialchars($loc, ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc>\n";
    echo '    <lastmod>' . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8') . "</lastmod>\n";
    echo '    <changefreq>' . htmlspecialchars($row['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
    echo '    <priority>' . htmlspecialchars($row['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
    echo "  </url>\n";
}

echo "</urlset>\n";
