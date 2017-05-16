<?php
/*
 * Plugin Name: Easy Digital Downloads - Disable Product Renewal Discount
 * Disables renewal discount for specific product
 *
 * Replace 566 with the ID of the product you wish to disable the renewal discount for
 */
function pw_edd_disable_product_renewal_discount( $renewal_discount, $license_id ) {
	$license = edd_software_licensing()->get_license( $license_id );
	
	if( 566 == $license->download_id ) {
		$renewal_discount = 0;
	}

	return $renewal_discount;
}
add_filter( 'edd_sl_renewal_discount_percentage', 'pw_edd_disable_product_renewal_discount', 10, 2 );