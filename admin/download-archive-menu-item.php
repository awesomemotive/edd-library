<?php
/*
 * Plugin Name: Download Archive Menu Item
 * Description: Displays the download archive link in the "View All" tab of the "Pages" menu items meta box.
 * Author: Cor van Noorloos
 * Version: 1.0
 */

function cor_edd_nav_menu_items_page( $posts ) {
	array_unshift(
		$posts, (object) array(
			'ID'           => 0,
			'object_id'    => - 1,
			'post_content' => '',
			'post_excerpt' => '',
			'post_parent'  => '',
			'post_title'   => get_post_type_object( 'download' )->labels->menu_name,
			'post_type'    => 'nav_menu_item',
			'type'         => 'custom',
			'url'          => get_post_type_archive_link( 'download' ),
		)
	);

	return $posts;
}
add_filter( 'nav_menu_items_page', 'cor_edd_nav_menu_items_page' );
