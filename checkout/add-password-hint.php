<?php
/**
 * Add standard WP password hint to checkout right below account creation fields.
 */
function pd_add_standard_wp_password_hint() {
	?>

	<p id="edd-password-hint-wrap">
		<?php echo wp_get_password_hint(); ?>
	</p>

	<?php
}
add_action( 'edd_register_account_fields_after', 'pd_add_standard_wp_password_hint', 10, 2 );
