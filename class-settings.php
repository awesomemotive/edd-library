<?php
if ( !class_exists( "EDD_Library_Settings" ) ) {

    class EDD_Library_Settings {

        public $args = array();
        public $sections = array();
        public $ReduxFramework;
        public function __construct() {

            if ( !class_exists( "ReduxFramework" ) ) {
                require_once( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' );
            }

            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if ( !isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }


        public function setSections() {
            $this->sections[] = array(
                'title' => __( 'Main Settings', 'edd_library' ),
                'desc' => __( 'Easy Digital Downloads Library contains dozens of additional features that we don\'t ship with EDD core', 'edd_library' ),
                'icon' => 'el-icon-home',
                'fields' => array(
                    // todo: coming soon
                )
            );
            do_action( 'edd_library_settings_panel_sections', $this->sections );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'edd_library_settings', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => __( 'Easy Digital Downloads Snippets Library', 'edd_library' ), // Name that appears at the top of your panel
                'display_version' => edd_library_plugin_version, // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => false, // Show the sections below the admin menu item or not
                'menu_title' => __( 'EDD Library', 'edd_library' ),
                'page_title' => __( 'EDD Library', 'edd_library' ),
                'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'edit.php?post_type=download', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_shop_settings', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'edd-library', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
				'use_cdn' => true,
				'customizer' => false,
                'update_notice' => false,
                'allow_tracking' => false,
                'redux_notice_check' => false,
				'forced_dev_mode_off' => true,
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                'footer_credit'       => __( 'Thanks for using the EDD Library', 'edd_library' ), // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                'hints' => array(
                    'icon'              => 'icon-question-sign',
                    'icon_position'     => 'right',
                    'icon_color'        => 'lightgray',
                    'icon_size'         => 'normal',

                    'tip_style'         => array(
                        'color'     => 'light',
                        'shadow'    => true,
                        'rounded'   => false,
                        'style'     => '',
                    ),
                    'tip_position'      => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            // Panel Intro text -> before the form
            if ( !isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( !empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( "-", "_", $this->args['opt_name'] );
                }
                $this->args['intro_text'] = __( 'Thanks for using the EDD Library', 'edd_library' );
            }
        }

    }
    global $edd_library_settings_save;
   $edd_library_settings_save = new EDD_Library_Settings();
}
