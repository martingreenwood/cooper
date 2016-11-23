<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cooper
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class($pagename); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">

		<div class="container">
			<div class="site-branding">
			<?php
			if ( function_exists( 'the_custom_logo' ) ):
				the_custom_logo();
			else: ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			<?php endif; ?>
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav>

		
		<?php  /* ?>
		<nav id="sub-navigation" class="sub-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'sub', 'menu_id' => 'sub-menu' ) ); ?>
		</nav>
		<nav id="painting-navigation" class="cat-navigation" role="navigation">
			<div class="menu-cat-container">
				<?php echo woocommerce_subcats_from_parentcat_by_ID('12'); //painting ?>
			</div>
		</nav>
		<nav id="drawing-navigation" class="cat-navigation" role="navigation">
			<div class="menu-cat-container">
				<?php echo woocommerce_subcats_from_parentcat_by_ID('14'); //brands ?>
			</div>
		</nav>
		<nav id="brands-navigation" class="cat-navigation" role="navigation">
			<div class="menu-cat-container">
				<?php echo woocommerce_subcats_from_parentcat_by_ID('13'); //drawing ?>
			</div>
		</nav>
		<nav id="childrens-art-navigation" class="cat-navigation" role="navigation">
			<div class="menu-cat-container">
				<?php echo woocommerce_subcats_from_parentcat_by_ID('15'); //childrens art ?>
			</div>
		</nav>
		<?php */ ?>

		<div class="clear"></div>
	</header>

	<div id="content" class="site-content">
