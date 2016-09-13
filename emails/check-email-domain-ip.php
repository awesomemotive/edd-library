<?php
/*
 * Plugin Name: Verify Email Domain
 * Description: During the banned email checks, see if the domain being checked has DNS configured, if not report it as 'banned'
 * Author: Chris Klosowski
 * Author URI: https://easydigitaldownloads.com/
 * Version: 1.0.0
 */

/**
 * Verify the domain on the email address is at least setup with DNS
 *
 * @param  bool $is_banned   If the email has passed previous checks
 * @param  string $email     The email address to verify
 * @return bool              If the domain fails an IP check, return that it's 'banned'
 */
function kfg_is_valid_email( $is_banned, $email ) {
	if ( true === $is_banned ) {
		return $is_banned;
	}

	$email_parts = explode( '@', $email );
	$domain      = $email_parts[1];

	$host = gethostbyname( $domain );
	if ( false === ip2long( $host ) ) {
		$is_banned = true;
	}

	return $is_banned;

}
add_filter( 'edd_is_email_banned', 'kfg_is_valid_email', 10, 2 );

/**
 * Since the `edd_is_email_banned()` function only runs to the filter if there are banned emails, we need to fake it into
 * thinking there are banned emails.
 *
 * @param  array $emails Current list of banned emails
 * @return array         Returns either the banned emails, or an array with our 'fake' email address
 */
function kfg_pad_banned_emails( $emails ) {
	if ( ! is_array( $emails ) || empty( $emails ) ) {
		$emails = array( 'testing@example.com' );
	}

	return $emails;
}
add_filter( 'edd_get_banned_emails', 'kfg_pad_banned_emails', 10, 1 );