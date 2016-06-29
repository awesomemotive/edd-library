<?php
/*
 * Plugin Name: Billing Address Email Tag - Actual Country Name
 * Description: Replace the default {billing_address} email tag to use the full State/Country names on purchase receipts.
 * Author: Phi Johnston
 * Author URI: http://easydigitaldownloads.com/
 * Version: 1.0.0
 */

function pj_edd_billing_address_tag( $payment_id ) {
	
	edd_remove_email_tag( 'billing_address' );
	
	edd_add_email_tag( 'billing_address', __( 'The buyer\'s billing address', 'easy-digital-downloads' ), 'pj_edd_billing_address_tag_callback' );
	
}
add_action( 'edd_add_email_tags', 'pj_edd_billing_address_tag', 99 );

function pj_edd_billing_address_tag_callback( $payment_id ) {
		
	$user_info    = edd_get_payment_meta_user_info( $payment_id );
	$user_address = ! empty( $user_info['address'] ) ? $user_info['address'] : array( 'line1' => '', 'line2' => '', 'city' => '', 'country' => '', 'state' => '', 'zip' => '' );

	$return = $user_address['line1'] . "\n";
	if( ! empty( $user_address['line2'] ) ) {
		$return .= $user_address['line2'] . "\n";
	}
	
	$all_states = edd_get_shop_states( $user_address['country'] );
	$return .= $user_address['city'] . ' ' . $user_address['zip'] . ' ' . $all_states[$user_address['state']] . "\n";
	
	$all_countries = edd_get_country_list();
	$return .= $all_countries[$user_address['country']];

	return $return;
	
}