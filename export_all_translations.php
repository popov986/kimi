<?php
/**
 * Extract all tr('...') / tr("...") keys from PHP files and export en + de to CSV/Excel.
 * Scans: public/*.php, includes/*.php
 * Run: php export_all_translations.php
 */

$baseDir = __DIR__;
$scanDirs = [$baseDir . '/public', $baseDir . '/includes'];
$phpFiles = [];
foreach ($scanDirs as $dir) {
    if (!is_dir($dir)) continue;
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS));
    foreach ($it as $file) {
        if ($file->getExtension() === 'php') {
            $path = $file->getPathname();
            if (strpos($path, '\\HTWF\\') !== false || strpos($path, '/HTWF/') !== false) continue;
            if (strpos($path, 'twitteroauth') !== false) continue;
            $phpFiles[] = $path;
        }
    }
}

$keysFromCode = [];
foreach ($phpFiles as $file) {
    $code = @file_get_contents($file);
    if ($code === false) continue;
    $tokens = @token_get_all($code);
    $i = 0;
    $n = count($tokens);
    while ($i < $n) {
        $t = $tokens[$i];
        if (!is_array($t)) {
            $i++;
            continue;
        }
        if ($t[0] === T_STRING && $t[1] === 'tr') {
            $i++;
            while ($i < $n && is_array($tokens[$i]) && $tokens[$i][0] === T_WHITESPACE) $i++;
            if ($i < $n && $tokens[$i] === '(') {
                $i++;
                while ($i < $n && is_array($tokens[$i]) && $tokens[$i][0] === T_WHITESPACE) $i++;
                if ($i < $n && is_array($tokens[$i]) && $tokens[$i][0] === T_CONSTANT_ENCAPSED_STRING) {
                    $raw = $tokens[$i][1];
                    $key = substr($raw, 1, -1);
                    $key = str_replace(['\\\'', '\\"', '\\\\'], ["'", '"', '\\'], $key);
                    $keysFromCode[$key] = true;
                }
            }
        }
        $i++;
    }
}

$deFile = $baseDir . '/includes/lang/de.php';
$de = is_file($deFile) ? (array) require $deFile : [];

$allKeys = array_unique(array_merge(array_keys($keysFromCode), array_keys($de)));
sort($allKeys, SORT_STRING);

$outCsv = $baseDir . '/translations_all_en_de.csv';
$fp = fopen($outCsv, 'w');
if (!$fp) {
    fwrite(STDERR, "Cannot create $outCsv\n");
    exit(1);
}
fwrite($fp, "\xEF\xBB\xBF");
fputcsv($fp, ['en', 'de'], ',', '"');
foreach ($allKeys as $en) {
    $deVal = isset($de[$en]) ? $de[$en] : '';
    fputcsv($fp, [$en, $deVal], ',', '"');
}
fclose($fp);

$count = count($allKeys);
echo "Exported $count translation rows (from " . count($phpFiles) . " PHP files) to $outCsv\n";
echo "Run: python csv_to_xlsx.py  (edit script to use translations_all_en_de.csv) for .xlsx\n";
