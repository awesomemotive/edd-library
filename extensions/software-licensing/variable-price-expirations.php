<?php
/*
Plugin Name: Easy Digital Downloads - Variable Pricing License Expiration
Plugin URL: http://easydigitaldownloads.com/extension/
Description: Set the expiration time for licenses per price option
Version: 1.1
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Contributors: mordauk
*/

function pw_edd_sl_license_length( $expiration, $payment_id, $download_id, $license_id ) {

	$price_id = edd_software_licensing()->get_price_id( $license_id );

	if( $price_id !== false ) {

		switch( $price_id ) {

			case 1:
				$expiration = '+10 years';
				break;
			case 2:
				$expiration = '+2 years';
				break;
			case 3:
				$expiration = '+1 year';
				break;
		}

	}

	return $expiration;

}
add_filter( 'edd_sl_license_exp_length', 'pw_edd_sl_license_length', 10, 4 );
