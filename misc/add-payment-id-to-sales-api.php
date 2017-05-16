<?php
/**
* If sequential order numbers are on, those numbers are returned in the sales API
* instead of the actual payment record's ID
* This adds the true payment ID to each sale in the API
*/
function kjm_add_payment_id_to_sales_endpoint( $sales ) {
	
	foreach ( $sales['sales'] as $sale => $data ) {
		// If sequential order numbering is on, the ID key will be a string
		$payment = ( is_string( $data['ID'] ) ) ? edd_get_payment_by('payment_number', $data['ID']) : $data['ID'];
		$payment_id = ( is_object( $payment ) ) ? $payment->ID : $payment;
		$sales['sales'][$sale]['payment_id'] = $payment_id;
	}

	return $sales;
}
add_filter( 'edd_api_sales', 'kjm_add_payment_id_to_sales_endpoint' );
