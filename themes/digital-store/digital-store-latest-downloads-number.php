<?php
/**
 * Plugin Name: Easy Digital Downloads - Digital Store Theme - Latest Downloads Number
 * Description: Changes the number of downloads displayed in the latest downloads section of the store front template.
 */
function jp_ds_latest_downloads( $atts ) {
	$atts['limit'] = 3; // Set this number to whatever you want
	return $atts;
}
add_filter( 'digitalstore_latest_downloads_atts', 'jp_ds_latest_downloads' );