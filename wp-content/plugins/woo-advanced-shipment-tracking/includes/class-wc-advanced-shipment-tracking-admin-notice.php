<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WC_Advanced_Shipment_Tracking_Admin_notice {

	/**
	 * Instance of this class.
	 *
	 * @var object Class Instance
	 */
	private static $instance;
	
	/**
	 * Initialize the main plugin function
	*/
    public function __construct() {
		
		global $wpdb;
		$this->table = $wpdb->prefix."woo_shippment_provider";
		if( is_multisite() ){
			if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			}
			if ( is_plugin_active_for_network( 'woo-advanced-shipment-tracking/woocommerce-advanced-shipment-tracking.php' ) ) {
				$main_blog_prefix = $wpdb->get_blog_prefix(BLOG_ID_CURRENT_SITE);			
				$this->table = $main_blog_prefix."woo_shippment_provider";	
			} else{
				$this->table = $wpdb->prefix."woo_shippment_provider";
			}			
		} else{
			$this->table = $wpdb->prefix."woo_shippment_provider";	
		}
		
		$this->init();	
    }
	
	/**
	 * Get the class instance
	 *
	 * @return WC_Advanced_Shipment_Tracking_Admin_notice
	*/
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	
	/*
	* init from parent mail class
	*/
	public function init(){						
		add_action( 'wp_ajax_ast_hide_admin_menu_tooltip', array( $this, 'ast_mark_admin_menu_tooltip_hidden') );		
		$wc_ast_api_key = get_option('wc_ast_api_key');		
		
		require_once( 'vendor/persist-admin-notices-dismissal/persist-admin-notices-dismissal.php' );			
		add_action( 'admin_init', array( 'PAnD', 'init' ) );
				
		add_action( 'admin_notices', array( $this, 'admin_notice_for_addon' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice_after_update' ) );		
		add_action( 'admin_notices', array( $this, 'admin_notice_for_sync_providers' ) );				
		
		if(!$wc_ast_api_key){
			add_action( 'adminmenu', array( $this, 'admin_notice_menu_tooltip') );
		}
		
		if ( is_plugin_active( 'woocommerce-pdf-invoices-packing-slips/woocommerce-pdf-invoices-packingslips.php' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_for_invoices_plugin' ) );
		}
	}		

	/*
	* Display admin notice addons
	*/	
	public function admin_notice_for_addon(){
		if ( ! PAnD::is_admin_notice_active( 'disable-alp-plugin-notice-forever' ) ) {
			return;
		}
		?>		
		<style>		
		.notice.addon-admin-notice {			
			padding: 10px 20px;
			background: #F6FBFF;
			border: 1px solid #eee;
			border-left: 4px solid #23305e !important;
		}
		.rtl .notice.addon-admin-notice {
			border-right-color: #83bd31 !important;
		}
		.notice.addon-admin-notice .ast-admin-notice-inner {
			display: table;
			width: 100%;
		}
		.notice.addon-admin-notice .ast-admin-notice-inner .ast-admin-notice-icon,
		.notice.addon-admin-notice .ast-admin-notice-inner .ast-admin-notice-content,
		.notice.addon-admin-notice .ast-admin-notice-inner .trackship-install-now {
			display: table-cell;
			vertical-align: middle;
		}
		.notice.addon-admin-notice .ast-admin-notice-icon {
			color: #83bd31;			
		}
		.notice.addon-admin-notice .ast-admin-notice-icon .notice-logo{
			width: 200px;
		}
		.notice.addon-admin-notice .ast-admin-notice-content {
			padding: 0 20px;
		}
		.notice.addon-admin-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.addon-admin-notice h3 {
			margin: 0 0 5px;
			color: #005B9A;
		}
		.notice.addon-admin-notice .trackship-install-now {
			text-align: center;
		}
		.notice.addon-admin-notice .trackship-install-now .hello-elementor-install-button {
			padding: 5px 30px;
			height: auto;
			line-height: 20px;
			text-transform: capitalize;
		}
		.notice.addon-admin-notice .trackship-install-now .hello-elementor-install-button i {
			padding-right: 5px;
		}
		.rtl .notice.addon-admin-notice .trackship-install-now .hello-elementor-install-button i {
			padding-right: 0;
			padding-left: 5px;
		}
		.notice.addon-admin-notice .trackship-install-now .hello-elementor-install-button:active {
			transform: translateY(1px);
		}
		.addon-admin-notice .notice-dismiss:before{
			color: #23305e;
			font: normal 20px/20px dashicons;
		}
		.wp-core-ui .btn_large.btn_blue {
			background: #005B9A;
			text-shadow: none;
			border-color: #005B9A;
			color: #fff;
			box-shadow: none;
			font-size: 14px;
			line-height: 30px;
			height: 34px;
			padding: 0 10px;
			margin-top: 5px;
		}
		.wp-core-ui .button-primary.btn_blue_outline {
			background: transparent;
			text-shadow: none;
			border-color: #005B9A;
			box-shadow: none;
			font-size: 14px;
			line-height: 30px;
			height: 34px;
			padding: 0 10px;
			margin-top: 5px;
			color: #005B9A;
		}
		.wp-core-ui .btn_blue:hover, .wp-core-ui .btn_blue:focus {
			background: #005B9A;
			border-color: rgba(0,0,0,0.05);
			color: #fff;
			text-shadow: none;
			box-shadow: inset 0 0 0 100px rgba(0,0,0,0.2);
		}
		.wp-core-ui .button-primary.btn_blue_outline.notice-dismiss,.wp-core-ui .button-primary.btn_blue.notice-dismiss{
			position: relative;
		}
		.wp-core-ui .button-primary.btn_blue.notice-dismiss:before,.wp-core-ui .button-primary.btn_blue_outline.notice-dismiss:before{
			display:none;
		}
		</style>	
		<div data-dismissible="disable-alp-plugin-notice-forever" class="notice updated is-dismissible addon-admin-notice">
			<div class="ast-admin-notice-inner">
				<div class="ast-admin-notice-icon">
					<img class="notice-logo" src="<?php echo wc_advanced_shipment_tracking()->plugin_dir_url().'/assets/images/zorem-logo.png'; ?>" alt="Tracking Per Item Add-on" />
				</div>
		
				<div class="ast-admin-notice-content">					
					<p>Local pickup is a perfect way for retailers to drive in-store foot traffic and with the current coronavirus pandemic, it has become vital for many businesses in order to survive. We just launched the <a target="blank" href="https://www.zorem.com/how-to-set-up-local-pickup-on-your-woocommerce-store/">Advanced Local Pickup plugin</a> to help WooCommerce stores to offer an improved local pickup process to their customers!</p>
					<div data-dismissible="disable-alp-plugin-notice-forever" style="display:inline-block;">
						<a class="button button-primary btn_blue btn_large notice-dismiss" href="<?php echo admin_url( 'plugin-install.php?tab=search&s=advanced+local+pickup+zorem&tab=search&type=term' )?>">Install for Free</a>	
					</div>	
					<div data-dismissible="disable-alp-plugin-notice-forever" style="display:inline-block;">						
						<a class="button button-primary btn_blue_outline notice-dismiss" href="javascript:void(0);">Dismiss this notice</a>	
					</div>
				</div>						
			</div>
		</div>
	<?php 
	}
	
	/*
	* Display admin notice if WooCommerce PDF Invoices & Packing Slips plugin is active that e remove compatibility code from plugin
	*/
	public function admin_notice_for_invoices_plugin(){
		if ( ! PAnD::is_admin_notice_active( 'disable-pdf-plugin-notice-forever' ) ) {
			return;
		}
		?>
		<div data-dismissible="disable-pdf-plugin-notice-forever" class="notice updated is-dismissible">
			<p>We removed compatibility code for WooCommerce PDF Invoices & Packing Slips plugin from our plugin. If you want to add tracking information in Invoice and packing slip PDF use this <a href="https://www.zorem.com/docs/woocommerce-advanced-shipment-tracking/compatibility/#pdf-invoices-plugins" target="blank">code snippet</a>.</p>
		</div>
		<?php	
	}
	
	/*
	* Display admin notice on plugin install or update
	*/
	public function admin_notice_after_update(){			
		if ( ! PAnD::is_admin_notice_active( 'disable-review-notice-forever' ) ) {
			return;
		}
		?>		
		<style>		
		.notice.ast-admin-notice {			
			padding: 20px;
			background: rgb(245, 248, 250);
			border: 1px solid #eee;
			border-left: 4px solid #83bd31 !important;
		}
		.rtl .notice.ast-admin-notice {
			border-right-color: #83bd31 !important;
		}
		.notice.ast-admin-notice .ast-admin-notice-inner {
			display: table;
			width: 100%;
		}
		.notice.ast-admin-notice .ast-admin-notice-inner .ast-admin-notice-icon,
		.notice.ast-admin-notice .ast-admin-notice-inner .ast-admin-notice-content,
		.notice.ast-admin-notice .ast-admin-notice-inner .trackship-install-now {
			display: table-cell;
			vertical-align: middle;
		}
		.notice.ast-admin-notice .ast-admin-notice-icon {
			color: #83bd31;			
		}
		.notice.ast-admin-notice .ast-admin-notice-icon .notice-logo{
			width: 200px;
		}
		.notice.ast-admin-notice .ast-admin-notice-content {
			padding: 0 20px;
		}
		.notice.ast-admin-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.ast-admin-notice h3 {
			margin: 0 0 5px;
			color: #061c58;
		}
		.notice.ast-admin-notice .trackship-install-now {
			text-align: center;
		}
		.notice.ast-admin-notice .trackship-install-now .hello-elementor-install-button {
			padding: 5px 30px;
			height: auto;
			line-height: 20px;
			text-transform: capitalize;
		}
		.notice.ast-admin-notice .trackship-install-now .hello-elementor-install-button i {
			padding-right: 5px;
		}
		.rtl .notice.ast-admin-notice .trackship-install-now .hello-elementor-install-button i {
			padding-right: 0;
			padding-left: 5px;
		}
		.notice.ast-admin-notice .trackship-install-now .hello-elementor-install-button:active {
			transform: translateY(1px);
		}
		.ast-admin-notice .notice-dismiss:before{
			color: #061c58;
			font: normal 20px/20px dashicons;
		}
		.wp-core-ui .btn_green2 {
			background: #83bd31;
			text-shadow: none;
			border-color: #83bd31;
			box-shadow: none;
			font-size: 14px;
			line-height: 32px;
			height: 35px;
			padding: 0 20px;
		}
		.wp-core-ui .btn_green2:hover, .wp-core-ui .btn_green2:focus {
			background: rgba(131, 189, 49, 0.8);
			border-color: rgba(131, 189, 49, 0.8);
			color: #fff;
			text-shadow: none;
			box-shadow: inset 0 0 0 100px rgba(0,0,0,0.2);
		}
		</style>	
		<div data-dismissible="disable-review-notice-forever" class="notice updated is-dismissible">
			<p>
			<?php			
				printf(
					//esc_html__( '%1$s %2$s.' ),
					esc_html__( 'We added many improvements to %1$s, please help and give us a review :) Thanks!', '' ),
					sprintf(
						'<a href="%s" target="blank">%s</a>',
						esc_url( 'https://wordpress.org/support/plugin/woo-advanced-shipment-tracking/reviews/#new-post' ),
						esc_html__( 'Advanced Shipment Tracking', '' )
					)
				);
			?>
			</p>
		</div>
	<?php 		
	}	
	/**
	* Admin menu tooltip.
	*/
	function admin_notice_menu_tooltip() {

		$show_tooltip = get_option( 'ast_admin_menu_tooltip', 0 );				
	
		if ( $show_tooltip ) {
			// Dismissed less than 30 days ago.
			return;
		}
			
		$url = 'https://trackship.info/?utm_source=wpadmin&utm_campaign=astpopup';
		?>
		<div id="ast-admin-menu-tooltip" class="ast-admin-menu-tooltip-hide">
			<div class="ast-admin-menu-tooltip-header">
				<!--span class="ast-admin-menu-tooltip-icon"><span class="dashicons dashicons-megaphone"></span></span-->
				Automate your Post-Shipping Operations
				<a href="#" class="ast-admin-menu-tooltip-close"><span class="dashicons dashicons-dismiss"></span></a>
			</div>
			<div class="ast-admin-menu-tooltip-content">
				<img src="<?php echo wc_advanced_shipment_tracking()->plugin_dir_url()?>assets/images/trackship-logo.png" class="sidebar_ts_logo" style="max-width: 50%;">
				<p>TrackShip will auto-track your shipments with 140+ carriers around the globe and display real-time shipment status on your orders admin. You can automate the order management flow, direct customers to a tracking page on your store, automatically send shipment status notifications to your customer and more…</p>
				<p>
					<a href="<?php echo esc_url( $url ); ?>" target="blank" class="button button-primary btn_green2 btn_large">Try TrackShip for free!</a>
				</p>
			</div>
		</div>
		<style type="text/css">
			#ast-admin-menu-tooltip {
				position: absolute;
				left: 100%;
				top: 100%;
				background: #fff;
				margin-left: 16px;
				width: 350px;
				box-shadow: 0px 4px 7px 0px #ccc;
			}
	
			#ast-admin-menu-tooltip:before {
				content: '';
				width: 0;
				height: 0;
				border-style: solid;
				border-width: 12px 12px 12px 0;
				border-color: transparent #fff transparent transparent;
				position: absolute;
				right: 100%;
				top: 130px;
				z-index: 10;
			}
	
			#ast-admin-menu-tooltip:after {
				content: '';
				width: 0;
				height: 0;
				border-style: solid;
				border-width: 13px 13px 13px 0;
				border-color: transparent #ccc transparent transparent;
				position: absolute;
				right: 100%;
				margin-left: -1px;
				top: 129px;
				z-index: 5;
			}
	
			#ast-admin-menu-tooltip.ast-tooltip-arrow-top:before {
				top: 55px;
			}
	
			#ast-admin-menu-tooltip.ast-tooltip-arrow-top:after {
				top: 54px;
			}
	
			.ast-admin-menu-tooltip-header {
				background: #83bd31;
				padding: 10px 12px;
				font-size: 14px;
				font-weight: 700;
				font-family: Arial, Helvetica, "Trebuchet MS", sans-serif;
				color: #fff;
				line-height: 1.6;
			}
	
			.ast-admin-menu-tooltip-icon {
				background: #fff;
				border-radius: 50%;
				width: 28px;
				height: 25px;
				display: inline-block;
				color: #83bd31;
				text-align: center;
				padding: 3px 0 0;
				margin-right: 6px;
			}
	
			.ast-admin-menu-tooltip-hide {
				display: none;
			}
	
			.ast-admin-menu-tooltip-content {
				padding: 20px 15px 7px;
			}
	
			.ast-admin-menu-tooltip-content strong {
				font-size: 14px;
			}
	
			.ast-admin-menu-tooltip-content p strong {
				font-size: 13px;
			}
	
			.ast-admin-menu-tooltip-close {
				color: #fff;
				text-decoration: none;
				position: absolute;
				right: 10px;
				top: 14px;
				display: block;
			}
	
			.ast-admin-menu-tooltip-close:hover {
				color: #fff;
				text-decoration: none;
			}
	
			.ast-admin-menu-tooltip-close .dashicons {
				font-size: 14px;
			}
	
			@media ( max-width: 782px ) {
				#ast-admin-menu-tooltip {
					display: none;
				}
			}
		</style>
		<script type="text/javascript">
			if ( 'undefined' !== typeof jQuery ) {
				jQuery( function ( $ ) {
					var $tooltip = $( document.getElementById( 'ast-admin-menu-tooltip' ) );
					var $menuwrapper = $( document.getElementById( 'adminmenuwrap' ) );
					var $menuitem = $( document.getElementById( 'toplevel_page_woocommerce' ) );				
	
					if ( $menuitem.length ) {
						$menuwrapper.append( $tooltip );
						$tooltip.removeClass( 'ast-admin-menu-tooltip-hide' );
					}
	
					function alignTooltip() {
						var sticky = $( 'body' ).hasClass( 'sticky-menu' );
	
						var menuitem_pos = $menuitem.position();
						
						var tooltip_top = menuitem_pos.top - 124;					
												
						if ( sticky && $( window ).height() > $menuwrapper.height() + 150 ) {
							$tooltip.removeClass( 'ast-tooltip-arrow-top' );
						} else {
							tooltip_top = menuitem_pos.top - 50;
							$tooltip.addClass( 'ast-tooltip-arrow-top' );
						}
												
						$tooltip.css( {
							top: tooltip_top + 'px'
						} );
					}
	
					var $document = $( document );
					var timeout = setTimeout( alignTooltip, 10 );
					$document.on( 'wp-pin-menu wp-window-resized.pin-menu postboxes-columnchange.pin-menu postbox-toggled.pin-menu wp-collapse-menu.pin-menu wp-scroll-start.pin-menu', function () {
						if ( timeout ) {
							clearTimeout( timeout );
						}
						timeout = setTimeout( alignTooltip, 10 );
					} );
	
					$( '.ast-admin-menu-tooltip-close' ).on( 'click', function ( e ) {
						e.preventDefault();
						hideTooltip();
					} );
	
					function hideTooltip() {
						$tooltip.addClass( 'ast-admin-menu-tooltip-hide' );
						$.post( ajaxurl, {
							action: 'ast_hide_admin_menu_tooltip',
							nonce: '<?php echo esc_js( wp_create_nonce( 'ast-admin-tooltip-nonce' ) ); ?>',
						} );
					}
				} );
			}
		</script>
		<?php
	}

	public function admin_notice_for_sync_providers(){
		if ( ! PAnD::is_admin_notice_active( 'disable-synch-provider-notice-forever' ) ) {
			return;
		}
		?>
		<div data-dismissible="disable-synch-provider-notice-forever" class="notice updated is-dismissible">
			<p>Shipping Providers List Update is required. <span data-dismissible="disable-synch-provider-notice-forever"><a class="synch_providers_link" href="<?php echo admin_url( '/admin.php?page=woocommerce-advanced-shipment-tracking&tab=shipping-providers&open=synch_providers' ); ?>">Sync Now</a></span></p>
		</div> <?php
	}	
	
	/**
	* Store the time when the float bar was hidden so it won't show again for 14 days.
	*/
	function ast_mark_admin_menu_tooltip_hidden() {
		check_ajax_referer( 'ast-admin-tooltip-nonce', 'nonce' );
		update_option( 'ast_admin_menu_tooltip', time() );
		wp_send_json_success();
	}	
}