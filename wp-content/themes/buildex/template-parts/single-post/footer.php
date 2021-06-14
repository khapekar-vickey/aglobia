<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

?>

<footer class="entry-footer">
	<div class="entry-meta"><?php
		buildex_post_tags ( array(
			'prefix'    => __( 'Tags:', 'buildex' ),
			'delimiter' => ''
		) );
	?></div>
</footer><!-- .entry-footer -->