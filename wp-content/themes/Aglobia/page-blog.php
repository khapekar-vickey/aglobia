<?php
/*
Template Name: Blog custom template
*/

get_header();
?>
<!-- <div class="banner-section" style="background-image: url('<?php echo wpcustom_featured_image(); ?>');">
    <div class="container">
         <?php //the_breadcrumb(); ?> 
        <h1 class="banner-title"><?php the_title(); ?></h1>
    </div>
</div>-->
	<div id="primary" class="content-area">
        <div class="container">
            <div class="blog-wrapper">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <?php 
                            // the query
                            $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>10)); ?>

                            <?php if ( $wpb_all_query->have_posts() ) : ?>
                                <!-- the loop -->
                                <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                                    <article class="blog-post">
                                        <a href="<?php the_permalink(); ?>" class="hover-effect">
                                            <?php icarefurnishers_post_thumbnail(); ?>
                                        </a>
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                       <?php if ( 'post' === get_post_type() ) :
                                            ?>
                                            <div class="blog-meta">
                                                <a href="javascript:void(0);" class="b-link author-element">
                                                    <i class="fa fa-user"></i><?php the_author(); ?>
                                                </a>
                                                <a href="javascript:void(0);" class="b-link date-element">
                                                    <i class="fa fa-calendar"></i>on <?php the_time('F jS, Y'); ?>
                                                </a>
                                                <div class="blog-tags"><?php the_category(', '); ?></div>
                                            </div><!-- .blog-meta -->
                                            <p><?php the_excerpt()?></p>
                                            <a href="<?php the_permalink()?>" class="arrow-right">Read More</a>
                                        <?php endif; ?>
                                    </article>
                                <?php endwhile; ?>
                                <!-- end of the loop -->
                                <?php wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                            <?php endif; ?>
                    </div><!-- /.col-md-9 -->
                    <!-- sidebar -->
                    <div class="col-md-4 col-sm-12">
                        <section id="sidebar-blog">
                            <aside id="categories-blog">
                                <header><h3>Categories</h3></header>
                                <?php
                                $categories = get_categories() ;
                                ?>
                                <ul class="list-links">
                                    <?php
                                    foreach ( $categories as $category ) 
                                    {
                                        $cat_ID  = (int) $category->term_id;
                                        $category_name = $category->name;
                                        $cat_link =get_category_link( $category->term_id);
                                        // When viewing a particular category, give it an [active] class
                                        $cat_class = ( $cat_ID == $term_id ) ? 'active' : 'not-active';
                                        // Not showing the [uncategoirzed] category
                                        if ( strtolower( $category_name ) != 'uncategorized' )
                                        {
                                            echo "<li class='$cat_class'><a href='$cat_link'>$category_name</a></li>";
                                        }
                                    } 
                                    ?>
                                </ul>
                            </aside><!-- /#categories -->
                        </section><!-- /#sidebar -->
                    </div><!-- /.col-md-3 -->
                </div><!--row-->
            </div>
        </div>
    </div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
