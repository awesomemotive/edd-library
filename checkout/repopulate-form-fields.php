<?php 

/**
 * Add javascript to the checkout page to repopulate the checkout form fields with user submitted data.
 */
static function edd_enqueue_checkout_repopulate_js() {
	// Make sure there's form data in the session.
	if ( ! isset( $_SESSION['edd']['edd_purchase'] ) ) {
		return;
	}

	// Ensure this is the checkout page (NOTE: CHANGE THIS IF YOUR CHECKOUT PAGE IS CALLED SOMETHING DIFFERENT).
	if ( ! is_page( 'checkout' ) ) {
		return;
	}


	// Register the script (NOTE: CHANGE THE FILE PATH IF YOU PUT THE JS FILE SOMEWHERE DIFFERENT).
	wp_register_script(
		'checkout_repopulate',
		get_stylesheet_directory_uri() . '/js/repopulate-form-fields.js'
	);

	// Localize the script with the session data.
	$localize_array = array(
		'form_data' => maybe_unserialize( $_SESSION['edd']['edd_purchase'] )
	);
	wp_localize_script( 'checkout_repopulate', 'checkout_repopulate', $localize_array );

	// Enqueued script with localized data.
	wp_enqueue_script( 'checkout_repopulate' );
}

add_action( 'wp_enqueue_scripts', 'edd_enqueue_checkout_repopulate_js' );
