<?php
function jp_customize_verification_email( $message, $user_id ) {
	$user_data = get_userdata( $user_id );
	$url       = edd_get_user_verification_url( $user_id );
	$from_name = edd_get_option( 'from_name', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$message   = sprintf( __( "Howdy %s,\n\nYour account with %s needs to be verified before you can access your purchase history. <a href='%s'>Click here</a> to verify your account and get access to your purchases.", 'edd' ), $user_data->display_name, $from_name, $url );
	return $message;
}
add_filter( 'edd_user_verification_email_message', 'jp_customize_verification_email', 10, 2 );