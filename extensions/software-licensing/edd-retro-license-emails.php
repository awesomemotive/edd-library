<?php
/**
 * Plugin Name: Retroactive License Emails for EDD Software Licensing
 * Plugin URI: https://github.com/easydigitaldownloads/library
 * Description: Send an email with the license key to customers when retroactively generating licenses with Easy Digital Download's Software Licensing. Don't forget to modify the email message below!
 * Version: 0.0.1
 * Author: Nate Wright
 * Author URI: https://github.com/NateWr
 * License: GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Initialize the plugin when an ajax call is made by the retroactive license
 * generation process. We don't want to send out a duplicate email during the
 * normal purchase process, so this way the plugin does nothing unless we're in
 * the middle of the retroactive license generation process.
 */
add_action( 'wp_ajax_edd_sl_process_retroactive_post', 'eddrle_attach_license_generation_hook' );

/**
 * Attach a hook to the normal license generation method
 */
if ( !function_exists( 'eddrle_attach_license_generation_hook' ) ) {
function eddrle_attach_license_generation_hook() {

	add_action( 'edd_sl_store_license', 'eddrle_send_license_email', 10, 4 );

}
} // endif;

/**
 * Send an email when a license is generated. This hooks into the normal
 * license generation when a download is processed, so make sure it's never
 * called except during the retroactive license generation.
 */
if ( !function_exists( 'eddrle_send_license_email' ) ) {
function eddrle_send_license_email( $license_id, $d_id, $payment_id, $type ) {

	// Sanity check! Is EDD 1.2+ active?
	if ( !function_exists( 'edd_get_payment_meta' ) ) {
		return;
	}

	$payment_meta = edd_get_payment_meta( $payment_id );

	// Bail early if we don't have an email address. Tough luck, man!
	if ( empty( $payment_meta['email'] ) ) {
		return;
	}

	$license_key = get_post_meta( $license_id, '_edd_sl_key', true );

	// Bail early if we don't have a license key, for some reason.
	if ( empty( $license_key ) ) {
		return;
	}

	$download_title = get_the_title( $d_id );

	// Bail early if there's no title. There should be, though!
	if ( empty( $download_title ) ) {
		return;
	}

	// A quick message. Hey don't forget to change this text!
	$message = 'A license key has been generated for your purchase of ' . $download_title . '. Please use the license key below to take advantage of one-click updates.

' . $license_key . '

Let me know if you have any questions,

Nate Wright
Theme of the Crop
http://themeofthecrop.com';

	// Send the email
	wp_mail(
		$payment_meta['email'],
		'License key generated for ' . $download_title,
		$message
	);

}
} // endif;