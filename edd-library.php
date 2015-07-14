<?php
/**
 * Plugin Name:         Easy Digital Downloads - Library
 * Plugin URI:          https://github.com/easydigitaldownloads/library
 * Description:         A collection of EDD snippets made into a Jetpack like plugin
 * Author:              Chris Christoff
 * Author URI:          http://www.chriscct7.com
 *
 * Version:             0.9
 * Requires at least:   4.2
 * Tested up to:        4.4
 *
 * Text Domain:         edd_library
 * Domain Path:         /edd_library/languages/
 *
 * @category            Plugin
 * @copyright           Copyright © 2015 Chris Christoff
 * @author              Chris Christoff
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/** Check if Easy Digital Downloads is active */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

class EDD_Library {
	/**
	 * @var EDD_Library The one true EDD_Library
	 * @since 1.4
	 */
	private static $instance;
	// Setup objects for each class
	public $helper;

	/**
	 * Main EDD_Library Instance
	 *
	 * Insures that only one instance of EDD_Library exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 2.0
	 * @static
	 * @staticvar array $instance
	 * @uses EDD_Library::setup_globals() Setup the globals needed
	 * @uses EDD_Library::includes() Include the required files
	 * @uses EDD_Library::setup_actions() Setup the hooks and actions
	 * @see EDD()
	 * @return The one true EDD_Library
	 */
	public static function instance() {
		global $wp_version;

		if ( version_compare( $wp_version, '4.2', '< ' ) ) {
			add_action( 'admin_notices', array('edd_library','wp_notice' ) );
			return;

		} else if ( !class_exists( 'Easy_Digital_Downloads' ) || ( version_compare( EDD_VERSION, '0.9' ) < 0 ) ) {
			add_action( 'admin_notices', array('edd_library','edd_notice' ) );
			return;
		}

		if ( !isset( self::$instance ) && !( self::$instance instanceof EDD_Library ) ) {
			self::$instance = new EDD_Library;
			self::$instance->define_globals();
			self::$instance->includes();
			self::$instance->setup();
			self::$instance->helper = new EDD_Library_Helper;
		}
		return self::$instance;
	}
	
	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 2.3
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'edd_library' ), '0.9' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 2.3
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'edd_library' ), '0.9' );
	}

	public function define_globals() {
		$this->title    = __( 'Easy Digital Downloads - Library', 'edd_library' );
		$this->file     = __FILE__;
		$this->basename = apply_filters( 'fes_plugin_basename', plugin_basename( $this->file ) );
		// Plugin Name
		if ( !defined( 'edd_library_plugin_name' ) ) {
			define( 'edd_library_plugin_name', 'Easy Digital Downloads - Library' );
		}
		// Plugin Version
		if ( !defined( 'edd_library_plugin_version' ) ) {
			define( 'edd_library_plugin_version', '0.9' );
		}
		// Plugin Root File
		if ( !defined( 'edd_library_plugin_file' ) ) {
			define( 'edd_library_plugin_file', __FILE__ );
		}
		// Plugin Folder Path
		if ( !defined( 'edd_library_plugin_dir' ) ) {
			define( 'edd_library_plugin_dir', WP_PLUGIN_DIR . '/' . basename( dirname( __FILE__ ) ) . '/' );
		}
		// Plugin Folder URL
		if ( !defined( 'edd_library_plugin_url' ) ) {
			define( 'edd_library_plugin_url', plugin_dir_url( edd_library_plugin_file ) );
		}
	}

	public function includes() {
		//admin
			if ( EDD_Library()->helpers->get_option( 'admin-add-settings-hidden-field-type', false ) ){
				require_once edd_library_plugin_dir . 'admin/add_settings_hidden_fieldtype.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-add-username-to-customer-details', false ) ){
				require_once edd_library_plugin_dir . 'admin/add_settings_hidden_fieldtype.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-add-username-to-customer-details', false ) ){
				require_once edd_library_plugin_dir . 'admin/alter-payment-list-quick-actions.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-bulk-delete-orders', false ) ){
				require_once edd_library_plugin_dir . 'admin/bulk-delete-orders.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-disable-dashboard-summary-widget', false ) ){
				require_once edd_library_plugin_dir . 'admin/disable-dashboard-summary-widget.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-download-archive-menu-item', false ) ){
				require_once edd_library_plugin_dir . 'admin/download-archive-menu-item.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-download-column-thumbnail', false ) ){
				require_once edd_library_plugin_dir . 'admin/download-column-thumbnail.php';
			}
			if ( EDD_Library()->helpers->get_option( 'admin-menu-icon', false ) ){
				require_once edd_library_plugin_dir . 'admin/replace-menu-icon.php';
			}
		//checkout
			if ( EDD_Library()->helpers->get_option( 'checkout-add-text-before-purchase-button', false ) ){
				require_once edd_library_plugin_dir . 'checkout/add-text-before-purchase-button.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-continue-shopping-button', false ) ){
				require_once edd_library_plugin_dir . 'checkout/continue-shopping-button.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-custom-cart-row', false ) ){
				require_once edd_library_plugin_dir . 'checkout/custom-cart-row.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-custom-gateway-icons', false ) ){
				require_once edd_library_plugin_dir . 'checkout/custom-payment-icons.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-custom-terms-page', false ) ){
				require_once edd_library_plugin_dir . 'checkout/custom-terms-page.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-force-account-creation-by-total', false ) ){
				require_once edd_library_plugin_dir . 'checkout/force-account-creation-by-cart-total.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-force-account-creation-by-tag', false ) ){
				require_once edd_library_plugin_dir . 'checkout/force-account-creation-by-category-or-tag.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-force-account-creation-by-category', false ) ){
				require_once edd_library_plugin_dir . 'checkout/force-account-creation-by-category-or-tag.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-force-minimum-password-length', false ) ){
				require_once edd_library_plugin_dir . 'checkout/force-minimum-password-length.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-hide-payment-icons-when-free', false ) ){
				require_once edd_library_plugin_dir . 'checkout/hide-payment-icons-when-free.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-max-cart-amount', false ) ){
				require_once edd_library_plugin_dir . 'checkout/limit-purchase-total.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-move-user-fields-below-account-creation', false ) ){
				require_once edd_library_plugin_dir . 'checkout/move-user-fields-below-account-creation.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-require-card-state', false ) ){
				require_once edd_library_plugin_dir . 'checkout/non-required-card-state.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-one-product-checkout', false ) ){
				require_once edd_library_plugin_dir . 'checkout/one-item-checkout.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-prevent-discounts-wtih-sl-renewals', false ) ){
				require_once edd_library_plugin_dir . 'checkout/prevent-discounts-with-sl-renewals.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-prevent-duplicate-cart-items', false ) ){
				require_once edd_library_plugin_dir . 'checkout/prevent-duplicate-cart-items.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-remove-download-links', false ) ){
				require_once edd_library_plugin_dir . 'checkout/remove-download-files.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-remove-last-name', false ) ){
				require_once edd_library_plugin_dir . 'checkout/remove-last-name.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-make-last-name-required', false ) ){
				require_once edd_library_plugin_dir . 'checkout/required-fields.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-send-sale-alerts-from-customer-email', false ) ){
				require_once edd_library_plugin_dir . 'checkout/send-sale-alerts-from-customer-email.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-show-discount-field', false ) ){
				require_once edd_library_plugin_dir . 'checkout/show-discount-field.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-show-checkout-terms-by-default', false ) ){
				require_once edd_library_plugin_dir . 'checkout/show-terms-by-default.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-show-ssl-seal', false ) ){
				require_once edd_library_plugin_dir . 'checkout/ssl-site-seal.php';
			}
			if ( EDD_Library()->helpers->get_option( 'checkout-custom-user-role', false ) ){
				require_once edd_library_plugin_dir . 'checkout/user-role-on-checkout.php';
			}

		//downloads

		//emails

		//extensions

		//output

		// misc

	}

	public function setup() {
		$this->load_settings();
		add_action( 'init', array( $this, 'load_textdomain' ) );
	}

	public function load_textdomain() {
		$locale        = apply_filters( 'plugin_locale', get_locale(), 'edd_library' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'edd_library', $locale );

		$mofile_local  = trailingslashit( edd_library_plugin_dir . 'languages' ) . $mofile;
		$mofile_global = WP_LANG_DIR . '/edd_library/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			return load_textdomain( 'edd_library', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			return load_textdomain( 'edd_library', $mofile_local );
		}
		else{
			load_plugin_textdomain( 'edd_library', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
	}

	public function load_settings() {
		if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' ) ) {
			require_once( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' );
		}
		require_once( dirname( __FILE__ ) . '/class-settings.php' );
	}

	public static function edd_notice() {
?>
	<div class="updated">
		<p><?php
		printf( __( '<strong>Notice:</strong> Easy Digital Downloads Frontend Submissions requires Easy Digital Downloads 2.3 or higher in order to function properly.', 'edd_library' ) );
?>
		</p>
	</div>
	<?php
	}
	public static function wp_notice() {
?>
	<div class="updated">
		<p><?php
		printf( __( '<strong>Notice:</strong> Easy Digital Downloads Frontend Submissions requires WordPress 4.2 or higher in order to function properly.', 'edd_library' ) );
?>
		</p>
	</div>
	<?php
	}
}

/**
 * The main function responsible for returning the one true EDD_Library
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $EDD_Library = EDD_Library(); ?>
 *
 * @since 2.0
 * @return object The one true EDD_Library Instance
 */
function EDD_Library() {
	return EDD_Library::instance();
}
EDD_Library();