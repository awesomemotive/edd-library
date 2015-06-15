<?php
/*
 * Plugin Name: Easy Digital Downloads - Conditional Gateway Fees
 * Description: Do not charge gateway fee onto customer if amount is over X
 * Author: Chris LaBonty
 * Version: 1.0
 */
function cl_remove_gateway_fees_by_cart_total() {
    // enter the cart total for no gateway fees
    $limit = 5;
	// get the cart total
	$cart_total = edd_get_cart_total();
	if ( $cart_total >= $limit ) {
		// if the cart total is greater than or equal to the limit, remove gateway fees
		EDD()->fees->remove_fee('gateway_fee');
	}
}
add_action( 'edd_before_checkout_cart', 'cl_remove_gateway_fees_by_cart_total' );
