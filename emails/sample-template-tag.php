<?php

/*
 * This is an example of how to register a new email template tag for EDD
 *
 * These template tags can be used in the purchase receipt and admin sale notification emails 
 *
 */ 
class EDD_Sample_Email_Tag {
 
	function __construct() {
 
		add_action( 'edd_add_email_tags', array( $this, 'add_sample_tag' ), 100 );
 
	}
 
	public function add_sample_tag() {
 
		edd_add_email_tag( 'replace_with_your_tag', 'Put your tag description here', array( $this, 'render_tag_content' ) );
 
	}
 
	public function render_tag_content( $payment_id = 0 ) {
 
		$output     = '';
		$cart_items = edd_get_payment_meta_cart_details( $payment_id, true );
		
		foreach( $cart_items as $item ) {
			// do something to $output for each cart item
		}
 
		return $output;
 
	}
 
 
}
new EDD_Sample_Email_Tag;