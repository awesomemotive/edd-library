<?php

/**
 * Disable the new user notification email for both admin and user
 */
remove_action( 'edd_insert_user', 'edd_new_user_notification', 10, 2 );