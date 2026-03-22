<?php
$nav_active = 'contact';
require_once __DIR__ . '/../includes/config.php';
$page_title = tr('Contact | Ki Mi Innenausbau Leverkusen');
$page_description = tr('Contact us – drywall, interior construction tiles and renovation.');
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
                    <h1><?= tr('Contact Us') ?></h1>
                    <p class="lead"><?= tr("We're ready to discuss your renovation or construction needs.") ?></p>
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
    <div class="google-map map-no-scroll-zoom" style="overflow:hidden; position:relative;">
        <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=6.94,51.02,7.04,51.07&amp;layer=mapnik&amp;marker=51.0459,6.9892" width="100%" height="350" style="border:0;display:block;" allowfullscreen referrerpolicy="no-referrer-when-downgrade" title="Map - <?= $contact_address ?>"></iframe>
        <div class="map-scroll-blocker" id="contact-map-blocker" style="position:absolute;top:0;left:0;right:0;bottom:0;cursor:pointer;z-index:1;" title="<?php echo htmlspecialchars(tr('Click to zoom map with +/-')); ?>"></div>
    </div>
    <script>
    (function(){
        var blocker = document.getElementById('contact-map-blocker');
        if (!blocker) return;
        blocker.addEventListener('wheel', function(e) {
            e.preventDefault();
            window.scrollBy(0, e.deltaY);
        }, { passive: false });
        blocker.addEventListener('click', function() {
            blocker.style.pointerEvents = 'none';
            blocker.style.display = 'none';
        }, { once: true });
    })();
    </script>
    <div class="container content">
        <div class="row">
            <div class="col-md-6">
                <h2><?php echo htmlspecialchars(tr('Send a message')); ?></h2>
                <hr class="space s" />
                <p>
                    <?php echo htmlspecialchars(tr('Get in touch for drywall, interior construction tiles or renovation. Tell us about your project and we will get back to you as soon as possible.')); ?>
                </p>
                <hr class="space s" />
                <form id="contact-form" action="<?php echo htmlspecialchars($base); ?>contact-form" class="form-box form-ajax" method="post" data-email="<?php echo htmlspecialchars($contact_email); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <p><?php echo htmlspecialchars(tr('Name')); ?></p>
                            <input id="name" name="name" placeholder="<?php echo htmlspecialchars(tr('name')); ?>" type="text" class="form-control form-value" required>
                        </div>
                        <div class="col-md-6">
                            <p><?php echo htmlspecialchars(tr('Email')); ?></p>
                            <input id="email" name="email" placeholder="<?php echo htmlspecialchars(tr('email')); ?>" type="email" class="form-control form-value" autocomplete="email" required>
                        </div>
                    </div>
                    <hr class="space s" />
                    <div class="row">
                        <div class="col-md-12">
                            <p><?php echo htmlspecialchars(tr('Phone')); ?></p>
                            <input id="phone" name="phone" placeholder="<?php echo htmlspecialchars(tr('phone')); ?>" type="tel" class="form-control form-value" required>
                        </div>
                    </div>
                    <hr class="space s" />
                    <div class="row">
                        <div class="col-md-12">
                            <p><?php echo htmlspecialchars(tr('Messagge')); ?></p>
                            <textarea id="messagge" name="messagge" class="form-control form-value contact-message" rows="4" placeholder="<?php echo htmlspecialchars(tr('Write your message')); ?>" required></textarea>
                            <hr class="space s" />
                            <button class="anima-button btn-border btn-sm btn" type="submit">
                                <i class="fa fa-mail-reply-all"></i><?php echo htmlspecialchars(tr('Send messagge')); ?>
                            </button>
                            <span class="cf-loader" aria-hidden="true"><i class="fa fa-spinner fa-spin"></i></span>
                        </div>
                    </div>
                    <div class="success-box">
                        <div class="alert alert-success"><?php echo htmlspecialchars(tr('Congratulations. Your message has been sent successfully')); ?></div>
                    </div>
                    <div class="error-box">
                        <div class="alert alert-warning"><?php echo htmlspecialchars(tr('Error, please retry. Your message has not been sent')); ?></div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <hr class="space visible-xs" />
                <h2><?php echo htmlspecialchars(tr('How to reach us')); ?></h2>
                <p class="text-color no-margins"><?php echo htmlspecialchars(tr('Phone, address and email')); ?></p>
                <hr class="space s" />
                <p>
                    <?php echo htmlspecialchars(tr('We are your partner for drywall, interior construction tiles and renovation. Visit us in Leverkusen or get in touch by phone or email.')); ?>
                </p>
                <hr class="space s" />
                <div class="row">
                    <div class="col-md-6">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-phone"></i> <a href="tel:<?= $contact_phone; ?>"><?= $contact_phone; ?></a></li>
                            <li><i class="fa-li fa fa-envelope-o"></i> <a href="mailto:<?php echo htmlspecialchars($contact_email); ?>"><?php echo htmlspecialchars($contact_email); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-map-marker"></i><?= $contact_address ?></li>
                        </ul>
                    </div>
                </div>
                <hr class="space m" />
                <div class="btn-group social-group btn-group-icons">
                    <a target="_blank" href="#" data-social="share-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                        <i class="fa fa-facebook text-s circle"></i>
                    </a>
                    <a target="_blank" href="#" data-social="share-twitter" data-toggle="tooltip" data-placement="top" title="Twitter">
                        <i class="fa fa-instagram text-s circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
