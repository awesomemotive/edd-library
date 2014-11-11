<?php
/**
 * Adds label and comma-separated terms list to [downloads] shortcode based on taxonomy
 */

function sd_edd_downloads_shortcode_display_terms() {
	
	// use "download_category" for categories and "download_tag" for tags
    the_terms( $post->ID, 'download_category', '<span class="download-terms-label">Categories:</span> ', ', ', '' );
}
add_action( 'edd_download_after', 'sd_edd_downloads_shortcode_display_terms' );