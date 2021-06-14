<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package icarefurnishers
 */

?>

	</div><!-- #content -->

	<footer class="footer">
        <div class="footer-section">
            <div class="container">
            	<div class="footer-top">
	                <div class="row">
	                    <div class="col-md-4">
	                        <div class="icare-contact mb-2">
	                            <?php if(get_theme_mod('footer_logo_upload')):?>
	                            <a href="<?php echo get_home_url(); ?>" target="_blank"><img src="<?php echo get_theme_mod('footer_logo_upload'); ?>" class="footer-logo" /></a>
	                            <?php endif; ?>
	                            <div class="f-contact mb-3 d-flex">
	                            	<i class="fa fa-home"></i> 
					                <?php
					                $content_mod = get_theme_mod('contact_address');
					                echo $content_mod; ?>
					            </div>
	                            <div class="f-phone mb-3 d-flex">
	                                <i class="fa fa-phone"></i> 
	                                <a href="tel:<?php $content_mod = get_theme_mod('phone_number'); echo $content_mod;?>">
	                                <?php
	                                $content_mod = get_theme_mod('phone_number');
	                                echo $content_mod;?>
	                                </a>
	                            </div>
	                            <div class="f-email d-flex">
	                                <i class="fa fa-envelope"></i> 
	                                <a href="mailto:<?php $content_mod = get_theme_mod('email_address'); echo $content_mod; ?>">
	                                    <?php
	                                        $content_mod = get_theme_mod('email_address');
	                                        echo $content_mod;
	                                    ?>
	                                </a>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-4">
	                        <div class="info-links mb-2">
	                            <h3>Useful Links</h4>
	                            <?php wp_nav_menu(array('menu' => 'footer_menu', 'menu_class' => 'footer-nav')); ?>
	                        </div>
	                        <div class="footer-search">
	                        	<div class="home-search">
			                    	<form role="search" method="get" id="searchform2" class="form_search" action="<?php echo home_url( '/' );?>" >
										<input type="text" value="<?php echo get_search_query();?>" name="s" id="s" class="form-control search-in" placeholder="Type Keyword..." aria-label="Recipient's username" aria-describedby="basic-addon2">
										<div class="input-group-append">
										<button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
										</div>
										<a href="javascript:void(0)" class="search-close">
										<i class="fa fa-times"></i>
										</a>
									</form>
			                    </div>
	                        </div>
	                    </div>
	                    <div class="col-md-4">
	                        <div class="footer-social-link">
	                            <h3>Connect with us</h4>
	                            <div class="social-icons ">
		                            <?php if($content_mod = get_theme_mod('social_facebook')):?>
		                            <a href="<?php $content_mod = get_theme_mod('social_facebook'); echo $content_mod; ?>" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a>
		                            <?php endif; ?>

		                            <?php if($content_mod = get_theme_mod('social_instagram')):?>
		                            <a href="<?php $content_mod = get_theme_mod('social_instagram'); echo $content_mod; ?>" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a>
		                            <?php endif; ?>
									
									<?php if($content_mod = get_theme_mod('social_youTube')):?>
		                            <a href="<?php $content_mod = get_theme_mod('social_youTube'); echo $content_mod; ?>" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a>
		                            <?php endif; ?>
		                            
		                            <?php if($content_mod = get_theme_mod('social_linkedIn')):?>
		                            <a href="<?php $content_mod = get_theme_mod('social_linkedIn'); echo $content_mod; ?>" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a>
		                            <?php endif; ?>
									
									<?php if($content_mod = get_theme_mod('social_pinterest')):?>
		                            <a href="<?php $content_mod = get_theme_mod('social_pinterest'); echo $content_mod; ?>" target="_blank" class="pinterest"><i class="fa fa-pinterest"></i></a>
		                            <?php endif; ?>

		                            <?php if($content_mod = get_theme_mod('social_twitter')):?>
		                            <a href="<?php $content_mod = get_theme_mod('social_twitter'); echo $content_mod; ?>" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a>
		                            <?php endif; ?>

		                            
	                        	</div>
	                            <div class="warranty-logo">
	                            	<img src="<?php echo get_theme_mod('footer_warranty_logo_upload'); ?>" alt="Warranty Logo">
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </div>
                <div class="footer-copyright">
	                <div class="row">
	                    <div class="col-sm-6">
	                        <div class="copyright">
	                            <p>All rights reserved @<?php echo date("Y"); ?> AglobiaCreations</p>
	                        </div>
	                    </div>
	                    <div class="col-sm-6">
	                        <div class="payment-gateway text-right">
	                            <img src="<?php echo get_theme_mod('footer_pg_logo_upload'); ?>" alt="">
	                        </div>
	                    </div>
	                </div>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<!-- Temporary script for popup on page onload -->
<script type="text/javascript">
	// for registration modal Fields
	jQuery(document).ready(function(){
		$status = jQuery( 'body' ).hasClass( 'logged-in' );
		//alert($status);  
		if(!($status)){
			//alert('not logged in');
			setTimeout(function(){
                jQuery("#registrationForm").modal('show');
				jQuery(".close").on("click", function() 
				{
                    jQuery(".modal").removeClass('show');
                    jQuery(".modal-backdrop").removeClass('show');
                    jQuery(".modal-backdrop").css("display","none");                    
				});
                
		   },10000); 
		}
		jQuery('#advertiseModal').modal('show');
	});
	
	//For adverttisement Modal Pop up
	jQuery(window).on('load',function(){
		//jQuery('.modal').modal('show');
	});
	
</script>
<?php wp_footer(); ?>

<!-- ==== ===========Login Popup=========================-->
<!-- The Modal Login Popup -->
<div class="modal" id="loginForm">
	<div class="modal-dialog row">
		<div class="modal-bg col-md-4">&nbsp;</div>
	  <div class="modal-content col-md-8 col-sm-12">
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">Existing user? Log In</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		
		<!-- Modal body -->
		<div class="modal-body">
			<div class="loginFields">
			<?php 
			echo do_shortcode('[WPUM_LOGIN title="Login"]');
			?>
			</div>
		</div>
		
		<!-- Modal footer -->
		<!--div class="modal-footer">
		  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
		</div-->
		
	  </div>
	</div>
</div>
<!-- End Login Popup -->
<!-- The Modal Registration Popup -->
<div class="modal" id="registrationForm">
	<div class="modal-dialog row">
		<div class="modal-bg col-md-4">&nbsp;</div>
	  <div class="modal-content col-md-8">
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">New to AGlobia? Register Here</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		
		<!-- Modal body -->
		<div class="modal-body">
			<div class="registrationFields">
			  	<?php 
			echo do_shortcode('[WPUM_NEWUSER_REGISTRATION uid="" userrole="customer" title="Registration" redirect_slug="login"]');

			?>
			</div>
		</div>
		
		<!-- Modal footer -->
		<!--div class="modal-footer">
		  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
		</div-->
		
	  </div>
	</div>
</div>
<!-- End The Modal Registration Popup -->	


<!-- ==== ===========Advertisement Popup=========================-->

<div id="advertiseModal" class="modal" tabindex="-1" role="dialog">
	    <div class="modal-dialog advertise-modal">
	      	<!-- Modal content-->
	      	<div class="modal-content">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<div class="modal-body">
	          		<!-- Your modal Content -->
	          		<?php
					$args = array(
					        // 'posts_per_page' =>1,
					        'post_type' => 'advertisements',
					    );
					$query = new WP_Query( $args  );

					while ( $query->have_posts() ) : $query->the_post();
						$post_id = get_the_ID();
						$advertisement_data = get_post_meta( $post_id, '_advertisement', true );
						$show_hide = get_field( 'show_hide', $post_id );
						
						if( $show_hide == 'Show' ): 						        	
							$advertise_image = get_field('advertise_image', $post_id);
							$advertise_url = get_field('advertise_url', $post_id);
							// echo "<pre>";
							// print_r($post_id);
						?>
							<a href="<?php echo $advertise_url ?>"><img src="<?php echo $advertise_image; ?>" alt="<?php echo $advertise_image; ?>" /></a>
						<?php		
						endif;			            
					endwhile;
					
					wp_reset_postdata();
	          		?>
	        	</div>
	      	</div>
	    </div>
	</div>

</body>
</html>