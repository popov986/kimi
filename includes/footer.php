<?php
$base = defined('BASE_PATH') ? BASE_PATH : '../';
?>
    <i class="scroll-top scroll-top-mobile show fa fa-sort-asc"></i>
<footer class="footer-base">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-center text-left">
                    <img width="180" src="<?php echo $base; ?>images/<?php echo rawurlencode('gallery'); ?>/logo.png" alt="" />
                    <p class="text-s"><strong><?php echo htmlspecialchars(tr('Address')); ?>: <?= $contact_address ?? '' ?></strong></p>
                    <div class="tag-row text-s">
                        <span><strong><?php echo htmlspecialchars(tr('Email')); ?>: <?= $contact_email ?? '' ?></strong></span>
                        <span><strong><?php echo htmlspecialchars(tr('Phone')); ?>: <?= $contact_phone ?? '' ?></strong></span>
                    </div>
                    <hr class="space xs" />
                    <div class="btn-group social-group btn-group-icons">
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100054798437309" data-social="share-facebook">
                            <i class="fa fa-facebook text-xs circle"></i>
                        </a>
                        <a target="_blank" href="#" data-social="share-twitter">
                            <i class="fa fa-instagram text-xs circle"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 footer-left text-center">
                    <div class="row">
                        <div class="text-s">
                            <h3><?php echo htmlspecialchars(tr('Menu')); ?></h3>
                            <a href="/"><?php echo htmlspecialchars(tr('Home')); ?></a><br />
                            <a href="/about"><?php echo htmlspecialchars(tr('About us')); ?></a><br />
                            <a href="/portfolio"><?php echo htmlspecialchars(tr('Portfolio')); ?></a><br />
                            <a href="/galery"><?php echo htmlspecialchars(tr('Gallery')); ?></a><br />
                            <a href="/contact"><?php echo htmlspecialchars(tr('Contact us')); ?></a><br />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 footer-left text-left">
                    <h3><?php echo htmlspecialchars(tr('You can trust us')); ?></h3>
                    <p class="text-s">
                        <?php echo htmlspecialchars(tr('You can trust us to deliver every project with professionalism and care. With expertise in renovation, interior finishing, and building modernization, we ensure high-quality, durable, and stylish results. Our team focuses on precision, safety, and clear communication from start to finish.')); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row copy-row">
            <div class="col-md-12 copy-text">
                © <?= date('Y') . ' ' . tr('Ki-Mi Innenausbau') ?> 
            </div>
        </div>
    </div>

        <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/font-awesome/css/font-awesome.css">
        <script async src="<?php echo $base; ?>HTWF/scripts/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/imagesloaded.min.js"></script>
        <script async src="<?php echo $base; ?>HTWF/scripts/isotope.min.js"></script>
        <script async src="<?php echo $base; ?>HTWF/scripts/jquery.tab-accordion.js"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/parallax.min.js"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/smooth.scroll.min.js"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/flexslider/jquery.flexslider-min.js"></script>
        <script async src="<?php echo $base; ?>HTWF/scripts/php/contact-form.js"></script>
        <script async src="<?php echo $base; ?>HTWF/scripts/jquery.progress-counter.js"></script>
        <script async src="<?php echo $base; ?>HTWF/scripts/bootstrap/js/bootstrap.popover.min.js"></script>
        <script async src="<?php echo $base; ?>HTWF/scripts/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/social.stream.min.js"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/jquery.slimscroll.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo htmlspecialchars(isset($google_maps_api_key) ? $google_maps_api_key : ''); ?>"></script>
        <script src="<?php echo $base; ?>HTWF/scripts/google.maps.min.js"></script>
        <?php if (!empty($footer_extra_js)) { echo $footer_extra_js; } ?>

</footer>
</body>
</html>
