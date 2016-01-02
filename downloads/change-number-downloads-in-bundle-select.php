<?php

// Remove original bundle item select field which defaults to 30 items
function kjm_remove_old_bundle_field() {
	remove_action( 'edd_meta_box_files_fields', 'edd_render_products_field', 10 );
}
add_action( 'plugins_loaded', 'kjm_remove_old_bundle_field' );

// Add back bundle select field with 'number' specified
function kjm_render_products_field( $post_id ) {

	$type     = edd_get_download_type( $post_id );
	$display  = $type == 'bundle' ? '' : ' style="display:none;"';
	$products = edd_get_bundled_products( $post_id );
?>
	<div id="edd_products"<?php echo $display; ?>>
		<div id="edd_file_fields" class="edd_meta_table_wrap">
			<table class="widefat" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th><?php printf( __( 'Bundled %s:', 'easy-digital-downloads' ), edd_get_label_plural() ); ?></th>
						<?php do_action( 'edd_download_products_table_head', $post_id ); ?>
					</tr>
				</thead>
				<tbody>
					<tr class="edd_repeatable_product_wrapper">
						<td>
							<?php
							echo EDD()->html->product_dropdown( array(
								'name'     => '_edd_bundled_products[]',
								'id'       => 'edd_bundled_products',
								'selected' => $products,
								'multiple' => true,
								'chosen'   => true,
								'bundles'  => false,
								'number'	=> 2 // change this number to specify how many downloads should show
							) );
							?>
						</td>
						<?php do_action( 'edd_download_products_table_row', $post_id ); ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php
}
add_action( 'edd_meta_box_files_fields', 'kjm_render_products_field', 11 );
