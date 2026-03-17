<?php
$nav_active = 'search';
require_once __DIR__ . '/../includes/config.php';

$search_query = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$page_title = $search_query !== '' ? tr('Search for...') . ' "' . htmlspecialchars($search_query) . '"' : tr('Search');
$page_description = tr('Search for...');
$base = BASE_PATH;

// Searchable pages: url, title (key for tr), description (key for tr)
$searchable_pages = [
    ['url' => '/', 'title' => 'Ki Mi Innenausbau', 'description' => 'Your Construction and Renovation Expert'],
    ['url' => '/about', 'title' => 'About us', 'description' => 'We are a professional renovation and construction company.'],
    ['url' => '/contact', 'title' => 'Contact Us', 'description' => 'Contact us – drywall, interior construction tiles and renovation.'],
    ['url' => '/portfolio', 'title' => 'Portfolio', 'description' => 'Explore Our Services'],
    ['url' => '/galery', 'title' => 'Gallery', 'description' => 'Browse our gallery to discover our expertly finished renovation work.'],
];

$results = [];
$results_seen = []; // avoid duplicate url+title
if ($search_query !== '') {
    $q = mb_strtolower($search_query, 'UTF-8');

    // 1) Match main pages by title/description
    foreach ($searchable_pages as $page) {
        $title = tr($page['title']);
        $desc = tr($page['description']);
        $text = mb_strtolower($title . ' ' . $desc, 'UTF-8');
        if (mb_strpos($text, $q) !== false) {
            $id = $page['url'] . '|' . $title;
            if (!isset($results_seen[$id])) {
                $results_seen[$id] = true;
                $results[] = [
                    'url' => $page['url'],
                    'title' => $title,
                    'description' => $desc,
                ];
            }
        }
    }

    // 2) Search in all translation strings (so e.g. "message" finds contact form text)
    $lang_file = __DIR__ . '/../includes/lang/de.php';
    if (is_file($lang_file)) {
        $strings = (array) require $lang_file;
        foreach ($strings as $key => $value) {
            $key_lower = mb_strtolower($key, 'UTF-8');
            $value_lower = mb_strtolower($value, 'UTF-8');
            if (mb_strpos($key_lower, $q) === false && mb_strpos($value_lower, $q) === false) {
                continue;
            }
            $display_title = $current_lang === 'en' ? $key : $value;
            $snippet = $current_lang === 'en' ? $value : $key;
            if (mb_strlen($snippet) > 160) {
                $snippet = mb_substr($snippet, 0, 157, 'UTF-8') . '...';
            }
            $url = '/';
            if (preg_match('/\b(message|send|email|contact|form|retry|nachricht|senden|e-mail)\b/ui', $key_lower . ' ' . $value_lower)) {
                $url = '/contact';
            } elseif (preg_match('/\b(about|company|team|team|unternehmen|philosophy)\b/ui', $key_lower . ' ' . $value_lower)) {
                $url = '/about';
            } elseif (preg_match('/\b(portfolio|project|service|leistung|galery|gallery|galerie)\b/ui', $key_lower . ' ' . $value_lower)) {
                $url = (mb_strpos($key_lower, 'galer') !== false || mb_strpos($value_lower, 'galer') !== false) ? '/galery' : '/portfolio';
            }
            $id = $url . '|' . $display_title;
            if (!isset($results_seen[$id])) {
                $results_seen[$id] = true;
                $results[] = [
                    'url' => $url,
                    'title' => $display_title,
                    'description' => $snippet,
                ];
            }
        }
    }
}

require_once __DIR__ . '/../includes/head.php';
?>

<body>
    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <div class="header-base">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-base text-left">
                        <h1><?php echo htmlspecialchars(tr('Search')); ?></h1>
                        <p class="lead"><?php echo htmlspecialchars(tr('Search for...')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="space s" />
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php if ($search_query === ''): ?>
                    <p><?php echo htmlspecialchars(tr('Enter a search term above and press Enter or click the search icon.')); ?></p>
                <?php elseif (count($results) === 0): ?>
                    <p><?php echo htmlspecialchars(tr('No results found for')); ?> "<?php echo htmlspecialchars($search_query); ?>".</p>
                <?php else: ?>
                    <p class="text-muted"><?php echo count($results); ?> <?php echo htmlspecialchars(tr('results found')); ?>.</p>
                    <ul class="list-group">
                        <?php foreach ($results as $r): ?>
                            <li class="list-group-item">
                                <a href="<?php echo htmlspecialchars($r['url']); ?>"><strong><?php echo htmlspecialchars($r['title']); ?></strong></a>
                                <?php if (!empty($r['description'])): ?>
                                    <p class="small margin-clear"><?php echo nl2br(htmlspecialchars($r['description'])); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <hr class="space m" />

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
