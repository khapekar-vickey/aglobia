<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	$show_page_title = buildex_theme()->customizer->get_value( 'show_page_title' );

	if ( filter_var( $show_page_title, FILTER_VALIDATE_BOOLEAN ) ) : ?>
		<header class="page-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<?php buildex_post_thumbnail(); ?>

	<div class="page-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'buildex' ),
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .page-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="page-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'buildex' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .page-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
