<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

$author_block_enabled = buildex_theme()->customizer->get_value( 'single_author_block' );

?>

<div class="single-header-6">
	<header class="entry-header">
		<div class="entry-meta">
			<?php
				buildex_posted_in( array(
					'delimiter' => '',
					'before'    => '<div class="cat-links btn-style">',
					'after'     => '</div>'
				) );
				if ( ! $author_block_enabled ) {
					buildex_posted_by();
					buildex_posted_on( array(
						'prefix'  => __( 'Posted', 'buildex' ),
					) );
				}
				buildex_post_comments( array(
					'postfix' => __( 'Comment(s)', 'buildex' ),
				) );
			?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title h2-style">', '</h1>' ); ?>
	</header><!-- .entry-header -->
</div>