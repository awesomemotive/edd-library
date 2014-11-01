<?php
/**
 * Move Single Product Page Message below content
 */

if ( class_exists( 'EDD_Points_Renderer' ) ) { 
	global $edd_points_render;
	remove_action( 'edd_before_download_content', array( $edd_points_render, 'edd_points_message_content' ), 10 );
	add_action( 'edd_after_download_content', array( $edd_points_render, 'edd_points_message_content' ), 0 );
}