<?php
/**
 * Template part for displaying creative posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item creative-item invert-hover' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="creative-item__thumbnail" <?php buildex_post_overlay_thumbnail(); ?>></div>
	<?php endif; ?>

	<div class="container">

		<?php if ( buildex_theme()->customizer->get_value( 'blog_post_categories' ) ) : ?>
			<div class="creative-item__before-content"><?php
				buildex_posted_in( array(
					'prefix'    => '',
					'delimiter' => '',
					'before'    => '<div class="cat-links">',
					'after'     => '</div>'
				) );
			?></div>
		<?php endif; ?>

		<div class="creative-item__content">
			<header class="entry-header">
				<h3 class="entry-title"><?php
					buildex_sticky_label();
					the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
				?></h3>
			</header><!-- .entry-header -->

			<?php buildex_post_excerpt(); ?>

			<footer class="entry-footer">
				<div class="entry-meta">
					<div>
						<?php
							buildex_posted_by();
							buildex_posted_on( array(
								'prefix' => __( 'Posted', 'buildex' )
							) );
							buildex_post_tags( array(
								'prefix' => __( 'Tags:', 'buildex' )
							) );
						?>
					</div>
					<?php
						buildex_post_comments( array(
							'postfix' => __( 'Comment(s)', 'buildex' )
						) );
					?>
				</div>
				<?php buildex_edit_link(); ?>
			</footer><!-- .entry-footer -->
		</div>

		<?php if ( 'none' !== buildex_theme()->customizer->get_value( 'blog_read_more_type' ) ) : ?>
			<div class="creative-item__after-content"><?php
				buildex_post_link();
			?></div>
		<?php endif; ?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
