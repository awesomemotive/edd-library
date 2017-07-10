/**
* Disable renewal emails for specific download
*/
function kjm_disable_renewal_notice( $send, $subsciption_id ) {
	$subscription = new EDD_Subscription( $subsciption_id );
	$purchased_product = $subscription->product_id;
	// Set this to be the ID of the download you wish to disable renewal notices for
	$no_email_product = 123;
	if ( $purchased_product == $no_email_product ) {
		$send = false;
	}
	return $send;
}
add_filter( 'edd_recurring_send_reminder', 'kjm_disable_renewal_notice', 10, 2 );
