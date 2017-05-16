<?php

/*
 * Sets renewal discount to 40% for any customer that purchased before April 18, 2016
 */
function pw_edd_grandfather_renewal_discount( $renewal_discount, $license_id ) {

	$license = get_post( $license_id );

	if( strtotime( $license->post_date ) < strtotime( 'April 18, 2016' ) ) {
		$renewal_discount = 40;
	}

	return $renewal_discount;
}
add_filter( 'edd_sl_renewal_discount_percentage', 'pw_edd_grandfather_renewal_discount', 10, 2 );
