<?php
/**
 * Template part for top panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Buildex
 */

// Don't show top panel if all elements are disabled.
if ( ! buildex_is_top_panel_visible() ) {
	return;
} ?>

<div class="top-panel container">
	<div class="space-between-content">
		<div class="top-panel-content__left">
				<?php do_action( 'buildex-theme/top-panel/elements-left' ); ?>
				<?php buildex_site_description(); ?>
		</div>
		<div class="top-panel-content__right">
				<?php buildex_social_list( 'header' ); ?>
				<?php do_action( 'buildex-theme/top-panel/elements-right' ); ?>
		</div>
	</div>
</div>