<?php
/*
Plugin Name: EDD FES - Submission Form Redirect
Plugin URL: https://github.com/easydigitaldownloads/library/blob/master/extensions/frontend-submissions/submission-form-redirect.php
Description: Filter the redirect URL for successful FES Submission Form submission
Version: 1.0
Author: Sean Davis
Author URI: http://seandavis.co/
*/

function sd_fes_submission_redirect( $response, $post_id, $form_id ) {
	$response['redirect_to'] = 'http://SITEURL.com/';
	return $response;
}
add_filter( 'fes_add_post_redirect', 'sd_fes_submission_redirect', 10, 3 );