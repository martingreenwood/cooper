<?php

/**
 * AUTO DEV MENU HELPER
 */

add_filter( 'wp_nav_menu_objects', 'build_shop_menu', 10, 2 );
function build_shop_menu( $items, $args ) {

	if ($args->theme_location == 'primary') {

		$painting = array (
			'title'            => 'Painting',
			'menu_item_parent' => 11,
			'ID'               => 9999991, //an unlikely, high number
			'db_id'            => 9999991, //an unlikely, high number
			'url'              => home_url( '/paintings/' )
		);
		$items[] = (object) $painting;

		$drawings = array (
			'title'            => 'Drawings',
			'menu_item_parent' => 11,
			'ID'               => 9999992, //an unlikely, high number
			'db_id'            => 9999992, //an unlikely, high number
			'url'              => home_url( '/gallery/' )
		);
		$items[] = (object) $drawings;

		$brands = array (
			'title'            => 'Brands',
			'menu_item_parent' => 11,
			'ID'               => 9999993, //an unlikely, high number
			'db_id'            => 9999993, //an unlikely, high number
			'url'              => home_url( '/gallery/' )
		);
		$items[] = (object) $brands;

		$childrensart = array (
			'title'            => 'Children’s Art Supplies',
			'menu_item_parent' => 11,
			'ID'               => 9999994, //an unlikely, high number
			'db_id'            => 9999994, //an unlikely, high number
			'url'              => home_url( '/gallery/' )
		);
		$items[] = (object) $childrensart;

	}

    return $items;    

}