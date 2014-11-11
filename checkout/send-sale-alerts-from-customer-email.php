<?php
/*
 * Plugin Name: Easy Digital Downloads - Send Sale Alerts From Customer Email
 * Description: Sets the From address of New Sale alert emails to the customer's email address
 * Author: Pippin Williamson
 * Contributors: mordauk
 * Version: 1.0
 */

class EDD_SAFCE {

	public function __construct() {

		add_action( 'edd_admin_sale_notice', array( $this, 'set_payment_id' ), -1000, 2 );
		add_action( 'edd_email_send_before', array( $this, 'set_from_address' ) );

	}

	public function set_payment_id( $payment_id, $payment_data ) {

		global $edd_payment_id;
		$edd_payment_id = $payment_id;

	}

	public function set_from_address( $emails_class ) {

		global $edd_payment_id;

		if( empty( $edd_payment_id ) ) {
			return;
		}

		$emails_class->from_address = edd_get_payment_user_email( $edd_payment_id );

	}

}
new EDD_SAFCE;