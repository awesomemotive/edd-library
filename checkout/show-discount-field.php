<?php

/**
 * Unhook default EDD discount field
*/
remove_action( 'edd_checkout_form_top', 'edd_discount_field', -1 );

/**
 * Show discount field by default
 * If you want a button, simply add <a class="edd-submit button" href="#">Apply discount</a> after the input field.
 * Because the discount is applied when you click outside the field, it will work in the exact same way
*/
function sumobi_edd_show_discount_field() {
	if( ! isset( $_GET['payment-mode'] ) && count( edd_get_enabled_payment_gateways() ) > 1 && ! edd_is_ajax_enabled() )
		return; // Only show once a payment method has been selected if ajax is disabled
 
	if ( edd_has_active_discounts() && edd_get_cart_total() ) {
	?>
	<fieldset id="edd_discount_code">
		<p>
			<label class="edd-label" for="edd-discount">
				<?php _e( 'Discount', 'my-child-theme' ); ?>
				<img src="<?php echo EDD_PLUGIN_URL; ?>assets/images/loading.gif" id="edd-discount-loader" style="display:none;"/>
			</label>
			<span class="edd-description"><?php _e( 'Enter a coupon code if you have one.', 'my-child-theme' ); ?></span>
			<input class="edd-input" type="text" id="edd-discount" name="edd-discount" placeholder="<?php _e( 'Enter discount', 'my-child-theme' ); ?>"/>
			
		</p>
	</fieldset>
	<?php
	}
}
add_action( 'edd_checkout_form_top', 'sumobi_edd_show_discount_field', -1 );