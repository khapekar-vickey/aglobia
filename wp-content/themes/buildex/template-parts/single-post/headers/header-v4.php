<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

$has_post_thumbnail = has_post_thumbnail();
$invert_class = $has_post_thumbnail ? 'invert' : '';

?>

<header class="single-header-4 entry-header <?php echo esc_attr( $invert_class ); ?>">
	<?php if ( $has_post_thumbnail ) : ?>
		<div class="overlay-thumbnail" <?php buildex_post_overlay_thumbnail( 'buildex-thumb-xl' ); ?>></div>
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-10 col-lg-push-1">

				<?php buildex_posted_in( array(
					'delimiter' => '',
					'before'    => '<div class="cat-links btn-style">',
					'after'     => '</div>'
				) ); ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if ( has_excerpt() ) :
					the_excerpt();
				endif; ?>
				<?php if ( buildex_theme()->customizer->get_value( 'single_post_author' ) ) : ?>
					<div class="post-author">
						<div class="post-author__avatar"><?php
							buildex_get_post_author_avatar( array(
								'size' => 50
							) );
						?></div>
						<?php buildex_posted_by( array(
								'before'  => '<div class="byline">',
								'after'   => '</div>'
						) );
					?></div>
				<?php endif; ?>
				<div class="entry-meta"><?php
					buildex_posted_on( array(
						'prefix'  => '<i class="fa fa-clock-o" aria-hidden="true"></i> ' . __( 'Posted', 'buildex' ),
					) );
					buildex_post_tags ( array(
						'prefix'    => '<i class="fa fa-tag" aria-hidden="true"></i>',
					) );
					buildex_post_comments( array(
						'prefix'  => '<i class="fa fa-comment-o" aria-hidden="true"></i>',
						'postfix' => __( 'Comment(s)', 'buildex' ),
					) );
				?></div><!-- .entry-meta -->
			</div>
		</div>
	</div>
</header><!-- .entry-header -->