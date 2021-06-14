<?php
/**
 * Template part for default Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buildex
 */
?>

<?php get_template_part( 'template-parts/top-panel' ); ?>

<div <?php buildex_header_class(); ?>>
	<?php do_action( 'buildex-theme/header/before' ); ?>
	<div class="space-between-content">
		<div <?php buildex_site_branding_class(); ?>>
			<?php buildex_header_logo(); ?>
		</div>
		<?php buildex_main_menu(); ?>
	</div>
	<?php do_action( 'buildex-theme/header/after' ); ?>
</div>
