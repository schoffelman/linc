<?php
/**
 * The Header template for the ludens theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Linc
 * @since Linc 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- load scripts -->
<script src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js" type="text/javascript"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js" type="text/javascript"></script>

<!-- start styles -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="masthead" class="navbar" role="navigation">
		<div class="banner">
			<div class="container">

				<hgroup class="col-md-4">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</hgroup>

				<nav id="site-navigation" class="col-md-8 main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'main-navigation', 'menu_class' => 'nav-menu' ) ); ?>
				</nav><!-- #site-navigation -->

			</div>

		</div>

	</header><!-- #masthead -->