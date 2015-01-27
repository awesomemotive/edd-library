<?php
/*
 * Plugin Name: EDD - Remove Free Text
 */

function pw_edd_remove_free( $form, $args ) {
	
	$form = str_replace( 'Free&nbsp;&ndash;&nbsp;Add to Cart', 'Add to Cart' , $form );

	return $form;
}
add_filter( 'edd_purchase_download_form', 'pw_edd_remove_free', 10, 2 );