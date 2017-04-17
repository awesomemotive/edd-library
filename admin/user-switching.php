<?php
/**
 * Plugin Name:       	Easy Digital Downloads - User Switching
 * Plugin URI:        	https://github.com/easydigitaldownloads/library
 * Description:       	Easily switch to a Customer when using the User Switching plugin
 * Version:          	1.0
 * Author:            	GravityView
 * Author URI:        	https://gravityview.co
 * Text Domain:       	edd-user-switching
 * License:           	GPLv2
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.html
 */

add_filter( 'edd_report_customer_columns', 'gv_edd_report_customer_columns_add_user_switching' );

/**
 * Add "Switch To" column to the list of columns in the EDD Customers table
 *
 * @param array $columns
 *
 * @return array
 */
function gv_edd_report_customer_columns_add_user_switching( $columns ) {

	if ( ! class_exists( 'user_switching' ) ) {
	    return $columns;
	}

	$columns['user_switching'] = esc_html__( 'Switch To', 'edd-user-switching' );

	return $columns;
}

add_filter( 'edd_customers_column_user_switching', 'gv_edd_customers_column_user_switching', 10, 2 );

/**
 * Add the "Switch to Customer" link for the Customers Table
 *
 * @param $value
 * @param int $item_id
 *
 * @return string
 */
function gv_edd_customers_column_user_switching( $value, $item_id = 0 ) {

	$customer = new EDD_Customer( $item_id );

    return gv_edd_user_switching_link( $customer );
}

add_filter( 'edd_payments_table_column', 'gv_edd_payments_table_column_user_switching', 10, 3 );

/**
 * Add "(Switch To)" link in Payments table
 * @param $value
 * @param int $payment_id
 * @param string $column_name
 *
 * @return string
 */
function gv_edd_payments_table_column_user_switching( $value, $payment_id = 0, $column_name = '' ) {

	if ( ! class_exists( 'user_switching' ) ) {
		return $value;
	}

	if ( 'user' === $column_name ) {
		$payment  = new EDD_Payment( $payment_id );
		$customer = new EDD_Customer( $payment->customer_id );
		if ( $link = gv_edd_user_switching_link( $customer, __( 'Switch&nbsp;To', 'edd-user-switching' ) ) ) {
			$value .= ' (' . $link . ')';
		}
	}

	return $value;
}

add_action( 'edd_payment_view_details', 'gv_edd_payment_view_details_user_switching' );

/**
 * Display the "Switch to Customer" link in the "Customer Details" box of a payment
 *
 * @param int $payment_id
 *
 * @return void
 */
function gv_edd_payment_view_details_user_switching( $payment_id ) {

	$payment = new EDD_Payment( $payment_id );

	if ( ! $payment ) {
        return;
	}

	$customer = new EDD_Customer( $payment->customer_id );

	if ( ! $customer ) {
        return;
	}

	$link = gv_edd_user_switching_link( $customer );

	if( empty( $link ) ) {
	    return;
    }

	// Position to the right
?>
<script>
jQuery( document ).ready( function( $ ) {
	$('.edd-switch-customer').appendTo('#edd-customer-details h3').addClass('alignright').css('font-size', '13px');
});
</script>
<?php
	echo $link;
}

add_action( 'edd_customer_before_stats', 'gv_edd_customer_user_switching_link' );

/**
 * Add link to the Customer details screen above the customer stats
 *
 * @param EDD_Customer $customer
 *
 * @return void
 */
function gv_edd_customer_user_switching_link( $customer ) {

	$link = gv_edd_user_switching_link( $customer );

	if ( $link ) {
        echo '<div class="customer-note-wrapper" id="customer-edit-actions">';
		echo $link;
	    echo '</div >';
	}
}

/**
 * Print a "Switch to Customer" link
 *
 * @param EDD_Customer $customer EDD customer object
 * @param string $text Anchor text override. Default: "Switch&nbsp;To&nbsp;Customer"
 *
 * @return string HTML link to switch to/from customer. Empty string if class doesn't exist, user doesn't exist, or link shouldn't be shown (switched user is same as current user)
 */
function gv_edd_user_switching_link( $customer, $text = '' ) {

    if ( ! class_exists( 'user_switching' ) ) {
        return '';
    }

    $user = get_user_by( 'id', $customer->user_id );

	if ( ! $user ) {
	    return '';
	}

	if ( ! $link = user_switching::maybe_switch_url( $user ) ) {
        return '';
    }

	if ( empty( $text ) ) {
        $text = __( 'Switch&nbsp;To&nbsp;Customer', 'edd-user-switching' );
	}

    return sprintf( '<a href="%s" class="edd-switch-customer">%s</a>', esc_url( $link ), esc_html( $text ) );
}