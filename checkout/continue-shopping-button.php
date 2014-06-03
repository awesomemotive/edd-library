<?php
/**
 * Adds a 'Continue Shopping' button to the left of the Update and Save Cart Buttons on checkout
 */
add_action( 'edd_cart_footer_buttons', 'ck_edd_continue_shopping_button', 1 );
function ck_edd_continue_shopping_button() {
	global $edd_options;

	// Change the 'green' at the end to choose a different color that EDD supports
	$color = isset( $edd_options[ 'checkout_color' ] ) ? $edd_options[ 'checkout_color' ] : 'green';
	$color = ( $color == 'inherit' ) ? '' : $color;
?>
	<a href="<?php echo get_post_type_archive_link( 'download' ); ?>"><div class="edd-submit button<?php echo ' ' . $color; ?>"><?php _e( 'Continue Shopping', 'edd' ); ?></div></a>
<?php

}