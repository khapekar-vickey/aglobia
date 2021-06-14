<?php

/**
 * Network order interface
 */
class WOO_MSTORE_SINGLE_NETWORK_ORDERS {


	var $network_dashboard_url;

	public function __construct() {
		add_action( 'init', array( $this, 'init' ), 10, 0 );
	}

	public function init() {
		$this->network_dashboard_url = admin_url( 'admin.php?page=woonet-woocommerce' );

		if ( ! woomulti_has_valid_license() ) {
			return;
		}

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'network-orders' ) {
            // handle bulk actions.
			add_action( 'wp_loaded', array( $this, 'orders_interface_form_submit' ), 1 );
		}

		add_action( 'admin_menu', array( $this, 'network_admin_menu' ) );
		add_filter( 'set-screen-option', array( $this, 'set_screen_options' ), 10, 3 );
		add_filter( 'manage_toplevel_page_woonet-woocommerce-network_columns', array( $this, 'add_column_headers' ) );
	}

	function network_admin_menu() {
		// only if superadmin
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! woomulti_has_valid_license() ) {
			return;
		}

		if ( get_option( 'woonet_network_type' ) == 'master' ) {
			$menus_hook = add_submenu_page(
				'woonet-woocommerce',
				'Network Orders',
				'Network Orders',
				'manage_options',
				'network-orders',
				array(
					$this,
					'orders_interface',
				)
			);

			add_action( 'load-' . $menus_hook, array( $this, 'load_dependencies' ) );
			add_action( 'load-' . $menus_hook, array( $this, 'admin_notices' ) );
			add_action( 'load-' . $menus_hook, array( $this, 'screen_options' ) );

			add_action( 'admin_print_styles-' . $menus_hook, array( $this, 'admin_print_styles' ) );
			add_action( 'admin_print_scripts-' . $menus_hook, array( $this, 'admin_print_scripts' ) );
		}
	}


	function load_dependencies() {

	}

	function admin_notices() {
		global $WOO_SL_messages;

		if ( ! is_array( $WOO_SL_messages ) || count( $WOO_SL_messages ) < 1 ) {
			return;
		}

		foreach ( $WOO_SL_messages    as $message_data ) {
			echo "<div id='notice' class='" . $message_data['status'] . " fade'><p>" . $message_data['message'] . '</p></div>';
		}
	}

	function admin_print_styles() {
		$WC_url = plugins_url() . '/woocommerce';
		wp_enqueue_style( 'woocommerce_admin_styles', $WC_url . '/assets/css/admin.css', array() );
	}

	function admin_print_scripts() {
		$WC_url = plugins_url() . '/woocommerce';
		wp_register_script( 'jquery-tiptip', $WC_url . '/assets/js/jquery-tiptip/jquery.tipTip.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-tiptip' );

		wp_register_script( 'woocommerce_admin', $WC_url . '/assets/js/admin/woocommerce_admin.js', array( 'jquery', 'jquery-blockui', 'jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-tiptip' ) );
		wp_enqueue_script( 'woocommerce_admin' );
	}


	function screen_options() {
		$screen = get_current_screen();

		if ( is_object( $screen ) && $screen->id == 'multistore_page_network-orders' ) {
			$args = array(
				'label'   => __( 'Orders per page from each site', 'woonet' ),
				'default' => 10,
				'option'  => 'orders_per_page',
			);

			add_screen_option( 'per_page', $args );
		}
	}

	function set_screen_options( $status, $option, $value ) {
		if ( 'orders_per_page' == $option ) {
			$status = absint( $value );
		}

		return $status;
	}

	private function search_orders( $term, $blog_prefix ) {
		global $wpdb;

		/**
		 * Searches on meta data can be slow - this lets you choose what fields to search.
		 * 3.0.0 added _billing_address and _shipping_address meta which contains all address data to make this faster.
		 * This however won't work on older orders unless updated, so search a few others (expand this using the filter if needed).
		 *
		 * @var array
		 */
		$search_fields = array_map(
			'wc_clean',
			apply_filters(
				'woocommerce_shop_order_search_fields',
				array(
					'_billing_address_index',
					'_shipping_address_index',
					'_billing_last_name',
					'_billing_email',
				)
			)
		);

		$order_ids = array();

		if ( is_numeric( $term ) ) {
			$order_ids[] = absint( $term );
		}

		if ( ! empty( $search_fields ) ) {
			$order_ids_postmeta    = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT DISTINCT p1.post_id FROM {$blog_prefix}postmeta p1 WHERE p1.meta_value LIKE %s AND p1.meta_key IN ('" . implode( "','", array_map( 'esc_sql', $search_fields ) ) . "')", // @codingStandardsIgnoreLine
					'%' . $wpdb->esc_like( wc_clean( $term ) ) . '%'
				)
			);
			$order_ids_order_items = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT order_id
							FROM {$blog_prefix}woocommerce_order_items as order_items
							WHERE order_item_name LIKE %s",
					'%' . $wpdb->esc_like( wc_clean( $term ) ) . '%'
				)
			);
			$order_ids             = array_unique(
				array_merge(
					$order_ids,
					$order_ids_postmeta,
					$order_ids_order_items
				)
			);
		}

		return apply_filters( 'woocommerce_shop_order_search_results', $order_ids, $term, $search_fields );
	}


	private function get_all_sites_orders( $per_page = 10, $paged = 1, $post_status = '', $search = '' ) {
		if ( ! empty( $_REQUEST['paged'] ) ) {
			$page = (int) $_REQUEST['paged'];
		}

		$query = new WC_Order_Query(
			array(
				'limit' => $per_page,
				'page'  => $page,
			)
		);

		$orders = $query->get_orders();

		$_engine               = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();
		$site_orders           = array();
		$sites                 = get_option( 'woonet_child_sites' );
		$highest_total_records = (int) $per_page;

		if ( ! empty( $sites ) ) {
			foreach ( $sites as $site ) {
				$current_site_orders = $_engine->fetch_child_orders( $site, $page, $per_page );

				if ( ! empty( $current_site_orders['total'] ) && $current_site_orders['total'] > $highest_total_records ) {
					$highest_total_records = $current_site_orders['total'];
				}

				if ( ! empty( $current_site_orders['orders'] ) ) {
					$site_orders = array_merge(
						$site_orders,
						$current_site_orders['orders']
					);
				}
			}
		}

		return array(
			'results'       => $site_orders,
			'total_records' => $highest_total_records,
		);
	}

	private function get_all_sites_orders_statuses() {
		return array();
	}

    /**
     * Handle bulk order status update
     */
	function orders_interface_form_submit() {
		$action   = isset( $_POST['action'] ) ? $_POST['action'] : '';
		$data_set = $_POST;

		if ( empty( $action ) ) {
			$action   = isset( $_GET['action'] ) ? $_GET['action'] : '';
			$data_set = $_GET;
		}

		// bulk actions
		if ( ! empty( $action ) ) {
            if ( empty($data_set['post']) ) {
                return;
            }

            $posts_list = (array) $data_set['post'];
            $update_post_array = array();

            foreach ( $posts_list as  $post_data ) {
                list($site_id, $post_id) = explode( '_', $post_data );

                if ( !empty($post_id) ) {
                    $update_post_array[ $site_id ][] = array(
                        'status' => $action,
                        'post'  => $post_id,
                    );
                }
            }

            if ( ! empty( $update_post_array ) ) {
                $_engine = new WOO_MSTORE_SINGLE_NETWORK_SYNC_ENGINE();
                $response = $_engine->sync_order_status( $update_post_array );

                set_transient('woonet_order_status_updates', $response, 300);

                wp_redirect(add_query_arg(
                    array(
                        'paged'  => !empty( $_REQUEST['paged'] ) ? (int) $_REQUEST['paged'] : 1,
                    ),
                    admin_url('admin.php?page=network-orders')
                ));
                die;
            }
		}
	}

	function orders_interface() {
		$user          = get_current_user_id();
		$screen        = get_current_screen();
		$screen_option = $screen->get_option( 'per_page', 'option' );
		$per_page      = get_user_meta( $user, $screen_option, true );

		if ( empty( $per_page ) || $per_page < 1 ) {
			$per_page = $screen->get_option( 'per_page', 'default' );
		}

		$paged       = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
		$post_status = isset( $_GET['post_status'] ) ? $_GET['post_status'] : '';
		$search      = empty( $_REQUEST['s'] ) ? '' : esc_sql( $_REQUEST['s'] );

		$data = $this->get_all_sites_orders( $per_page, $paged, '', $search );

		$orders                      = $data['results'];
		$total_records               = $data['total_records'];
		$current_post_status_records = $data['total_records'];

		if ( $post_status != '' ) {
			$data                        = $this->get_all_sites_orders( $per_page, $paged, $post_status, $search );
			$orders                      = $data['results'];
			$current_post_status_records = $data['total_records'];
		}

		$wc_order_statuses = wc_get_order_statuses();
		$wc_order_statuses = array_merge( $wc_order_statuses, get_post_statuses() );

		// add the trash
		$wc_order_statuses['trash'] = 'Trash';

		$order_statuses = $this->get_all_sites_orders_statuses();
		?>
			<div id="woonet" class="wrap">
                <div class='order_status_updates'>
                    <?php 
                        $woonet_order_status_updates = get_transient('woonet_order_status_updates');
                        delete_transient('woonet_order_status_updates'); //we need it only once.

                        if ( !empty( $woonet_order_status_updates ) ) {
                            foreach ( $woonet_order_status_updates as $site ) {
                                $site_status = $site['status'] == 'failed' ? 'error' : 'success';
                    ?>
                                <div class="notice notice-<?php echo $site_status; ?> is-dismissible">
                                    <p><?php _e( $site['message'], 'woonet' ); ?></p>
                                </div>
                    <?php

                            }

                        } 
                    ?>
                </div>
				<h2>Orders </h2>
				<ul class="subsubsub">
                    <li class="all">
                        <a class="<?php if ( $post_status == '' ) { echo 'current'; } ?>" 
                            href="admin.php?page=woonet-woocommerce"> All <span class="count">(<?php echo $total_records; ?>)</span>
                        </a>
                    	<?php if ( count( $order_statuses ) > 0 ) { ?> | 
                    </li>
							<?php

								$remaining = count( $order_statuses );
								foreach ( $order_statuses as  $order_status   => $count ) {
									$remaining--;
							?>
			        <li class="wc-processing">
                        <a class="<?php if ( $post_status == $order_status ) { echo 'current'; }?>" 
                            href="admin.php?page=woonet-woocommerce&post_status=<?php echo $order_status; ?>"><?php echo $wc_order_statuses[ $order_status ]; ?> 
                            <span class="count">(<?php echo $count; ?>)</span>
                        </a>
						<?php if ( $remaining > 0 ) { echo ' |';} ?>
                    </li>
						<?php
						      }
							} else { ?>
	               </li>
					<?php } ?>
                </ul>
				
				<form id="posts-filter" method="post" action="
				<?php
					$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
					$current_url = remove_query_arg( array( 'hotkeys_highlight_last', 'hotkeys_highlight_first', 'paged' ), $current_url );
					echo $current_url;
				?>
				">

				<?php
					$text     = __( 'Search orders', 'woocommerce' );
					$input_id = 'post';
					$input_id = $input_id . '-search-input';

    				if ( ! empty( $_REQUEST['orderby'] ) ) {
    					echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
    				}

    				if ( ! empty( $_REQUEST['order'] ) ) {
    					echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
    				}

    				if ( ! empty( $_REQUEST['post_mime_type'] ) ) {
    					echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
    				}

    				if ( ! empty( $_REQUEST['detached'] ) ) {
    					echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
    				}
				?>
				<p class="search-box">
					<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo $text; ?>:</label>
					<input type="search" id="<?php echo esc_attr( $input_id ); ?>" name="s" value="<?php _admin_search_query(); ?>" />
					<?php submit_button( $text, '', '', false, array( 'id' => 'search-submit' ) ); ?>
				</p>

				<div class="tablenav top">
					
					<div class="alignleft actions bulkactions">
						<?php $this->bulk_action( $post_status ); ?>
					</div>
					
				
					<?php
						$this->pagination( $current_post_status_records, $per_page, $paged, 'top' );
					?>
					  
				</div>
				<div class="post-type-shop_order">
					<table class="wp-list-table widefat fixed posts">
						<thead>
							<tr>
								<th style="" class="manage-column column-cb check-column" id="cb"><label for="cb-select-all-1" class="screen-reader-text"><?php _e( 'Select All', 'woonet' ); ?></label><input type="checkbox" id="cb-select-all-1"></th>
								<th style="" class="manage-column column-order_blog" id="order_blog" scope="col"><?php _e( 'Store name', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_title column-primary" id="order_title" scope="col"><?php _e( 'Order', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_date" id="order_date" scope="col"><?php _e( 'Date', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_status" id="order_status" scope="col"><?php _e( 'Status', 'woonet' ); ?></th>
								<th style="" class="manage-column column-billing_address" id="billing_address" scope="col"><?php _e( 'Billing', 'woonet' ); ?></th>
								<th style="" class="manage-column column-shipping_address" id="shipping_address" scope="col"><?php _e( 'Ship to', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_total" id="order_total" scope="col"><?php _e( 'Total', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_actions" id="order_actions" scope="col"><?php _e( 'Actions', 'woonet' ); ?></th>
							</tr>
						</thead>

						<tfoot>
							<tr>
								<th style="" class="manage-column column-cb check-column" id="cb"><label for="cb-select-all-1" class="screen-reader-text"><?php _e( 'Select All', 'woonet' ); ?></label><input type="checkbox" id="cb-select-all-1"></th>
								<th style="" class="manage-column column-order_blog" id="order_blog" scope="col"><?php _e( 'Store name', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_title column-primary" id="order_title" scope="col"><?php _e( 'Order', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_date" id="order_date" scope="col"><?php _e( 'Date', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_status" id="order_status" scope="col"><?php _e( 'Status', 'woonet' ); ?></th>
								<th style="" class="manage-column column-billing_address" id="billing_address" scope="col"><?php _e( 'Billing', 'woonet' ); ?></th>
								<th style="" class="manage-column column-shipping_address" id="shipping_address" scope="col"><?php _e( 'Ship to', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_total" id="order_total" scope="col"><?php _e( 'Total', 'woonet' ); ?></th>
								<th style="" class="manage-column column-order_actions" id="order_actions" scope="col"><?php _e( 'Actions', 'woonet' ); ?></th>
							</tr>
						</tfoot>

						<tbody id="the-list">

						<?php
						foreach ( $orders as $key => $order_data ) {
							?>
								<tr class="post-<?php echo esc_attr( $order_data['store_name'] ); ?>_<?php echo esc_attr( $order_data['id'] ); ?> type-shop_order status-<?php echo esc_attr( $order_data['status'] ); ?> post-password-required hentry" id="post-<?php echo esc_attr( $order_data['uuid'] ); ?>_<?php echo esc_attr( $order_data['id'] ); ?>">
									<th class="check-column" scope="row"><input type="checkbox" value="<?php echo $order_data['uuid']; ?>_<?php echo $order_data['id']; ?>" name="post[]" id="cb-select-<?php echo $order_data['uuid']; ?>_<?php echo $order_data['id']; ?>"><div class="locked-indicator"></div></th>
									<td class="order_blog column-order_blog"><?php $this->render_shop_order_columns( 'order_blog', $order_data ); ?></td>
									<td class="order_title column-order_title"><?php $this->render_shop_order_columns( 'order_title', $order_data ); ?></td>
									<td class="order_date column-order_date"><?php $this->render_shop_order_columns( 'order_date', $order_data ); ?></td>
									<td class="order_status column-order_status">
									<?php $this->render_shop_order_columns( 'order_status', $order_data ); ?>
									</td>
									<td class="billing_address column-billing_address"><?php $this->render_shop_order_columns( 'billing_address', $order_data ); ?></td>
									<td class="shipping_address column-shipping_address"><?php $this->render_shop_order_columns( 'shipping_address', $order_data ); ?></td>
									<td class="order_total column-order_total"> <?php echo get_woocommerce_currency_symbol( $order_data['currency'] ); ?> <?php $this->render_shop_order_columns( 'order_total', $order_data ); ?></td>
									<td class="order_actions column-order_actions">
									   <?php $this->render_shop_order_columns( 'order_actions', $order_data ); ?>
									</td>
								</tr>
							<?php
						}

						?>
						</tbody>
					</table>
				</div>

				<div class="tablenav bottom">
					<?php
						$this->pagination( $current_post_status_records, $per_page, $paged, 'bottom' );
					?>
				</div>
				</form>
			</div> 
		<?php
	}

	public function render_shop_order_columns( $column, $the_order ) {
		switch ( $column ) {
			case 'order_status':
				printf(
					'<mark class="order-status status-%s"><span>%s</span></mark>',
					esc_attr( $the_order['status'] ),
					esc_html( wc_get_order_status_name( $the_order['status'] ) )
				);
				break;
			case 'order_blog':
				echo '<span class="na">' . $the_order['store_name'] . '</span>';
				break;
			case 'order_date':
				echo '<abbr title="' . esc_attr( $the_order['date_created'] ) . '">' . esc_html( $the_order['date_created'] ) . '</abbr>';
				break;
			case 'customer_message':
				if ( $the_order->get_customer_note() ) {
					echo '<span class="note-on tips" data-tip="' . esc_attr( $the_order['customer_note'] ) . '">' . __( 'Yes', 'woonet' ) . '</span>';
				} else {
					echo '<span class="na">&ndash;</span>';
				}
				break;
			case 'order_items':
				echo '<a href="#" class="show_order_items">' . count( $the_order['line_items'] ) . '</a>';

				if ( sizeof( $the_order['line_items'] ) > 0 ) {

					echo '<table class="order_items" cellspacing="0">';

					foreach ( $the_order['line_items'] as $item ) {
						?>
						<tr class="<?php echo apply_filters( 'woocommerce_admin_order_item_class', '', $item ); ?>">
							<td class="qty"><?php echo absint( $item['qty'] ); ?></td>
							<td class="name">
								<?php $item['name']; ?>
								<?php if ( $item['meta'] ) : ?>
									<a class="tips" href="#" data-tip="<?php echo esc_attr( $item['meta'] ); ?>">[?]</a>
								<?php endif; ?>
							</td>
						</tr>
						<?php
					}

					echo '</table>';

				} else {
					echo '&ndash;';
				}
				break;
			case 'billing_address':
				$address = implode( ' ', $the_order['billing'] );

				if ( $address ) {
					echo esc_html( $address );

					if ( $the_order['payment_method_title'] ) {
						/* translators: %s: payment method */
						echo '<span class="description">' . sprintf( __( 'via %s', 'woocommerce' ), esc_html( $the_order['payment_method_title'] ) ) . '</span>'; // WPCS: XSS ok.
					}
				} else {
					echo '&ndash;';
				}
				break;
			case 'shipping_address':
				if ( ! empty( $the_order['shipping'] ) ) {
					echo '<a target="_blank" href="' . esc_url( 'https://maps.google.com/maps?&q=' . urlencode( implode( ',', $the_order['shipping'] ) ) . '&z=16' ) . '">' . esc_html( preg_replace( '#<br\s*/?>#i', ', ', implode( ' ', $the_order['shipping'] ) ) ) . '</a>';
				} else {
					echo '&ndash;';
				}

				if ( true ) {
					echo '<small class="meta">' . __( 'Via', 'woonet' ) . ' ' . esc_html( 'N/A' ) . '</small>';
				}

				break;
			case 'order_notes':
				echo '';
				break;
			if ( $post->comment_count ) {
				// check the status of the post
				( $post->post_status !== 'trash' ) ? $status = '' : $status = 'post-trashed';

				$latest_notes = get_comments(
					array(
						'post_id'   => $post->ID,
						'number'    => 1,
						'status'    => $status,
						'post_type' => 'any',
					)
				);

				$latest_note = current( $latest_notes );

				if ( $latest_note === false ) {
					echo '<span class="na">&ndash;</span>';
					return;
				}

				if ( $post->comment_count == 1 ) {
					echo '<span class="note-on tips" data-tip="' . esc_attr( $latest_note->comment_content ) . '">' . __( 'Yes', 'woonet' ) . '</span>';
				} else {
					$note_tip = isset( $latest_note->comment_content ) ? esc_attr( $latest_note->comment_content . '<small style="display:block">' . sprintf( _n( 'plus %d other note', 'plus %d other notes', ( $post->comment_count - 1 ), 'woonet' ), ( $post->comment_count - 1 ) ) . '</small>' ) : sprintf( _n( '%d note', '%d notes', $post->comment_count, 'woonet' ), $post->comment_count );

					echo '<span class="note-on tips" data-tip="' . $note_tip . '">' . __( 'Yes', 'woonet' ) . '</span>';
				}
			} else {
				echo '<span class="na">&ndash;</span>';
			}

			break;
			case 'order_total':
				echo esc_html( strip_tags( $the_order['total'] ) );

				if ( $the_order['payment_method_title'] ) {
					echo '<small class="meta">' . __( 'Via', 'woonet' ) . ' ' . esc_html( $the_order['payment_method_title'] ) . '</small>';
				}
				break;
			case 'order_title':
				if ( $address = $the_order['billing'] ) {
					$customer_tip .= __( 'Billing:', 'woonet' ) . ' ' . implode( ' ', $the_order['billing'] ) . '<br/><br/>';
				}

				if ( $the_order['billing']['phone'] ) {
					$customer_tip .= __( 'Tel:', 'woonet' ) . ' ' . $the_order['billing']['phone'];
				}

				echo '<div class="tips" data-tip="' . esc_attr( $customer_tip ) . '">';

				if ( false ) {
					// if ( ! empty( $user_info ) ) {

					$username = '<a href="' . $the_order['store_url'] . 'user-edit.php?user_id=' . absint( $user_info->ID ) . '">';

					if ( $user_info->first_name || $user_info->last_name ) {
						$username .= esc_html( ucfirst( $user_info->first_name ) . ' ' . ucfirst( $user_info->last_name ) );
					} else {
						$username .= esc_html( ucfirst( $user_info->display_name ) );
					}

					$username .= '</a>';

				} else {
					if ( $the_order['billing']['first_name'] || $the_order['billing']['first_name'] ) {
						$username = trim( $the_order['billing']['first_name'] . ' ' . $the_order['billing']['last_name'] );
					} else {
						$username = __( 'Guest', 'woonet' );
					}
				}

				printf( __( '%1$s by %2$s', 'woonet' ), '<a href="' . $the_order['store_url'] . '/wp-admin/post.php?post=' . absint( $the_order['id'] ) . '&action=edit' . '"><strong>' . esc_attr( $the_order['id'] ) . '</strong></a>', $the_order['customer_id'] );

				if ( $the_order['billing']['email'] ) {
					echo '<small class="meta email"><a href="' . esc_url( 'mailto:' . $the_order['billing']['email'] ) . '">' . esc_html( $the_order['billing']['email'] ) . '</a></small>';
				}

				echo '</div>';

				break;
			case 'order_actions':
				echo '<p>';

				do_action( 'woocommerce_admin_order_actions_start', $the_order );

				$actions = array();

    			if ( !empty($the_order['status']) && in_array($the_order['status'], array( 'pending', 'on-hold' )) ) {
    				$actions['processing'] = array(
    					'url'    => add_query_arg(
    						array(
    							'action' => 'processing',
    							'post'   => $the_order['uuid'] . '_' . $the_order['id'],
                                'paged'  => !empty( $_REQUEST['paged'] ) ? (int) $_REQUEST['paged'] : 1,
    						),
    						admin_url('admin.php?page=network-orders')
    					),
    					'name'   => __( 'Processing', 'woonet' ),
    					'action' => 'processing',
    				);
    			}

    			if ( !empty($the_order['status']) && in_array($the_order['status'], array( 'pending', 'on-hold', 'processing' )) ) {
    				$actions['complete'] = array(
    					'url'    => add_query_arg(
    						array(
    							'action' => 'completed',
    							'post'   => $the_order['uuid'] . '_' . $the_order['id'],
                                'paged'  => !empty( $_REQUEST['paged'] ) ? (int) $_REQUEST['paged'] : 1,
    						),
    						admin_url('admin.php?page=network-orders')
    					),
    					'name'   => __( 'Complete', 'woonet' ),
    					'action' => 'complete',
    				);
    			}

				$actions['view'] = array(
					'url'    => esc_url( $the_order['store_url'] .  '/wp-admin/post.php?post=' .  $the_order['id'] . '&action=edit' ),
					'name'   => __( 'View', 'woonet' ),
					'action' => 'view',
				);

				$actions = apply_filters( 'woocommerce_admin_order_actions', $actions, $the_order );

				foreach ( $actions as $action ) {
					printf(
						'<a style="margin-bottom: 5px;" class="button tips wc-action-button wc-action-button-%1$s %1$s" href="%2$s" data-tip="%3$s">%3$s</a>',
						esc_attr( $action['action'] ),
						esc_url( $action['url'] ),
						esc_attr( $action['name'] )
					);
				}

				do_action( 'woocommerce_admin_order_actions_end', $the_order );
				echo '</p>';
				break;
		}
	}

	function pagination( $total_items, $per_page, $paged, $which = 'top' ) {
		$total_pages = ceil( $total_items / $per_page );

		$output = '<span class="displaying-num">' . sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) ) . '</span>';

		$current = $paged;

		$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );

		$current_url = remove_query_arg( array( 'hotkeys_highlight_last', 'hotkeys_highlight_first' ), $current_url );

		$page_links = array();

		$disable_first = $disable_last = '';

		if ( $current == 1 ) {
			$disable_first = ' disabled';
		}

		if ( $current == $total_pages ) {
			$disable_last = ' disabled';
		}

		$page_links[] = sprintf(
			"<a class='%s' title='%s' href='%s'>%s</a>",
			'first-page woonet-navigation-links' . $disable_first,
			esc_attr__( 'Go to the first page', 'woonet' ),
			esc_url( remove_query_arg( 'paged', $current_url ) ),
			'&laquo;'
		);

		$page_links[] = sprintf(
			"<a class='%s' title='%s' href='%s'>%s</a>",
			'prev-page woonet-navigation-links' . $disable_first,
			esc_attr__( 'Go to the previous page', 'woonet' ),
			esc_url( add_query_arg( 'paged', max( 1, $current - 1 ), $current_url ) ),
			'&lsaquo;'
		);

		if ( 'bottom' == $which ) {
			$html_current_page = $current;
		} else {
			$html_current_page = sprintf(
				"%s<input class='current-page' id='current-page-selector' title='%s' type='text' name='paged' value='%s' size='%d' />",
				'<label for="current-page-selector" class="screen-reader-text">' . __( 'Select Page', 'woonet' ) . '</label>',
				esc_attr__( 'Current page', 'woonet' ),
				$current,
				strlen( $total_pages )
			);
		}

		$html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
		$page_links[]     = '<span class="paging-input">' . sprintf( _x( '%1$s of %2$s', 'paging' ), $html_current_page, $html_total_pages ) . '</span>';

		$page_links[] = sprintf(
			"<a class='%s' title='%s' href='%s'>%s</a>",
			'next-page woonet-navigation-links' . $disable_last,
			esc_attr__( 'Go to the next page', 'woonet' ),
			esc_url( add_query_arg( 'paged', min( $total_pages, $current + 1 ), $current_url ) ),
			'&rsaquo;'
		);

		$page_links[] = sprintf(
			"<a class='%s' title='%s' href='%s'>%s</a>",
			'last-page woonet-navigation-links' . $disable_last,
			esc_attr__( 'Go to the last page', 'woonet' ),
			esc_url( add_query_arg( 'paged', $total_pages, $current_url ) ),
			'&raquo;'
		);

		$pagination_links_class = 'pagination-links';

		if ( ! empty( $infinite_scroll ) ) {
			$pagination_links_class = ' hide-if-js';
		}

		$output .= "\n<span class='$pagination_links_class'>" . join( "\n", $page_links ) . '</span>';

		if ( $total_pages ) {
			$page_class = $total_pages < 2 ? ' one-page' : '';
		} else {
			$page_class = ' no-pages';
		}

		$_pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";

		echo $_pagination;
	}


	function bulk_action( $post_status ) {
		?>
			<label class="screen-reader-text" for="bulk-action-selector-top"><?php _e( 'Select bulk action', 'woonet' ); ?></label>

			<select id="bulk-action-selector-top" name="action">
				<option selected="selected" value="-1"><?php _e( 'Bulk Actions', 'woonet' ); ?></option>
				<?php
				    if ( $post_status == 'trash' ) {
				?>
				<option value="untrash"><?php _e( 'Restore', 'woonet' ); ?></option>
				<option value="delete"><?php _e( 'Delete Permanently', 'woonet' ); ?></option>
				<?php } else { ?>
				<option value="trash"><?php _e( 'Move to Trash', 'woonet' ); ?></option>
				<?php } ?>
				<option value="processing"><?php _e( 'Mark processing', 'woonet' ); ?></option>
				<option value="on-hold"><?php _e( 'Mark on-hold', 'woonet' ); ?></option>
				<option value="completed"><?php _e( 'Mark complete', 'woonet' ); ?></option>
			</select>
			
			<input type="submit" value="Apply" class="button action" id="doaction" name="">
		<?php
	}

	public function add_column_headers() {
		$column_headers = array(
			'order_blog'       => __( 'Store name', 'woonet' ),
			'order_title'      => __( 'Order', 'woocommerce' ),
			'order_date'       => __( 'Date', 'woocommerce' ),
			'order_status'     => __( 'Status', 'woocommerce' ),
			'billing_address'  => __( 'Billing', 'woocommerce' ),
			'shipping_address' => __( 'Ship to', 'woocommerce' ),
			'order_total'      => __( 'Total', 'woocommerce' ),
			'order_actions'    => __( 'Actions', 'woocommerce' ),
		);

		return $column_headers;
	}
}

$GLOBALS['WOO_MSTORE_SINGLE_NETWORK_ORDERS'] = new WOO_MSTORE_SINGLE_NETWORK_ORDERS();
