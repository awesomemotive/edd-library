<?php
 
 /*
  * Change user role for buyers
  *
  * This is useful if, for example, you want buyers to be able to access dedicated content on your website
  * (buyers-only support forums, tutorials, etc...)
  *
  */
  
// update user role from "subscriber" to "buyer" when purchase is completed
function ao_edd_run_when_purchase_complete( $payment_id ) {
        $email = edd_get_payment_user_email( $payment_id );
        $downloads = edd_get_payment_meta_downloads( $payment_id );
        $user_id   = edd_get_payment_user_id( $payment_id );
        if( is_array( $downloads ) ) {
// Increase purchase count and earnings
        foreach( $downloads as $download ) {
// Get product ID
        $download_id = $download['340'];
// Do stuff here for each product purchased
        $user = new WP_User( $user_id );
       // Add role
       $user->add_role( 'buyer' );
        }
 }
}

add_action( 'edd_complete_purchase', 'ao_edd_run_when_purchase_complete', 100, 3 );
