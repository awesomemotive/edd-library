<?php
/*
 * Plugin Name: Easy Digital Downloads - PDF Invoices - Show for Refunded
 * Description: Makes PDF Invoices available for refunded payments
 * Author: Pippin Williamson
 * Version: 1.0
 */

function pw_edd_pdf_invoices_for_refunded( $show_invoice, $payment_id ) {
	
	$payment = get_post( $payment_id );
	$status = edd_get_payment_status( $payment );
	
    if( 'refunded' === $status ) {
            $show_invoice = true;
    }
	
    return $show_invoice;
}
    
add_filter( 'eddpdfi_is_invoice_link_allowed', 'pw_edd_pdf_invoices_for_refunded', 10, 2 );