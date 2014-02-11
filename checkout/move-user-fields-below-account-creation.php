<?php

/*
 * Move the user fields below the "create an account" fields
 */
remove_action( 'edd_register_fields_before', 'edd_user_info_fields' );
add_action( 'edd_register_fields_after', 'edd_user_info_fields' );