<!DOCTYPE html>
<html>
<head>
    <meta content="utf-8" http-equiv="encoding">
    <title><?php echo igo_meta_title (" | "); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="favicon.png" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/bootstrap/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/linea/styles.css" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/animate/animate.min.css" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/fonts.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/skins/<?php
	$options = get_option('landingtheme_options');
	echo $options['selectinput']; ?>.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/media.css" />
	<?php wp_head(); ?>
</head>
<body>

<div class="loader">
    <div class="loader_inner"></div>
</div>

<header class="main_head main_color_bg" data-parallax="scroll" data-image-src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/bg.jpg" data-z-index="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo_container">
	                <?php dynamic_sidebar('logo'); ?>
                </div>
                <button class="toggle_mnu">
					<span class="sandwich">
						<span class="sw-topper"></span>
						<span class="sw-bottom"></span>
						<span class="sw-footer"></span>
					</span>
                </button>
                <nav class="top_mnu">
                    <ul>
                        <li><a href="#about">About Me</a></li>
                        <li><a href="#resume">Questionnaire</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#contacts">Contacts</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="top_wrapper">
        <div class="top_descr">
            <div class="top_centered">
                <div class="top_text">
                    <h1><?php echo get_bloginfo('name'); ?></h1>
                    <p><?php echo get_bloginfo('description'); ?></p>
                </div>
            </div>
        </div>
    </div>
</header>