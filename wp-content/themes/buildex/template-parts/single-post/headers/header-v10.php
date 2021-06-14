<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Buildex
 */

$has_post_thumbnail = has_post_thumbnail();
$has_post_thumbnail_class = $has_post_thumbnail ? 'has-post-thumbnail' : '';

?>

<div class="single-header-10 invert <?php echo esc_attr( $has_post_thumbnail_class ); ?>">
	<?php buildex_post_thumbnail( 'buildex-thumb-xl', array( 'link' => false ) ); ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title h3-style">', '</h1>' ); ?>
					<div class="entry-header-bottom">
						<div class="entry-meta"><?php
							if ( buildex_theme()->customizer->get_value( 'single_post_author' ) ) : ?>
								<span class="post-author">
									<span class="post-author__avatar"><?php
										buildex_get_post_author_avatar( array(
											'size' => 50
										) );
									?></span>
									<?php buildex_posted_by();
								?></span>
							<?php endif; ?>
							<?php
								buildex_posted_in( array(
									'prefix'  => __( 'In', 'buildex' ),
								) );
								buildex_posted_on( array(
									'prefix'  => __( 'Posted', 'buildex' ),
								) );
						?></div><!-- .entry-meta -->
						<div class="entry-meta"><?php
							buildex_post_comments( array(
								'prefix' => '<i class="fa fa-comment" aria-hidden="true"></i>',
								'class'  => 'comments-button'
							) );
						?></div><!-- .entry-meta -->
					</div>
				</header><!-- .entry-header -->
			</div>
		</div>
	</div>
</div>

