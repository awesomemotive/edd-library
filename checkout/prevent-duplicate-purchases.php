<?php // DO NOT COPY THIS LINE

/**
 * Prevents logged-in customers from purchasing an item twice
 *
 */
function pw_edd_prevent_duplicate_purchase( $valid_data, $posted ) {
	
	$cart_contents = edd_get_cart_contents();
	foreach( $cart_contents as $item ) {
		if( edd_has_user_purchased( get_current_user_id(), $item['id'] ) ) {
			edd_set_error( 'duplicate_item', 'You have already purchased this item so may not purchase it again' );
		}
	}
}
add_action( 'edd_checkout_error_checks', 'pw_edd_prevent_duplicate_purchase', 10, 2 );
