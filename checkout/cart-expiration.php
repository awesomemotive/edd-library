<?php

/*
 * Sets the cart expiration to 48 hours
 */
function pw_edd_set_cart_expiration( $seconds ) {
	return 172800; // 48 hours in seconds
}
add_filter( 'wp_session_expiration','pw_edd_set_cart_expiration', 999990 );