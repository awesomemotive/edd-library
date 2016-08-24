<?php
/*
 * Plugin Name: Easy Digital Downloads - Remove Decimals 
 * Description: Removes decimal places from all prices
 * Author: Pippin Williamson
 * Version: 1.0
 */ 
 
function pw_edd_remove_decimals( $decimals ) {
 
	return 0;
}
add_filter( 'edd_format_amount_decimals', 'pw_edd_remove_decimals' );
