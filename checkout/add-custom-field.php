<?php
/**
 * Adding a custom field to the checkout screen
 *
 * Covers:
 * 
 * Adding a phone number field to the checkout
 * Making the phone number field required
 * Setting an error when the phone number field is not filled out
 * Storing the phone number into the payment meta
 * Adding the customer's phone number to the "view order details" screen
 * Adding a new {phone} email tag so you can display the phone number in the email notifications (standard purchase receipt or admin notification)
 */


/**
 * Display phone number field at checkout
 * Add more here if you need to
 */
function sumobi_edd_display_checkout_fields() {
?>
    <p id="edd-phone-wrap">
        <label class="edd-label" for="edd-phone">
        	<?php echo 'Phone Number'; ?>
        </label>
        <span class="edd-description">
        	<?php echo 'Enter your phone number so we can get in touch with you.'; ?>
        </span>
        <input class="edd-input" type="text" name="edd_phone" id="edd-phone" placeholder="<?php echo 'Phone Number'; ?>" />
    </p>
    <?php
}
add_action( 'edd_purchase_form_user_info_fields', 'sumobi_edd_display_checkout_fields' );

/**
 * Make phone number required
 * Add more required fields here if you need to
 */
function sumobi_edd_required_checkout_fields( $required_fields ) {
	$required_fields = array(
		'edd_phone' => array(
			'error_id' => 'invalid_phone',
			'error_message' => 'Please enter a valid Phone number'
		),
	);

	return $required_fields;
}
add_filter( 'edd_purchase_form_required_fields', 'sumobi_edd_required_checkout_fields' );

/**
 * Set error if phone number field is empty
 * You can do additional error checking here if required
 */
function sumobi_edd_validate_checkout_fields( $valid_data, $data ) {
    if ( empty( $data['edd_phone'] ) ) {
        edd_set_error( 'invalid_phone', 'Please enter your phone number.' );
    }
}
add_action( 'edd_checkout_error_checks', 'sumobi_edd_validate_checkout_fields', 10, 2 );

/**
 * Store the custom field data into EDD's payment meta
 */
function sumobi_edd_store_custom_fields( $payment_meta ) {
    $payment_meta['phone'] = isset( $_POST['edd_phone'] ) ? sanitize_text_field( $_POST['edd_phone'] ) : '';
    
    return $payment_meta;
}
add_filter( 'edd_payment_meta', 'sumobi_edd_store_custom_fields');


/**
 * Add the phone number to the "View Order Details" page
 */
function sumobi_edd_view_order_details( $payment_meta, $user_info ) {
	$phone = isset( $payment_meta['phone'] ) ? $payment_meta['phone'] : 'none';
?>
    <div class="column-container">
    	<div class="column">
    		<strong><?php echo 'Phone: '; ?></strong>
    		 <?php echo $phone; ?>	
    	</div>
    </div>
<?php
}
add_action( 'edd_payment_personal_details_list', 'sumobi_edd_view_order_details', 10, 2 );

/**
 * Add a {phone} tag for use in either the purchase receipt email or admin notification emails
 */
edd_add_email_tag( 'phone', 'Customer\'s phone number', 'sumobi_edd_email_tag_phone' );

/**
 * The {phone} email tag
 */
function sumobi_edd_email_tag_phone( $payment_id ) {
	$payment_data = edd_get_payment_meta( $payment_id );
	return $payment_data['phone'];
}
