<?php
/**
 * Plugin Name: REST API Shopping Cart Endpoint for EDD
 * Plugin URI: https://github.com/easydigitaldownloads/library
 * Description: Adds a REST API endpoint which returns the current user's shopping cart.
 * Version: 0.0.1
 * Author: Nate Wright
 * Author URI: https://github.com/NateWr
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
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
defined( 'ABSPATH' ) || exit;

/**
 * Add a REST endpoint for retrieving the cart
 *
 * This establishes the endpoint at:
 * http://yoursite.com/wp-json/totc/1.0/edd/cart
 */
function totc_edd_rest_endpoints() {

	register_rest_route(
		'totc/1.0',
		'/edd/cart',
		array(
			'methods' => 'GET',
			'callback' => 'totc_edd_rest_cart',
		)
	);
}
add_action( 'rest_api_init', 'totc_edd_rest_endpoints' );

/**
 * Respond to requests to the cart REST endpoint
 *
 * @param $request WP_REST_Request
 */
function totc_edd_rest_cart( WP_REST_Request $request ) {
	return edd_get_cart_content_details();
}
