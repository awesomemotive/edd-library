<?php

/*
 * Adjusts the commission rate for payments that were referred by an affiliate
 *
 * This is for combining EDD Commissions with Affiliates Pro
 *
 */
function pw_edd_adjust_commission_rate_for_referrals( $recipient, $commission_amount, $rate, $download_id, $commission_id, $payment_id ) {

	global $wpdb;

	// See if this payment had a referral associated with it
	if( $wpdb->get_var( $wpdb->prepare( "SELECT referral_id FROM $wpdb->aff_referrals WHERE status = 'accepted' AND reference = %d", $payment_id ) ) ) {

		$meta = get_post_meta( $commission_id, '_edd_commission_info', true );
		$meta['amount'] = $commission_amount - round( $commission_amount * 0.30, 2 ); // reduce commission by 30%
		update_post_meta( $commission_id, '_edd_commission_info', $meta );

	}
	
}
add_action( 'eddc_insert_commission', 'pw_edd_adjust_commission_rate_for_referrals', 10, 6 );