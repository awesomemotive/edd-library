<?php

/*
 * This snippet forces the billing address to always be collected at checkout
 */

function pw_edd_force_billing_address() {
	if( ! did_action( 'edd_after_cc_fields', 'edd_default_cc_address_fields' ) ) {
		edd_default_cc_address_fields();
	}
}
add_action( 'edd_purchase_form_after_cc_form', 'pw_edd_force_billing_address' );