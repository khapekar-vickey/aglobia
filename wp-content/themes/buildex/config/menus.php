<?php
/**
 * Menus configuration.
 *
 * @package Buildex
 */

add_action( 'after_setup_theme', 'buildex_register_menus', 5 );
function buildex_register_menus() {

	register_nav_menus( array(
		'main'   => esc_html__( 'Main', 'buildex' ),
		'footer' => esc_html__( 'Footer', 'buildex' ),
		'social' => esc_html__( 'Social', 'buildex' ),
	) );
}
