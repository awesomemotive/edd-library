<?php
/*
 Plugin Name: Easy Digital Downloads - File Size Display
 Plugin URI: https://easydigitaldownloads.com
 Description: After the download content, shows a list of the download files and their sizes
 Author: Chris Klosowski
 Version: 1.0
 Author URI: https://kungfugrep.com
 */

add_action( 'edd_after_download_content', 'edd_ck_show_file_sizes', 10, 1 );
function edd_ck_show_file_sizes( $post_id ) {
	$files = edd_get_download_files( $post_id, null );
	$decimals = 2;
	$sz = 'BKMGTP';
	$header = _n( 'File Size', 'File Sizes', count( $files ), 'edd' );
	echo '<h5>' . $header . '</h5>';
	echo '<ul>';
	foreach( $files as $file ) {
		$bytes = filesize( get_attached_file( $file['attachment_id'] ) );
		$factor = floor((strlen($bytes) - 1) / 3);
		echo '<li>' . $file['name'] . ' - ' . sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor) ) . @$sz[$factor] . '</li>';
	}
	echo '</ul>';
}