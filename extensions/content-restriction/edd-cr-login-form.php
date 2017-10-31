<?php
/**
 * Plugin Name: Easy Digital Downloads - Content Restriction - Showing the login form for logged out users
 * Description: Shows the [edd_login] form on restricted content for logged out users.
 * Author: John Parris
 */
function jp_cr_login_form( $content ) {

	if ( ! function_exists( 'edd_cr_is_restricted' ) ) {
		return $content;
	}

	global $post;
	if ( ! is_object( $post ) ) {
		return $content;
	}

	if ( edd_cr_is_restricted( $post->ID ) && ! is_user_logged_in() ) {
		$content .= do_shortcode( '[edd_login]' );
	}
	return $content;
}
add_filter( 'the_content', 'jp_cr_login_form', 11 );
