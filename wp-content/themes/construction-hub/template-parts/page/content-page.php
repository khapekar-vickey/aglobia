<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php the_post_thumbnail();?>
		<p><?php the_content(); ?></p>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'construction-hub' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</div>