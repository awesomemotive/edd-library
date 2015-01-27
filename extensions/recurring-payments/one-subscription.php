<?php
/**
 * Plugin Name: Easy Digital Downloads - Single Subscription
 * Description: Prevents customers from purchasing multiple subscriptions
 * Version: 1.0
 * Author: Pippin Williamson
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: edd
 * Domain Path: /languages/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

function pw_edd_recurring_limit_one_subscription( $valid_data, $post_data ) {
	
	if( ! class_exists( 'EDD_Recurring_Customer' ) ) {
		return;
	}

	if( ! is_user_logged_in() ) {
		return;
	}

	if( EDD_Recurring_Customer::is_customer_active() ) {
		edd_set_error( edd-one-subscription', __( 'You already have an active subscription so may not purchase a second one.', 'edd' ) );
	}

}
add_action( 'edd_checkout_error_checks', 'pw_edd_recurring_limit_one_subscription' );