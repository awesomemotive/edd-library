<?php

/*
 * Modify the user role that is given to users that register during checkout
 */
function pw_edd_customer_user_role( $user_args, $user_data ) {
	
	// Set the role to the role you wish customers to have
	$user_args['role'] = 'customer';

	return $user_args;
}
add_filter( 'edd_insert_user_args', 'pw_edd_customer_user_role', 10, 2 );