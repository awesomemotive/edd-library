<?php
/**
 * Add the featured image to output of Download Details widget
 */

function sd_edd_download_details_widget_thumbnail( $instance ) {
	
	// get the ID of the current post
	$post_id = get_the_ID();
	
	// grab featured image of the appropriate download
	if ( 'current' == $instance['download_id'] ) {
		echo get_the_post_thumbnail( $post_id );
	} else {
		echo get_the_post_thumbnail( $instance['download_id'] );
	}
}
add_action( 'edd_product_details_widget_before_purchase_button', 'sd_edd_download_details_widget_thumbnail' );