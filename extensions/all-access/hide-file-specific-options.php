<?php
/*
 * Plugin Name: EDD All Access - Hide file-specific download options
 * Description: This plugin hides file-specific download options so that All Access customers can only view/download the first attached file.
 * Author: Phil Johnston
 * URL: https://github.com/easydigitaldownloads/library/issues/119
 * Version: 1.0
 */

 function my_custom_function_to_hide_file_specific_options( $hide_file_specific_options, $download_id ) {
 	return true
 }
 add_filter( 'edd_all_access_download_form_hide_file_specific_download_options', 'my_custom_function_to_hide_file_specific_options', 10, 2 );
