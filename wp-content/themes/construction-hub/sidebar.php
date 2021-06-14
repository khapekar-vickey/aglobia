<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */
?>

<aside id="theme-sidebar" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'construction-hub' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>