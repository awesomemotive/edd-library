<?php

/**
 * Exclude downloads from search
*/
function sumobi_download_post_type_args( $download_args ) {
	$download_args['exclude_from_search'] = true;

	return $download_args;
}
add_filter( 'edd_download_post_type_args', 'sumobi_download_post_type_args' );