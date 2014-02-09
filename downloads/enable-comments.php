<?php

/*
 * Adds comment support to the download post type
 */
function pw_edd_comments() {
	add_post_type_support( 'download', 'comments' );
}
add_action( 'init', 'pw_edd_comments', 999 );