<?php

/**
 * Enable revisions. Note this will be added into core from EDD v2.0
*/
function sumobi_edd_modify_edd_download_supports( $supports ) {
	$supports[] = 'revisions';
	return $supports;	
}
add_filter( 'edd_download_supports', 'sumobi_edd_modify_edd_download_supports' );