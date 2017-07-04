<?php
/*
 * Plugin Name: Easy Digital Downloads - Modify Software Licensing License Structure
 * Description: Modify the structure of Software Licensing's license keys.
 * Author: EDD Team
 * Version: 1.0
 */

// This is just one example

// Prepend/append text to license keys
function custom_edd_license_usernam_date_md5( $key, $license_id, $download_id, $payment_id, $cart_index ) {
	$prepend   = 'prepend';
	$license   = md5( $license_id );
	$append    = 'append';
	$key       = $prepend . '_' . $license . '_' . $append;
	return $key;
}
add_filter( 'edd_sl_generate_license_key', 'custom_edd_license_usernam_date_md5', 10, 5 );