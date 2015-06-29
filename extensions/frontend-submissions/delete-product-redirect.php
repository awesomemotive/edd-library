<?php
/**
* Plugin Name: Change Vendor Delete Product Redirect
* Author: Kyle Maurer
*/

function kjm_change_vendor_delete_product_redirect() {
	$redirect_to = get_permalink( EDD_FES()->helper->get_option( 'fes-vendor-dashboard-page', false ) );
	$redirect_to = add_query_arg( array(
			'task' => 'products'
		), $redirect_to );
	wp_redirect( $redirect_to );
	exit;
}
add_action( 'fes_vendor_delete_product', 'kjm_change_vendor_delete_product_redirect' );
