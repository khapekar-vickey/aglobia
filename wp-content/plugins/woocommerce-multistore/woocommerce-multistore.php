<?php
/**
 * Plugin Name: WooCommerce Multistore
 * Description: WooCommerce Multistore
 * Author: Lykke Media AS
 * Author URI: https://woomultistore.com/
 * Version: 3.0.5
 * WC tested up to: 3.9.2
 * Network: true
 *
 * @package WooMultistore
 **/

defined( 'ABSPATH' ) || exit;

if ( is_multisite() ) {
	/**
	 * Entry script for the single site version
	 */
	require_once __DIR__ . '/multisite-entry.php';
} else {
	/**
	 * Entry script for the multisite version
	 */
	require_once __DIR__ . '/single-site/single-site-entry.php';
}
