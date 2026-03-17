<?php
/**
 * Export EN/DE translations to CSV (Excel-compatible).
 * Run from project root: php export_translations.php
 */
$langFile = __DIR__ . '/includes/lang/de.php';
if (!is_file($langFile)) {
    fwrite(STDERR, "Lang file not found: $langFile\n");
    exit(1);
}
$translations = require $langFile;
if (!is_array($translations)) {
    fwrite(STDERR, "Invalid lang file: expected array\n");
    exit(1);
}

$outPath = __DIR__ . '/translations_en_de.csv';
$fp = fopen($outPath, 'w');
if (!$fp) {
    fwrite(STDERR, "Cannot create file: $outPath\n");
    exit(1);
}

// UTF-8 BOM so Excel detects encoding
fwrite($fp, "\xEF\xBB\xBF");
// Header
fputcsv($fp, ['en', 'de'], ',', '"');

foreach ($translations as $en => $de) {
    fputcsv($fp, [(string) $en, (string) $de], ',', '"');
}
fclose($fp);
echo "Exported " . count($translations) . " rows to " . $outPath . "\n";
