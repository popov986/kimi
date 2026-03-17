<?php
$nav_active = 'home';
require_once __DIR__ . '/../includes/config.php';
$page_title = tr('Ki Mi Innenausbau');
$page_description = tr('Multipurpose HTML template.');
$base = BASE_PATH;
require_once __DIR__ . '/../includes/gallery_data.php';

// Per-project gallery lightbox: one gallery per project (next/prev stay in same project)
$footer_extra_js = '<script>
(function initProjectGallery(){
  if (typeof jQuery === "undefined" || !jQuery.fn.magnificPopup) { setTimeout(initProjectGallery, 50); return; }
  jQuery(function(){
    jQuery(".project-gallery").each(function(){
      var $wrap = jQuery(this);
      var $links = $wrap.find("a.project-lightbox");
      if ($links.length === 0) return;
      var items = $links.map(function() { return { src: jQuery(this).attr("href") }; }).get();
      $links.on("click.projectGallery", function(e) {
        e.preventDefault();
        var idx = $links.index(this);
        jQuery.magnificPopup.open({
          type: "image",
          items: items,
          index: idx,
          gallery: { enabled: true, tCounter: "%curr%/%total%" },
          mainClass: "mfp-fade project-gallery-lightbox"
        });
      });
    });
  });
})();
</script>';

require_once __DIR__ . '/../includes/head.php';
?>



<body>


    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <div class="section-empty no-paddings">
        <div class="section-slider row-18 white">
            <div class="flexslider advanced-slider slider visible-dir-nav" data-options="animation:fade">
                <ul class="slides">
                    <li class="slide-image-right" data-slider-anima="fade-left" data-time="1000">
                        <div class="section-slide">
                            <div class="bg-cover" style="background-image:url('<?= $base ?>images/gallery/<?= rawurlencode('project 5') ?>/project5_5.jpg')">
                            </div>
                            <div class="container">
                                <div class="container-middle">
                                    <div class="container-inner text-left">
                                        <hr class="space m visible-sm" />
                                        <div class="row">
                                            <div class="col-md-6 anima">
                                                <h1 class="text-l text-normal text-m-xs"><?= tr('Ki-Mi Drywall / Interior Construction') ?></h1>
                                                <p class="text-s-xs">
                                                    <?= tr('Renovations, Refurbishments & Interior Construction in Leverkusen and Surroundings.') ?>
                                                </p>
                                                <ul class="text-s-xs list">
                                                    <li><?= tr('Drywall Construction') ?></li>
                                                    <li><?= tr('Plaster Work') ?></li>
                                                    <li><?= tr('Finishing Work (Q1–Q4)') ?></li>
                                                    <li><?= tr('Painting (White)') ?></li>
                                                    <li><?= tr('Wallpapering') ?></li>
                                                    <li><?= tr('Demolition') ?></li>
                                                    <li><?= tr('Tile Repairs / Renovations and much more') ?></li>
                                                </ul>
                                                <br>
                                                <button class="btn btn-lg btn-slider-cta" type="button"><i class="fa fa-phone"></i>+49 176 40486454</button>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <hr class="space visible-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="slide-image-right" data-slider-anima="fade-left" data-time="1000">
                        <div class="section-slide">
                            <div class="bg-cover" style="background-image:url('<?= $base ?>images/<?= 'gallery' ?>/main.jpg')">
                            </div>
                            <div class="container">
                                <div class="container-middle">
                                    <div class="container-inner text-left">
                                        <hr class="space m visible-sm" />
                                        <div class="row">
                                            <div class="col-md-6 anima">
                                                <h1 class="text-l text-normal text-m-xs"><?= tr('Built with precision, designed to last') ?></h1>
                                                <p class="text-s-xs">
                                                    <?= tr('Our work is defined by precision. Perfectly straight lines, even spacing, and smooth finishes are not details — they are our standard. Using modern tools and proven construction methods, we ensure effective installation that resists moisture, wear, and time.') ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <hr class="space visible-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="slide-image-right" data-slider-anima="fade-left" data-time="1000">
                        <div class="section-slide">
                            <div class="bg-cover" style="background-image:url('<?= $base ?>images/gallery/<?= rawurlencode('project 5') ?>/project5_9.jpg')">
                            </div>
                            <div class="container">
                                <div class="container-middle">
                                    <div class="container-inner text-left">
                                        <hr class="space m visible-sm" />
                                        <div class="row">
                                            <div class="col-md-6 anima">
                                                <h1 class="text-l text-normal text-m-xs"><?= tr('Built for style and strength') ?></h1>
                                                <p class="text-s-xs">
                                                    <?= tr('Great tile work transforms a space instantly. We provide professional tiles construction that blends modern design with solid engineering. Every tile is placed with care, accuracy, and technical precision to create surfaces that are smooth, durable, and visually striking.') ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <hr class="space visible-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="section-bg-color section-services-boxes">
        <div class="container content">
            <div class="row">
                <div class="col-md-3">
                    <div class="advs-box advs-box-top-icon-img boxed-inverse text-left">
                        <a class="img-box lightbox img-scale-up" href="#">
                            <span><img src="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 13') ?>/project13_7.jpg" alt="Tiles construction"></span>
                        </a>
                        <div class="advs-box-content">
                            <h3><?= tr('Tiles construction') ?></h3>
                            <p>
                                <?= tr('Professional tile installation for floors, walls, and wet areas. Precision laying and lasting finishes for residential and commercial spaces.') ?>
                            </p>
                            <!-- <a href="#" class="btn-text">Read more</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="advs-box advs-box-top-icon-img boxed-inverse text-left">
                        <a class="img-box lightbox img-scale-up" href="#">
                            <span><img src="<?= $base ?>images/gallery/project 14/project14_3.jpeg" alt="Renovations"></span>
                        </a>
                        <div class="advs-box-content">
                            <h3><?= tr('Renovations') ?></h3>
                            <p>
                                <?= tr('We renew, beautify and repair living spaces with painting, flooring and minor repairs to bring your space back to life.') ?>
                            </p>
                            <!-- <a href="#" class="btn-text">Read more</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="advs-box advs-box-top-icon-img boxed-inverse text-left">
                        <a class="img-box lightbox img-scale-up" href="#">
                            <span><img src="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 9') ?>/project9_6.jpg" alt="Drywall"></span>
                        </a>
                        <div class="advs-box-content">
                            <h3><?= tr('Drywall') ?></h3>
                            <p>
                                <?= tr('Professional drywall installation, framing and finishing for walls and ceilings. Partitions, crack repair and paint-ready surfaces.') ?>
                            </p>
                            <!-- <a href="#" class="btn-text">Read more</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="advs-box advs-box-top-icon-img boxed-inverse text-left">
                        <a class="img-box lightbox img-scale-up" href="#">
                            <span><img src="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 8') ?>/project8_3.jpg" alt="Interior & Exterior Finishing"></span>
                        </a>
                        <div class="advs-box-content">
                            <h3><?= tr('Interior Finishing') ?></h3>
                            <p>
                                <?= tr('Complete interior finishing: walls, plastering, and painting. Making buildings weatherproof and move-in ready.') ?>
                            </p>
                            <!-- <a href="#" class="btn-text">Read more</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-empty section-projects">
        <div class="container content">
            <div class="maso-list">
                <div class="title-base  text-left">
                    <hr />
                    <h2><?= tr('Our latest Projects') ?></h2>
                </div>
                <hr class="space s" />
<!--                <div class="navbar navbar-inner">-->
<!--                    <div class="navbar-toggle"><i class="fa fa-bars"></i><span>Menu</span><i class="fa fa-angle-down"></i></div>-->
<!--                    <div class="collapse navbar-collapse">-->
<!--                        <ul class="nav navbar-nav over ms-minimal inner maso-filters nav-center">-->
<!--                            <li class="current-active active"><a data-filter="maso-item">All projects</a></li>-->
<!--                            --><?php //foreach ($gallery_cats as $cat_slug => $cat_label): ?>
<!--                            <li><a data-filter="--><?php //= htmlspecialchars($cat_slug) ?><!--">--><?php //= htmlspecialchars(tr($cat_label)) ?><!--</a></li>-->
<!--                            --><?php //endforeach; ?>
<!--                            <li><a class="maso-order" data-sort="asc"><i class="fa fa-arrow-down"></i></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="maso-box row" id="projects-maso-box">
                    <?php
                    $gallery_cat_list = array_keys($gallery_cats);
                    $sort = 0;
                    $initial_count = 8;

                    foreach ($gallery_projects_by_folder as $folder => $data):

                        $files = $data['files'];
                        $title = isset($data['title']) ? $data['title'] : (tr('Project') . ' ' . (int) preg_replace('/\D/', '', $folder));
                        $project_date = isset($data['date']) ? $data['date'] : '';
                        $cat = isset($data['cat']) ? $data['cat'] : $gallery_cat_list[$sort % count($gallery_cat_list)];
                        $first = $data['front_image'] ?? $files[0];
                        $folder_enc = rawurlencode($folder);
                        $hidden = $sort >= $initial_count ? ' project-card--hidden' : '';
                    ?>
                    <div data-sort="<?= $sort ?>" class="maso-item col-md-3 project-card <?= htmlspecialchars($cat) ?><?= $hidden ?>">
                        <div class="img-box adv-img adv-img-down-text boxed-inverse">
                            <div class="project-gallery">
                                <a class="img-box img-scale-up project-lightbox i-center" href="<?= $base ?>images/gallery/<?= $folder_enc ?>/<?= htmlspecialchars($first) ?>">
                                    <div class="caption">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <img src="<?= $base ?>images/gallery/<?= $folder_enc ?>/<?= htmlspecialchars($first) ?>" alt="<?= htmlspecialchars($title) ?>" />
                                </a>
                                <?php foreach ($files as $file): ?>
                                <a class="project-lightbox sr-only" href="<?= $base ?>images/gallery/<?= $folder_enc ?>/<?= htmlspecialchars($file) ?>" aria-hidden="true"></a>
                                <?php endforeach; ?>
                            </div>
                            <div class="caption-bottom">
<!--                                <h2><a href="#">--><?php //= htmlspecialchars(tr($title)) ?><!--</a></h2>-->
                                <?php if ($project_date !== ''): ?><p><?= htmlspecialchars(tr($project_date)) ?></p><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $sort++;
                    endforeach;
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="text-center project-load-more-wrap">
                    <a href="/galery" class="btn btn-sm btn-load-more-projects" id="load-more-projects"><?= tr('View All Projects') ?> <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="section-empty">
        <div class="container content">
            <div class="row vefrtical-row">
                <div class="col-md-4">
                    <div class="title-base  text-left">
                        <hr />
                        <h2><?= tr('Our services') ?></h2>
                        <p style="color: #F3B007 !important"><?= tr('Ki Mi – Drywall & Interior Construction') ?></strong></p>
                    </div>
                    <p class="text-color">
                        <?=
                            tr('Construction and renovation work, renovations, refurbishments, bathroom renovation, interior construction, and old building renovation.')
                        ?>
                    </p>
                    <p>
                        <?=
                            tr('Our team delivers high-quality results for every project, combining expert craftsmanship with modern techniques. Each space is carefully planned and executed to meet your needs, ensuring functional, stylish, and durable solutions.')
                        ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <?=
                            tr('From minor upgrades to full-scale renovations, we handle every task with precision and attention to detail. Our expertise ensures that interiors and bathrooms are modernized, practical, and aesthetically appealing.')
                        ?>
                    </p>
                    <p>
                        <?=
                            tr('We specialize in drywall, ceilings, flooring, and full interior finishing, as well as restoring and modernizing historic properties. Every project is approached with professionalism, quality, and long-lasting results in mind.')
                        ?>
                    </p>
                    <p>
                        <?=
                            tr('From planning to completion, our services cover all aspects of renovation, refurbishments, interior construction, and bathroom upgrades, providing reliable, stylish, and expert solutions for your home or commercial space.')
                        ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="list-items">
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?= tr('Construction and Renovation Work') ?></h3>
                                    <p><?= tr('Expert structural repairs, refurbishments, and maintenance for homes and commercial spaces.') ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span><?= tr('Structural') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?= tr('Bathroom Renovation') ?></h3>
                                    <p><?= tr('Modernizing bathrooms with high-quality materials, precise installation, and stylish designs.') ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span><?= tr('Modern') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?= tr('Interior Construction') ?></h3>
                                    <p><?= tr('Drywall, partition walls, ceilings, flooring, and complete interior finishing for functional, elegant spaces.') ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span><?= tr('Interior') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?= tr('Old Building Renovation') ?></h3>
                                    <p><?= tr('Restoring and modernizing historic properties while preserving character and ensuring long-lasting results.') ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span><?= tr('Historic') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="space s" />
                    <a href="/galery" class="btn btn-lg"><i class="fa fa-angle-right"></i><?= tr('View Galery') ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="section-empty">
        <div class="container content">
            <div class="row proporzional-row">
                <div class="col-md-3 boxed white middle-content">
                    <h2><?= tr('Tiles & construction you can trust') ?></h2>
                </div>
                <div class="col-md-3 boxed-inverse middle-content text-left">
                    <h4><?= tr('Expertise') ?></h4>
                    <h2 class="text-color"><?= tr('What we do') ?></h2>
                    <p><?= tr('Tiles construction, renovations, bathroom remodels, and interior finishing for homes and businesses.') ?></p>
                </div>
                <div class="col-md-3 col-sm-12">
                    <a class="img-box lightbox" href="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 10') ?>/project10_9.jpg" data-lightbox-anima="fade-right">
                        <img src="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 10') ?>/project10_9.jpg" alt="<?= tr('Bathroom tiling') ?>">
                    </a>
                </div>
                <div class="col-md-3 boxed-inverse middle-content text-left">
                    <h4><?= tr('People') ?></h4>
                    <h2 class="text-color"><?= tr('The team') ?></h2>
                    <p><?= tr('Skilled tilers and renovation specialists dedicated to quality and precision.') ?></p>
                </div>
            </div>
            <hr class="space m" />
            <div class="row proporzional-row">
                <div class="col-md-3 boxed-inverse middle-content text-left">
                    <p><?= tr('Renovations include measures to renew, beautify or repair living spaces: painting, flooring, and minor repairs. We bring outdated spaces back to life.') ?></p>
                </div>
                <div class="col-md-3 col-sm-12">
                    <a class="img-box lightbox" href="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 5') ?>/project5_2.jpg" data-lightbox-anima="fade-right">
                        <img src="<?= $base ?>images/<?= 'gallery' ?>/<?= rawurlencode('project 5') ?>/project5_2.jpg" alt="<?= tr('Interior finishing') ?>">
                    </a>
                </div>
                <div class="col-md-3 boxed white middle-content">
                    <p><?= tr('Interior finishing encompasses all work after the building shell—from roof and windows to making the building habitable and move-in ready.') ?></p>
                </div>
                <div class="col-md-3 boxed-inverse middle-content text-left">
                    <h4><?= tr('Services') ?></h4>
                    <h2 class="text-color"><?= tr('Packages') ?></h2>
                    <p><?= tr('Full bathroom renovation, tiling, and old-building modernization.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section-bg-image parallax-window" data-natural-height="1080" data-natural-width="1920" data-parallax="scroll" data-image-src="<?= $base ?>images/gallery/project 16/project16_1.jpeg">
        <div class="container content">
            <div class="row proporzional-row">
                <div class="col-md-3 boxed-inverse boxed-border white middle-content text-left">
                    <p><?= tr('From tiles construction to full bathroom remodels and interior finishing—we deliver precision and quality for every project.') ?></p>
                </div>
                <div class="col-md-3  col-sm-12">
                    <a class="img-box lightbox" href="<?= $base ?>images/gallery/project 10/project10_3.jpg" data-lightbox-anima="fade-right">
                        <img src="<?= $base ?>images/gallery/project 10/project10_3.jpg" alt="<?= tr('Tiles construction') ?>">
                    </a>
                </div>
                <div class="col-md-3 boxed white middle-content">
                    <p><?= tr('Renovation of old buildings: refurbishment and modernization to make them more functional, energy-efficient and aesthetically pleasing.') ?></p>
                </div>
                <div class="col-md-3  col-sm-12">
                    <a class="img-box lightbox" href="<?= $base ?>images/gallery/project 10/project10_9.jpg" data-lightbox-anima="fade-right">
                        <img src="<?= $base ?>images/gallery/project 10/project10_9.jpg" alt="<?= tr('Tiles construction') ?>">
                    </a>
                </div>
<!--                <div class="col-md-3 boxed-inverse middle-content text-left">-->
<!--                    <h4>--><?php //= tr('Services') ?><!--</h4>-->
<!--                    <h2 class="text-color">--><?php //= tr('Quality & precision') ?><!--</h2>-->
<!--                    <p class="no-margins">--><?php //= tr('Tiles, renovations, bathrooms, interior finishing.') ?><!--</p>-->
<!--                </div>-->
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>

