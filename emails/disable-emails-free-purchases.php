<?php
/**
 * Plugin Name: Easy Digital Downloads - Disable emails on free purchases
 */
function jp_no_email_free( $payment_id ) {

	$amount = edd_get_payment_amount( $payment_id );
	if ( 0 == $amount ) {
		remove_action( 'edd_complete_purchase', 'edd_trigger_purchase_receipt', 999, 1 ); // This disables customer purchase receipts
		remove_action( 'edd_admin_sale_notice', 'edd_admin_email_notice', 10, 2 ); // This disables email notices to admins
	}
}
add_action( 'edd_complete_purchase', 'jp_no_email_free', 998, 1 );