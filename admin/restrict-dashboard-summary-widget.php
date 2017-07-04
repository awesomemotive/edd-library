<?php
/*
 * Plugin Name: Easy Digital Downloads - Restrict Dashboard Summary Widget
 * Description: Prevent specific users (by user ID) from seeing the Easy Digital Downloads Sales Summary widget.
 * Author: EDD Team
 * Version: 1.0
 */

// remove sales summary widget
remove_action( 'wp_dashboard_setup', 'edd_register_dashboard_widgets', 10 );

// add sales summary widget with new conditions
function custom_edd_register_dashboard_widgets() {
	$user_id = get_current_user_id();

	// comma separated list of user IDs to restrict - adjust as needed
	$no_access = array( 10, 20, 30 );

	// allow view of sales summary only if admin and is not on the restricted list
	if ( current_user_can( 'view_shop_reports' ) && !in_array( $user_id, $no_access ) ) {
		wp_add_dashboard_widget( 'edd_dashboard_sales', __( 'Easy Digital Downloads Sales Summary','easy-digital-downloads' ), 'edd_dashboard_sales_widget' );
	} else {
		return;
	}
}
add_action( 'wp_dashboard_setup', 'custom_edd_register_dashboard_widgets', 10 );