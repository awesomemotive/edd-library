<?php
/*
Plugin Name: EDD FES - Profile Data Shortcode
Plugin URL: https://github.com/easydigitaldownloads/library/blob/master/extensions/frontend-submissions/fes-profile-data-shortcode.php
Description: Renders the value of a single Profile Form field. Accepts one value, key.  Example: [fes_profile_data key='name_of_store'] Possible values found here: http://docs.easydigitaldownloads.com/article/966-frontend-submissions-profile-form-editor
Version: 1.0
Author: Topher
Author URI: http://topher1kenobe.com
*/

if ( ! function_exists( 'fes_profile_data') ) {

	function fes_profile_data( $atts ) {

        $output     = '';
        $vendor     = false;
        $vendor_var = get_query_var( 'vendor' );

        if ( ! empty( $vendor_var ) ) {
            if ( is_numeric( $vendor_var ) ) {
                $vendor = get_vendor( absint( $vendor_var ) );
            } else {
                $vendor = get_user_by( 'slug', esc_attr( $vendor_var ) );
            }
        }

		$user_data = get_userdata( $vendor->ID );

        $output .= '<div id="' . esc_attr( $atts['key'] ) . '" class="vendor-profile-field">' . "\n";

        if ( 'description' == $atts['key'] ) {
            $output .= wpautop( get_user_meta( absint( $vendor->ID ), esc_attr( $atts['key'] ), true ) );
        } elseif ( 'user_avatar' == $atts['key'] ) {
            $output .= '<img src="' . esc_url( get_user_meta( absint( $vendor->ID ), esc_attr( $atts['key'] ), true ) ) . '" alt="Image of ' . esc_attr( $vendor->name ) . '">' . "\n";
        } elseif ( 'display_name' == $atts['key'] ) {
            $output .= $user_data->display_name;
        } else {
            $output .= get_user_meta( absint( $vendor->ID ), esc_attr( $atts['key'] ), true );
        }

        $output .= '</div>' . "\n";

        return $output;
	}
	add_shortcode( 'fes_profile_data', 'fes_profile_data' );
}
