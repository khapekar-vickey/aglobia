<?php
/**
 * The template for displaying all pages
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area">
		<?php $construction_hub_sidebar_layout = get_theme_mod( 'construction_hub_sidebar_page_layout','full');
	    if($construction_hub_sidebar_layout == 'left'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-4 col-md-4" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	          	<div class="col-lg-8 col-md-8">
	           		<?php while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						endwhile; // End of the loop.
					?>
	          	</div>
	        </div>
	        <div class="clearfix"></div>
	    <?php }else if($construction_hub_sidebar_layout == 'right'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-8 col-md-8">
		            <?php while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						endwhile; // End of the loop.
					?>
	          	</div>
	          	<div class="col-lg-4 col-md-4" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	        </div>
	    <?php }else if($construction_hub_sidebar_layout == 'full'){ ?>
	        <div class="full">
	            <?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/page/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					endwhile; // End of the loop.
				?>
	      	</div>
		<?php }?>
	</div>
</div>

<?php get_footer();