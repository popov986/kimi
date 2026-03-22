<?php
$nav_active = 'portfolio';
require_once __DIR__ . '/../includes/config.php';
$page_title = tr('Portfolio | Ki Mi Innenausbau Leverkusen');
$page_description = tr('Portfolio: completed projects – renovation, drywall, bathroom and interior work in Leverkusen and region.');
$base = BASE_PATH;

require_once __DIR__ . '/../includes/head.php';
?>



<body>


    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <div class="header-base">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="title-base text-left">
                        <h1><?= tr('Portfolio') ?></h1>
                        <p><?= tr('Explore Our Services') ?></p>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <ol class="breadcrumb b white">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">Portfolio</li>
                    </ol>
                </div> -->
            </div>
        </div>
    </div>

    <div class="section-empty section-item">
        <div class="container content">
            <div class="maso-list">
                <div class="maso-box row" data-options="anima:fade-in">
                    <div data-sort="1" class="maso-item col-md-4 col-sm-6 cat1 cat5">
                        <div class="advs-box advs-box-multiple boxed-inverse" data-anima="scale-up" data-trigger="hover">
                            <a class="img-box"><img class="anima" src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 1'); ?>/project1_4.jpg" alt="" /></a>
                            <div class="circle anima"><i class="fa fa-bath"></i></div>
                            <div class="advs-box-content">
                                <h3><?php echo htmlspecialchars(tr('Tiles')); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars(tr('We provide professional bathroom and tile construction services, combining modern design, high-quality materials, and precise installation to create stylish, functional, and durable spaces.')); ?>
                                </p>
<!--                                <a class="btn-text" href="#">--><?php //echo htmlspecialchars(tr('Enter now')); ?><!--</a>-->
                            </div>
                        </div>
                    </div>
                    <div data-sort="1" class="maso-item col-md-4 col-sm-6 cat1 cat2">
                        <div class="advs-box advs-box-multiple boxed-inverse" data-anima="scale-up" data-trigger="hover">
                            <a class="img-box"><img class="anima" src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 5'); ?>/project5_6.jpg" alt="" /></a>
                            <div class="circle anima"><i class="fa fa-wrench"></i></div>
                            <div class="advs-box-content">
                                <h3><?php echo htmlspecialchars(tr('Renovations')); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars(tr('We offer expert structural repairs, precise painting and plastering, quality flooring replacement, and complete interior finishing to transform your space beautifully and durably.')); ?>
                                </p>
<!--                                <a class="btn-text" href="#">--><?php //echo htmlspecialchars(tr('Enter now')); ?><!--</a>-->
                            </div>
                        </div>
                    </div>
                    <div data-sort="1" class="maso-item col-md-4 col-sm-6 cat4 cat2 cat5">
                        <div class="advs-box advs-box-multiple boxed-inverse" data-anima="scale-up" data-trigger="hover">
                            <a class="img-box"><img class="anima" src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 10'); ?>/project10_6.jpg" alt="" /></a>
                            <div class="circle anima"><i class="fa fa-paint-brush"></i></div>
                            <div class="advs-box-content">
                                <h3><?php echo htmlspecialchars(tr('Interior Finishing')); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars(tr('We provide professional drywall construction, precise flooring installation, and expert painting services, delivering stylish, durable, and functional interiors for homes and businesses.')); ?>
                                </p>
<!--                                <a class="btn-text" href="#">--><?php //echo htmlspecialchars(tr('Enter now')); ?><!--</a>-->
                            </div>
                        </div>
                    </div>
                    <div data-sort="1" class="maso-item col-md-4 col-sm-6 cat1 cat3 cat2">
                        <div class="advs-box advs-box-multiple boxed-inverse" data-anima="scale-up" data-trigger="hover">
                            <a class="img-box"><img class="anima" src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 10'); ?>/project10_1.jpg" alt="" /></a>
                            <div class="circle anima"><i class="fa fa-building"></i></div>
                            <div class="advs-box-content">
                                <h3><?php echo htmlspecialchars(tr('Modernization')); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars(tr('We specialize in old building renovation, offering structural repairs, modernization, and interior upgrades, transforming historic properties into functional, comfortable, and stylish spaces.')); ?>
                                </p>
<!--                                <a class="btn-text" href="#">--><?php //echo htmlspecialchars(tr('Enter now')); ?><!--</a>-->
                            </div>
                        </div>
                    </div>
                    <div data-sort="1" class="maso-item col-md-4 col-sm-6 cat1 cat4 cat2">
                        <div class="advs-box advs-box-multiple boxed-inverse" data-anima="scale-up" data-trigger="hover">
                            <a class="img-box"><img class="anima" src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 4'); ?>/project4_4.jpg" alt="" /></a>
                            <div class="circle anima"><i class="fa fa-th-large"></i></div>
                            <div class="advs-box-content">
                                <h3><?php echo htmlspecialchars(tr('Exterior Finishing')); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars(tr('We specialize in outdoor tile installation and exterior surfaces, creating durable, weather-resistant patios, terraces, and walkways with precise workmanship and stylish designs.')); ?>
                                </p>
<!--                                <a class="btn-text" href="#">--><?php //echo htmlspecialchars(tr('Enter now')); ?><!--</a>-->
                            </div>
                        </div>
                    </div>
                    <div data-sort="1" class="maso-item col-md-4 col-sm-6 cat1 cat3 cat4">
                        <div class="advs-box advs-box-multiple boxed-inverse" data-anima="scale-up" data-trigger="hover">
                            <a class="img-box"><img class="anima" src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 5'); ?>/project5_4.jpg" alt="" /></a>
                            <div class="circle anima"><i class="fa fa-shower"></i></div>
                            <div class="advs-box-content">
                                <h3><?php echo htmlspecialchars(tr('Bathroom')); ?></h3>
                                <p>
                                    <?php echo htmlspecialchars(tr('Complete bathroom modernization, including tiling, plumbing, fixtures, and design upgrades, transforming spaces into stylish, functional, and comfortable bathrooms tailored to your needs.')); ?>
                                </p>
<!--                                <a class="btn-text" href="#">--><?php //echo htmlspecialchars(tr('Enter now')); ?><!--</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <i class="scroll-top scroll-top-mobile show fa fa-sort-asc"></i>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
