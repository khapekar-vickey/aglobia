<?php
/**
 * WooCommerce Multistore single site init
 * @since 3.0.0
 **/

class WOO_MSTORE_CONNECTED_SITES {

	/**
	 * Initialize action hooks and load the plugin classes
	 **/
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_woomultistore_submenu' ) );
	}

	/**
	 * Add a primary menu for WooCommerce Multistore
	 **/
	public function add_woomultistore_submenu() {
		// only if superadmin
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! woomulti_has_valid_license() ) {
			return;
		}

		if ( get_option( 'woonet_network_type' ) == 'master' ) {
			// enter license key
			$hookname = add_submenu_page(
				'woonet-woocommerce',
				'Sites',
				'Sites',
				'manage_options',
				'woonet-connected-sites',
				array( $this, 'menu_callback_connected_sites' )
			);

			add_action( 'load-' . $hookname, array( $this, 'connected_sites_form_submit' ) );
		}
	}

	public function menu_callback_connected_sites() {
		woomulti_get_template_parts( 'connected-sites' );
	}

	public function connected_sites_form_submit() {
		if ( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
			return;
		}

		if ( ! isset( $_POST['_wpnonce'] )
			|| ! wp_verify_nonce( $_POST['_wpnonce'], 'woonet_delete_site' )
		) {
			wp_die( 'Nope! You are not allowed to pefrom this action.' );
		}

		$connected_sites = get_option( 'woonet_child_sites' );

		foreach ( $connected_sites as $key => $value ) {
			if ( $key == $_POST['__key'] ) {
				unset( $connected_sites[ $key ] );
			}
		}

		update_option( 'woonet_child_sites', $connected_sites );

		$_SESSION['mstore_form_submit_messages']   = array();
		$_SESSION['mstore_form_submit_messages'][] = 'Site removed succesfully.';
	}

}

$GLOBALS['WOO_MSTORE_CONNECTED_SITES'] = new WOO_MSTORE_CONNECTED_SITES();

