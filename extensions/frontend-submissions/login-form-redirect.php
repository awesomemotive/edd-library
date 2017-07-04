<?php
/*
 * Plugin Name: Easy Digital Downloads - FES Login Form Redirect
 * Description: Set custom redirect URL for those who just logged in via Frontend Submissions login form.
 * Author: EDD Team
 * Version: 1.0
 */

// vendor login redirect
function custom_fes_login_redirect( $response, $userdata ) {
	$response['redirect_to'] = 'http://google.com/';
	return $response;
}
add_filter( 'fes_login_form_success_redirect', 'custom_fes_login_redirect', 10, 2 );