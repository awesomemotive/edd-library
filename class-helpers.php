<?php
class EDD_Library_Helper {
    // Gets EDD Library setting for the given key. If not set, returns the default
    public function get_option( $key = '', $default = false ) {
        global $edd_library_settings;
        $value = isset( $edd_library_settings[ $key ] ) ? $edd_library_settings[ $key ] : $default;
        $value = apply_filters( 'fes_get_option', $value, $key, $default );
        return apply_filters( 'fes_get_option_' . $key, $value, $key, $default );
    }

    // Sets EDD Library setting for the given key. If not set, returns the default
    public function set_option( $key, $value ) {
        global $edd_library_settings_save;
        $edd_library_settings_save->ReduxFramework->set( $key, $value );
    }
}
