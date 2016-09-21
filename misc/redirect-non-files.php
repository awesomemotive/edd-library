<?php
/*
Plugin Name: Easy Digital Downloads - Redirect non-files
Plugin URI:
Description: Redirects customers to page URL instead of trying to download the page as a file
Version:
Author: Pippin Williamson
Author URI:
License:
License URI:
*/

function pw_edd_redirect_non_file( $requested_file, $download_files, $file_key ) {

	if( ! edd_get_file_extension( $requested_file ) ) {
		wp_redirect( $requested_file ); exit;
	}

	return $requested_file;

}
add_filter( 'edd_requested_file', 'pw_edd_redirect_non_file', 10, 4 );