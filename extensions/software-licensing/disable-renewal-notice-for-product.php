<?php

// Disables renewal notices for specific products
function pw_edd_disable_product_renewal_notice( $should_send, $license_id, $notice_id ) {
	
	$download_id = (int) edd_software_licensing()->get_download_id( $license_id );
	$price_id = (int) edd_software_licensing()->get_price_id( $license_id );

	if( 55 === $download_id ) {

		// Do not send for download with an ID of 55
		$should_send = false;
	}

	/* 
	// Second example. Do not send if product ID is 1 AND price ID 2 was purchased
	if( 55 === $download_id && 2 === $price_dd ) {

		// Do not send for download with an ID of 55
		$should_send = false;
	}
	*/

	return $should_send;
}
add_filter( 'edd_sl_send_scheduled_reminder_for_license', 'pw_edd_disable_product_renewal_notice', 10, 3 );