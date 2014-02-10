<?php

/**
 * Reverse variable pricing. Great for when you've added variable prices lowest to highest but want to show highest to lowest without re-adding all the variable prices
*/
function sumobi_edd_purchase_variable_prices( $variable_prices, $download_id ) {
	krsort( $variable_prices );

	return $variable_prices;
}
add_filter( 'edd_purchase_variable_prices', 'sumobi_edd_purchase_variable_prices', 10, 2 );

/**
 * make sure the last option in array is checked (highest priced item)
*/
function sumobi_edd_price_option_checked( $checked, $download_id, $key ) {
	$prices = edd_get_variable_prices( $download_id );
	end( $prices );

	$checked = key( $prices );
	return $checked;
}
add_filter( 'edd_price_option_checked', 'sumobi_edd_price_option_checked', 10, 3 );