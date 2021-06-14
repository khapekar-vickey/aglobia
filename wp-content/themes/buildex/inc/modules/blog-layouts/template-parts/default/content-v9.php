<?php
/**
 * Template part for displaying default posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-list__item default-item invert-item'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="default-item__thumbnail" <?php buildex_post_overlay_thumbnail( 'buildex-thumb-l' ); ?>></div>
	<?php endif; ?>

	<div class="container">

		<header class="entry-header">
			<div class="entry-meta"><?php
				buildex_posted_by();
				buildex_posted_in( array(
					'prefix' => __( 'In', 'buildex' ),
				) );
				buildex_posted_on( array(
					'prefix' => __( 'Posted', 'buildex' )
				) );
				buildex_post_tags( array(
					'prefix' => __( 'Tags:', 'buildex' )
				) );
				buildex_post_comments( array(
					'postfix' => __( 'Comment(s)', 'buildex' )
				) );
			?></div><!-- .entry-meta -->
			<h3 class="entry-title"><?php
				buildex_sticky_label();
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
			?></h3>
		</header><!-- .entry-header -->

		<?php buildex_post_excerpt(); ?>

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php
					buildex_post_link();
				?>
			</div>
			<?php buildex_edit_link(); ?>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
