<?php
/**
 * getallheaders may not be defined for Nginx servers
 * load the ployfill to provide a backup for nginx enviornments
 */

require_once dirname( __FILE__ ) . '/getallheaders.php';


/**
 * Retrieve a template from template directory
 **/
function woomulti_get_template_parts( $template ) {
	$template = preg_replace( '[^a-zA-Z0-9-_\/]', '', $template );
	$template = WOO_MSTORE_SINGLE_TEMPLATES_PATH . $template . '.php';

	if ( file_exists( $template ) ) {
		require_once $template;
	}
}

/**
 * Get all sites
 **/
function woomulti_get_sites( $include_current = false ) {
	return get_option( 'woonet_child_sites' );
}

/**
 * Get minimum user role
 **/
function woomulti_has_min_user_role() {

	if ( get_option( 'woonet_network_type' ) != 'master' ) {
		return true;
	}

	$_options = get_option( 'woonet_options' );

	if ( empty( $_options['publish-capability'] ) ) {
		return false;
	}

	$user = wp_get_current_user();

	if ( array_intersect( array( $_options['publish-capability'], 'administrator' ), $user->roles ) ) {
		return true;
	}

	return false;
}

/**
 * check if the user has an active license
 */
function woomulti_has_valid_license() {
	static $_woomostore_has_license = null;

	// child sites don't need a license, only master does
	if ( get_option( 'woonet_network_type' ) != 'master' ) {
		return true;
	}

	if ( ! is_null( $_woomostore_has_license ) ) {
		return $_woomostore_has_license;
	}

	$license_manager = new WOO_MSTORE_licence();

	return $_woomostore_has_license = $license_manager->licence_key_verify();
}

/**
 * Channel error messages to the right logger.
 * The default is to use WooCommerce logger. If WooCommerce is not present, logs are sent to 
 * WordPress logger instead.
 * 
 * @since 3.0.3
 *
 * @param string $error Error message to be sent to the logger
 * @return null
 */

function woomulti_log_error( $error ) {

	$logger = null;
	$context = array( 'source' => 'woocommerce-multistore' ); // seperate log file for the plugin.

	if ( ! defined('WP_DEBUG') || WP_DEBUG == false ) {
		return;
	}

	if ( is_array( $error ) || is_object( $error ) ) {
		$error = var_export( $error, true );
	}

	if ( function_exists('wc_get_logger') ) {
		$logger = wc_get_logger();
	}

	if ( $logger ) {
		$logger->debug( $error, $context );
	} else {
		error_log( $error );
	}
}

/**
 * Fix the json response received from another server so that
 * json_decode can decode them correctly. 
 */
function woomulti_json_decode( $string, $return_type = 0 ) {
	$json = json_decode( $string, $return_type );

	if ( $json === null ) {
		$json = json_decode( stripslashes( $string ), $return_type );
	}

	if ( $json === null ) {
		$string = iconv('UTF-8', 'ISO-8859-1//IGNORE', $string);
		$json = json_decode(  $string, $return_type);
	}

	return $json;
}
