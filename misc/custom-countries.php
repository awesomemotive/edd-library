<?php
 
 /*
  * Illustrates how to add a custom list of countries
  *
  * This list will be used anywhere EDD outputs a list of countries
  * The format should be "COUNTRY CODE" => "Country Name"
  *
  */
function pw_edd_custom_countries( $countries = array() ) {
	$countries = array(
		'US' => 'United States',
		'CA' => 'Canada'
	);
	return $countries;
}
add_filter( 'edd_countries', 'pw_edd_custom_countries' );