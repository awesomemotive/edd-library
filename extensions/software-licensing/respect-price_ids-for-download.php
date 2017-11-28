<?php

/*
Plugin Name: Easy Digital Downloads - Respect the price id associated with a license key for Software Licensing Updates
Plugin URL: http://easydigitaldownloads.com/extension/
Description: Respect the price id associated with a license key, instead of just giving a the selected download for all updates.
Version: 1.0
Author: Dan Cameron
Author URI: http://sproutapps.co
Contributors: dancameron
*/

/**
 * Respect the price id associated with a license key, instead of just giving
 * a the selected download for all updates.
 * @param  int $file_url 		The filtered URL for the download package
 * @param  int $download_id The Download ID to get the package for
 * @param  string  $license_key The license key
 * @param  bool  $license_key 	If it's a beta download, however this param is filtered yet.
 * @return string               The URL for the download package
 */
function _respect_download_by_price_id( $file_url, $download_id, $license_key, $download_beta = false ) {
	if ( $download_beta ) {
		$file_key  = get_post_meta( $download_id, '_edd_sl_beta_upgrade_file_key', true );
		$all_files = get_post_meta( $download_id, '_edd_sl_beta_files', true );
	} else {
		$file_key  = get_post_meta( $download_id, '_edd_sl_upgrade_file_key', true );
		$all_files = get_post_meta( $download_id, 'edd_download_files', true );
	}

	$edd_sl = edd_software_licensing();
	$license = $edd_sl->get_license( $license_key, true );
	$price_id = $edd_sl->get_price_id( $license->ID );

	foreach ( $all_files as $key => $file ) {
		if ( isset( $file['condition'] ) && isset( $file['condition'] ) && (int) $price_id === (int) $file['condition'] ) {
			$file_url = $file['file'];
		}
	}
	return $file_url;
}
add_filter( 'edd_sl_download_package_url', '_respect_download_by_price_id', 10, 3 );
