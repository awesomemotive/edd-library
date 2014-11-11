<?php
/*
Plugin Name: Easy Digital Downloads - Variable Pricing License Expiration
Plugin URL: http://easydigitaldownloads.com/extension/
Description: Set the expiration time for licenses per price option
Version: 1.0
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Contributors: mordauk
*/

function pw_edd_sl_license_length( $expiration, $payment_id, $download_id, $license_id ) {

	$purchase_details = edd_get_payment_meta_cart_details( $payment_id );

	$price_id = false;

	foreach( $purchase_details as $item ) {
		if( (int) $item['id'] === (int) $download_id ) {
			if( ! empty( $item['item_number']['options'] ) ) {
				foreach( $item['item_number']['options'] as $option ) {
					$price_id = (int) $option['price_id'];
				}
			}
		}
	}

	if( $price_id !== false ) {

		switch( $price_id ) {

			case 0:
				$expiration = '+10 years';
				break;
			case 1:
				$expiration = '+2 years';
				break;
			case 2:
				$expiration = '+1 year';
				break;
		}

	}

	return $expiration;

}
add_filter( 'edd_sl_license_exp_length', 'pw_edd_sl_license_length', 10, 4 );
