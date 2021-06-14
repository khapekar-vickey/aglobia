<?php
/**
 * Network Bulk Updater
 *
 * @class   WOO_MSTORE_BULK_SYNC
 * @since   2.0.20
 * @package WooMultistore
 */

class WOO_MSTORE_SINGLE_NETWORK_PRODUCTS_SYNC {

	/**
	 * Product updater instance
	 */

	private $product_updater = null;

	/**
	 * Functions instance
	 */

	private $functions = null;

	/**
	 * Hook in ajax event handlers.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ), 10, 0 );
	}

	/**
	 * Run all action hooks.
	 **/
	public function init() {
		if ( ! woomulti_has_valid_license() ) {
			return;
		}

		if ( woomulti_has_min_user_role() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'admin_notices', array( $this, 'set_admin_notice' ) );
			add_action( 'wp_ajax_woomulti_cancel_sync', array( $this, 'cancel_sync' ) );
			add_action( 'wp_ajax_woomulti_process_job', array( $this, 'ajax_process_job' ) );
			add_filter( 'wp_redirect', array( $this, 'add_storage_id_to_query_string' ), PHP_INT_MAX, 2 );
			add_action( 'wp_ajax_nopriv_woomulti_child_payload', array( $this, 'receive_product_from_child' ) );
			add_action( 'wp_ajax_nopriv_woomulti_orders', array( $this, 'send_child_orders' ) );
			add_action( 'wp_ajax_nopriv_woomulti_order_status', array( $this, 'update_child_status' ) );

			if ( is_admin() ) {
				add_action( 'woocommerce_update_product', array( $this, 'process_product' ), PHP_INT_MAX, 1 );
			}

			$this->product_updater = new WOO_MSTORE_admin_product( false );
			$this->functions       = new WOO_MSTORE_functions( false );
		}
	}

	/**
	 * Enqueue assets for the the updater
	 */
	public function enqueue_assets() {
		if ( is_admin() ) {
			wp_register_style( 'woomulti-speed-css', plugins_url( '/assets/css/speed-updater.css', dirname( dirname( __FILE__ ) ) ), array(), WOO_MSTORE_VERSION );
			wp_enqueue_style( 'woomulti-speed-css' );

			wp_register_script( 'woomulti-speed-js', plugins_url( '/assets/js/speed-updater.js', dirname( dirname( __FILE__ ) ) ), array(), WOO_MSTORE_VERSION );
			wp_enqueue_script( 'woomulti-speed-js' );

			wp_enqueue_script( 'jquery-ui-progressbar' );
		}
	}

	/**
	 * Save submitted options for products in the database from the bulk editor
	 */
	public function process_product( $post_id ) {
		if ( ! empty( $_REQUEST['action'] )
			 && $_REQUEST['action'] == 'woocommerce_save_variations' ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		/**
		 * If the product being updated is a child product
		 * Update its metadata.
		 */

		if ( $this->is_child_product() ) {
			$this->update_child_product_metadata( $post_id );
		} else {
			$this->update_parent_product_metadata( $post_id );
		}

		if ( ! empty( $_REQUEST['woomulti_request_processed'] ) ) {
			/**
			 * The hook is called once for each product. Request processed once for all products in the array.
			 */
			return;
		}

		/**
		 * User is not on edit screen hook legacy product updater function for backward compatibility
		 */

		if ( ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'inline-save' ) {
			return $this->quick_sync();
		}

		if ( ! $this->is_edit_screen() ) {
			return;
		}

		if ( ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'editpost' ) {
			$_REQUEST['post'] = (array) $_REQUEST['post_ID'];
		}

		if ( count( $_REQUEST['post'] ) >= 1 ) {
			$_REQUEST['total_products'] = count( $_REQUEST['post'] );

		} else {
			return; // no post to update
		}

		$selected_stores = $this->get_selected_stores( $_REQUEST );

		if ( empty( $selected_stores ) ) {
			return;
		}

		if ( $this->store_update_options( $_REQUEST, $selected_stores ) ) {
			$_REQUEST['woomulti_request_processed'] = true; // request processed once. Don't process for every product in the array.
		}
	}

	/**
	 * Store product update options using transient APIs
	 *
	 * @param array request array
	 * @return boolean
	 */
	public function store_update_options( array $data, $selected_stores ) {
		$storage_id              = uniqid();
		$data['storage_id']      = $storage_id;
		$data['selected_stores'] = $selected_stores;
		$data['post_to_update']  = $this->generate_post_array_to_update( $data, $selected_stores );

		if ( set_transient( 'woomulti_product_sync_queue', $data, 4 * HOUR_IN_SECONDS ) ) {
			$_REQUEST['woomulti_storage_id'] = $storage_id;
			return true;
		}
	}

	/**
	 * Create a new multi-dimentional array with post to be updated,
	 * one array with post ID and one with store ID.
	 **/
	public function generate_post_array_to_update( $data, $selected_stores ) {
		$post_to_update = array();

		if ( ! empty( $data['post'] ) && ! empty( $selected_stores ) ) {
			foreach ( $data['post'] as $p ) {
				foreach ( $selected_stores as $s ) {
					$post_to_update[ $p ][] = array(
						'post_id'  => $p,
						'store_id' => $s,
					);
				}
			}
		}

		return $post_to_update;
	}

	/**
	 * Enqueue JavaScripts to process product update requests
	 */
	public function set_product_updater_js( $storage_id ) {
		?>
		<div class="wrap woomulti-panel">
			<div class="welcome-panel">
				<div class="welcome-panel-content">
					<h2><?php _e( 'WooCommerce Multistore Product Sync' ); ?></h2>
					<p class="about-description"><?php _e( 'Processing products in the queue. Please do not quit the browser while the sync is in progress.' ); ?></p>
					<div class="welcome-panel-column-container">
						<div class="welcome-panel-column">
								<div>
									<p style='display: none;' class="woomultistore_sync_completed"</p>
									<p style='display: none;' class="woomultistore_sync_failed"</p>
								</div>
								<div class="woomultistire_sync_container">
									<h3 class="woo-sync-message"><?php _e( 'Preparing to sync' ); ?></h3>
									<p class="woo-sync-product-count"><?php _e( 'Calculating products to be synchronized.' ); ?></p>
									<div class="progress-bar-container"> <div id="woo-product-update-progress-bar"></div> </div>
									<input type="submit" name="submit" id="submit" class="button button-primary woomulti-cancel-sync" value="Cancel Sync">
								</div>
								<div class="close-sync-screen" style="display: none;">
									<a data-attr='3' href="#"> Close (3) </a>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Check for transient data and enqueue JavaScript data if present
	 */
	public function set_admin_notice() {
		if ( $transient = get_transient( 'woomulti_product_sync_queue' ) ) {

			if ( ( isset( $transient['site_id'] ) && $transient['site_id'] == get_current_blog_id() ) || is_admin() ) {
				if ( ! empty( $_REQUEST['woomulti_storage_id'] ) ) {
					$this->set_product_updater_js( 123 );
				}
			}
		}
	}

	/**
	 * Cancel Sync that is already running.
	 */
	public function cancel_sync() {
		/**
		 * Page reloaded after transient is deleted to cancel the sync
		 */
		$this->delete_transient_from_all_blogs();
	}

	/**
	 * Process the job request from ajax request
	 */
	public function ajax_process_job() {
		define( 'WOOMULTI_MAX_SITE_PER_REQUEST', 3 );

		$update_config = get_transient( 'woomulti_product_sync_queue' );

		if ( count( $update_config['post_to_update'] ) ) {
			/**
			 * Request data is used by slave product update functions
			 * Lets restore request variable from transient data
			 * so that we can run product update hook without modifying those functions
			 */
			$_REQUEST = $update_config;

			$next_post = array_shift( $update_config['post_to_update'] );

			if ( count( $next_post ) > WOOMULTI_MAX_SITE_PER_REQUEST ) {
				array_unshift( $update_config['post_to_update'], array_slice( $next_post, WOOMULTI_MAX_SITE_PER_REQUEST - 1 ) );
				$next_post = array_slice( $next_post, 0, WOOMULTI_MAX_SITE_PER_REQUEST );
			}

			foreach ( $next_post as $p ) {
				// $this->process_master_meta($update_config, $p['post_id'], $p['store_id']);
				// $this->product_updater->process_ajax_product($p['post_id'], $p['store_id'], WOOMULTI_MAX_SITE_PER_REQUEST);
				$sync = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();
				$sync->sync( $p['post_id'], $p['store_id'] );
			}

			/**
			 * We update the data after process_ajax_product() calls wp_cache_flush()
			*/
			set_transient( 'woomulti_product_sync_queue', $update_config, 4 * HOUR_IN_SECONDS );

			echo json_encode(
				array(
					'progress_percentage' => 100 - ( count( $update_config['post_to_update'] ) / $update_config['total_products'] ) * 100,
					'product_count'       => ( $update_config['total_products'] - count( $update_config['post_to_update'] ) ) . ' out of ' . $update_config['total_products'],
					'status'              => 'in-progress',
				)
			);

		} else {
			$this->delete_transient_from_all_blogs();

			echo json_encode(
				array(
					'progress_percentage' => 100,
					'product_count'       => $update_config['total_products'] . ' out of ' . $update_config['total_products'],
					'status'              => 'completed',
				)
			);

		}

		die;
	}

	/**
	 * Add slave publish to settings to master product
	 *
	 * @param $data
	 * @param $post_id
	 */
	private function process_master_meta( $data, $post_id, $store_id ) {
		if ( isset( $data[ '_woonet_publish_to_' . $store_id ] ) && $data[ '_woonet_publish_to_' . $store_id ] == 'yes' ) {
			update_post_meta( $post_id, '_woonet_publish_to_' . $store_id, 'yes' );
		} else {
			update_post_meta( $post_id, '_woonet_publish_to_' . $store_id, 'no' );
		}
	}

	/**
	 * Return the ID of the stores selected by the user for update
	 *
	 * @return array
	 */
	private function get_selected_stores( $data ) {
		$selected_stores = array();

		$sites = get_option( 'woonet_child_sites' );

		foreach ( $sites as $site ) {
			if ( isset( $data[ '_woonet_publish_to_' . $site['uuid'] ] ) && $data[ '_woonet_publish_to_' . $site['uuid'] ] == 'yes' ) {
				$selected_stores[] = $site['uuid'];
			} elseif ( isset( $data[ '_woonet_publish_to_' . $site['uuid'] ] ) && $data[ '_woonet_publish_to_' . $site['uuid'] ] == 'no' ) {
				if ( $this->is_sync_required( $data, $site['uuid'] ) && ! in_array( $blog_id, $selected_stores ) ) {
					$selected_stores[] = $site['uuid'];
				}
			}
		}

		return $selected_stores;
	}

	/**
	 * When deleting transient data it's not being deleted for all blogs
	 * As a temporary solution, this method loops through all blogs and remove transient from each of them
	 *
	 * @todo: find a better solution
	 * @note the function got its name from multisite version
	 */
	private function delete_transient_from_all_blogs() {
		delete_transient( 'woomulti_product_sync_queue' );
	}

	/**
	 * When _woonet_publish_to_<blog_id> set to No, check if the product has previously been synced.
	 * If it was synced, unsync is required and we need to queue the blog for update.
	 *
	 * If it has never been synced, skip updating.
	 */
	public function is_sync_required( $data, $blog_id ) {
		if ( isset( $data['post_ID'] ) ) {
			$data['post'] = (array) $data['post_ID'];
		}

		if ( ! empty( $data['post'] ) ) {
			foreach ( $data['post'] as $pid ) {
				$post = get_post_meta( $pid, '_woonet_publish_to_' . $blog_id, true );

				if ( ! empty( $post ) && strtolower( $post ) == 'yes' ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Check if the product being updated is a child product
	 */
	public function is_child_product() {
		$network_type = get_option( 'woonet_network_type' );

		if ( $network_type == 'master' ) {
			return false;
		}

		return true;
	}

	/**
	 * Update child product metadata
	 */
	public function update_child_product_metadata( $post_id ) {
		if ( isset( $_REQUEST['_woonet_child_inherit_updates'] ) ) {
			update_post_meta( $post_id, '_woonet_child_inherit_updates', strip_tags( $_REQUEST['_woonet_child_inherit_updates'] ) );
		}

		if ( isset( $_REQUEST['_woonet_child_stock_synchronize'] ) ) {
			update_post_meta( $post_id, '_woonet_child_stock_synchronize', strip_tags( $_REQUEST['_woonet_child_stock_synchronize'] ) );
		}
	}

	/**
	 * Check if the user is on edit screen
	 */
	public function is_edit_screen() {
		if ( ! empty( $_REQUEST['page'] ) && $_REQUEST['page'] == 'woonet-woocommerce-products' && ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'edit' ) {
			return true;
		}

		if ( ! empty( $_REQUEST['action'] )
			 && ( $_REQUEST['action'] == 'editpost' || $_REQUEST['action'] == 'edit' )
			 && ! empty( $_REQUEST['post_type'] ) && $_REQUEST['post_type'] == 'product' ) {
			return true;
		}

		return false;
	}


	/**
	 * Append the query string that is used by Sync function to determine whether to show sync dialogue
	 */
	public function add_storage_id_to_query_string( $url, $status_code ) {

		if ( ! empty( $_REQUEST['woomulti_storage_id'] ) ) {
			return add_query_arg( 'woomulti_storage_id', $_REQUEST['woomulti_storage_id'], $url );
		} else {
			return $url;
		}
	}

	public function update_parent_product_metadata( $post_id ) {
		$sites = get_option( 'woonet_child_sites' );

		foreach ( $sites as $site ) {
			$key = '_woonet_publish_to_' . $site['uuid'];
			update_post_meta( $post_id, $key, $_REQUEST[ $key ] );

			$key = '_woonet_publish_to_' . $site['uuid'] . '_child_inheir';
			update_post_meta( $post_id, $key, $_REQUEST[ $key ] );

			$key = '_woonet_' . $site['uuid'] . '_child_stock_synchronize';
			update_post_meta( $post_id, $key, $_REQUEST[ $key ] );
		}
	}

	public function receive_product_from_child() {
		if ( get_option( 'woonet_network_type' ) != 'child' ) {
			return;
		}

		$sync = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();
		$sync->sync_child();
	}

	public function quick_sync() {
		$stores = $this->get_selected_stores( $_REQUEST );

		if ( $this->is_child_product() ) {
			$this->update_child_product_metadata( $post_id );
		} else {
			$this->update_parent_product_metadata( $post_id );
		}

		foreach ( $stores as $store ) {
			$sync = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();
			$sync->sync( $_REQUEST['post_ID'], $store );
		}
	}

	/**
	 * Send child site orders to master
	 *
	 * Send child site orders to the master site to be displayed on
	 * the network order interface.
	 *
	 * @since 3.0.0
	 */
	public function send_child_orders() {
		global $wpdb;

		$per_page = 10;
		$page     = 1;

		if ( ! empty( $_REQUEST['per_page'] ) ) {
			$per_page = (int) $_REQUEST['per_page'];
		}

		if ( ! empty( $_REQUEST['page'] ) ) {
			$page = (int) $_REQUEST['page'];
		}

		$_engine = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();

		if ( ! $_engine->is_request_authenticated( $_POST ) ) {
			woomulti_log_error( 'ORDER LIST: Authentication failed.' );
			
			die(
				json_encode(
					array(
						'error'   => 1,
						'message' => 'You are not allowed to access this resource.',
					)
				)
			);
		}

		$query = new WC_Order_Query(
			array(
				'limit' => $per_page,
				'page'  => $page,
			)
		);

		$orders       = $query->get_orders();
		$orders_array = array();
		$site_data    = get_option( 'woonet_master_connect' );

		if ( ! empty( $orders ) ) {
			foreach ( $orders as $order ) {
				$order_data = $order->get_data();

				$items = array();

				foreach ( $order->get_items() as $item ) {
					$items[] = array_merge(
						$item->get_data(),
						array(
							'meta_data' => get_post_meta( $item->get_id() ),
						)
					);
				}

				$order_meta = array();

				foreach ( get_post_meta( $order->get_id() ) as $key => $value ) {
					$order_meta[ $key ] = isset( $value[0] ) ? $value[0] : '';
				}

				$orders_array[] = array_merge(
					$order_data,
					array(
						'date_created'   => $order_data['date_created']->date( 'Y/m/d H:i:s' ),
						'date_modified'  => $order_data['date_modified']->date( 'Y/m/d H:i:s' ),
						'meta_data'      => $order_meta,
						'line_items'     => $items,
						'shipping_lines' => array(), // not needed
					),
					array(
						'uuid'       => $site_data['uuid'],
						'store_url'  => site_url(),
						'store_name' => get_bloginfo( 'name' ),
					)
				);
			}
		}

		$total = $wpdb->get_var( 'SELECT count(*) as total FROM ' . $wpdb->prefix . "posts WHERE post_type IN('shop_order_refund', 'shop_order')" );

		echo json_encode(
			array(
				'page'     => $page,
				'per_page' => $per_page,
				'total'    => $total,
				'orders'   => $orders_array,
			)
		);
		die; // prevent 0 at the end of the output
	}

	/**
	 * Update order status on the child site
	 *
	 * When master initiates a request to update child status
	 * this hook runs on the child site to update the status
	 *
	 *
	 * @since 3.0.3
	 */
	public function update_child_status() {
		$_engine = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();

		if ( ! $_engine->is_request_authenticated( $_POST ) ) {
			echo json_encode(array(
				'status'  => 'failed',
				'message' => 'Authentication failed for ' . site_url(),
			));
			die;
		}

		if ( !empty( $_POST['post_data'] ) ) {

			$post_data = (array) $_POST['post_data'];
			$status_message = '';
			$failed  = array();
			$success = array();

			if( !empty( $post_data ) ) {
				foreach( $post_data as $post ) {
					$order = wc_get_order( (int) $post['post'] );

					if ( $order && $order->update_status( $post['status'] ) ) {
						$success[] = '#' . $post['post'];
					} else {
						$failed[] = '#' . $post['post'];
					}
				}
			}

			if ( !empty( $success ) ) {
				$status_message .= 'Status for order(s) ' . implode(',', $success) . ' were succesfully updated on ' . site_url() . '.';
			}

			if ( !empty( $failed ) ) {
				$status_message .= 'Status for order(s) ' . implode(',', $failed) . ' failed to update on ' . site_url() . '.';
			}

			echo json_encode(array(
				'status'  => 'success',
				'message' => $status_message 
			));
		} else {
			echo json_encode(array(
				'status'  => 'failed',
				'message' => 'Child site (' . site_url() . ') received no data.',
			));
		}

		die;
	}
}

$GLOBALS['WOO_MSTORE_SINGLE_NETWORK_PRODUCTS_SYNC'] = new WOO_MSTORE_SINGLE_NETWORK_PRODUCTS_SYNC();
