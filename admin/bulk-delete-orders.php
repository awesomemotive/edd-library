<?php
/**
 * Plugin Name:         Easy Digital Downloads - Mass Order Delete
 * Plugin URI:          https://easydigitaldownloads.com/
 * Description:         Bulk delete orders from Easy Digital Downloads easily
 * Author:              Chris Christoff
 * Author URI:          http://www.chriscct7.com
 *
 * Version:             1.0
 * Requires at least:   3.6
 * Tested up to:        3.89
 *
 * Text Domain:         edd
 */
function emod_show_menu() {
	global $wpdb;
?>
	<style>
	.widefat td {
		vertical-align: top;
		margin-top: 0px;
		padding-top: 0px;
	}
	.wrap h4, .widefat th {
		padding-top: 0px;
		margin-top: 0px;
	}
	</style>
	<div class="wrap">
		<h2 style="display: run-in;"><?php _e( 'EDD Mass Order Deletion', 'edd' );?></h2><p><?php _e( 'The plugin allows one to mass delete EDD orders. Use with caution.', 'edd' );?></p>
		<table class="form-table" style="margin-top: .5em" width="100%">
			<tbody>
				<tr>
					<td>
						<form method="post">
							<table class="widefat" style="padding: 10px;">
								<tr valign="top">
									<th align="left"><?php _e( 'Delete all orders', 'edd' );?></th>
									<td style="width: 40%;">
										<h4><?php _e( 'Between (inclusive)', 'edd' );?></h4>
										<?php _e( 'Start Year (XXXX format):', 'edd' );?> <input type="text" name="startyear" value="" size="10"> <br />
										<?php _e( 'Start Month (XX format):', 'edd' );?>  <input type="text" name="startmonth" value="" size="10"> <br />
										<?php _e( 'Start Day (XX format):', 'edd' );?>	 <input type="text" name="startday" value="" size="10"> <br />
										<?php _e( 'End Year (XXXX format):', 'edd' );?>	<input type="text" name="endyear" value="" size="10"> <br />
										<?php _e( 'End Month (XX format):', 'edd' );?>	 <input type="text" name="endmonth" value="" size="10"> <br />
										<?php _e( 'End Day (XX format):', 'edd' );?>  <input type="text" name="endday" value="" size="10">
									</td>
									<td style="width: 30%;">
										<h4><?php _e( 'Older Than (inclusive)', 'edd' );?></h4>
										<?php _e( 'Year (XXXX format):', 'edd' );?> <input type="text" name="year" value="" size="10"><br />
										<?php _e( 'Month (XX format):', 'edd' );?><input type="text" name="month" value="" size="10"><br />
										<?php _e( 'Day (XX format):', 'edd' );?> <input type="text" name="day" value="" size="10">
									</td>
									<td style="width: 30%;">
										<h4><?php _e( 'Newer Than (inclusive)', 'edd' );?></h4>
										<?php _e( 'Year (XXXX format):', 'edd' );?> <input type="text" name="newyear" value="" size="10"> <br />
										<?php _e( 'Month (XX format):', 'edd' );?> <input type="text" name="newmonth" value="" size="10"> <br />
										<?php _e( 'Day (XX format):', 'edd' );?> <input type="text" name="newday" value="" size="10">
									</td>
								</tr>
								<tr valign="top">
									<th align="left"><?php _e( 'Order Status(es)', 'edd' );?></th>
									<td align="left">
										<input type="checkbox" name="publish"   > <?php _e( 'Published/Completed', 'edd' );?> &nbsp;&nbsp; <br />
										<input type="checkbox" name="pending"   > <?php _e( 'Pending', 'edd' );?> &nbsp;&nbsp; <br />
										<input type="checkbox" name="refunded"  > <?php _e( 'Refunded', 'edd' );?> &nbsp;&nbsp; <br />
										<input type="checkbox" name="failed"	> <?php _e( 'Failed', 'edd' );?> &nbsp;&nbsp; <br />
										<input type="checkbox" name="revoked"   > <?php _e( 'Revoked', 'edd' );?> &nbsp;&nbsp; <br />
										<input type="checkbox" name="cancelled"   > <?php _e( 'Cancelled', 'edd' );?> &nbsp;&nbsp; <br />
										<input type="checkbox" name="abandoned" > <?php _e( 'Abandoned', 'edd' );?> &nbsp;&nbsp;
								</tr>
									<tr valign="top">
										<th align="left"><?php _e( 'Bypass trash', 'edd' );?></th>
										<td align="left"><input type="checkbox" name="force_delete" checked> -
											<?php _e( 'If checked, orders will be permanently deleted.', 'edd' );?>

									</tr>
									<tr valign="top">
										<th align="left"><?php _e( 'Delete associated log entries', 'edd' );?></th>
										<td align="left"><input type="checkbox" name="delete_logs" checked>
									</tr>
							</table>
							<br />
							<div align="center">
								<input type="submit" name="delete" class="button-primary"
									   value="<?php _e( 'Delete Orders', 'edd' );?>" />
							</div>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
	if ( isset( $_POST[ 'delete' ] ) ) {
		$type   = array();
		$status = array();
		if ( isset( $_POST[ 'publish' ] ) && $_POST[ 'publish' ] == "on" ) {
			$status[] = "publish";
			$status[] = "complete";
		}
		if ( isset( $_POST[ 'pending' ] ) && $_POST[ 'pending' ] == "on" ) {
			$status[] = "pending";
		}
		if ( isset( $_POST[ 'failed' ] ) && $_POST[ 'failed' ] == "on" ) {
			$status[] = "failed";
		}
		if ( isset( $_POST[ 'revoked' ] ) && $_POST[ 'revoked' ] == "on" ) {
			$status[] = "revoked";
		}
		if ( isset( $_POST[ 'cancelled' ] ) && $_POST[ 'cancelled' ] == "on" ) {
			$status[] = "cancelled";
		}
		if ( isset( $_POST[ 'abandoned' ] ) && $_POST[ 'abandoned' ] == "on" ) {
			$status[] = "abandoned";
		}
		$mode = 1;
		if ( isset( $_POST[ 'newyear' ] ) && !empty( $_POST[ 'newyear' ] ) ) {
			$mode = 2;
		}
		if ( isset( $_POST[ 'startyear' ] ) && !empty( $_POST[ 'startyear' ] ) ) {
			$mode = 3;
		}
		@set_time_limit( 60 * 30 );
		if ( $mode === 1 ) {
			$args = array(
				'numberposts' => -1,
				'orderby' => 'post_date',
				'order' => 'ASC',
				'post_type' => 'edd_payment',
				'post_status' => $status,
				'suppress_filters' => 1,
				'fields' => 'ids',
				'date_query' => array(
					array(
						'before' => array(
							'year' => $_POST[ 'year' ],
							'month' => $_POST[ 'month' ],
							'day' => $_POST[ 'day' ]
						),
						'inclusive' => true
					)
				)
			);
		} else if ( $mode === 2 ) {
				$args = array(
					'numberposts' => -1,
					'orderby' => 'post_date',
					'order' => 'ASC',
					'post_type' => 'edd_payment',
					'post_status' => $status,
					'suppress_filters' => 1,
					'fields' => 'ids',
					'date_query' => array(
						array(
							'after' => array(
								'year' => $_POST[ 'newyear' ],
								'month' => $_POST[ 'newmonth' ],
								'day' => $_POST[ 'newday' ]
							),
							'inclusive' => true
						)
					)
				);
			} else {
			$args = array(
				'numberposts' => -1,
				'orderby' => 'post_date',
				'order' => 'ASC',
				'post_type' => 'edd_payment',
				'post_status' => $status,
				'suppress_filters' => 1,
				'fields' => 'ids',
				'date_query' => array(
					array(
						'before' => array(
							'year' => $_POST[ 'startyear' ],
							'month' => $_POST[ 'startmonth' ],
							'day' => $_POST[ 'startday' ]
						),
						'after' => array(
							'year' => $_POST[ 'endyear' ],
							'month' => $_POST[ 'endmonth' ],
							'day' => $_POST[ 'endday' ]
						),
						'inclusive' => true
					)
				)
			);
		}
		$cnt = get_posts( $args );
		if ( $cnt ) {
			$count = count( $cnt );
			echo "<br \><div id=\"message\" class=\"updated fade\">Deleting <strong>$count</strong> item(s)...<br />";
			foreach ( $cnt as $id ) {
				// Don't do it if more than 50
				if ( $count < 50 ) {
					echo "Deleted Order #" . $id . "<br />";
				}
				wp_delete_post( $id, @$_POST[ 'force_delete' ] == "on" );
				if ( isset( $_POST['delete_logs'] ) ) {
					$log_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_edd_log_payment_id' AND meta_value = $id" );
					wp_delete_post( $log_id, true );
				}
			}
			echo "Done!</div><br \>";
			return;
		}
	}
}

function emod_main_menu() {
	add_submenu_page( 'edit.php?post_type=download', __( 'Bulk Delete Orders' ), __( 'Bulk Delete Orders' ), 'manage_options', 'emod_mass_delete', 'emod_show_menu' );
}

if ( is_admin() ) {
	add_action( 'admin_menu', 'emod_main_menu', 9 );
}