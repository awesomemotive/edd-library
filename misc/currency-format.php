<?php
/*
 * Plugin Name: EDD Format USD Currency
 * Description: Displays $ as USD
 *
 */

/*
 * This will make $10 be displayed as 10 USD
 *
 * To set this up for your own currency, replace USD with your currency code or the sign you wish to use
 * and replace usd in the add_filter call with the lowercase currency code.
 *
 */
function pw_edd_custom_currency_format( $formatted, $currency, $price ) {
	return $price . ' USD';
}
add_filter( 'edd_usd_currency_filter_before', 'pw_edd_custom_currency_format', 10, 3 );
add_filter( 'edd_usd_currency_filter_after', 'pw_edd_custom_currency_format', 10, 3 );
