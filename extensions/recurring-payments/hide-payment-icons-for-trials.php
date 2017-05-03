<?php
/**
 * Plugin Name: Easy Digital Downloads - Hide payment icons for trials
 * Plugin URI: https://easydigitaldownloads.com/downloads/recurring-paymets
 * Description: Hides the payment icons on checkout when the item in the card is a free trial
 * Version: 0.0.1
 * Author: Chris Klosowski
 * Author URI: https://easydigitaldownloads.com
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function edd_library_maybe_show_payment_icons() {
	if ( EDD_Recurring()->cart_has_free_trial() ) {
		remove_action( 'edd_payment_mode_top', 'edd_show_payment_icons' );
		remove_action( 'edd_checkout_form_top', 'edd_show_payment_icons' );
	}
}
add_action( 'init', 'edd_library_maybe_show_payment_icons', 99 );