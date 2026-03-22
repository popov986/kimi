<?php
/**
 * Admin: translations + gallery reorder (no new projects / uploads).
 * Route: /admin
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/config.php';

$adminUser = 'kimitrockenbau';
$adminPass = 'kimitrockenbau';

if (!empty($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: /admin');
    exit;
}

$isAuthed = !empty($_SESSION['admin_authed']);

if (!$isAuthed && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $u = isset($_POST['username']) ? (string)$_POST['username'] : '';
    $p = isset($_POST['password']) ? (string)$_POST['password'] : '';

    if (hash_equals($adminUser, $u) && hash_equals($adminPass, $p)) {
        $_SESSION['admin_authed'] = true;
        header('Location: /admin');
        exit;
    }

    $loginError = 'Invalid username or password.';
}

if (!$isAuthed) {
    $page_title = 'Admin Login';
    $page_description = 'Admin access';
    $base = BASE_PATH;
    $seo_noindex = true;
    require_once __DIR__ . '/../includes/head.php';
    ?>
    <?php require_once __DIR__ . '/../includes/header.php'; ?>
    <div class="section-empty">
        <div class="container content">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2>Admin Login</h2>
                    <hr />
                    <?php if (!empty($loginError)) : ?>
                        <div class="alert alert-warning"><?php echo htmlspecialchars($loginError); ?></div>
                    <?php endif; ?>
                    <form action="/admin" method="post" style="max-width:420px;">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" autocomplete="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" autocomplete="current-password" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
    <?php
    exit;
}

$adminTab = isset($_GET['tab']) ? (string)$_GET['tab'] : 'translations';
if (!in_array($adminTab, ['translations', 'gallery'], true)) {
    $adminTab = 'translations';
}

$langCode = isset($_GET['tlang']) ? (string)$_GET['tlang'] : 'de';
if (!isset($supported_languages[$langCode])) {
    foreach ($supported_languages as $code => $_name) {
        $candidateFile = __DIR__ . '/../includes/lang/' . $code . '.php';
        if (is_file($candidateFile)) {
            $langCode = $code;
            break;
        }
    }
}

$langFile = __DIR__ . '/../includes/lang/' . $langCode . '.php';
if (!is_file($langFile)) {
    $page_title = 'Admin - Translations';
    $base = BASE_PATH;
    $seo_noindex = true;
    require_once __DIR__ . '/../includes/head.php';
    ?>
    <?php require_once __DIR__ . '/../includes/header.php'; ?>
    <div class="section-empty">
        <div class="container content">
            <div class="alert alert-warning">No translation file found for language: <?php echo htmlspecialchars($langCode); ?></div>
        </div>
    </div>
    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
    <?php
    exit;
}

$translations = require $langFile;
if (!is_array($translations)) {
    $translations = [];
}

if (empty($_SESSION['admin_csrf'])) {
    $_SESSION['admin_csrf'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['admin_csrf'];

/** Gallery save XHR from admin JS (fetch + FormData). */
$isGalleryJsonRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower(trim((string)$_SERVER['HTTP_X_REQUESTED_WITH'])) === 'xmlhttprequest';

/**
 * Detect success from $saveMessage for gallery POST handlers (strict whitelist).
 */
function admin_gallery_save_message_is_ok(string $msg): bool
{
    $msg = trim($msg);
    if ($msg === '') {
        return false;
    }
    if (strpos($msg, 'Gallery order saved.') !== false) {
        return true;
    }
    if (strpos($msg, 'Saved image order for:') === 0) {
        return true;
    }

    return false;
}

$saveMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_translation') {
    $postedCsrf = $_POST['csrf'] ?? '';
    if (!hash_equals($csrf, (string)$postedCsrf)) {
        $saveMessage = 'Security check failed (CSRF). Please reload the page.';
    } else {
        $key = isset($_POST['key']) ? (string)$_POST['key'] : '';
        $newValue = isset($_POST['translation']) ? (string)$_POST['translation'] : '';

        if ($key !== '') {
            $translations[$key] = $newValue;

            $backupPath = $langFile . '.bak';
            @copy($langFile, $backupPath);

            $export = "<?php\nreturn " . var_export($translations, true) . ";\n";
            $ok = @file_put_contents($langFile, $export);
            $saveMessage = $ok ? 'Translation saved.' : 'Failed to write translation file (check permissions).';
        } else {
            $saveMessage = 'Missing translation key.';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_gallery_order') {
    $postedCsrf = $_POST['csrf'] ?? '';
    if (!hash_equals($csrf, (string)$postedCsrf)) {
        $saveMessage = 'Security check failed (CSRF). Please reload the page.';
    } else {
        require_once __DIR__ . '/../includes/gallery_data.php';

        $allowedProjects = array_keys($gallery_projects_by_folder);

        $parseList = function ($text) {
            $text = (string)($text ?? '');
            $parts = preg_split('/[\r\n,]+/', $text);
            $out = [];
            foreach ($parts as $p) {
                $p = trim((string)$p);
                if ($p !== '') {
                    $out[] = $p;
                }
            }
            return array_values(array_unique($out));
        };

        $projectsOrder = $parseList($_POST['projects_order'] ?? '');
        $newProjects = [];
        foreach ($projectsOrder as $p) {
            if (in_array($p, $allowedProjects, true)) {
                $newProjects[] = $p;
            }
        }
        foreach ($allowedProjects as $p) {
            if (!in_array($p, $newProjects, true)) {
                $newProjects[] = $p;
            }
        }

        $postedFilesMap = [];
        $rawJson = $_POST['files_order_json'] ?? '';
        if (is_string($rawJson) && $rawJson !== '') {
            $decoded = json_decode($rawJson, true);
            if (is_array($decoded)) {
                $postedFilesMap = $decoded;
            }
        }

        $newFilesOrder = [];
        foreach ($allowedProjects as $folder) {
            $existingFiles = $gallery_projects_by_folder[$folder]['files'] ?? [];
            if (!is_array($existingFiles)) {
                $existingFiles = [];
            }

            $fileList = [];
            if (isset($postedFilesMap[$folder]) && is_array($postedFilesMap[$folder])) {
                foreach ($postedFilesMap[$folder] as $f) {
                    $fileList[] = (string)$f;
                }
            }

            $ordered = [];
            foreach ($fileList as $f) {
                if (in_array($f, $existingFiles, true)) {
                    $ordered[] = $f;
                }
            }
            foreach ($existingFiles as $f) {
                if (!in_array($f, $ordered, true)) {
                    $ordered[] = $f;
                }
            }

            if (!empty($ordered)) {
                $newFilesOrder[$folder] = $ordered;
            }
        }

        $galleryOrderPath = __DIR__ . '/../includes/gallery_order.json';
        $payload = [
            'projects' => $newProjects,
            'files' => $newFilesOrder,
        ];

        $export = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $ok = @file_put_contents($galleryOrderPath, $export);
        $saveMessage = $ok ? 'Gallery order saved.' : 'Failed to write gallery_order.json (check permissions).';
    }
}

// Save image order for one project only (merges into gallery_order.json)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save_gallery_order_project') {
    $postedCsrf = $_POST['csrf'] ?? '';
    if (!hash_equals($csrf, (string)$postedCsrf)) {
        $saveMessage = 'Security check failed (CSRF). Please reload the page.';
    } else {
        require_once __DIR__ . '/../includes/gallery_data.php';
        $allowedProjects = array_keys($gallery_projects_by_folder);
        $folder = trim((string)($_POST['project_folder'] ?? ''));
        $rawJson = $_POST['files_order_json_single'] ?? '';

        if ($folder === '' || !in_array($folder, $allowedProjects, true)) {
            $saveMessage = 'Invalid project.';
        } else {
            $fileList = [];
            if (is_string($rawJson) && $rawJson !== '') {
                $decoded = json_decode($rawJson, true);
                if (is_array($decoded)) {
                    foreach ($decoded as $f) {
                        $fileList[] = (string)$f;
                    }
                }
            }

            $existingFiles = $gallery_projects_by_folder[$folder]['files'] ?? [];
            if (!is_array($existingFiles)) {
                $existingFiles = [];
            }

            $ordered = [];
            foreach ($fileList as $f) {
                if (in_array($f, $existingFiles, true)) {
                    $ordered[] = $f;
                }
            }
            foreach ($existingFiles as $f) {
                if (!in_array($f, $ordered, true)) {
                    $ordered[] = $f;
                }
            }

            if (empty($ordered)) {
                $saveMessage = 'No valid files for this project.';
            } else {
                $galleryOrderPath = __DIR__ . '/../includes/gallery_order.json';
                $payload = [];
                if (is_file($galleryOrderPath)) {
                    $payload = json_decode((string)file_get_contents($galleryOrderPath), true);
                }
                if (!is_array($payload)) {
                    $payload = [];
                }
                if (empty($payload['projects']) || !is_array($payload['projects'])) {
                    $payload['projects'] = $allowedProjects;
                }
                if (empty($payload['files']) || !is_array($payload['files'])) {
                    $payload['files'] = [];
                }
                $payload['files'][$folder] = $ordered;

                @copy($galleryOrderPath, $galleryOrderPath . '.bak');
                $export = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                $ok = @file_put_contents($galleryOrderPath, $export);
                $saveMessage = $ok
                    ? 'Saved image order for: ' . $folder
                    : 'Failed to write gallery_order.json (check permissions).';
            }
        }
    }
}

if ($isGalleryJsonRequest && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $ga = (string)($_POST['action'] ?? '');
    if ($ga === 'save_gallery_order' || $ga === 'save_gallery_order_project') {
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');
        $ok = admin_gallery_save_message_is_ok($saveMessage);
        $msg = $saveMessage;
        if ($msg === '' && !$ok) {
            $msg = 'Save could not be completed. Please reload and try again.';
        }
        echo json_encode([
            'ok' => $ok,
            'message' => $msg,
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

$q = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
$page = max(1, (int)($_GET['page'] ?? 1));
$pageSize = 25;

$selectedPage = isset($_GET['p']) ? (string)$_GET['p'] : 'all';
$pageGroups = [
    'all' => ['label' => 'All', 'file' => null],
    'home' => ['label' => '/home', 'file' => __DIR__ . '/home.php'],
    'contact' => ['label' => '/contact', 'file' => __DIR__ . '/contact.php'],
    'about' => ['label' => '/about', 'file' => __DIR__ . '/about.php'],
    'portfolio' => ['label' => '/portfolio', 'file' => __DIR__ . '/portfolio.php'],
    'galery' => ['label' => '/galery', 'file' => __DIR__ . '/galery.php'],
    'search' => ['label' => '/search', 'file' => __DIR__ . '/search.php'],
];
if (!isset($pageGroups[$selectedPage])) {
    $selectedPage = 'all';
}

$extractTrKeys = function ($filePath) {
    if (empty($filePath) || !is_file($filePath)) {
        return [];
    }
    $content = file_get_contents($filePath);
    if ($content === false) {
        return [];
    }

    $found = [];
    if (preg_match_all('~tr\(\s*(["\'])(.*?)\1\s*\)~s', $content, $matches)) {
        foreach ($matches[2] as $raw) {
            $decoded = stripcslashes($raw);
            if ($decoded !== '') {
                $found[] = $decoded;
            }
        }
    }
    return array_values(array_unique($found));
};

if ($selectedPage === 'all') {
    $keys = array_keys($translations);
} else {
    $extracted = $extractTrKeys($pageGroups[$selectedPage]['file']);
    $keys = array_values(array_intersect($extracted, array_keys($translations)));
}

$filteredKeys = [];
if ($q === '') {
    $filteredKeys = $keys;
} else {
    foreach ($keys as $k) {
        $v = $translations[$k] ?? '';
        if (mb_stripos((string)$k, $q) !== false || mb_stripos((string)$v, $q) !== false) {
            $filteredKeys[] = $k;
        }
    }
}

$total = count($filteredKeys);
$start = ($page - 1) * $pageSize;
$sliceKeys = array_slice($filteredKeys, $start, $pageSize);

$availableLangs = [];
foreach ($supported_languages as $code => $label) {
    if (is_file(__DIR__ . '/../includes/lang/' . $code . '.php')) {
        $availableLangs[$code] = $label;
    }
}

$page_title = 'Admin';
$page_description = 'Site administration';
$base = BASE_PATH;
$seo_noindex = true;
require_once __DIR__ . '/../includes/head.php';
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="section-empty">
    <div class="container content">
        <div class="row">
            <div class="col-md-12">
                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
                    <h2 style="margin:0;">
                        <?php if ($adminTab === 'gallery') : ?>
                            Gallery order
                        <?php else : ?>
                            Translation admin (<?php echo htmlspecialchars($pageGroups[$selectedPage]['label']); ?>)
                        <?php endif; ?>
                    </h2>
                    <div>
                        <a class="btn btn-default btn-sm" href="/admin?logout=1">Logout</a>
                    </div>
                </div>
                <hr />

                <?php if (!empty($saveMessage)) : ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($saveMessage); ?></div>
                <?php endif; ?>

                <div style="margin-bottom:16px; display:flex; gap:10px; flex-wrap:wrap;">
                    <a class="btn btn-sm <?php echo $adminTab === 'translations' ? 'btn-primary' : 'btn-default'; ?>"
                       href="/admin?tlang=<?php echo urlencode($langCode); ?>&tab=translations">
                        Translations
                    </a>
                    <a class="btn btn-sm <?php echo $adminTab === 'gallery' ? 'btn-primary' : 'btn-default'; ?>"
                       href="/admin?tlang=<?php echo urlencode($langCode); ?>&tab=gallery">
                        Gallery order
                    </a>
                </div>

                <?php if ($adminTab === 'gallery') : ?>
                    <?php
                    require_once __DIR__ . '/../includes/gallery_data.php';
                    $galleryProjects = array_keys($gallery_projects_by_folder);
                    ?>

                    <p style="margin:0 0 10px;">
                        Drag projects or thumbnails, then use <strong>Save this project</strong> for one folder or <strong>Save gallery order</strong> to save everything (project order + all images).
                    </p>

                    <?php
                    $thumbBase = isset($base) ? $base : '/';
                    ?>

                    <div style="margin-bottom:12px;">
                        <strong>Drag &amp; drop</strong> projects and image thumbnails.
                    </div>

                    <div id="projects-sortable" style="display:flex; flex-wrap:wrap; gap:12px;">
                            <?php foreach ($galleryProjects as $folder) : ?>
                                <?php
                                $data = $gallery_projects_by_folder[$folder] ?? [];
                                $files = $data['files'] ?? [];
                                if (!is_array($files)) {
                                    $files = [];
                                }
                                $front = $data['front_image'] ?? ($files[0] ?? '');
                                $folderEnc = rawurlencode($folder);
                                ?>
                                <div class="project-card-sortable"
                                     draggable="true"
                                     data-folder="<?php echo htmlspecialchars($folder, ENT_QUOTES, 'UTF-8'); ?>"
                                     style="flex:1 1 320px; border:1px solid #e6e6e6; border-radius:8px; padding:12px; background:#fff;">
                                    <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
                                        <?php if (!empty($front)) : ?>
                                            <img
                                                src="<?php echo $thumbBase; ?>images/gallery/<?php echo $folderEnc; ?>/<?php echo htmlspecialchars($front); ?>"
                                                alt=""
                                                style="width:64px; height:48px; object-fit:cover; border-radius:4px; border:1px solid #eee;"
                                                loading="lazy"
                                                draggable="false"
                                            />
                                        <?php endif; ?>
                                        <div style="min-width:0;">
                                            <div style="font-weight:700; line-height:1.2;"><?php echo htmlspecialchars($folder); ?></div>
                                            <div style="font-size:12px; color:#666;"><?php echo (int)count($files); ?> images</div>
                                        </div>
                                    </div>

                                    <div style="font-size:12px; color:#666; margin-bottom:8px;">Images (drag)</div>

                                    <div class="files-sortable"
                                         data-folder="<?php echo htmlspecialchars($folder, ENT_QUOTES, 'UTF-8'); ?>"
                                         style="display:flex; flex-wrap:wrap; gap:8px; border-top:1px solid #f0f0f0; padding-top:10px;">
                                        <?php foreach ($files as $f) : ?>
                                            <div class="file-item"
                                                 draggable="true"
                                                 data-file="<?php echo htmlspecialchars($f, ENT_QUOTES, 'UTF-8'); ?>"
                                                 style="width:82px;">
                                                <img
                                                    src="<?php echo $thumbBase; ?>images/gallery/<?php echo $folderEnc; ?>/<?php echo htmlspecialchars($f); ?>"
                                                    alt=""
                                                    draggable="false"
                                                    style="width:82px; height:62px; object-fit:cover; border-radius:4px; border:2px solid #fff; box-shadow:0 0 0 1px #eee;"
                                                    loading="lazy"
                                                />
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <form method="post" action="/admin?tlang=<?php echo urlencode($langCode); ?>&tab=gallery" class="project-files-save-form" style="margin-top:10px;">
                                        <input type="hidden" name="action" value="save_gallery_order_project" />
                                        <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($csrf); ?>" />
                                        <input type="hidden" name="project_folder" value="<?php echo htmlspecialchars($folder, ENT_QUOTES, 'UTF-8'); ?>" />
                                        <input type="hidden" name="files_order_json_single" value="" class="project-files-json-input" />
                                        <button type="button" class="btn btn-sm btn-default js-save-this-project">Save this project</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                    </div>

                    <form method="post" action="/admin?tlang=<?php echo urlencode($langCode); ?>&tab=gallery" id="gallery-order-form" style="margin-top:14px;">
                        <input type="hidden" name="action" value="save_gallery_order" />
                        <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($csrf); ?>" />
                        <input type="hidden" name="projects_order" id="projects_order_hidden" />
                        <input type="hidden" name="files_order_json" id="files_order_json_hidden" value="{}" />
                        <button class="btn btn-primary" type="button" id="save-gallery-order-btn">Save gallery order</button>
                    </form>

                    <script>
                        (function () {
                            var galleryPostUrl = <?php echo json_encode('/admin?tlang=' . urlencode($langCode) . '&tab=gallery', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
                            var galleryCsrf = <?php echo json_encode($csrf, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

                            function postGalleryAction(action, extraFields) {
                                var fd = new FormData();
                                fd.append('action', action);
                                fd.append('csrf', galleryCsrf);
                                if (extraFields) {
                                    Object.keys(extraFields).forEach(function (k) {
                                        fd.append(k, extraFields[k]);
                                    });
                                }
                                return fetch(galleryPostUrl, {
                                    method: 'POST',
                                    body: fd,
                                    credentials: 'same-origin',
                                    cache: 'no-store',
                                    redirect: 'follow',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        Accept: 'application/json'
                                    }
                                });
                            }

                            function finishGallerySave(btn, label, res) {
                                function resetBtn() {
                                    if (btn) {
                                        btn.disabled = false;
                                        btn.textContent = label;
                                    }
                                }
                                return res.text().then(function (text) {
                                    var data;
                                    try {
                                        data = JSON.parse(text);
                                    } catch (e) {
                                        resetBtn();
                                        if (!res.ok) {
                                            window.alert('Save failed (HTTP ' + res.status + ').');
                                        } else {
                                            window.alert('Unexpected response from server. Try reloading the page.');
                                        }
                                        return;
                                    }
                                    if (data && data.ok) {
                                        window.location.reload();
                                        return;
                                    }
                                    resetBtn();
                                    window.alert((data && data.message) ? data.message : 'Save failed.');
                                });
                            }

                            var projectsSortable = document.getElementById('projects-sortable');
                            if (!projectsSortable) return;

                            var dragProject = null;
                            projectsSortable.querySelectorAll('.project-card-sortable').forEach(function (el) {
                                el.addEventListener('dragstart', function (e) {
                                    if (e.target && e.target.closest && e.target.closest('.file-item')) {
                                        return;
                                    }
                                    dragProject = el;
                                    e.dataTransfer.effectAllowed = 'move';
                                });
                                el.addEventListener('dragover', function (e) {
                                    e.preventDefault();
                                    e.dataTransfer.dropEffect = 'move';
                                });
                                el.addEventListener('drop', function (e) {
                                    e.preventDefault();
                                    if (!dragProject || dragProject === el) return;
                                    el.parentNode.insertBefore(dragProject, el);
                                    updateHiddenInputs();
                                });
                            });

                            document.querySelectorAll('.files-sortable').forEach(function (filesBox) {
                                var dragFile = null;
                                filesBox.querySelectorAll('.file-item').forEach(function (fEl) {
                                    fEl.addEventListener('dragstart', function (e) {
                                        dragFile = fEl;
                                        dragProject = null;
                                        e.dataTransfer.effectAllowed = 'move';
                                        e.stopPropagation();
                                    });
                                    fEl.addEventListener('dragover', function (e) {
                                        e.preventDefault();
                                        e.dataTransfer.dropEffect = 'move';
                                    });
                                    fEl.addEventListener('drop', function (e) {
                                        e.preventDefault();
                                        if (!dragFile || dragFile === fEl) return;
                                        fEl.parentNode.insertBefore(dragFile, fEl);
                                        e.stopPropagation();
                                        updateHiddenInputs();
                                    });
                                });
                            });

                            function updateHiddenInputs() {
                                var projects = Array.prototype.slice.call(
                                    projectsSortable.querySelectorAll('.project-card-sortable')
                                ).map(function (p) { return p.getAttribute('data-folder'); });

                                var projectsHidden = document.getElementById('projects_order_hidden');
                                if (projectsHidden) projectsHidden.value = projects.join('\n');

                                var map = {};
                                document.querySelectorAll('.files-sortable').forEach(function (filesBox) {
                                    var folder = filesBox.getAttribute('data-folder');
                                    var files = Array.prototype.slice.call(
                                        filesBox.querySelectorAll('.file-item')
                                    ).map(function (f) { return f.getAttribute('data-file'); });
                                    map[folder] = files;
                                });
                                var jsonHidden = document.getElementById('files_order_json_hidden');
                                if (jsonHidden) jsonHidden.value = JSON.stringify(map);
                            }

                            document.querySelectorAll('.project-files-save-form').forEach(function (pf) {
                                var btn = pf.querySelector('.js-save-this-project');
                                if (!btn) {
                                    return;
                                }
                                btn.addEventListener('click', function () {
                                    if (btn.disabled) {
                                        return;
                                    }
                                    var card = pf.closest('.project-card-sortable');
                                    if (!card) {
                                        return;
                                    }
                                    var filesBox = card.querySelector('.files-sortable');
                                    if (!filesBox) {
                                        return;
                                    }
                                    var files = Array.prototype.slice.call(
                                        filesBox.querySelectorAll('.file-item')
                                    ).map(function (node) {
                                        return node.getAttribute('data-file');
                                    });
                                    var folderInput = pf.querySelector('[name="project_folder"]');
                                    var folder = folderInput ? folderInput.value : '';
                                    var json = JSON.stringify(files);
                                    var label = btn.textContent;
                                    btn.disabled = true;
                                    btn.textContent = 'Saving…';
                                    postGalleryAction('save_gallery_order_project', {
                                        project_folder: folder,
                                        files_order_json_single: json
                                    }).then(function (res) {
                                        return finishGallerySave(btn, label, res);
                                    }).catch(function () {
                                        btn.disabled = false;
                                        btn.textContent = label;
                                        window.alert('Network error while saving.');
                                    });
                                });
                            });

                            var saveAllBtn = document.getElementById('save-gallery-order-btn');
                            if (saveAllBtn) {
                                saveAllBtn.addEventListener('click', function () {
                                    if (saveAllBtn.disabled) {
                                        return;
                                    }
                                    updateHiddenInputs();
                                    var po = document.getElementById('projects_order_hidden');
                                    var fj = document.getElementById('files_order_json_hidden');
                                    var label = saveAllBtn.textContent;
                                    saveAllBtn.disabled = true;
                                    saveAllBtn.textContent = 'Saving…';
                                    postGalleryAction('save_gallery_order', {
                                        projects_order: po ? po.value : '',
                                        files_order_json: fj ? fj.value : '{}'
                                    }).then(function (res) {
                                        return finishGallerySave(saveAllBtn, label, res);
                                    }).catch(function () {
                                        saveAllBtn.disabled = false;
                                        saveAllBtn.textContent = label;
                                        window.alert('Network error while saving.');
                                    });
                                });
                            }

                            updateHiddenInputs();
                        })();
                    </script>
                <?php else : ?>
                <form method="get" action="/admin" class="form-inline" style="margin-bottom:16px;">
                    <input type="hidden" name="tlang" value="<?php echo htmlspecialchars($langCode); ?>" />
                    <input type="hidden" name="p" value="<?php echo htmlspecialchars($selectedPage); ?>" />
                    <input class="form-control" type="text" name="q" value="<?php echo htmlspecialchars($q); ?>" placeholder="Search key or value..." style="width:300px;" />
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

                <div style="margin-bottom:16px;">
                    <label>Language:&nbsp;</label>
                    <select class="form-control" style="display:inline-block; width:auto;" onchange="window.location='/admin?tlang='+this.value+'&p=<?php echo urlencode($selectedPage); ?>&q=<?php echo urlencode($q); ?>';">
                        <?php foreach ($availableLangs as $code => $label) : ?>
                            <option value="<?php echo htmlspecialchars($code); ?>" <?php echo $code === $langCode ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom:16px;">
                    <label>Page:&nbsp;</label>
                    <div style="display:flex; flex-wrap:wrap; gap:10px;">
                        <?php foreach ($pageGroups as $code => $pg) : ?>
                            <a class="btn btn-sm <?php echo $code === $selectedPage ? 'btn-primary' : 'btn-default'; ?>"
                               href="/admin?tlang=<?php echo urlencode($langCode); ?>&p=<?php echo urlencode($code); ?>&q=<?php echo urlencode($q); ?>&page=1">
                                <?php echo htmlspecialchars($pg['label']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <p style="margin:0 0 10px;">
                            Showing <?php echo (int)($start + 1); ?> - <?php echo (int)min($start + $pageSize, $total); ?>
                            of <?php echo (int)$total; ?>
                        </p>

                        <table class="table table-bordered table-striped" style="margin-bottom:0;">
                            <thead>
                                <tr>
                                    <th style="width:45%;">Key</th>
                                    <th>Translation (<?php echo htmlspecialchars($langCode); ?>)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sliceKeys as $k) : ?>
                                    <?php $currentValue = $translations[$k] ?? ''; ?>
                                    <tr>
                                        <td style="vertical-align:top;">
                                            <textarea class="form-control" rows="2" readonly style="resize:vertical;"><?php echo htmlspecialchars((string)$k); ?></textarea>
                                        </td>
                                        <td style="vertical-align:top;">
                                            <form method="post" action="/admin?tlang=<?php echo urlencode($langCode); ?>&p=<?php echo urlencode($selectedPage); ?>&q=<?php echo urlencode($q); ?>&page=<?php echo (int)$page; ?>" style="margin:0;">
                                                <input type="hidden" name="action" value="save_translation" />
                                                <input type="hidden" name="csrf" value="<?php echo htmlspecialchars($csrf); ?>" />
                                                <input type="hidden" name="key" value="<?php echo htmlspecialchars((string)$k, ENT_QUOTES, 'UTF-8'); ?>" />
                                                <textarea name="translation" class="form-control" rows="3" style="resize:vertical;"><?php echo htmlspecialchars((string)$currentValue); ?></textarea>
                                                <div style="height:10px;"></div>
                                                <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php
                        $prevPage = max(1, $page - 1);
                        $nextPage = $total > 0 ? min($page + 1, (int)ceil($total / $pageSize)) : 1;
                        ?>
                        <div style="margin-top:18px; display:flex; justify-content:space-between;">
                            <a class="btn btn-default btn-sm" href="/admin?tlang=<?php echo urlencode($langCode); ?>&p=<?php echo urlencode($selectedPage); ?>&q=<?php echo urlencode($q); ?>&page=<?php echo $prevPage; ?>">Prev</a>
                            <a class="btn btn-default btn-sm" href="/admin?tlang=<?php echo urlencode($langCode); ?>&p=<?php echo urlencode($selectedPage); ?>&q=<?php echo urlencode($q); ?>&page=<?php echo $nextPage; ?>">Next</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
