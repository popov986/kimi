<?php
$nav_active = 'galery';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/gallery_data.php';
$page_title = tr('Gallery | Ki Mi Innenausbau Leverkusen');
$page_description = tr('Gallery: photos of renovation, drywall, tiling and interior projects in Leverkusen.');
$base = BASE_PATH;

// Project-gallery lightbox: one gallery per project (next/prev stay in same project)
$footer_extra_js = '<script>
(function initProjectGallery(){
  if (typeof jQuery === "undefined" || !jQuery.fn.magnificPopup) { setTimeout(initProjectGallery, 50); return; }
  jQuery(function(){
    setTimeout(function(){
    var $projectsBox = jQuery("#projects-maso-box");
    if ($projectsBox.length) {
      $projectsBox.off("click.magnificPopup").removeData("magnificPopup");
    }
    jQuery(".project-gallery").each(function(){
      var $wrap = jQuery(this);
      var $links = $wrap.find("a.project-lightbox");
      if ($links.length === 0) return;
      var items = $links.map(function() { return { src: jQuery(this).attr("href") }; }).get();
      $links.off("click.projectGallery").on("click.projectGallery", function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var idx = $links.index(this);
        jQuery.magnificPopup.open({
          type: "image",
          items: items,
          index: idx,
          gallery: { enabled: true, tCounter: "%curr%/%total%" },
          mainClass: "mfp-fade project-gallery-lightbox"
        });
        return false;
      });
    });
    jQuery("a.mfp-iframe.video-lightbox").on("click.videoLightbox", function(e) {
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();
      var url = jQuery(this).attr("href");
      var $inline = jQuery("#video-lightbox-inline");
      if (!$inline.length) {
        jQuery("body").append(\'<div id="video-lightbox-inline" class="mfp-hide"><div class="video-lightbox-inner"><video controls autoplay playsinline></video></div></div>\');
        $inline = jQuery("#video-lightbox-inline");
      }
      $inline.find("video").attr("src", url);
      jQuery.magnificPopup.open({
        items: { src: "#video-lightbox-inline" },
        type: "inline",
        mainClass: "mfp-fade video-gallery-lightbox",
        removalDelay: 300,
        callbacks: {
          close: function() { jQuery("#video-lightbox-inline video").attr("src", ""); }
        }
      });
      return false;
    });
    }, 80);
  });
})();
</script>';

// Same size for all gallery images (carousel + grid) to match theme
$header_extra_css = '<style>
.flexslider.carousel.gallery .slides > li > a.img-box { height: 200px; overflow: hidden; display: block; }
.flexslider.carousel.gallery .slides > li > a.img-box img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.maso-list.gallery .maso-box .maso-item { overflow: hidden; }
.maso-list.gallery .maso-box .maso-item .img-box { width: 100%; height: 280px; overflow: hidden; display: block; }
.maso-list.gallery .maso-box .maso-item .img-box img { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.maso-list.gallery .maso-box .maso-item .img-box video { width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; }
.maso-list.gallery .maso-box .maso-item.cat5 .img-box { position: relative; }
.maso-list.gallery .maso-box .maso-item.cat5 .img-box .play-icon { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 60px; height: 60px; background: rgba(0,0,0,0.6); border-radius: 50%; display: flex; align-items: center; justify-content: center; pointer-events: none; }
.maso-list.gallery .maso-box .maso-item.cat5 .img-box .play-icon i { color: #fff; font-size: 24px; margin-left: 4px; }
</style>';
require_once __DIR__ . '/../includes/head.php';
?>



<body>


    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <div class="header-base">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-base text-left">
                        <h1><?= tr('Galery') ?></h1>
                        <p class="lead"><?= tr('Browse our gallery to discover our expertly finished renovation work.') ?></p>
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

    <div class="section-empty">
        <div class="container content">
            <div class="flexslider carousel gallery white visible-dir-nav nav-inner" data-options="minWidth:200,itemMargin:15,numItems:3,controlNav:true,directionNav:true">
                <ul class="slides">
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 14'); ?>/project14_4.jpeg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 14'); ?>/project14_4.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 15'); ?>/project15_1.jpeg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 15'); ?>/project15_1.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 16'); ?>/project16_1.jpeg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 16'); ?>/project16_1.jpeg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 5'); ?>/project5_1.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 5'); ?>/project5_1.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 13'); ?>/project13_7.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 13'); ?>/project13_7.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 8'); ?>/project8_3.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 8'); ?>/project8_3.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 3'); ?>/project3_4.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 3'); ?>/project3_4.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 4'); ?>/project4_4.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 4'); ?>/project4_4.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 1'); ?>/project1_4.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 1'); ?>/project1_4.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 6'); ?>/project6_2.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 6'); ?>/project6_2.jpg" alt="">
                        </a>
                    </li>

                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 9'); ?>/project9_1.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 9'); ?>/project9_1.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a class="img-box lightbox" data-lightbox-anima="fade-top" href="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 11'); ?>/project11_7.jpg">
                            <img src="<?php echo $base; ?>images/gallery/<?php echo rawurlencode('project 11'); ?>/project11_7.jpg" alt="">
                        </a>
                    </li>

                </ul>
            </div>
            <hr class="space xs" />

<!--            <div class="maso-list gallery">-->
<!--                <div class="navbar navbar-inner">-->
<!--                    <div class="navbar-toggle"><i class="fa fa-bars"></i><span>--><?php //echo htmlspecialchars(tr('Menu')); ?><!--</span><i class="fa fa-angle-down"></i></div>-->
<!--                    <div class="collapse navbar-collapse">-->
<!--                        <ul class="nav navbar-nav over ms-minimal inner maso-filters">-->
<!--                            <li class="current-active active"><a data-filter="maso-item">--><?php //echo htmlspecialchars(tr('All')); ?><!--</a></li>-->
<!--                            <li><a data-filter="tiles">--><?php //echo htmlspecialchars(tr('Tiles')); ?><!--</a></li>-->
<!--                            <li><a data-filter="drywall">--><?php //echo htmlspecialchars(tr('Drywall')); ?><!--</a></li>-->
<!--                            <li><a data-filter="renovation">--><?php //echo htmlspecialchars(tr('Renovations')); ?><!--</a></li>-->
<!--                            <li><a data-filter="int-ext">--><?php //echo htmlspecialchars(tr('Interior & Exterior')); ?><!--</a></li>-->
<!--                            <li><a data-filter="cat5">--><?php //echo htmlspecialchars(tr('Videos')); ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="maso-box row" data-lightbox-anima="fade-top">-->
<!--                    --><?php
//                    $gallery_grid = [
//                        ['project 3', 'project3_4.jpg'],
//                        ['project 5', 'project5_1.jpg'],
//                        ['project 5', 'project5_6.jpg'],
//                        ['project 1', 'project1_2.jpg'], ['project 1', 'project1_6.jpg'], ['project 1', 'project1_7.jpg'],
//                        ['project 2', 'project2_1.jpg'], ['project 2', 'project2_2.jpg'],
//                        ['project 3', 'project3_2.jpg'], ['project 3', 'project3_3.jpg'],
//                        ['project 4', 'project4_2.jpg'], ['project 4', 'project4_4.jpg'],
//                        ['project 5', 'project5_2.jpg'], ['project 5', 'project5_7.jpg'],
//                        ['project 6', 'project6_2.jpg'], ['project 6', 'project6_3.jpg'],
//                        ['project 7', 'project7_1.jpg'], ['project 7', 'project7_2.jpg'],
//                        ['project 8', 'project8_1.jpg'], ['project 8', 'project8_2.jpg'],
//                        ['project 9', 'project9_1.jpg'], ['project 9', 'project9_2.jpg'], ['project 9', 'project9_6.jpg'],
//                        ['project 10', 'project10_1.jpg'], ['project 10', 'project10_2.jpg'], ['project 10', 'project10_3.jpg'], ['project 10', 'project10_4.jpg'], ['project 10', 'project10_6.jpg'], ['project 10', 'project10_7.jpg'], ['project 10', 'project10_9.jpg'],
//                        ['project 11', 'project11_2.jpg'], ['project 11', 'project11_7.jpg'],
//                        ['project 12', 'project12_5.jpg'], ['project 12', 'project12_7.jpg'],
//                        ['project 13', 'project13_2.jpg'], ['project 13', 'project13_4.jpg'], ['project 13', 'project13_7.jpg'],
//                        ['project 14', 'project14_3.jpeg'], ['project 14', 'project14_4.jpeg'], ['project 14', 'project14_5.jpeg'],
//                        ['project 15', 'project15_1.jpeg'], ['project 15', 'project15_4.jpeg'],
//                        ['project 16', 'project16_1.jpeg'], ['project 16', 'project16_2.jpeg']
//                    ];
//                    $tiles_tag = [
//                        'project1_6.jpg', 'project3_4.jpg', 'project5_1.jpg', 'project6_2.jpg', 'project9_1.jpg',
//                        'project9_2.jpg', 'project10_4.jpg', 'project10_6.jpg', 'project10_9.jpg', 'project11_7.jpg',
//                        'project12_7.jpg', 'project13_2.jpg', 'project13_7.jpg', 'project14_4.jpg', 'project14_5.jpg',
//                        'project15_1.jpeg', 'project15_4.jpeg', 'project16_1.jpeg', 'project16_2.jpeg'
//                    ];
//                    $drywall_tag = [
//                        'project1_2.jpg', 'project1_7.jpg', 'project9_6.jpg', 'project10_2.jpg', 'project11_2.jpg', 'project13_4.jpg'
//                    ];
//                    $renovation_tag = [
//                        'project2_2.jpg', 'project3_2.jpg', 'project3_3.jpg', 'project5_6.jpg', 'project5_7.jpg',
//                        'project6_3.jpg', 'project10_1.jpg', 'project10_3.jpg', 'project10_7.jpg', 'project12_5.jpg',
//                        'project14_3.jpg'
//                    ];
//                    $int_ext_tag = [
//                        'project2_1.jpg', 'project4_2.jpg', 'project4_4.jpg', 'project5_2.jpg', 'project7_1.jpg', 'project7_2.jpg',
//                        'project8_1.jpg', 'project8_2.jpg'
//                    ];
//                    foreach ($gallery_grid as $idx => $item):
//                        list($folder, $file) = $item;
//                        $url = $base . 'images/gallery/' . rawurlencode($folder) . '/' . $file;
//                        $alt = pathinfo($file, PATHINFO_FILENAME);
//                        $classes = 'maso-item col-md-4' . (in_array($file, $tiles_tag, true) ? ' tiles' : '') . (in_array($file, $drywall_tag, true) ? ' drywall' : '') . (in_array($file, $renovation_tag, true) ? ' renovation' : '') . (in_array($file, $int_ext_tag, true) ? ' int-ext' : '');
//                    ?>
<!--                    <div data-sort="--><?php //echo $idx + 1; ?><!--" class="--><?php //echo htmlspecialchars($classes); ?><!--">-->
<!--                        <a class="img-box" href="--><?php //echo htmlspecialchars($url); ?><!--" data-lightbox-anima="fade-top">-->
<!--                            <img src="--><?php //echo htmlspecialchars($url); ?><!--" alt="--><?php //echo htmlspecialchars($alt); ?><!--" />-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    --><?php //endforeach; ?>
<!--                    <div data-sort="0" class="maso-item col-md-4 cat5">-->
<!--                        <a class="img-box mfp-iframe" href="--><?php //echo htmlspecialchars($base); ?><!--images/gallery/videos/video1.mp4" data-lightbox-anima="fade-top">-->
<!--                            <img src="--><?php //echo htmlspecialchars($base); ?><!--images/gallery/videos/video1.png" alt="Video" />-->
<!--                            <span class="play-icon"><i class="fa fa-play"></i></span>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="clear"></div>-->
<!--                </div>-->
<!--                <div class="list-nav">-->
<!--                    <a href="#" class="btn-sm btn load-more-maso" data-page-items="18">--><?php //echo htmlspecialchars(tr('Load More')); ?><!-- <i class="fa fa-arrow-down"></i></a>-->
<!--                </div>-->
<!--            </div>-->


            <div class="section-empty section-projects">
                <div class="container content">
                    <div class="maso-list gallery">
                        <div class="title-base  text-left">
                            <hr />
                            <h2><?= tr('Projects') ?></h2>
                        </div>
                        <hr class="space s" />
                            <div class="navbar navbar-inner">
                                <div class="navbar-toggle"><i class="fa fa-bars"></i><span><?= tr('Menu') ?></span><i class="fa fa-angle-down"></i></div>
                                <div class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav over ms-minimal inner maso-filters nav-center">
                                        <li class="current-active active"><a data-filter="maso-item"><?= tr('All projects'); ?></a></li>
                                        <?php foreach ($gallery_cats as $cat_slug => $cat_label): ?>
                                        <li><a data-filter="<?= htmlspecialchars($cat_slug) ?>"><?= htmlspecialchars(tr($cat_label)) ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <div class="maso-box row" id="projects-maso-box">
                            <?php
                            $gallery_cat_list = array_keys($gallery_cats);
                            $sort = 0;
                            $initial_count = 100;

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
                                                <?php if ($file === $first) {
                                                    continue;
                                                } ?>
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

                            // Videos: data from $gallery_videos_by_folder, files in gallery/videos/ (flat)
                            $videos_base_url = $base . 'images/gallery/videos/';
                            foreach ($gallery_videos_by_folder as $folder => $data):
                                $poster = $data['front_image'] ?? $data['files'][0];
                                $video_file = null;
                                foreach ($data['files'] as $f) {
                                    if (preg_match('/\.(mp4|webm|ogg)$/i', $f)) {
                                        $video_file = $f;
                                        break;
                                    }
                                }
                                $video_file = $video_file ?? $data['files'][0];
                                $video_url = $videos_base_url . rawurlencode($video_file);
                                $poster_url = $videos_base_url . rawurlencode($poster);
                                $video_title = $data['title'] ?? tr('Video');
                                $project_date = $data['date'] ?? '';
                                ?>
                                <div data-sort="<?= $sort ?>" class="maso-item col-md-3 project-card cat5">
                                    <div class="img-box adv-img adv-img-down-text boxed-inverse">
                                        <div class="project-gallery">
                                            <a class="img-box img-scale-up mfp-iframe video-lightbox i-center" href="<?= htmlspecialchars($video_url) ?>" data-lightbox-anima="fade-top" title="<?= htmlspecialchars($video_title) ?>">
                                                <div class="caption">
                                                    <i class="fa fa-play"></i>
                                                </div>
                                                <img src="<?= htmlspecialchars($poster_url) ?>" alt="<?= htmlspecialchars($video_title) ?>" />
                                            </a>
                                        </div>
                                        <div class="caption-bottom">
                                            <?php if ($project_date !== ''): ?><p><?= htmlspecialchars(tr($project_date)) ?></p><?php endif; ?>
                                            <p><?= htmlspecialchars($video_title) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $sort++;
                            endforeach;
                            ?>
                            <div class="clear"></div>
                        </div>
                        

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
