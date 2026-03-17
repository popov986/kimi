<?php
$nav_active = 'about';
require_once __DIR__ . '/../includes/config.php';
$page_title = tr('About Us');
$page_description = tr('Multipurpose HTML template.');
$base = BASE_PATH;

require_once __DIR__ . '/../includes/head.php';
?>



<body>


    <?php require_once __DIR__ . '/../includes/header.php'; ?>

    <div class="header-base">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-base text-left">
                        <h1><?= tr('About us') ?></h1>
                        <p class="lead"><?= tr('We are a professional renovation and construction company.') ?></p>
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
            <div class="row vertical-row">
                <div class="col-md-3 col-sm-12">
                    <div class="row">
                        <h1><span class="text-color"><?php echo htmlspecialchars(tr('Ki-Mi')); ?></span> <br /><?php echo htmlspecialchars(tr('Drywall, Tiles, Interior finishing & Renovation')); ?></h1>
                        <p>
                            <?php echo htmlspecialchars(tr('We are your competent partner for drywall construction, interior finishing, renovation, and refurbishment.')); ?>
                        </p>
                        <p>
                            <?php echo htmlspecialchars(tr('From the construction of new partition walls and ceilings to the modernization and refurbishment of existing rooms – we complete your project reliably, cleanly, and on schedule.')); ?>
                        </p>
                        <p>
                            <?php echo htmlspecialchars(tr('Quality, precision, and customer satisfaction are our top priorities.')); ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <a class="img-box" href="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/main.jpg">
                                <img src="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/main.jpg" alt="<?php echo htmlspecialchars(tr('Construction')); ?>">
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a class="img-box" href="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/<?php echo rawurlencode('project 5'); ?>/project5_5.jpg">
                                <img src="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/<?php echo rawurlencode('project 5'); ?>/project5_5.jpg" alt="<?php echo htmlspecialchars(tr('Tiles')); ?>">
                            </a>
                            <ul class="list-texts text-s">
                                <li><b><?php echo htmlspecialchars(tr('Phone')); ?></b> <a href="tel:<?= $contact_phone ?? '' ?>"><?= $contact_phone ?? '' ?></a></li>
                                <li><b><?php echo htmlspecialchars(tr('Address')); ?></b> <?= $contact_address ?? '' ?></li>
                            </ul>
                            <p>
                                <?php echo htmlspecialchars(tr('Drywall, interior construction and renovation—your reliable partner for quality work in Leverkusen and the region.')); ?>
                            </p>
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <?php
                            $text = tr('Our team also specializes in drywall/interior finishing and the renovation of older buildings, ensuring functional and comprehensive renovation services.');

                            echo htmlspecialchars($text);
                            ?>

                            <?php
                                $text2 = tr('Whether it\'s a new partition wall, a tiled bathroom, or a complete renovation – we bring experience, precision, and attention to detail to every project.')
                                . ' '
                                . tr('Our team also specializes in bathroom renovations, interior finishing, and the renovation of older buildings, creating functional, stylish, and durable spaces. From planning and material selection to execution and finishing, we oversee every step with care and professionalism.')
                                . ' '
                                .tr('We combine modern techniques with expert craftsmanship for lasting results – whether it\'s a small upgrade or a complete renovation. We tailor each project to your individual needs and transform residential and commercial properties into comfortable, elegant, and practical spaces. At Ki-Mi, quality, reliability, and satisfaction are guaranteed for every renovation or construction project.');
                                echo htmlspecialchars($text2);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="space m" />
            <div class="row proporzional-row">
                <div class="col-md-6 col-sm-12">
                    <a class="img-box inner img-bubble" href="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/<?php echo rawurlencode('project 8'); ?>/project8_3.jpg">
                        <span><img src="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/<?php echo rawurlencode('project 8'); ?>/project8_3.jpg" alt="<?php echo htmlspecialchars(tr('Interior Design')); ?>"></span>
                        <span class="caption-box" data-anima="show-scale">
                            <span class="caption">
                                <?php echo htmlspecialchars(tr('Balcony tiles and exterior surfaces—durable, stylish, and precise workmanship for every project.')); ?>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12 boxed-inverse">
                    <div class="list-items">
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Drywall')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('Installation, framing and finishing for walls and ceilings. Partitions and paint-ready surfaces.')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Plaster Work')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('Our team performs expert plastering work to create smooth and durable surfaces.')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Finishing Work (Q1–Q4)')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('We offer high-quality surface finishing (Q1–Q4) to ensure perfect preparation for painting or wallpapering.')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Painting (White)')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('We specialize in precise white painting for a clean, modern look.')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Demolition')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('We handle demolition work safely and efficiently for any renovation project.')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Tile Repairs / Tile Renovations')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('We repair and renovate tiles and provide a wide range of additional interior renovation services.')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="row">
                                <div class="col-md-9">
                                    <h3><?php echo htmlspecialchars(tr('Contact')); ?></h3>
                                    <p><?php echo htmlspecialchars(tr('Phone: +49 176 40486454 · Musterstrasse 123, 51371 Leverkusen')); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-bg-image parallax-window white" data-natural-height="650" data-natural-width="1920" data-parallax="scroll" data-image-src="<?php echo $base; ?>images/<?php echo 'gallery'; ?>/<?php echo rawurlencode('project 9'); ?>/project9_2.jpg">
        <div class="container content">
            <div class="row proporzional-row">
                <div class="col-md-4 col-sm-12 boxed">
                    <h2><?php echo htmlspecialchars(tr('Our philosophy')); ?></h2>
                    <p><?php echo htmlspecialchars(tr('Quality in drywall, interior construction tiles and renovation. We work with precision and care for every project.')); ?></p>
                    <hr class="space xs" />
                </div>
                <div class="col-md-8 boxed boxed-border white">
                    <p>
                        <?php echo htmlspecialchars(tr('We are your partner for drywall, interior construction tiles and renovation in Leverkusen and the region. Our services include drywall installation and finishing, professional tiling for floors and walls, bathroom and kitchen renovations, and full interior and exterior finishing. We combine experience with modern techniques to deliver lasting results. Contact us at +49 176 40486454 or visit us at Musterstrasse 123, 51371 Leverkusen.')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
