<?php
/*
 * Plugin Name: Disable EDD Dashboard Widget
 * Description: Removes the EDD sales sumamry widget
 * Author: Pippin Williamson
 * Version: 1.0
 */
 
remove_action( 'wp_dashboard_setup', 'edd_register_dashboard_widgets', 10 );