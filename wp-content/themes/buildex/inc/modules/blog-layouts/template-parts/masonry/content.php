<?php
/**
 * Template part for displaying default posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package buildex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item masonry-item' ); ?>>
	<?php buildex_post_thumbnail( 'buildex-thumb-masonry' ); ?>
	<header class="entry-header">
		<div class="entry-meta">
			<?php
			buildex_posted_by();
			buildex_posted_in( array(
				'prefix' => __( 'In', 'buildex' ),
				'delimiter' => ', '
			) );
			buildex_posted_on( array(
				'prefix' => __( 'Posted', 'buildex' ),
			) );
			?>
		</div><!-- .entry-meta -->
		<h4 class="entry-title"><?php
			buildex_sticky_label();
			the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
		?></h4>
	</header><!-- .entry-header -->
	<?php buildex_post_excerpt(); ?>

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php
			buildex_post_tags();

			$post_more_btn_enabled = strlen( buildex_theme()->customizer->get_value( 'blog_read_more_text' ) ) > 0 ? true : false;
			$post_comments_enabled = buildex_theme()->customizer->get_value( 'blog_post_comments' );

			if( $post_more_btn_enabled || $post_comments_enabled ) {
				?><div class="space-between-content"><?php
				buildex_post_link();
				buildex_post_comments();
				?></div><?php
			}
			?>
		</div>
		<?php buildex_edit_link(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
