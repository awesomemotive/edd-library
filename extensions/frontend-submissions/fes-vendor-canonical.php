<?php
/**
 * Plugin Name: Easy Digital Downloads - Frontend Submissions - Vendor Canonical Links
 * Description: Makes the vendor canonical links go to yoursite/vendor/vendor-name instead of yoursite/vendor.
 * Author: John Parris
 */
function jp_maybe_fix_canonical() {
	if ( get_query_var( 'vendor' ) ) {
		remove_action( 'wp_head', 'rel_canonical' );
		add_action( 'wp_head', 'jp_fix_canonical' );
	}
}
add_action( 'template_redirect', 'jp_maybe_fix_canonical' );


function jp_fix_canonical() {
	$link = home_url( 'vendor/' );

	if ( $vendor = get_query_var( 'vendor' ) ) {
		$link .= $vendor . '/';
	}

	echo '<link rel="canonical" href="' . esc_url( $link ) . '" />';
}