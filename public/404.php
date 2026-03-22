<?php
$nav_active = '';
require_once __DIR__ . '/../includes/config.php';
$page_title = tr('404 - Page not found');
$page_description = tr('The page you were looking for could not be found.');
$base = BASE_PATH;
$seo_noindex = true;

require_once __DIR__ . '/../includes/head.php';
?>



<body>


    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <div class="section-empty">
        <div class="container content box-middle-container full-screen-size" data-sub-height="80">
            <div class="row">
                <div class="col-md-12 text-center box-middle">
                    <div>
                        <h1 data-anima="pulse-vertical" class="text-xxl">404</h1>
                        <h1><?php echo htmlspecialchars(tr('Page not found')); ?></h1>
                        <p>
                            <?php echo htmlspecialchars(tr('The page you were looking for could not be found.')); ?>
                        </p>
                        <hr class="space m" />
                        <a class="anima-button btn-lg btn" href="/"><i class="fa-long-arrow-left fa"></i><?php echo htmlspecialchars(tr('Go back to home')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <i class="scroll-top scroll-top-mobile show fa fa-sort-asc"></i>
    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
