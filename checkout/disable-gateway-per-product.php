<?php
/*
 * Plugin Name: Easy Digital Downloads - Disable Gateway Per Product
 * Description: An example plugin that shows how to deactivate a gateway on checkout depending on the items that are in the cart
 */

function pw_edd_disable_gateway_on_checkout( $gateways ) {
	
	if( edd_is_checkout() ) {

		// Disable Stripe if the download with an ID of 10 is in the cart
		if( edd_item_in_cart( 10 ) ) {
			unset( $gateways['stripe'] );
		}

	}

	return $gateways;
}
add_filter( 'edd_payment_gateways', 'pw_edd_disable_gateway_on_checkout' );