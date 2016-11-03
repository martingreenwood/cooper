<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _cooper
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _cooper_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', '_cooper_body_classes' );


/**
 * WooCommerce Support
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', '_cooper_wrapper_start', 10);
add_action('woocommerce_after_main_content', '_cooper_wrapper_end', 10);
add_action( 'after_setup_theme', '_cooper_woocommerce_support' );

function _cooper_wrapper_start() {
  echo '<main id="main" class="site-main" role="main">';
}

function _cooper_wrapper_end() {
  echo '</main>';
}

function _cooper_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Add Search to Nav
 */
function add_search_to_wp_menu ( $items, $args ) {
	if( 'primary' === $args->theme_location ) {
		$items .= '<li class="menu-item menu-item-search">';
			$items .= '<form method="get" class="menu-search-form" action="' . get_bloginfo('url') . '/"><p><i class="fa fa-search" aria-hidden="true"></i><input class="text_input" type="text" placeholder="Search The Shop" name="s" id="s" /><input type="submit" class="_cooper-wp-search" id="searchsubmit" value="search" /></p></form>';
		$items .= '</li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items','add_search_to_wp_menu',10,2);



/**
 * List sub cats by name
 */
function woocommerce_subcats_from_parentcat_by_NAME($parent_cat_NAME) {
	$IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
	$product_cat_ID = $IDbyNAME->term_id;
	$args = array(
		'hierarchical' => 1,
		'show_option_none' => '',
		'hide_empty' => 0,
		'parent' => $product_cat_ID,
		'taxonomy' => 'product_cat'
	);
	$subcats = get_categories($args);
	echo '<ul class="wooc_sclist">';
		foreach ($subcats as $sc) {
		$link = get_term_link( $sc->slug, $sc->taxonomy );
		echo '<li><a href="'. $link .'">'.$sc->name.'</a></li>';
	}
	echo '</ul>';
}

function woocommerce_scsubcats_from_parentcat_by_NAME($parent_cat_NAME) {
	$IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
	$product_cat_ID = $IDbyNAME->term_id;
	$args = array(
		'hierarchical' => 1,
		'show_option_none' => '',
		'hide_empty' => 0,
		'parent' => $product_cat_ID,
		'taxonomy' => 'product_cat'
	);
	$subcats = get_categories($args);
	echo '<ul class="wooc_scsclist">';
	foreach ($subcats as $sc) {
		$scargs = array(
			'hierarchical' => 1,
			'show_option_none' => '',
			'hide_empty' => 0,
			'parent' => $sc->term_id,
			'taxonomy' => 'product_cat'
		);
		$subsubcats = get_categories($scargs);
		foreach ($subsubcats as $scsc) {
			$sclink = get_term_link( $scsc->slug, $scsc->taxonomy );
			echo '<li><a href="'. $sclink .'">'.$scsc->name.'</a></li>';
		}
	}
	echo '</ul>';
}

function woocommerce_subcats_from_parentcat_by_ID($parent_cat_ID) {
	$subsubcats = array();
	$args = array(
		'hierarchical' => 1,
		'show_option_none' => '',
		'hide_empty' => 0,
		'parent' => $parent_cat_ID,
		'taxonomy' => 'product_cat'
	);
	$subcats = get_categories($args);
    echo '<ul class="wooc_sclist">';
	foreach ($subcats as $sc) {
		$link = get_term_link( $sc->slug, $sc->taxonomy );
		echo '<li><a href="'. $link .'">'.$sc->name.'</a>';
		$scargs = array(
			'hierarchical' => 1,
			'show_option_none' => '',
			'hide_empty' => 0,
			'parent' => $sc->term_id,
			'taxonomy' => 'product_cat'
		);
		$subsubcats = get_categories($scargs);
		echo '<ul class="children">';
		foreach ($subsubcats as $scsc) {
			$sclink = get_term_link( $scsc->slug, $scsc->taxonomy );
			echo '<li><a href="'. $sclink .'">'.$scsc->name.'</a></li>';
		}
		echo '</ul>';
	}
	echo '</li>';
	echo '</ul>';
}