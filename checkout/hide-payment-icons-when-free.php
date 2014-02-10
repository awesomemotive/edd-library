<?php

/**
 * Hide payment icons when cart total is free
*/
function sumobi_edd_hide_payment_icons() {
	$cart_total = edd_get_cart_total();

	if ( $cart_total )
		return;

	remove_action( 'edd_payment_mode_top', 'edd_show_payment_icons' );
	remove_action( 'edd_checkout_form_top', 'edd_show_payment_icons' );
}
add_action( 'template_redirect', 'sumobi_edd_hide_payment_icons' );