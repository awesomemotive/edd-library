<?php
/*
 * Plugin Name: Download Column Thumbnail
 * Description: Render a new post column featuring the download thumbnail.
 * Author: Cor van Noorloos
 * Version: 1.0.1
 */

add_filter( 'manage_edit-download_columns', 'cor_edd_manage_edit_download_columns' );
/**
 * Insert the thumbnail column.
 */
function cor_edd_manage_edit_download_columns( $columns ) {
	$column_thumbnail = array( 'icon' => false );

	return array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
}

add_action( 'manage_download_posts_custom_column', 'cor_edd_manage_download_posts_custom_column' );
/**
 * Get the thumbnail.
 */
function cor_edd_manage_download_posts_custom_column( $column_name ) {
	global $post;

	if ( 'icon' === $column_name ) {
		echo get_the_post_thumbnail( $post->ID, array( 80, 60 ) );
	}
}

add_action( 'admin_print_styles-edit.php', 'cor_edd_admin_print_styles_edit' );
/**
 * Column thumbnail specific styles.
 */
function cor_edd_admin_print_styles_edit() {
	$screen = get_current_screen();
	if ( 'edit-download' === $screen->id ) {
		?>
		<style>
			.fixed .column-icon {
				text-align: center;
			}

			.fixed .column-icon img {
				display: inline-block;
				width: auto;
				max-width: 80px;
				height: auto;
				max-height: 60px;
				border: 1px solid #e7e7e7;
				border: 1px solid rgba(0, 0, 0, 0.07);
			}
		</style>
		<?php
	}
}
