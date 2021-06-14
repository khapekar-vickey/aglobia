<?php
/**
 * Template part for displaying default posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-list__item default-item'); ?>>

	<?php buildex_post_thumbnail( 'buildex-thumb-l' ); ?>

	<div class="default-item__content">

		<header class="entry-header">
			<h3 class="entry-title"><?php
				buildex_sticky_label();
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
			?></h3>
			<div class="entry-meta">
				<?php
					buildex_posted_by();
					buildex_posted_in( array(
						'prefix' => __( 'In', 'buildex' ),
					) );
					buildex_posted_on( array(
						'prefix' => __( 'Posted', 'buildex' )
					) );
				?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<?php buildex_post_excerpt(); ?>

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php
					buildex_post_tags( array(
						'prefix' => __( 'Tags:', 'buildex' )
					) );
				?>
				<div><?php
					buildex_post_comments( array(
						'prefix' => '<i class="fa fa-comment" aria-hidden="true"></i>',
						'class'  => 'comments-button'
					) );
					buildex_post_link();
				?></div>
			</div>
			<?php buildex_edit_link(); ?>
		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
