<?php

/*
 * This snippet will provide customers with one year of access to to subscription content
 * when they make a purchase
 */
function pw_edd_give_subscription_on_purchase( $payment_id ) {
	
	$user_id = edd_get_payment_user_id( $payment_id );
	if( empty( $user_id ) || $user_id < 1 ) {
		return;
	}

	if( ! class_exists( 'EDD_Recurring_Customer' ) ) {
		return;
	}

	$customer = new EDD_Recurring_Customer;
	$customer->set_as_subscriber( $user_id );
	$customer->set_customer_payment_id( $payment_id );
	$customer->set_customer_status( $user_id, 'active' );
	$customer->set_customer_expiration( $user_id, strtotime( '+1 year' ) );

}
add_action( 'edd_complete_purchase', 'pw_edd_give_subscription_on_purchase' );