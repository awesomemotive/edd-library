<?php

/*
 * This function illustrates how to add a custom row of HTML to the checkout shopping cart
 */
function edd_custom_cart_row_text() {
?>
	<tr>
		<td colspan="4">This is your custom text</td>
	</tr>
<?php
}
add_action( 'edd_cart_items_after', 'edd_custom_cart_row_text' );