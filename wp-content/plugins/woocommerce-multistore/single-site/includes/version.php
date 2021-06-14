<?php
/**
 * API to check plugin version.
 */

class WOO_MSTORE_SINGLE_VERSION {

	/**
	 * Initialize the action hooks and load the plugin classes
	 **/
	public function __construct() {
		add_action( 'wp_ajax_nopriv_woomulti_version', array( $this, 'hook_woomulti_version_check' ), 10, 0 );

		if ( get_option('woonet_network_type') == 'master') {
			add_action( 'admin_init', array( $this, 'check_versions' ), 10, 0 );
		}

		if ( get_transient('woonet_show_update_notice') ) {
			add_action( 'admin_notices', array( $this, 'show_update_notice' ), 10, 0 );
		}
	}

	public function hook_woomulti_version_check() {

		$_engine = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();

		if ( ! $_engine->is_request_authenticated( $_POST ) ) {
			echo json_encode(array(
				'error'   => 'failed',
				'message' => 'Authentication required.',
			));
			die;
		}

		echo json_encode(array(
			'version' => defined('WOO_MSTORE_VERSION') ? WOO_MSTORE_VERSION : '',
		));
		die;
	}

	/**
	 * Check all child sites and notify the user to 
	 * update if running an older version.
	 */
	public function check_versions() {

		//only run on the master site.
		if ( get_option('woonet_network_type') != 'master') {
			return;
		}

		if ( get_transient('woonet_version_check') ) {
			return;
		}

		$_sites = get_option('woonet_child_sites');
		$_set_update_notice = false;

		if ( !empty( $_sites ) ) {
			foreach ( $_sites as $_site ) {
				$data = array(
					'action'        => 'woomulti_version',
					'Authorization' => $_site['site_key'],
				);

				$url = trim($_site['site_url']) . '/wp-admin/admin-ajax.php';

				$headers = array(
					'Authorization' => $_site['site_key'],
				);

				$result = wp_remote_post(
					$url,
					array(
						'headers' => $headers,
						'body'    => $data,
					)
				);

				if ( is_wp_error( $result ) ) {
					woomulti_log_error( "Version check failed: " . $result->get_error_message() );
					die;
				}

				$_response = json_decode( $result['body'] );

				if ( ! empty($_response->version) && defined('WOO_MSTORE_VERSION') && $_response->version < WOO_MSTORE_VERSION ) {
					$_set_update_notice = true;
				}
			}
		}

		if ( $_set_update_notice === true ) {
			set_transient('woonet_show_update_notice', true, 24 * 60 * 60 );
		}

		set_transient( 'woonet_version_check', time(), 24 * 60 * 60 );
	}

	/**
	 * Show update notice
	 */
	public function show_update_notice() {
		?>
	    <div class="notice notice-warning is-dismissible">
	        <p><?php _e( 'Some of your child sites are running older versions of <a target="_blank" href="https://woomultistore.com/"> WooCommerce Multistore</a>. Product may fail to copy or feature may not be available. Please update to the latest version (<a target="_blank" href="https://woomultistore.com/my-account/downloads/">' . WOO_MSTORE_VERSION . '</a>).' ); ?></p>
	    </div>
	    <?php
	}
}

$GLOBALS['WOO_MSTORE_SINGLE_VERSION'] = new WOO_MSTORE_SINGLE_VERSION();
