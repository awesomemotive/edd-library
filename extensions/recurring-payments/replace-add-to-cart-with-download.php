<?php

/* If the user is recurring or has purcahsed the product already,
 * show a links to download each file associated with the product
 * instead of an Add To Cart Button
 */
add_filter( 'edd_purchase_download_form', 'ck_edd_user_download_button_recurring', 10, 2 );
function ck_edd_user_download_button_recurring( $purchase_form, $args ) {

	if( ! class_exists( 'EDD_Recurring_Customer' ) )
	    return $purchase_form;
	
	if( ! EDD_Recurring_Customer::is_customer_active( get_current_user_id() ) )
	    return $purchase_form;
    
	if ( !is_user_logged_in() )
		return $purchase_form;
 
	$download_id = (string)$args['download_id'];
	$current_user_id = get_current_user_id();

	// If the user has purchased this item, itterate through their purchases to get the specific
	// purchase data and pull out the key and email associated with it. This is necessary for the 
	// generation of the download link
	if ( edd_has_user_purchased( $current_user_id, $download_id, $variable_price_id = null ) ) {
		$user_purchases = edd_get_users_purchases( $current_user_id, -1, false, 'complete' );
		foreach ( $user_purchases as $purchase ) {
			$cart_items    = edd_get_payment_meta_cart_details( $purchase->ID );
			$item_ids = wp_list_pluck( $cart_items, 'id' );
			if ( in_array( $download_id, $item_ids ) ) {
				$email       = edd_get_payment_user_email( $purchase->ID );
				$payment_key = edd_get_payment_key( $purchase->ID );
			}
		}
 
 		// Attempt to get the file data associated with this download
		$download_data = edd_get_download_files( $download_id, null );
		if ( $download_data ) {
			// Setup the style and colors associated with the settings
			global $edd_options;
			$style = isset( $edd_options['button_style'] ) ? $edd_options['button_style'] : 'button';
			$color = isset( $edd_options['checkout_color'] ) ? $edd_options['checkout_color'] : 'blue';
			$new_purchase_form = '';

			foreach ( $download_data as $filekey => $file ) {
 				// Generate the file URL and then make a link to it
				$file_url = edd_get_download_file_url( $payment_key, $email, $filekey, $download_id, null );
				$new_purchase_form .= '<a href="' . $file_url . '" class="' . $style . ' ' . $color . ' edd-submit"><span class="edd-add-to-cart-label">Download ' . $file['name'] . '</span></a>&nbsp;';
			}
		}

		// As long as we ended up with links to show, use them.
		if ( !empty( $new_purchase_form ) )
			$purchase_form = '<h4>' . __( 'You already own this product. Download it now:', 'edd' ) . '</h4>' . $new_purchase_form;
	}
 
	return $purchase_form;
 
}
