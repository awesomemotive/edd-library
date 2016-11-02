<?php
/*
 * Plugin Name: Prevent Discounts on Upgrades
 * Description: Does not allow a discount code to be applied when an license upgrade is present in the cart
 * Author: Chris Klosowski
 * Version: 1.0
 */

function pw_edd_disable_discount_on_upgrade( $return ) {

	$cart_items = edd_get_cart_contents();
	if( $cart_items ) {
		foreach( $cart_items as $item ) {
			if( isset( $item['options']['is_upgrade'] ) ) {
				return false;
			}
		}
	}

	return $return;

}
add_filter( 'edd_is_discount_valid', 'pw_edd_disable_discount_on_upgrade', 99, 1 );
