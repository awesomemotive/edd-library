<?php
/*
 * Plugin Name: Easy Digital Downloads - PDF Invoices - Show for Pending
 * Description: Makes PDF Invoices available for pending payments
 * Author: Pippin Williamson
 * Version: 1.0
 */

function pw_edd_pdf_invoices_for_pending( $show_invoice, $payment_id ) {
	
	$payment = get_post( $payment_id );
	$status = edd_get_payment_status( $payment );
	
    if( 'pending' === $status ) {
            $show_invoice = true;
    }
	
    return $show_invoice;
}
    
add_filter( 'eddpdfi_is_invoice_link_allowed', 'pw_edd_pdf_invoices_for_pending', 10, 2 );