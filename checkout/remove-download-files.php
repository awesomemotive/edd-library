<?php

/*
 * Remove download links from checkout page for all downloads
 */  
function sumobi_edd_receipt_show_download_files() {
	return false;
}
add_filter( 'edd_receipt_show_download_files', 'sumobi_edd_receipt_show_download_files' );