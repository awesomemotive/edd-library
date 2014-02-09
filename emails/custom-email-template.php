<?php
// create the HTML for the custom template
function pw_edd_custom_email_template() {	
 
	echo '<div style="width: 550px; border: 1px solid #1e79c0; background: #ddd; padding: 8px 10px; margin: 0 auto;">';
		echo '<div id="edd-email-content" style="background: #f0f0f0; border: 1px solid #9ac7e1; padding: 10px;">';
			echo '{email}'; // this tag is required in order for the contents of the email to be shown
		echo '</div>';	
	echo '</div>';
 
}
add_action('edd_email_template_my_custom_template', 'pw_edd_custom_email_template');
 
// register the custom email template
function pw_edd_get_email_templates( $templates ) {
 
	$templates['my_custom_template'] = 'My Custom Template Name';
 
	return $templates;
}
add_filter('edd_email_templates', 'pw_edd_get_email_templates');