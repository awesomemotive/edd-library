<?php
 
/*
 * Adds pagination links to the top of the [downloads] short code
 */
function pw_edd_duplicate_pagination() {
?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var html = $('#edd_download_pagination').clone();
		html.attr('id', 'edd_download_pagination_top');
		html.insertBefore( '.edd_downloads_list' );
	});
	</script>
<?php
}
add_action( 'wp_footer', 'pw_edd_duplicate_pagination' );