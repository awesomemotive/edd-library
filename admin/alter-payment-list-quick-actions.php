<?php

/* Remove the 'Delete' option from the Payment List Quick Action
 * This requires a fine tuning of the user roles, typically handeled in a plugin
 * Example: http://wordpress.org/plugins/user-role-editor/
 */

function ck_edd_remove_payment_delete_action( $row_actions, $payment ) {
    if ( !current_user_can( 'delete_shop_payment' ) )
        unset( $row_actions['delete'] );

    return $row_actions;
}
add_filter( 'edd_payment_row_actions', 'ck_edd_remove_payment_delete_action', 10, 2 );