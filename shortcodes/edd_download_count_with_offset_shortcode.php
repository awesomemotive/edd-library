<?php

// Optional attributs supported : id, offset
function edd_download_count_shortcode( $atts ) {
    $post_id = get_the_ID();
    $a = shortcode_atts( array(
      'offset' => 0,
      'id' => $post_id,
    ), $atts );
  
  if( function_exists( 'edd_get_download_sales_stats' ) ) {
  	$download_count = edd_get_download_sales_stats( $a['id'] ) + $a['offset'];
  } else {
    $download_count = false;
  }
  return $download_count;
}

add_shortcode( 'edd_download_count', 'edd_download_count_shortcode' );
