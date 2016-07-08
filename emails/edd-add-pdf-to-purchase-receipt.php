<?php
/*
 * Plugin Name: Easy Digital Downloads - Add PDF to purchase receipt
 * Plugin URI: https://easydigitaldownloads.com
 * Description: Attaches a PDF to the email customers receive when they purchase
 * Author: Michael Beil
 * Version: 1.0
 */

/**
 *
 * @param  array  $attachments  required  Any existing attachments
 * @param  int    $payment_id   optional  ID of the current payment
 * @param  array  $payment_data optional  The remaining payment data
 * @return array  $attachments            Now our attachment is added
 */

function edd_add_pdf_to_purchase_receipt( $attachments, $payment_id, $purchase_data ) {

	$attachments = array();
	$attachments[] = WP_CONTENT_DIR . '/assets/pdf/file1.pdf';
	$attachments[] = WP_CONTENT_DIR . '/assets/pdf/file2.pdf';

    return $attachments;

}
add_filter( 'edd_receipt_attachments', 'edd_add_pdf_to_purchase_receipt' );
