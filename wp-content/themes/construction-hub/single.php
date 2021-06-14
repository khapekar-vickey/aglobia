<?php
/**
 * The template for displaying all single posts
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area">		
		<?php
        $construction_hub_sidebar_layout = get_theme_mod( 'construction_hub_sidebar_post_layout','right');
        if($construction_hub_sidebar_layout == 'left'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-4 col-md-4" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	          	<div class="col-lg-8 col-md-8">
	           		<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/single-post');	?>

							<div class="navigation">
					          	<?php
					              	// Previous/next page navigation.
					              	the_posts_pagination( array(
					                  	'prev_text'          => __( 'Previous page', 'construction-hub' ),
					                  	'next_text'          => __( 'Next page', 'construction-hub' ),
					                  	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
					              	) );
					          	?>
					        </div>

						<?php endwhile; // End of the loop.
					?>
	          	</div>
	        </div>
	        <div class="clearfix"></div>
	    <?php }else if($construction_hub_sidebar_layout == 'right'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-8 col-md-8">	           
		            <?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/single-post'); ?>

							<div class="navigation">
					          	<?php
					              	// Previous/next page navigation.
					              	the_posts_pagination( array(
					                  	'prev_text'          => __( 'Previous page', 'construction-hub' ),
					                  	'next_text'          => __( 'Next page', 'construction-hub' ),
					                  	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
					              	) );
					          	?>
					        </div>

						<?php endwhile; // End of the loop.
					?>
	          	</div>
	          	<div class="col-lg-4 col-md-4" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	        </div>
	    <?php }else if($construction_hub_sidebar_layout == 'full'){ ?>
	        <div class="full">
	           <?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/post/single-post'); ?>

						<div class="navigation">
				          	<?php
				              	// Previous/next page navigation.
				              	the_posts_pagination( array(
				                  	'prev_text'          => __( 'Previous page', 'construction-hub' ),
				                  	'next_text'          => __( 'Next page', 'construction-hub' ),
				                  	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
				              	) );
				          	?>
				        </div>

					<?php endwhile; // End of the loop.
				?>
          	</div>
	    <?php }else if($construction_hub_sidebar_layout == 'three-column'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-3 col-md-3" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	          	<div class="col-lg-6 col-md-6">	           
		            <?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/single-post'); ?>

							<div class="navigation">
					          	<?php
					              	// Previous/next page navigation.
					              	the_posts_pagination( array(
					                  	'prev_text'          => __( 'Previous page', 'construction-hub' ),
					                  	'next_text'          => __( 'Next page', 'construction-hub' ),
					                  	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
					              	) );
					          	?>
					        </div>

						<?php endwhile; // End of the loop.
					?>
	          	</div>
	          	<div class="col-lg-3 col-md-3" id="theme-sidebar"><?php dynamic_sidebar('sidebar-2');?></div>
	        </div>
	    <?php }else if($construction_hub_sidebar_layout == 'four-column'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-3 col-md-3" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	          	<div class="col-lg-3 col-md-3">	           
		            <?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/single-post'); ?>

							<div class="navigation">
					          	<?php
					              	// Previous/next page navigation.
					              	the_posts_pagination( array(
					                  	'prev_text'          => __( 'Previous page', 'construction-hub' ),
					                  	'next_text'          => __( 'Next page', 'construction-hub' ),
					                  	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
					              	) );
					          	?>
					        </div>

						<?php endwhile; // End of the loop.
					?>
	          	</div>
	          	<div class="col-lg-3 col-md-3" id="theme-sidebar"><?php dynamic_sidebar('sidebar-2');?></div>
	          	<div class="col-lg-3 col-md-3" id="theme-sidebar"><?php dynamic_sidebar('sidebar-3');?></div>
	        </div>
	    <?php }else if($construction_hub_sidebar_layout == 'grid'){ ?>
	        <div class="row m-0">
	          	<div class="col-lg-9 col-md-9">	           
		            <?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/single-post'); ?>

							<div class="navigation">
					          	<?php
					              	// Previous/next page navigation.
					              	the_posts_pagination( array(
					                  'prev_text'          => __( 'Previous page', 'construction-hub' ),
					                  'next_text'          => __( 'Next page', 'construction-hub' ),
					                  'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
					              	) );
					          	?>
					        </div>

						<?php endwhile; // End of the loop.
					?>
	          	</div>
	        	<div class="col-lg-3 col-md-3" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	        </div>
	    <?php }else {?>
	    	<div class="row m-0">
	          	<div class="col-lg-8 col-md-8">	           
		            <?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/post/single-post'); ?>

							<div class="navigation">
					          	<?php
					              	// Previous/next page navigation.
					              	the_posts_pagination( array(
					                  	'prev_text'          => __( 'Previous page', 'construction-hub' ),
					                  	'next_text'          => __( 'Next page', 'construction-hub' ),
					                  	'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'construction-hub' ) . ' </span>',
					              	) );
					          	?>
					        </div>

						<?php endwhile; // End of the loop.
					?>
	          	</div>
	          	<div class="col-lg-4 col-md-4" id="theme-sidebar"><?php dynamic_sidebar('sidebar-1');?></div>
	        </div>
	    <?php } ?>
	</div>
</div>

<?php get_footer();
