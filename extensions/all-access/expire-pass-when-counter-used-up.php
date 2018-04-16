<?php
/*
 * Plugin Name: EDD All Access - Expire pass when counter used up
 * Description: This plugin makes All Access passes expire at the moment their download counter is used up.
 * This allows the customer to renew/repurchase in order to get more downloads.
 * Author: Phil Johnston
 * Version: 1.0
 */

function all_access_expire_pass_when_counter_used_up( $all_access_pass, $download, $requested_file, $email, $log_id ) {

	// Get the download ID we will deliver
	$download_to_deliver = is_numeric( $_GET['edd-all-access-download'] ) ? $_GET['edd-all-access-download'] : NULL;
	$price_id_to_deliver = isset( $_GET['edd-all-access-price-id'] ) && is_numeric( $_GET['edd-all-access-price-id'] ) ? $_GET['edd-all-access-price-id'] : false;
	$file_id_to_deliver = isset( $_GET['edd-all-access-file-id'] ) && is_numeric( $_GET['edd-all-access-file-id'] ) ? $_GET['edd-all-access-file-id'] : false;

	// If All Access pass product ID is 123
	if( 123 == $all_access_pass->download_id ) {

		// If the All Access pass has just had its download limit exhausted
		if ( $all_access_pass->download_limit == $all_access_pass->downloads_used ) {

			//Expire the All Access Pass so that it can be renewed,. Any already-purchased renewals will automatically kick in now to renew it.
			$all_access_pass->maybe_expire( array( 'override_time_period' => true ) );

		}

	}


}
add_action( 'edd_all_access_download_being_counted_after', 'all_access_expire_pass_when_counter_used_up', 10, 5 );
