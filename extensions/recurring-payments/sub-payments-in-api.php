<?php

/*
 * Include EDD Subscription payments in the /edd-api/sales endpoint
 *
 */
function pw_edd_recurring_include_payments_in_api( $query ) {
  
  if( ! defined( 'EDD_DOING_API' ) || ! EDD_DOING_API ) {
    return;
  }

  $query->__set( 'post_status', array( 'publish', 'complete', 'edd_subscription' ) );

}
add_action( 'edd_pre_get_payments', 'pw_edd_recurring_include_payments_in_api', 100 );
