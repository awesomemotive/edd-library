<?php
/*
 * Plugin Name: Prevent Discounts on Renewals
 * Description: Does not allow a discount code to be applied when an EDD SL is present in the cart
 * Author: Chris Klosowski
 * Version: 1.0
 */

function kfg_check_if_is_renewal( $return ) {

	if ( EDD()->session->get( 'edd_is_renewal' ) ) {
		edd_set_error( 'edd-discount-error', __( 'This discount is not valid with renewals.', 'edd' ) );
		return false;
	}

	return $return;

}
add_filter( 'edd_is_discount_valid', 'kfg_check_if_is_renewal', 99, 1 );
