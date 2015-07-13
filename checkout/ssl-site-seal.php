<?php

/**
 * Add Security Info to the Checkout
 *
 * Replace the image with the proper image for your SSL certificate
 */
function pw_eddwp_add_security_info() {
?>
	<a href="https://www.PositiveSSL.com" id="ssl-seal" title="SSL Certificate Authority" style="font-family: arial; font-size: 10px; text-decoration: none;">
		<img src="https://www.positivessl.com/images/seals/PositiveSSL_tl_trans.gif" alt="SSL Certificate Authority" title="SSL Certificate Authority" border="0"/><br>SSL Certificate Authority
	</a>
<?php
}
add_action( 'edd_after_cc_expiration', 'pw_eddwp_add_security_info' );