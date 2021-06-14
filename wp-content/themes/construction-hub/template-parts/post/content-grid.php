<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-lg-4 col-md-4">
		<div class="page-box">
	        <div class="box-image">
	            <?php the_post_thumbnail();  ?>
	        </div>
		    <div class="box-content">
		    	<?php the_title();?></a></h4>
		        <div class="box-info">
	              <i class="far fa-calendar-alt"></i><span class="entry-date"><?php the_date(); ?></span>
	              <i class="fas fa-user"></i><span class="entry-author"><?php the_author(); ?></span>
	              <i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','construction-hub'), __('0 Comments','construction-hub'), __('% Comments','construction-hub') ); ?></span>
	            </div>
		        <p><?php $excerpt = get_the_excerpt(); echo esc_html( construction_hub_string_limit_words( $excerpt,30 ) ); ?></p>
	            <div class="more-btn">
	                <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read More', 'construction-hub' ); ?>"><?php esc_html_e('Read More','construction-hub'); ?></a>
	            </div>
		    </div>
		    <div class="clearfix"></div>
		</div>
	</div>
</div>