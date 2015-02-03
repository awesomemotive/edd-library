<?php
/*
Plugin Name: Easy Digital Downloads - Readme.txt Parsing Enhancements
Description: Updates a Download's current version and change log fields when using the readme.txt parsing feature in Easy Digital Downloads.
Version: 1.0
Author: John Parris
Author URI: http://www.johnparris.com/
*/

function jp_edd_readme_filter( $response, $download, $readme ) {

	// Update the current version number for a download
	$meta_version = get_post_meta( $download->ID, '_edd_sl_version', true );
	if ( '' != $readme['stable_tag'] && $meta_version != $readme['stable_tag'] ) {
		update_post_meta( $download->ID, '_edd_sl_version', $readme['stable_tag'] );
	}

	// Update the change log field so we can display it on the front end.
	$meta_changelog = get_post_meta( $download->ID, '_edd_sl_changelog', true );
	if( '' != $readme['sections']['change_log'] && $meta_changelog != $readme['sections']['change_log'] ) {
		update_post_meta( $download->ID, '_edd_sl_changelog', $readme['sections']['change_log'] );
	}

	return $response;

}
add_filter( 'edd_sl_license_readme_response', 'jp_edd_readme_filter', 10, 3 );