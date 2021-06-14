<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package icarefurnishers
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post">
		<?php icarefurnishers_post_thumbnail(); ?>
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			if ( 'post' === get_post_type() ) :
				?>
				<!-- <div class="entry-meta">
					<?php
					//icarefurnishers_posted_on();
					//icarefurnishers_posted_by();
					?>
				</div> -->
				<div class="blog-meta">
                    <a href="javascript:void(0);" class="b-link author-element">
                        <i class="fa fa-user"></i><?php the_author(); ?>
                    </a>
                    <a href="javascript:void(0);" class="b-link date-element">
                        <i class="fa fa-calendar"></i>on <?php the_time('F jS, Y'); ?>
                    </a>
                    <div class="blog-tags"><?php the_category(', '); ?></div>
                </div><!-- .blog-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

	<?php //icarefurnishers_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'icarefurnishers' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'icarefurnishers' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php icarefurnishers_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
