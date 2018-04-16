<?php
/*
 * Plugin Name: EDD All Access - Only count last file
 * Description: This plugin makes it so that All Access only increments the download counter if the customer is downloading the last file attached to a product.
 * Author: Phil Johnston
 * Version: 1.0
 */

function all_access_only_count_last_file( $should_be_counted, $all_access_pass, $download_id, $requested_file, $email, $log ) {

	// This is the id of the file being downloaded using All Access
	$requested_file_id = isset( $_GET['edd-all-access-file-id'] ) ? $_GET['edd-all-access-file-id'] : 0;

	// Get the array of files attached to this product being downloaded
	$download_files = edd_get_download_files( $download_id );

	// Move the internal pointer to the end of the array
	end($download_files);

	// Fetch the key of the element pointed to by the internal pointer
	$last_file_key = key($download_files);

	// Figure out if the requested file is the last file or not
	if ( $requested_file_id == $last_file_key ) {
		// If this is the last file attached to a product, count it in the All Access download counter.
		return true;
	} else {
		// If it is any other file, don't count it.
		return false;
	}

}
add_filter( 'edd_all_access_download_should_be_counted', 'all_access_only_count_last_file', 10, 6 );
