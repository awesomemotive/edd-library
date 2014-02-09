<?php
 
/*
 * Modify the required fields for checkout
 *
 * Fields are identified by the input fields "name" attribute.
 *
 * This example shows how to make the last name field, which has a name attribute of "edd_last", required
 */
function pw_edd_purchase_form_required_fields( $required_fields ) {
 
 	// Set a field as required
    $required_fields['edd_last'] = array(   
        'error_id'      => 'invalid_last_name',
        'error_message' => __( 'Please enter your last name.', 'edd' )
    );

    /*
     * If you wanted to remove a field from required list
	 * you would simply unset the array key
	 */
    // unset( $required_fields['edd_first'] );
 
    return $required_fields;
}
add_filter( 'edd_purchase_form_required_fields', 'pw_edd_purchase_form_required_fields' );