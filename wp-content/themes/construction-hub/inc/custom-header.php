<?php
/**
 * Custom header implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses construction_hub_header_style()
 */
function construction_hub_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'construction_hub_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/assets/images/header_img.jpeg' ),
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'construction_hub_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header_img.jpeg',
			'thumbnail_url' => '%s/assets/images/header_img.jpeg',
			'description'   => __( 'Default Header Image', 'construction-hub' ),
		),
	) );

}
add_action( 'after_setup_theme', 'construction_hub_custom_header_setup' );

if ( ! function_exists( 'construction_hub_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see construction_hub_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'construction_hub_header_style' );
function construction_hub_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$construction_hub_custom_css = "
        .headerimg{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'construction-hub-style', $construction_hub_custom_css );
	endif;
}
endif; // construction_hub_header_style