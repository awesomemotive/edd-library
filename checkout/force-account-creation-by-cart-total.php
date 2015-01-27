<?php
/*
 * Plugin Name: Easy Digital Downloads - Force account creation by cart total
 * Description: Force account creation at checkout if the cart total is a certain amount
 * Author: Andrew Munro
 * Version: 1.0
 */
function sumobi_edd_force_account_creation_by_cart_total( $ret ) {

	// enter the cart total amount that should force account creation
	$limit = 100;

	// get the cart total
	$cart_total = edd_get_cart_total();

	if ( $cart_total >= $limit ) {
		// if the cart total is greater than or equal to the limit, force account creation
		$ret = (bool) true;
	}

	return $ret;

}
add_filter( 'edd_no_guest_checkout', 'sumobi_edd_force_account_creation_by_cart_total' );