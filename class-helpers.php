<?php
class EDD_Modules_Helper {
    // Gets EDD Modules setting for the given key. If not set, returns the default
    public function get_option( $key = '', $default = false ) {
        global $edd_modules_settings;
        $value = isset( $edd_modules_settings[ $key ] ) ? $edd_modules_settings[ $key ] : $default;
        $value = apply_filters( 'edd_modules_get_option', $value, $key, $default );
        return apply_filters( 'edd_modules_get_option_' . $key, $value, $key, $default );
    }

    // Sets EDD Modules setting for the given key. If not set, returns the default
    public function set_option( $key, $value ) {
        global $edd_modules_settings_save;
        $edd_modules_settings_save->ReduxFramework->set( $key, $value );
    }
}
