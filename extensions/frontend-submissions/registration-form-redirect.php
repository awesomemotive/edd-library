<?php
/*
 * Plugin Name: Easy Digital Downloads - FES Registration Form Redirect
 * Description: Set custom redirect URL for those who just registered to become vendors.
 * Author: EDD Team
 * Version: 1.0
 */

// vendor registration redirect
function custom_fes_vendor_registration_redirect( $response, $post_id, $form_id ) {

	// replace http://google.com/ with your desired redirect URL
	$response['redirect_to'] = 'http://google.com/';
	return $response;
}
add_filter( 'fes_register_form_pending_vendor', 'custom_fes_vendor_registration_redirect', 10, 3 );
add_filter( 'fes_register_form_frontend_vendor', 'custom_fes_vendor_registration_redirect', 10, 3 );