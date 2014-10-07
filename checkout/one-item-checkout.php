<?php
/**
 * Plugin Name: Easy Digital Downloads - Limit Cart to One Items 
 * Description: Prevents customers from ever purchasing more than a single item at once
 */
function pw_edd_one_item_checkout( $download_id, $options ) {
	if( edd_get_cart_quantity() >= 1 ) {
		edd_empty_cart();
	}
}
add_action( 'edd_pre_add_to_cart', 'pw_edd_one_item_checkout', 10, 2 );