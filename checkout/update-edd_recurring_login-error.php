<?php

/**
 * Some checkout forms require the customer to be logged in. However the 
 * checkout form does not include a link to a sign in form. This updates 
 * the error to include a link.
 **/
function add_signin_link_to_checkout_error() {

	// Only do this if there is an edd error in the session.
	 if ( isset( $_SESSION['edd'] ) && isset( $_SESSION['edd']['edd_errors'] ) ) {

			// unserialize the errors, so we can check for the one we want.
			$errors = maybe_unserialize( $_SESSION['edd']['edd_errors'] );

			// If the edd_recurring_login error is set.
			if ( isset( $errors['edd_recurring_login'] ) ) {

				// Update the error to include our link.
				 $errors['edd_recurring_login'] = sprintf(
				 	'It looks like you have an account. Please sign in to check out. <a href="%s?redirect=%s">Sign into your account.</a>',
				 		site_url( '/signin/' ),
				 		urlencode( site_url( '/checkout/' ) )
				 	);

				// Readd the new error to the session.
				$_SESSION['edd']['edd_errors'] = serialize( $errors );
			}
	 }
}

add_action('init', 'add_signin_link_to_checkout_error');
