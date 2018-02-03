<?php
/*
 * Plugin Name: EDD All Access - Weighted download count
 * Description: This plugin makes it so that certain products use up more downloads in the download counter than others.
 * Author: Phil Johnston
 * Version: 1.0
 */

function all_access_weighted_downloads( $all_access_pass, $download, $requested_file, $email, $log_id ) {

	// Get the download ID we will deliver
	$download_to_deliver = is_numeric( $_GET['edd-all-access-download'] ) ? $_GET['edd-all-access-download'] : NULL;
	$price_id_to_deliver = isset( $_GET['edd-all-access-price-id'] ) && is_numeric( $_GET['edd-all-access-price-id'] ) ? $_GET['edd-all-access-price-id'] : false;
	$file_id_to_deliver = isset( $_GET['edd-all-access-file-id'] ) && is_numeric( $_GET['edd-all-access-file-id'] ) ? $_GET['edd-all-access-file-id'] : false;

	// Single price example: If product 123 is being downloaded, add 9 more counts to the downloads-used counter
	if( 123 == $download_to_deliver ) {

		// If you want to count 10 downloads, subtract the 1 already automatically counted by All Access. That is why we use "9" here:
		$all_access_pass->downloads_used = $all_access_pass->downloads_used + 9;

	}

	// Variable price example: If product 123 is being downloaded and variable price #1, add 9 more counts to the downloads-used counter
	if( 123 == $download_to_deliver && 1 == $price_id_to_deliver ) {

		// If you want to count 10 downloads, subtract the 1 already automatically counted by All Access. That is why we use "9" here:
		$all_access_pass->downloads_used = $all_access_pass->downloads_used + 9;

	}

}
add_filter( 'edd_all_access_download_being_counted_after', 'all_access_weighted_downloads', 10, 5 );
