<?php
function jp_disable_wish_list() {
	// replace category-goes-here below with your category slug
	if ( is_singular( 'download') && is_object_in_term( get_the_ID(), 'download_category', 'category-slug-goes-here' ) ) {
		remove_action( 'edd_purchase_link_top', 'edd_wl_load_wish_list_link' );
	}
}
add_action( 'template_redirect', 'jp_disable_wish_list', 100 );