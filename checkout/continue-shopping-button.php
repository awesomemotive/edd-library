<?php
/*
 * Plugin Name: Continue Shopping Button
 * Description: Adds a continue shopping button to the left of the Update/Save Cart buttons on checkout
 * Author: Chirs Klosowski
 * Version: 1.0
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