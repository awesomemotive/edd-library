<?php
/*
 * Plugin Name: Easy Digital Downloads - Checkout Cart Thumbnail Size
 * Description: Adjust the dimensions of the product thumbnails displayed in the checkout cart.
 * Author: EDD Team
 * Version: 1.0
 */

function custom_change_checkout_thumb_image_size( $dimensions ) {
	$dimensions = array( 60, 60 ); // array( width, height ) in pixels
	return $dimensions;
}
add_filter( 'edd_checkout_image_size', 'custom_change_checkout_thumb_image_size' );