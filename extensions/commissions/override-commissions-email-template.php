<?php
/**
 * Modify the email template sent for commissions
 */

// Remove default email template
remove_action( 'eddc_insert_commission', 'eddc_email_alert', 10, 5 );
 
// Build New email template for Commissions (same as default, carefully make your modifications)
function sd_edd_commissions_email_alert( $user_id, $commission_amount, $rate, $download_id, $commission_id ) {
	global $edd_options;
 
	$from_name = isset( $edd_options['from_name'] ) ? $edd_options['from_name'] : get_bloginfo( 'name' );
	$from_name = apply_filters( 'eddc_email_from_name', $from_name, $user_id, $commission_amount, $rate, $download_id );
 
	$from_email = isset( $edd_options['from_email'] ) ? $edd_options['from_email'] : get_option( 'admin_email' );
	$from_email = apply_filters( 'eddc_email_from_email', $from_email, $user_id, $commission_amount, $rate, $download_id );
 
	$headers = "From: " . stripslashes_deep( html_entity_decode( $from_name, ENT_COMPAT, 'UTF-8' ) ) . " <$from_email>\r\n";
 
	/* send an email alert of the sale */
 
	$user = get_userdata( $user_id );
 
	$email = $user->user_email; // set address here
 
	$message = __( 'Hello', 'eddc' ) . "\n\n" . sprintf( __( 'You have made a new sale on %s!', 'eddc' ), stripslashes_deep( html_entity_decode( $from_name, ENT_COMPAT, 'UTF-8' ) ) ) . ".\n\n";
	$variation = get_post_meta( $commission_id, '_edd_commission_download_variation', true );
	$message .= __( 'Item sold: ', 'eddc' ) . get_the_title( $download_id ) . (!empty($variation) ? ' - ' . $variation : '') . "\n\n";
	$message .= __( 'Amount: ', 'eddc' ) . " " . html_entity_decode( edd_currency_filter( edd_format_amount( $commission_amount ) ) ) . "\n\n";
	$message .= __( 'Commission Rate: ', 'eddc' ) . $rate . "%\n\n";
	$message .= __( 'Thank you', 'eddc' );
 
	$message = apply_filters( 'eddc_sale_alert_email', $message, $user_id, $commission_amount, $rate, $download_id );
 
	wp_mail( $email, __( 'New Sale!', 'eddc' ), $message, $headers );
}
 
// Add new email template
add_action( 'eddc_insert_commission', 'sd_edd_commissions_email_alert', 10, 5 );