<?php

function pw_cfm_company_field( $payment, $edd_receipt_args ) {

	/*
	 * TODO
	 *
	 * 1. Replace field label as appropriate
	 * 2. Replace "company" with the meta_key entered in Checkout Fields Manager
	 */
?>
	<tr>
		<td><strong><?php _e( 'Company', 'edd' ); ?>:</strong></td>
		<td><?php echo get_post_meta( $payment->ID, 'company', true ); ?></td>
	</tr>
<?php
}
add_action( 'edd_payment_receipt_after', 'pw_cfm_company_field', 10, 2 );