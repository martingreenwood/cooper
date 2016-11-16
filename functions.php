<?php
/**
 * cooper functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cooper
 */

if ( ! function_exists( 'cooper_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cooper_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cooper, use a find and replace
	 * to change 'cooper' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cooper', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slide', 1600, 560, true );

	/*
	 * Enable support for custom logo.
	 *
	 * @link https://make.wordpress.org/core/2016/03/10/custom-logo/
	 */
    add_theme_support( 'custom-logo' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'cooper' ),
		'sub' => esc_html__( 'Sub', 'cooper' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'cooper_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cooper_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cooper_content_width', 1200 );
}
add_action( 'after_setup_theme', 'cooper_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cooper_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cooper' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cooper' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Filter', 'cooper' ),
		'id'            => 'filter-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'cooper' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Products', 'cooper' ),
		'id'            => 'products-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'cooper' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cooper_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cooper_scripts() {
	wp_enqueue_style( 'cooper-style', get_stylesheet_uri() );
	wp_enqueue_style( 'cooper-fonts', '//fonts.googleapis.com/css?family=Lato:400,700,300' );
	wp_enqueue_style( 'cooper-chimp', '//cdn-images.mailchimp.com/embedcode/slim-10_7.css' );
	
	wp_enqueue_style( 'cooper-select-css-css', get_template_directory_uri() . '/css/select2.min.css' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'cooper-select-js', get_template_directory_uri() . '/js/select2.full.min.js', array(), '', true );
	wp_enqueue_script( 'cooper-fa', '//use.fontawesome.com/9ce4df9335.js', array(), '4.6.3', true );
	wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyCtu9lXft-cKjtQdd13eJz0zQykg2UkGLg', array(), '3', true );

	wp_enqueue_script( 'cooper-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '', true );
	wp_enqueue_script( 'cooper-js', get_template_directory_uri() . '/js/cooper.js', array(), '1.0.0.', true );
	wp_enqueue_script( 'cooper-map', get_template_directory_uri() . '/js/map.js', array(), '1.0.0.', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cooper_scripts' );


/** WOOCOMMERCE **/

if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {

	/**
	 * Output the WooCommerce Breadcrumb.
	 *
	 * @param array $args
	 */
	function woocommerce_breadcrumb( $args = array() ) {
		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '&nbsp;&#47;&nbsp;',
			'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
		) ) );

		$breadcrumbs = new WC_Breadcrumb();

		if ( ! empty( $args['home'] ) ) {
			$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

		wc_get_template( 'global/breadcrumb.php', $args );
	}
}

// get pc
function get_percentage($total, $number)
{
  if ( $total > 0 ) {
   return round($number / ($total / 100),2);
  } else {
    return 0;
  }
}

//custom length
function excerpt($limit) {

	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}

function content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	} else {
		$content = implode(" ",$content);
	}

	$content = preg_replace('/[.+]/','', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

//Short Description on Archive page

function cooper_excerpt_in_product_archives() {
	echo excerpt(5);
}

// custom prices
add_filter( 'woocommerce_get_price_html', 'custom_price_html', 100, 2 );
function custom_price_html( $price, $product ){
	$savepec = get_percentage(get_post_meta( get_the_ID(), '_regular_price', true), get_post_meta( get_the_ID(), '_sale_price', true));
	return str_replace( '</ins>', '</ins><span class="saving">Save '.floor($savepec) .'%</span>', $price );
}

/**
 * Custom menu
 */
//require get_template_directory() . '/inc/menu.php';

/**
 * Custom options page for this theme.
 */
require get_template_directory() . '/inc/options.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
