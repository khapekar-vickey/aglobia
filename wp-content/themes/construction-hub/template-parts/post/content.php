<?php
/**
 * Template part for displaying posts
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-box row">
	    <?php 
	        if(has_post_thumbnail()) { ?>
	        <div class="box-image col-lg-6 p-0">
	            <?php the_post_thumbnail();  ?>	   
	        </div>
	    <?php } ?>
	    <div class="box-content <?php 
	        if(has_post_thumbnail()) { ?>col-lg-6"<?php } else { ?>col-lg-12"<?php } ?>>
	        <h4><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h4>
	        <div class="box-info">
              <i class="far fa-calendar-alt"></i><span class="entry-date"><?php the_date(); ?></span>
              <i class="fas fa-user"></i><span class="entry-author"><?php the_author(); ?></span>
              <i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','construction-hub'), __('0 Comments','construction-hub'), __('% Comments','construction-hub') ); ?></span>
            </div>
	        <p><?php $excerpt = get_the_excerpt(); echo esc_html( construction_hub_string_limit_words( $excerpt,30 ) ); ?></p>
            <div class="readmore-btn">
                <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'construction-hub' ); ?>"><?php esc_html_e('Read More','construction-hub'); ?></a>
            </div>
	    </div>
	    <div class="clearfix"></div>
	</div>
</div>