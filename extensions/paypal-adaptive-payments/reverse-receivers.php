<?php

// Reverses the receivers for PayPal Adaptive Payments
function edd_c_reverse_receivers( $receivers, $payment_id ) {

	$receivers = explode( "\n", $receivers );
	$receivers = implode( "\n", array_reverse( $receivers ) );

	return $receivers;
}
add_filter( 'epap_adaptive_receivers', 'edd_c_reverse_receivers', 10, 2 );