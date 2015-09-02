<?php
function jp_fes_email_admin_auto_approve( $user_id, $userdata ) {

	$to = apply_filters('fes_registration_form_pending_vendor_to_admin', edd_get_admin_notice_emails(), $userdata );
	$from_name = isset( $edd_options[ 'from_name' ] ) ? $edd_options[ 'from_name' ] : get_bloginfo( 'name' );
	$from_email = isset( $edd_options[ 'from_email' ] ) ? $edd_options[ 'from_email' ] : get_option( 'admin_email' );
	$subject = apply_filters('fes_registration_form_to_admin_subject', __('New Vendor Application Received', 'edd_fes' ) );
	$message = EDD_FES()->helper->get_option( 'fes-admin-new-app-email', '' );
	$type = "user";
	$id = $user_id;
	$args = array( 'permissions' => 'fes-admin-new-app-email-toggle');
	EDD_FES()->emails->send_email( $to , $from_name, $from_email, $subject, $message, $type, $id, $args );
}
add_action( 'fes_registration_form_frontend_vendor', 'jp_fes_email_admin_auto_approve', 10, 2 );