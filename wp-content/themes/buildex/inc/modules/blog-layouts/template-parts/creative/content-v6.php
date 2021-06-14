<?php
/**
 * Template part for displaying creative posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item creative-item' ); ?>>

	<?php if ( buildex_theme()->customizer->get_value( 'blog_post_publish_date' ) ) : ?>
		<div class="creative-item__before-content">
			<?php
				$day = get_the_date('d');
				$month = get_the_date('m');
			?>
			<div class="posted-on">
				<span class="posted-on__day"><?php echo esc_html( $day ); ?></span><span class="posted-on__month">/<?php echo esc_html( $month ); ?></span>
			</div>
		</div>
	<?php endif; ?>

	<div class="creative-item__content">

		<?php buildex_post_thumbnail( 'thumbnail' ); ?>

		<div class="creative-item__content-wrapper">
			<header class="entry-header">
				<div class="entry-meta">
					<?php
						buildex_posted_by();
						buildex_posted_in( array(
							'prefix' => __( 'In', 'buildex' ),
						) );
					?>
				</div><!-- .entry-meta -->
				<h3 class="entry-title"><?php
					buildex_sticky_label();
					the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
				?></h3>
			</header><!-- .entry-header -->

			<?php buildex_post_excerpt(); ?>

			<footer class="entry-footer">
				<div class="entry-meta"><?php
					buildex_post_tags( array(
						'prefix' => __( 'Tags:', 'buildex' )
					) );
					buildex_post_comments( array(
						'postfix' => __( 'Comment(s)', 'buildex' )
					) );
				?></div>
				<?php buildex_edit_link(); ?>
			</footer><!-- .entry-footer -->
		</div>

	</div>

	<?php if ( 'none' !== buildex_theme()->customizer->get_value( 'blog_read_more_type' ) ) : ?>
		<div class="creative-item__after-content"><?php
			buildex_post_link();
		?></div>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
