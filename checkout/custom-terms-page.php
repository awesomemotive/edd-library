<?php

/**
 * Use custom page for "agree to terms" and link to it instead of opening terms in slidedown panel. Good for when you have a lot of text.
 * 
 * Change $page_id to the ID of your terms page below
*/
function sumobi_edd_terms_agreement() {
	global $edd_options;

	if ( isset( $edd_options['show_agree_to_terms'] ) ) : ?>
	
	<fieldset id="edd_terms_agreement">
		<label for="edd_agree_to_terms">
			<?php 
			$page_id = 32; // change this to the ID of your terms page
			echo '<a target="_blank" href="' . get_permalink( $page_id ) . '">Agree to terms?</a>';
			?>
		</label>
		<input name="edd_agree_to_terms" class="required" type="checkbox" id="edd_agree_to_terms" value="1" />
	</fieldset>
	
	<?php endif;
}
remove_action( 'edd_purchase_form_before_submit', 'edd_terms_agreement' );
add_action( 'edd_purchase_form_before_submit', 'sumobi_edd_terms_agreement' );