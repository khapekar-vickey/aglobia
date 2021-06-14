<?php
/**
 * Template part for displaying posts
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2><?php the_title();?></h2>
    <div class="box-info">
  		<i class="far fa-calendar-alt"></i><span class="entry-date"><?php the_date(); ?></span>
  		<i class="fas fa-user"></i><span class="entry-author"><?php the_author(); ?></span>
  		<i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','construction-hub'), __('0 Comments','construction-hub'), __('% Comments','construction-hub') ); ?></span>
    </div>
    <hr>
    <div class="box-image">
        <?php the_post_thumbnail();  ?>
    </div>
    <hr>
    <div class="box-content">
        <?php the_content(); 
        the_tags(); ?>
        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
        comments_template();

        if ( is_singular( 'attachment' ) ) {
            // Parent post navigation.
            the_post_navigation( array(
                'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'construction-hub' ),
            ) );
        } elseif ( is_singular( 'post' ) ) {
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next:', 'construction-hub' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous:', 'construction-hub' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
        }
    ?>
    </div>
</div>