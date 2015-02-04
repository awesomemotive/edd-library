<?php
/*
 * Plugin Name: Easy Digital Downloads - Force Minimum Password Length
 * Description: Force a minimum password length when a customer creates an account at checkout
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com/
 * Version: 1.0
 */

function sumobi_edd_set_minimum_password_length( $valid_data, $post_data  ) {

	// how many characters should the password be?
	$length = 8;

	if ( strlen( $post_data['edd_user_pass'] ) < $length ) {
		edd_set_error( 'password_too_short', sprintf( __( 'Please enter a password of %s characters or more.', 'edd' ), $length ) );
	}
	
}
add_action( 'edd_checkout_error_checks', 'sumobi_edd_set_minimum_password_length', 10, 2 );