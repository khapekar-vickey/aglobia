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
            	
                <div class="footer-copyright">
					<div class="store-mart-lite-container clearfix">
						<div class="row">
							<div class="col-sm-4 copyright-col-sec">
								<div class="copyright">
									<p>All rights reserved @<?php echo date("Y"); ?> icarefurnishers</p>
								</div>
							</div>
							<div class="col-sm-4 footer-menu-col-sec">
								<h3>Useful Links</h4>
	                            <?php wp_nav_menu(array('menu' => 'footer_menu', 'menu_class' => 'footer-nav')); ?>
							</div>
							<div class="col-sm-4 img-col-sec">
								<div class="payment-gateway text-right">
									<img src="<?php echo get_theme_mod('footer_pg_logo_upload'); ?>" alt="">
								</div>
							</div>
						</div>
					</div>
	                
                </div>
            </div>
        </div>
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
</body>
</html>