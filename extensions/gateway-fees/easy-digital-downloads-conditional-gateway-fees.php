<?php
/*
 * Plugin Name: Easy Digital Downloads - Conditional Gateway Fees
 * Description: Do not charge gateway fee onto customer if amount is over X
 * Author: Chris LaBonty and Chris Christoff
 * Version: 1.0
 */
function cl_remove_gateway_fees_by_cart_total( $fee ) {
    // enter the cart total for no gateway fees
    $limit = 5;
	// get the cart total
	$cart_total = edd_get_cart_total();
	if ( $cart_total >= $limit ) {
		// if the cart total is greater than or equal to the limit, remove gateway fees
		return 0;
	} else {
		return $fee; // else return the fee we had before
	}
}
add_filter( 'edd_gf_fee_total_before_add_fee', 'cl_remove_gateway_fees_by_cart_total', 10, 1 );
// Note: Snippet requires Gateway Fees 1.4.1 or above
