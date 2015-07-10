<?php
/**
 * Plugin Name: Digital Store - Add the_content to storefront template.
 * Description: Allows you to display page content on the storefront template above the latest downloads grid.
 */
function jp_inject_the_content() {
	remove_action( 'digitalstore_store_front', 'digitalstore_front_latest_downloads', 2 );
	add_action( 'digitalstore_store_front', 'digitalstore_front_latest_downloads', 3 );
	add_action( 'digitalstore_store_front', 'jp_add_content', 2 );
}
add_action( 'init', 'jp_inject_the_content' );

function jp_add_content() {
	echo apply_filters( 'the_content', get_post_field( 'post_content', get_the_ID() ) );
}
add_action( 'init', 'jp_add_content' );