<?php
/*
Plugin Name: Easy Digital Downloads - Remove Manage Sites
Description: Removes the Manage Sites column from the licenses table on customer purchase history page
Version: 0.1
Author: Easy Digital Downloads
Author URI: https://easydigitaldownloads.com
Contributors: easydigitaldownloads, brashrebel
*/

function kjm_remove_manage_sites_link() {
	if ( isset( $_GET['action'] ) && $_GET['action'] == 'manage_licenses' ) {
		add_filter( 'edd_sl_force_activation_increase', '__return_true' );
	}
}
add_action( 'wp_head', 'kjm_remove_manage_sites_link' );
