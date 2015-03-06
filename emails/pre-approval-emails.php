<?php
/*
 * Plugin Name: Easy Digital Downloads - Pre-approval Emails
 * Description: Email the admin and customer when a pre-approval payment has been made.
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com/
 * Version: 1.0
 */


/**
 * Send emails when purchase is pre-approved
 */
function edd_pre_approval_emails_send_emails( $payment_id, $new_status, $old_status ) {

	// Make sure that payments are only completed once
	if ( $old_status == 'publish' || $old_status == 'complete' ) {
		return; 
	}

	// Make sure the payment completion is only processed when new status is complete
	if ( $new_status != 'preapproval' ) {
		return;
	}

	// Send email to customer
	edd_pre_approval_emails_send_customer_email( $payment_id );

	// Send email to admin
	edd_pre_approval_emails_send_admin_email( $payment_id );

}
add_action( 'edd_update_payment_status', 'edd_pre_approval_emails_send_emails', 100, 3 );

/**
 * Send preapproval email to customer
 *
 * @since 1.0
 */
function edd_pre_approval_emails_send_customer_email( $payment_id ) {

	// get payment data from payment ID
	$payment_data = edd_get_payment_meta( $payment_id );

	// get customer email
	$email = edd_get_payment_user_email( $payment_id );

	// subject
	$subject = __( 'Thanks For Your Pledge', 'edd-pre-approval-emails' );
	
	// email heading
	$email_heading = __( 'Thanks For Your Pledge', 'edd-pre-approval-emails' );

	// message
	$message = edd_pre_approval_emails_get_customer_message_body( $payment_id, $payment_data );
	
	// run our message through the standard EDD email tag function
	$message = apply_filters( 'edd_purchase_receipt', edd_do_email_tags( $message, $payment_id ), $payment_id, $payment_data );

	// EDD 2.0+
	if ( class_exists( 'EDD_Emails' ) ) {

		// set email heading
		EDD()->emails->__set( 'heading', $email_heading );

		// send the email
		EDD()->emails->send( $email, $subject, $message );

	}

}


/**
 * Admin notification 
 */
function edd_pre_approval_emails_send_admin_email( $payment_id = 0, $payment_data = array() ) {

	$payment_id = absint( $payment_id );

	// get payment data from payment ID
	$payment_data = edd_get_payment_meta( $payment_id );

	if ( empty( $payment_id ) ) {
		return;
	}

	if ( ! edd_get_payment_by( 'id', $payment_id ) ) {
		return;
	}

	$from_name   = edd_get_option( 'from_name', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$from_name   = apply_filters( 'edd_purchase_from_name', $from_name, $payment_id, $payment_data );

	$from_email  = edd_get_option( 'from_email', get_bloginfo( 'admin_email' ) );
	$from_email  = apply_filters( 'edd_purchase_from_address', $from_email, $payment_id, $payment_data );

	$subject     = sprintf( __( 'New pledge - Order #%1$s', 'edd-pre-approval-emails' ), $payment_id );
	$subject     = wp_strip_all_tags( $subject );
	$subject     = edd_do_email_tags( $subject, $payment_id );

	$headers     = "From: " . stripslashes_deep( html_entity_decode( $from_name, ENT_COMPAT, 'UTF-8' ) ) . " <$from_email>\r\n";
	$headers    .= "Reply-To: ". $from_email . "\r\n";
	$headers    .= "Content-Type: text/html; charset=utf-8\r\n";
	$headers     = apply_filters( 'edd_admin_pledge_notification_headers', $headers, $payment_id, $payment_data );

	$attachments = apply_filters( 'edd_admin_pledge_notification_attachments', array(), $payment_id, $payment_data );

	$message     = edd_pre_approval_emails_get_admin_email_body( $payment_id, $payment_data );

	if ( class_exists( 'EDD_Emails' ) ) {

		$emails = EDD()->emails;
		$emails->__set( 'from_name', $from_name );
		$emails->__set( 'from_email', $from_email );
		$emails->__set( 'headers', $headers );
		$emails->__set( 'heading', __( 'New Pledge!', 'edd-pre-approval-emails' ) );
		$emails->send( edd_get_admin_notice_emails(), $subject, $message, $attachments );

	}

}

/**
 * Get a list of downloads from the payment meta
 *
 * @since 1.0
 */
function edd_pre_approval_emails_get_download_list( $payment_data = array() ) {

	$download_list = '';
	$downloads = maybe_unserialize( $payment_data['downloads'] );

	if ( is_array( $downloads ) ) {
		foreach( $downloads as $download ) {

			$id = isset( $payment_data['cart_details'] ) ? $download['id'] : $download;

			$title = get_the_title( $id );

			if ( isset( $download['options'] ) ) {
				if ( isset( $download['options']['price_id'] ) ) {
					$title .= ' - ' . edd_get_price_option_name( $id, $download['options']['price_id'], $payment_id );
				}
			}
			
			$download_list .= html_entity_decode( $title, ENT_COMPAT, 'UTF-8' ) . "\n";

		}
	}

	return $download_list;
}

/**
 * Default pre-approval email body for customer
 *
 * @since 1.0
 */
function edd_pre_approval_emails_get_customer_message_body( $payment_id = 0, $payment_data = array() ) {

	$email_body = "Dear" . " {name},\n\n";
	$email_body .= "Thank you for your pledge!" . "\n\n";
	$email_body .= sprintf( __( '%s pledged on:', 'edd-pre-approval-emails' ), edd_get_label_plural() ) . "\n\n";
	$email_body .= edd_pre_approval_emails_get_download_list( $payment_data ) . "\n\n";
	$email_body .= "Amount pledged:" . " " . html_entity_decode( edd_currency_filter( edd_format_amount( edd_get_payment_amount( $payment_id ) ) ), ENT_COMPAT, 'UTF-8' ) . "\n\n";
	$email_body .= "{sitename}";

	$email_body = wpautop( $email_body );

	$email_body = apply_filters( 'edd_purchase_receipt_' . EDD()->emails->get_template(), $email_body, $payment_id, $payment_data );

	return apply_filters( 'edd_pre_approval_emails_pledge_receipt', $email_body, $payment_id, $payment_data );
}


/**
 * Default pre-approval email body for admin
 *
 * @since 1.0
 */
function edd_pre_approval_emails_get_admin_email_body( $payment_id = 0, $payment_data = array() ) {
	global $edd_options;

	$user_info = maybe_unserialize( $payment_data['user_info'] );
	$email     = edd_get_payment_user_email( $payment_id );

	if( isset( $user_info['id'] ) && $user_info['id'] > 0 ) {
		$user_data = get_userdata( $user_info['id'] );
		$name = $user_data->display_name;
	} elseif( isset( $user_info['first_name'] ) && isset( $user_info['last_name'] ) ) {
		$name = $user_info['first_name'] . ' ' . $user_info['last_name'];
	} else {
		$name = $email;
	}

	$gateway = edd_get_gateway_admin_label( get_post_meta( $payment_id, '_edd_payment_gateway', true ) );

	$email_body = __( 'Hello', 'edd-pre-approval-emails' ) . "\n\n" . __( 'A new pledge has been made', 'edd-pre-approval-emails' ) . ".\n\n";
	$email_body .= sprintf( __( '%s pledged:', 'edd-pre-approval-emails' ), edd_get_label_plural() ) . "\n\n";
	$email_body .= edd_pre_approval_emails_get_download_list( $payment_data ) . "\n\n";
	$email_body .= __( 'Pledged by: ', 'edd-pre-approval-emails' ) . " " . html_entity_decode( $name, ENT_COMPAT, 'UTF-8' ) . "\n";
	$email_body .= __( 'Amount: ', 'edd-pre-approval-emails' ) . " " . html_entity_decode( edd_currency_filter( edd_format_amount( edd_get_payment_amount( $payment_id ) ) ), ENT_COMPAT, 'UTF-8' ) . "\n";
	$email_body .= __( 'Payment Method: ', 'edd-pre-approval-emails' ) . " " . $gateway . "\n\n";

	$email_body = edd_do_email_tags( $email_body, $payment_id );

	return apply_filters( 'edd_pledge_notification', wpautop( $email_body ), $payment_id, $payment_data );
}

