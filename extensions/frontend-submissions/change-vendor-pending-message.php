<?php
/**
* Plugin Name: Change Vendor Pending Message
* Author: Kyle Maurer
*/

function kjm_change_vendor_pending_message() {
	return 'My new message!';
}
add_action( 'fes_application_pending_message', 'kjm_change_vendor_pending_message' );
