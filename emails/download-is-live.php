<?php
/*
 *
 * Sends an email to the author of the download when published.  
 *
 */ 

function cl_edd_emailNotificationDownloadPublished($post_id) {

	if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {

		$post = get_post($post_id);
		$author = get_userdata($post->post_author);
		$author_email = $author->user_email;
		$message = "Hi ".$author->display_name.",

Your download, ".$post->post_title." is now live!

".get_permalink( $post_id )."

Let me know if you have any questions or need assistance.

Cheers,

";
		wp_mail($author_email, "Your Download Is Live!", $message);

	}
}
add_action('publish_download', 'cl_edd_emailNotificationDownloadPublished');
