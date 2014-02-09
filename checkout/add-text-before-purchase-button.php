<?php

/*
 * Add custom text just before the "Purchase" button at checkout
 */ 
function sumobi_edd_purchase_form_before_submit() { ?>
	<p>Your custom text</p>
<?php }
add_action( 'edd_purchase_form_before_submit', 'sumobi_edd_purchase_form_before_submit', 1000 );