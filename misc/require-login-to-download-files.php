<?php
/*
Plugin Name: EDD Force Login
Plugin URI: http://easydigitaldownloads.com
Description: Force users to be logged-in to download purchased files through Easy Digital Downloads
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Version: 1.0
*/

class EDD_Force_Login {

	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load' ) );
	}

	public function load() {
		add_action( 'edd_process_verified_download', array( $this, 'force_login' ), 10, 2 );
	}

	public function force_login( $download, $email ) {
		
		if(  ! is_user_logged_in() ) {
			$login_url = wp_login_url( trailingslashit( home_url() ) . '?' . $_SERVER['QUERY_STRING'] );
			$message = sprintf( 'You must be logged in to download files. <a href="%s">Login here</a>.', $login_url );
			wp_die( $message, 'Error' );
		}

	}

}
$GLOBALS['edd_force_login'] = new EDD_Force_Login();