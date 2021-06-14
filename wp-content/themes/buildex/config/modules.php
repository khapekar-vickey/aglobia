<?php
/**
 * Modules configuration
 *
 * Allowed to rewrite in child theme.
 *
 * Format:
 * associative array.
 * keys - module name to load,
 * values - array of child modules for this module. If module has no childs - just an empty array
 */

if ( ! function_exists( 'buildex_get_allowed_modules' ) ) {
	function buildex_get_allowed_modules() {
		return apply_filters( 'buildex-theme/allowed-modules', array(
			'blog-layouts'    => array(),
			'crocoblock'      => array(),
			'woo'             => array(
				'woo-breadcrumbs' => array(),
				'woo-page-title'  => array(),
			),
		) );
	}
}