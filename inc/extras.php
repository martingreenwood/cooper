<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cooper
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cooper_body_classes( $classes ) {
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
add_filter( 'body_class', 'cooper_body_classes' );


/**
 * WooCommerce Support
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'cooper_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'cooper_wrapper_end', 10);
add_action( 'after_setup_theme', 'cooper_woocommerce_support' );

function cooper_wrapper_start() {
  echo '<main id="main" class="site-main" role="main">';
}

function cooper_wrapper_end() {
  echo '</main>';
}

function cooper_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Add Search to Nav
 */
function add_search_to_wp_menu ( $items, $args ) {
	if( 'primary' === $args->theme_location ) {
		$items .= '<li class="menu-item menu-item-search">';
			$items .= '<form role="search" method="get" class="menu-search-form woocommerce-product-search" action="' . get_bloginfo('url') . '/"><p><i class="fa fa-search" aria-hidden="true"></i><input type="search" id="woocommerce-product-search-field" class="text_input search-field" placeholder="Search The Shop" value="" name="s" title="Search for:"><input id="searchsubmit" type="submit" class="cooper-wp-search" value="Search"><input type="hidden" name="post_type" value="product"></form>';
			//$items .= '<form method="get" class="menu-search-form" action="' . get_bloginfo('url') . '/"><p><i class="fa fa-search" aria-hidden="true"></i><input class="text_input" type="text" placeholder="Search The Shop" name="s" id="s" /><input type="submit" class="cooper-wp-search" id="searchsubmit" value="search" /></p></form>';
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

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 */
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$items = $woocommerce->cart->get_cart();
		$viewing_cart = __('View your shopping cart', 'ct');
		$start_shopping = __('Start shopping', 'ct');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d', '%d', $cart_contents_count, 'ct'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();

		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="cart_meniu_item"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
				$menu_item .= '<div class="cart_icon empty"></div>';
			} else {
				$menu_item = '<li class="cart_meniu_item"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
				$menu_item .= '<div class="cart_icon"></div>';
			}

			$menu_item .= '<div class="cart_contents">'.$cart_contents.'</div>';
			$menu_item .= '</a>';
			
			$menu_item .= '<div class="cart-content">';
			foreach ($items as $item => $values) { 
				$_product = $values['data']->post;
				//product image
				$getProductDetail = wc_get_product( $values['product_id'] );
				$price = get_post_meta($values['product_id'] , '_price', true);

				$menu_item .= '<div class="cart-item">';
					$menu_item .= '<p>';
						$menu_item .= $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )
						$menu_item .= '<span>' .$_product->post_title.' </span> <span>x ' .$values['quantity'];
						//$menu_item .=  get_post_meta($values['product_id'] , '_price', true)."</span>";
						$menu_item .= '</span>';
					$menu_item .= '</p>';
					//$meta_item .= print_r(get_post_meta( $values['product_id'] ));
				$menu_item .= '</div>';
			}
			$menu_item .= '</div>';
			$menu_item .= '</li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}

function cooper_custom_variable_price( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '' . $saleprice . ' ' . $price . '';
    }
    
    return $price;
}
add_filter( 'woocommerce_variable_sale_price_html', 'cooper_custom_variable_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'cooper_custom_variable_price', 10, 2 );