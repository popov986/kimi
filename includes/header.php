<?php
if (!isset($page_title)) {
    require_once __DIR__ . '/config.php';
}
$base = defined('BASE_PATH') ? BASE_PATH : '../';
$lang_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
if ($lang_path === null || $lang_path === '') {
    $lang_path = '/';
}


?>


<body>
    <div id="preloader"></div>
    <header class="fixed-top scroll-change" data-menu-anima="fade-in">
        <div class="navbar navbar-default mega-menu-fullwidth navbar-fixed-top" role="navigation">
            <?php if (!empty($header_mini_bar)) : ?>
            <div class="navbar-mini scroll-hide">
                <div class="container">
                    <div class="nav navbar-nav navbar-left">
                        <span><i class="fa fa-phone"></i><span style="color:#F3B007"><?= $contact_phone ?? '' ?></span></span>
                        <hr />
                        <span><span style="color:#F3B007"><i class="fa fa-envelope"></i><?= $contact_email ?? '' ?></span>
                        <hr />
                        <span><i class="fa fa-map-marker"></i><span style="color:#F3B007"><?= $contact_address ?? '' ?></span>
                        <hr />
                        <span><i class="fa fa-calendar"></i><span style="color:#F3B007">Mon - Sat: 8.00 - 19:00</span></span>
                    </div>
                    <div class="nav navbar-nav navbar-right">
                        <div class="minisocial-group">
                            <a target="_blank" href="https://www.facebook.com/profile.php?id=100054798437309"><i class="fa fa-facebook first"></i></a>
                            <a target="_blank" href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="navbar navbar-main">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="/">
                            <img class="logo-default" src="<?php echo $base; ?>images/<?php echo rawurlencode('gallery'); ?>/logo.png" alt="logo" />
                            <img class="logo-retina" src="<?php echo $base; ?>images/<?php echo rawurlencode('gallery'); ?>/logo.png" alt="logo" />
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <div class="nav navbar-nav navbar-right">
                            <ul class="nav navbar-nav">
                                <li class="dropdown <?php echo (!empty($nav_active) && $nav_active === 'home') ? 'active' : ''; ?>">
                                    <a href="/"><?php echo htmlspecialchars(tr('Home')); ?></a>
                                </li>
                                <li class="dropdown <?php echo (!empty($nav_active) && $nav_active === 'about') ? 'active' : ''; ?>">
                                    <a href="/about"><?php echo htmlspecialchars(tr('About Us')); ?></a>
                                </li>
                                <li class="dropdown <?php echo (!empty($nav_active) && $nav_active === 'portfolio') ? 'active' : ''; ?>">
                                    <a href="/portfolio"><?php echo htmlspecialchars(tr('Portfolio')); ?></a>
                                </li>
                                <li class="dropdown <?php echo (!empty($nav_active) && $nav_active === 'galery') ? 'active' : ''; ?>">
                                    <a href="/galery"><?php echo htmlspecialchars(tr('Gallery')); ?></a>
                                </li>
                                <li class="dropdown <?php echo (!empty($nav_active) && $nav_active === 'contact') ? 'active' : ''; ?>">
                                    <a href="/contact"><?php echo htmlspecialchars(tr('Contact Us')); ?></a>
                                </li>
                            </ul>
                            <div class="nav navbar-nav navbar-right">
                                <div class="search-box-menu">
                                    <a href="#" class="btn btn-default btn-search" aria-label="<?php echo htmlspecialchars(tr('Search for...')); ?>">
                                        <span class="fa fa-search"></span>
                                    </a>
                                    <form method="get" action="/search" class="search-form" role="search">
                                        <div class="search-box scrolldown">
                                            <input type="text" name="q" class="form-control" placeholder="<?php echo htmlspecialchars(tr('Search for...')); ?>" value="<?php echo isset($search_query) ? htmlspecialchars($search_query) : ''; ?>">
                                            <button type="submit" class="btn btn-default btn-sm" style="margin-top:8px;"><?php echo htmlspecialchars(tr('Search')); ?></button>
                                        </div>
                                    </form>
                                </div>
                                <ul class="nav navbar-nav lan-menu">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                            <img src="<?php echo $base; ?>images/gallery/<?php echo $current_lang; ?>.png" alt="" /><?php echo strtoupper($current_lang); ?><span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo htmlspecialchars($lang_path); ?>?lang=en"><img src="<?php echo $base; ?>images/gallery/en.png" alt="" /> EN</a></li>
                                            <li><a href="<?php echo htmlspecialchars($lang_path); ?>?lang=de"><img src="<?php echo $base; ?>images/gallery/de.png" alt="" /> DE</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
