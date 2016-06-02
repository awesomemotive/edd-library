<?php
/*
 * Plugin Name: Easy Digital Downloads - payment_id email tag.
 * Description: This adds support for the {payment_id} email tag to Commissions Notifications
 * Author: Phil Johnston
 * Version: 1.0
 */
function pj_eddc_add_payment_id_email_template_tag( $message, $user_id, $commission_amount, $rate, $download_id, $commission_id ){
	
	//Get the payment Id
	$payment_id = get_post_meta( $commission_id, '_edd_commission_payment_id', true );
	
	$message = str_replace( '{payment_id}', $payment_id, $message );
	
	return $message;
	
}
add_filter( 'eddc_sale_alert_email', 'pj_eddc_add_payment_id_email_template_tag', 10, 6 );