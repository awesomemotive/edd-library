<?php
 
/*
 * Prevent variable pricing options from being checked by default
 */ 
function sumobi_edd_price_option_checked( $checked, $download_id, $key ) {
	return '';
}
add_filter( 'edd_price_option_checked', 'sumobi_edd_price_option_checked', 10, 3 );