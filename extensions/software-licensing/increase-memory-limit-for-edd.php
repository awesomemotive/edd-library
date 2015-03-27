<?php
/**
 * Plugin Name: EDD - Increase Memory Limit During Download Delivery
 * Plugin URI: https://github.com/easydigitaldownloads/library/
 * Description: Increase the memory limit of your server to support delivery of large downloads.
 * Version: 0.0.1
 * Author: NateWr
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
if ( ! defined( 'ABSPATH' ) ) exit;

// Increase memory limit during regular download processes
if ( !function_exists( 'eddiml_increase_memory_limit' ) ) {
function eddiml_increase_memory_limit( $download, $email, $payment ) {

	@ini_set( 'memory_limit', '256M' );

}
add_action( 'edd_process_verified_download', 'eddiml_increase_memory_limit', 10, 3 );
} // endif

// Increase memory limit during Software Licensing's API-based updates
if ( !function_exists( 'eddsliml_increase_memory_limit' ) ) {
function eddsliml_increase_memory_limit() {

	@ini_set( 'memory_limit', '256M' );

}
add_action( 'edd_sl_before_package_download', 'eddsliml_increase_memory_limit' );
} // endif
