<?php

/*
 * Limit total purchase amount
 */
function pw_edd_limit_total_purchase( $valid_data, $post_data ) {
	
	if( edd_get_cart_total() > 100 ) {
		edd_set_error( 'too_much', 'You cannot purchase that much at one time.' );
	}

}
add_action( 'edd_checkout_error_checks', 'pw_edd_limit_total_purchase' );