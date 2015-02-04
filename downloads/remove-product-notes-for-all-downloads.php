<?php
/*
 * Plugin Name: Easy Digital Downloads - Remove Product Notes For All Downloads
 * Description: Remove product notes from all downloads. These show on the purchase confirmation page, the admin email and customer’s purchase receipt.
 * Author: Andrew Munro
 * Version: 1.0
 */

add_filter( 'edd_product_notes', '__return_false' );