<?php
/**
 * Activation Hook
 **/
function woo_mstore_activation_hook() {
	require_once dirname( __FILE__ ) . '/includes/activation-hook.php';
}

/**
 * Deactivation Hook
 **/
function woo_mstore_deactivation_hook() {
	require_once dirname( __FILE__ ) . '/includes/deactivation-hook.php';
}

/**
 * Regiser activation and deactivation hooks
 **/
register_activation_hook( dirname( dirname( __FILE__ ) ) . '/woocommerce-multistore.php', 'woo_mstore_activation_hook' );
register_deactivation_hook( dirname( dirname( __FILE__ ) ) . '/woocommerce-multistore.php', 'woo_mstore_deactivation_hook' );

/**
 * WooCommerce Multistore single site init
 **/
class WOO_MSTORE_SINGLE_INIT {

	/**
	 * initiate the action hooks and load the plugin classes
	 **/
	public function __construct() {
		$this->include_required_classes();
		$this->setup_action_hooks();

		// instantiate global classes
		$GLOBALS['WOO_MSTORE_SINGLE_LICENSE'] = new WOO_MSTORE_licence();
	}

	/**
	 * Include required classes
	 **/
	public function include_required_classes() {

		require_once dirname( __FILE__ ) . '/constants.php';

		// core files
		require_once dirname( WOO_MSTORE_PATH ) . '/include/licence.php';
		require_once dirname( WOO_MSTORE_PATH ) . '/include/class.updater.php';
		require_once dirname( WOO_MSTORE_PATH ) . '/include/class.admin.product.php';
		require_once dirname( WOO_MSTORE_PATH ) . '/include/class.functions.php';

		// single site files
		require_once dirname( __FILE__ ) . '/includes/assets-manager.php';
		require_once dirname( __FILE__ ) . '/includes/functions.php';
		require_once dirname( __FILE__ ) . '/includes/menu.php';
		require_once dirname( __FILE__ ) . '/includes/setup-wizard.php';
		require_once dirname( __FILE__ ) . '/includes/connected-sites.php';
		require_once dirname( __FILE__ ) . '/includes/editor-integration.php';
		require_once dirname( __FILE__ ) . '/includes/network-products.php';
		require_once dirname( __FILE__ ) . '/includes/network-orders.php';
		require_once dirname( __FILE__ ) . '/includes/network-products-sync.php';
		require_once dirname( __FILE__ ) . '/includes/network-sync-engine.php';
		require_once dirname( __FILE__ ) . '/includes/stock-sync.php';
		require_once dirname( __FILE__ ) . '/includes/options.php';
		require_once dirname( __FILE__ ) . '/includes/trash-products.php';
		require_once dirname( __FILE__ ) . '/includes/version.php';
	}

	/**
	 * Sets up common action hooks
	 **/
	public function setup_action_hooks() {
		if ( get_option( 'woonet_setup_wizard_complete' ) != 'yes' && ! $this->check_if_plugin_page() ) {
			add_action( 'admin_notices', array( $this, 'show_setup_instructions' ) );
		}
	}

	/**
	 * Show set up instructions
	 **/
	public function show_setup_instructions() {
		woomulti_get_template_parts( 'admin-notice-setup-wizard' );
	}

	/**
	 * Hide the setup wizard warning from plugin page
	 **/
	public function check_if_plugin_page() {
		if ( isset( $_GET['page'] ) && strpos( $_GET['page'], 'woonet' ) !== false ) {
			return true;
		}

		return false;
	}
}

$GLOBALS['WOO_MSTORE_SINGLE_INIT'] = new WOO_MSTORE_SINGLE_INIT();
