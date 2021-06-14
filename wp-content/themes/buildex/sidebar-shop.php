<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buildex
 */
?>

<?php if ( is_active_sidebar( 'sidebar-shop' ) && 'none' !== buildex_theme()->sidebar_position ) : ?>
	<aside id="secondary" <?php buildex_secondary_content_class( array( 'widget-area' ) ); ?>>
	  <?php dynamic_sidebar( 'sidebar-shop' ); ?>
	</aside><!-- #secondary -->
<?php endif;