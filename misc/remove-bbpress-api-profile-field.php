<?php
/*
 * This will remove the API key settings from the bbPress profile editor
 */
function pw_edd_remove_bbpress_api_key_setting() {

	remove_action( 'show_user_profile', 'edd_show_user_api_key_field', 10 );
	remove_action( 'edit_user_profile', 'edd_show_user_api_key_field', 10 );
}
add_action( 'plugins_loaded', 'pw_edd_remove_bbpress_api_key_setting' );