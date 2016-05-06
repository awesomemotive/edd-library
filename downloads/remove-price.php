<?php

/*
 * Removes the price from all add to cart buttons
 */
function pw_edd_remove_price( $args ) {
	
	$args['price'] = 'no';

	return $args;
}
add_filter( 'edd_purchase_link_defaults', 'pw_edd_remove_price' );