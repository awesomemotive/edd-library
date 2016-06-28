<?php
/**
 * Plugin Name: License Keys UL - Email Tag for Software Licensing.
 * Plugin URI: https://github.com/easydigitaldownloads/library
 * Description: Adds an email template tag called {license_keys_ul} which can be used to output an unordered list of the customer's purchased license keys.
 * Version: 1.0.0
 * Author: Phil Johnston
 * Author URI: https://easydigitaldownloads.com
 * License: GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
 
if ( ! defined( 'ABSPATH' ) )
	exit;

function my_custom_sl_emails_initialize(){
	
	if ( class_exists( EDD_SL_Emails ) ){
		
		edd_add_email_tag( 'license_keys_ul', __( 'Show all purchased licenses in an unordered list', 'edd_sl' ), 'my_custom_license_keys_ul_tag' );	
		
	}
	
}
add_action( 'init', 'my_custom_sl_emails_initialize' );

function my_custom_license_keys_ul_tag( $payment_id = 0 ) {

	$keys_output  = '<ul>';
	$license_keys = edd_software_licensing()->get_licenses_of_purchase( $payment_id );

	if( $license_keys ) {
		foreach( $license_keys as $key ) {

			$price_name  = '';
			$download_id = edd_software_licensing()->get_download_id( $key->ID );
			$price_id    = edd_software_licensing()->get_price_id( $key->ID );

			if( $price_id ) {

				$price_name = " - " . edd_get_price_option_name( $download_id, $price_id );

			}

			$keys_output .=  '<li>' . get_the_title( $download_id ) . $price_name . ": " . get_post_meta( $key->ID, '_edd_sl_key', true ) . '</li>';
		}
	}
	
	$keys_output .= '</ul>';

	return $keys_output;

}