<?php
/*
 * Removes the Discount Code field from the checkout
 *
 */
function pw_edd_remove_discount_field() {
	remove_action( 'edd_checkout_form_top', 'edd_discount_field', -1 );
}
add_action( 'init', 'pw_edd_remove_discount_field' );