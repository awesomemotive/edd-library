<?php 
/*
Plugin Name: EDD FES - Display Vendor-Submitted data as Restricted Content.
Plugin URL: https://github.com/easydigitaldownloads/library/blob/master/extensions/frontend-submissions/submission-form-redirect.php
Description: Automatically output content submitted by FES Vendors wrapped in the [edd_restrict] shortcode.
Version: 1.0
Author: Phil Johnston
Author URI: https://mintplugins.com/
*/

/**
 * This function demonstrates how to automatically display a field of content with the meta key 'my_prefix_restricted_content' (submitted 
 * through FES) to the content of the Product in question while wrapped in the edd_restrict shortcode.
 * Note: you can re-use this chunk for any field from your Submission form by swapping "my_prefix_restricted_content" with your field's custom meta_key.
 * An example of why you might use this: If you want to unlock/show a Vimeo/Youtube video only to customers who've purchased the product. 
 * For example, if you are setting up a video rental website, you could use this to display videos to customers after they purchase.
 *
 * @since	1.0.0
 * @param	string $content The content that will be shown for this post.
 * @return	string $content The content that will be shown for this post.
 */
function my_prefix_display_locked_video( $the_content ){
	if ($GLOBALS['post']->post_type != 'download') {
		return $content;
	}
	
	$restricted_content = '[edd_restrict id="' . $GLOBALS['post']->ID . '"]';
		$restricted_content .= wp_oembed_get( get_post_meta( $GLOBALS['post']->ID, 'my_prefix_restricted_content', true ) );
	$restricted_content .= '[/edd_restrict]';
	
	return $the_content . $restricted_content;
}
add_filter( 'the_content', 'my_prefix_display_locked_video' );