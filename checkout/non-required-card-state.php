<?php
/*
 * Makes the cart state a non-required field when present
 */
function pw_edd_remove_state_from_required_fields( $fields ) {
	if( array_key_exists( 'card_state', $fields ) ) {
		unset( $fields['card_state'] );
	}
	return $fields;
}
add_filter( 'edd_purchase_form_required_fields', 'pw_edd_remove_state_from_required_fields' );