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
		<div class="creative-item__thumbnail" <?php buildex_post_overlay_thumbnail( 'buildex-thumb-m' ); ?>></div>
	<?php endif; ?>

	<header class="entry-header">
		<?php
			buildex_posted_in();
			buildex_posted_on( array(
				'prefix' => __( 'Posted', 'buildex' )
			) );
		?>
		<h4 class="entry-title"><?php
			buildex_sticky_label();
			the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
		?></h4>
	</header><!-- .entry-header -->

	<?php buildex_post_excerpt(); ?>

	<footer class="entry-footer">
		<div class="entry-meta">
			<div>
				<?php
					buildex_posted_by();
					buildex_post_comments( array(
						'prefix' => '<i class="fa fa-comment" aria-hidden="true"></i>'
					) );
					buildex_post_tags( array(
						'prefix' => __( 'Tags:', 'buildex' )
					) );
				?>
			</div>
			<?php
				buildex_post_link();
			?>
		</div>
		<?php buildex_edit_link(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
