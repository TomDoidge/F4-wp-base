<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Favicons
  ================================================== -->
  <link rel="shortcut icon" href="<?php print IMAGES; ?>/favicon.ico">
  <link rel="apple-touch-icon" href="<?php print IMAGES; ?>/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php print IMAGES; ?>/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php print IMAGES; ?>/apple-touch-icon-114x114.png">

  <!-- CSS
  ================================================== -->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />

<!-- Scripts
  ================================================== -->
  <script src="<?php print THEMEROOT; ?>/js/vendor/custom.modernizr.js"></script>

  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--[if lt IE 8]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="top-bar">
    <ul class="title-area">
      <!-- Title Area -->
      <li class="name">
        <h1><a href="<?php echo home_url(); ?>"><img src="<?php print IMAGES; ?>/logo.png" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" /></a></h1>
      </li>
      <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
        <?php foundation_top_bar_l(); ?>
        <?php foundation_top_bar_r(); ?>
    </section>
</nav>