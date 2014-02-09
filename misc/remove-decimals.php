<?php

/*
 * Remove decimal places from all prices
 */
function pw_edd_remove_decimals( $decimals ) {
 
	return 0;
}
add_filter( 'edd_format_amount_decimals', 'pw_edd_remove_decimals' );