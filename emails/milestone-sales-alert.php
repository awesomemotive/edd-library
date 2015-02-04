<?php
/*
 * Plugin Name: Easy Digital Downloads - Milestone Sales Alert
 * Description: Emails the admin when a specific download has been sold X times.
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com/
 * Version: 1.0
 */

function sumobi_edd_milestone_sales_alert( $purchase_id ) {
	// ID of download to check
	$download_id = 8;

	// sales milestone to reach
	$milestone   = 100;

 	// email/s to send the notification to. Add more emails to array if neccessary
	$send_to     = get_option( 'admin_email' );

	// get the current number of sales for the download
	$sales       = get_post_meta( $download_id, '_edd_download_sales', true );
 	
 	// message to be included in the email
	$message     = sprintf( 'Congratulations, you have just reached your milestone of %s sales for %s! View this sale here: %s', $milestone, get_the_title( $download_id ), admin_url( 'edit.php?post_type=download&page=edd-payment-history&view=view-order-details&id=' . $purchase_id ) );
 	
 	// send email is milestone is reached
	if ( $milestone == $sales ) {
		wp_mail( $send_to, 'Milestone reached!', $message );
	}
}
add_action( 'edd_complete_purchase', 'sumobi_edd_milestone_sales_alert' );