<?php
/**
 * Verify password minimum length in the EDD profile editor.
 */
function pd_edd_pre_update_user_profile( $user_id, $userdata ) {
	// How many characters should the password be?
	$length = 8;

	$password = isset( $_POST['edd_new_user_pass1'] ) ? $_POST['edd_new_user_pass1'] : '';

	if ( ! empty( $password ) && ( strlen( $password ) < $length ) ) {
		edd_set_error( 'password_too_short', sprintf( 'Your password must contain at least %s characters.', $length ) );
	}
}

add_action( 'edd_pre_update_user_profile', 'pd_edd_pre_update_user_profile', 10, 2 );
