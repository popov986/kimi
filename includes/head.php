<?php
?>

<!DOCTYPE html>
<!--[if lt IE 10]> <html lang="en" class="iex"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <script src="<?php echo $base; ?>HTWF/scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/bootstrap/css/bootstrap.css">
    <script src="<?php echo $base; ?>HTWF/scripts/script.js"></script>
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/style.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/content-box.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/image-box.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/animations.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/css/components.css">

    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/flexslider/flexslider.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo $base; ?>HTWF/scripts/php/contact-form.css">

    <link rel="icon" href="<?php echo $base; ?>images/<?php echo rawurlencode('gallery'); ?>/logo.png">
    <link rel="stylesheet" href="<?php echo $base; ?>skin.css">
    <?php if (!empty($header_extra_css)) { echo $header_extra_css; } ?>
</head>




