<?php
/**
* Plugin Name: Easy Digital Downloads - Modify User Verification URL Expiration
* Author: Kyle Maurer
* Version: 1.0
*/

function kjm_modify_user_verification_url_expiration( $url ) {
	// EDD default is '+24 hours'. 'days' also works
	$url   = add_query_arg( 'ttl', strtotime( '+48 hours' ), $url );
	return $url;
}
add_filter( 'edd_get_user_verification_url', 'kjm_modify_user_verification_url_expiration' );
