<?php
/*
 * Plugin Name: Easy Digital Downloads - Purchase Button Custom Add to Cart Link
 * Description: Below all EDD purchase buttons, display a link to add that product to the cart and go straight to checkout.
 * Author: EDD Team
 * Version: 1.0
 */

function custom_purchase_button_cart_link() {
	?>
	<a href="<?php echo edd_get_checkout_uri() . '?edd_action=add_to_cart&download_id=' . get_the_ID(); ?>">Buy Now</a>
	<?php
	}
add_action( 'edd_purchase_link_end', 'custom_purchase_button_cart_link' );