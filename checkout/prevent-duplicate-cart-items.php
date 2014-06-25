<?php

/**
 * Prevents items from being added to the cart multiple times
 *
 */
function pw_edd_prevent_duplicate_cart_items( $download_id, $options ) {
	if( edd_item_in_cart( $download_id, $options ) ) {
		if( edd_is_ajax_enabled() ) {
			die('1');
		} else {
			wp_redirect( edd_get_checkout_uri() ); exit;
		}
	}
}
add_action( 'edd_pre_add_to_cart', 'pw_edd_prevent_duplicate_cart_items', 10, 2 );