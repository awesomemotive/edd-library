<?php

/**
 * Hide social login from checkout. Good for when you are using it elsewhere on your website and do not want it showing at checkout
*/
function sumobi_edd_remove_social_login_from_checkout() {
	global $edd_slg_render;
	remove_action( 'edd_checkout_form_top', array( $edd_slg_render, 'edd_slg_social_login_buttons' ) );
}
add_action( 'template_redirect', 'sumobi_edd_remove_social_login_from_checkout' );