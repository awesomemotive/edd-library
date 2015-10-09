<?php
/**
 * Plugin Name: Easy Digital Downloads - Enable PayPal Shipping Calculation
 * Description: Enables shipping calculations in PayPal
 */
function pw_enable_paypal_shipping( $paypal_args ) {
	$paypal_args['no_shipping'] = '2';
	return $paypal_args;
}
add_filter( 'edd_paypal_redirect_args', 'pw_enable_paypal_shipping' );