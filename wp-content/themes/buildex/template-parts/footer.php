<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Buildex
 */
?>

<?php do_action( 'buildex-theme/widget-area/render', 'footer-area' ); ?>

<div <?php buildex_footer_class(); ?>>
	<div class="space-between-content"><?php
		buildex_footer_copyright();
		buildex_social_list( 'footer' );
	?></div>
</div><!-- .container -->
