<?php

/**
 * Execute code whenever an EDD purchase is complete
 *
 */

function pw_edd_do_on_complete_purchase( $payment_id = 0 ) {
	
	// Execute your code here

}
add_action( 'edd_complete_purchase', 'pw_edd_do_on_complete_purchase' );