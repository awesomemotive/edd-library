<?php
 
 /*
  * Change user role for buyers
  *
  * This is useful if, for example, you want buyers to be able to access dedicated content on your website
  * (buyers-only support forums, tutorials, etc...)
  *
  */
function ao_edd_set_customer_role( $payment_id ) {

	$email     = edd_get_payment_user_email( $payment_id );
	$downloads = edd_get_payment_meta_downloads( $payment_id );
	$user_id   = edd_get_payment_user_id( $payment_id );

	if( $user_id ) {
		$user = new WP_User( $user_id );
		// Add role
		$user->add_role( 'buyer' );
	}
}
add_action( 'edd_complete_purchase', 'ao_edd_set_customer_role', 100 );