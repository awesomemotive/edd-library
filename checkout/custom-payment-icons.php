<?php
/**
 * Register a custom payment icon
 */
function pw_edd_payment_icon( $icons = array() ) {
    $icons['url/to/your/image/icon.png'] = 'Name of the Payment Method';
    return $icons;
}
add_filter( 'edd_accepted_payment_icons', 'pw_edd_payment_icon' );