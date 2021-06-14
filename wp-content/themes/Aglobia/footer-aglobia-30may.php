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

	<footer id="page-footer" class="block background-is-dark ">
    <div class="container">
        
		<?php if(get_theme_mod('footer_logo_upload')):?>
			<a href="<?php echo get_home_url(); ?>" target="_blank"><img src="<?php echo get_theme_mod('footer_logo_upload'); ?>" class="footer-logo brand hover-effect" /></a>
		<?php endif; ?>
        <!--end brand-->
		
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <p>
                 A-Globia envisions itself as the pioneer of unique, path-breaking designs inspired by traditions and infused with the latest in advanced tech and infrastructure.
                </p>
            </div>
            <!--end col-md-4-->


            <div class="col-md-8 col-sm-8">
                <div class="contact-data text-align-right">
                    <figure>+91 7040 787 878 <br> +91 7040 797 979</figure>
                    <a href="mailto:info@aglobia.com" class="hover-effect"><span><div class="hover-element">info@aglobia.com</div></span></a>
                </div>
            </div>
            <!--end col-md-8-->
        </div>
        <!--end row-->
        <hr>
        <div class="note">© 2020 All Rights Reserved</div>
        <!--end note-->
        <div class="to-top">
            <a href="#page-top" class="arrow-up framed scroll">
                <i class="fa fa-long-arrow-up"></i>
            </a>
        </div>
    </div>
    <!--end container-->

</footer>
    <script type="text/javascript">

        /*-- Chat Box --*/
        
        /*-- Chat Box --*/

        /*-- Search box --*/
        jQuery(document).ready(function ($) {
	    	//$('.search-inline').hide();
		    jQuery(".search-open").click(function() {
		        jQuery('.search-inline').toggle();
		    });
		    
		    jQuery(".search-close").click(function() {
		        jQuery('.search-inline').hide();
		    });

		    // End here
		});
        
    </script>

    
</div><!-- #page -->

<script src="<?php echo get_template_directory_uri();?>/textlocal_sms/verification.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
	
	
<?php wp_footer(); ?>
<!-- ==== ===========Login Popup=========================-->
<!-- The Modal Login Popup -->
<div class="modal" id="loginForm">
	<div class="modal-dialog">
	  <div class="modal-content">
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">Login</h4>
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
	<div class="modal-dialog">
	  <div class="modal-content">
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">Registration</h4>
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
<!-- ==== ===========Login Popup=========================-->

<script type="javascript">

jQuery(document).ready(function($) {

	var owl = $("#owl-demo-2");
  owl.owlCarousel({
      items : 5, 
      itemsDesktop : [992,3],
      itemsDesktopSmall : [768,2], 
      itemsTablet: [480,2], 
      itemsMobile : [320,1]
  });
  $(".next").click(function(){ owl.trigger('owl.next'); });
  $(".prev").click(function(){ owl.trigger('owl.prev'); });

$('.latest-blog-posts .thumbnail.item').matchHeight();
	
)};

 jQuery(document).ready(function ($) {
    //$('.search-inline').hide();
   jQuery(".search-open").click(function() {
       jQuery('.search-inline').toggle();
   });
   
   jQuery(".search-close").click(function() {
       jQuery('.search-inline').hide();
   });

   // End here
});

</script>

<script type="text/javascript">
$(document).ready(function() {
   var owl = $("#owl-demo");
  owl.owlCarousel({
      items : 6, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
  });
 
  // Custom Navigation Events
  
 $('.press-slider-sec .owl-carousel').owlCarousel({
    items :6,
    rtl:false,
    loop:true,
    margin:10,
    nav: true,
    navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
   
});

  
 $('.myinteriordefine-slider .owl-carousel').owlCarousel({
     items : 7,
    rtl:true,
    loop:true,
    margin:10,
    nav: true,
    navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
   
})

});
</script>
</body>
</html>