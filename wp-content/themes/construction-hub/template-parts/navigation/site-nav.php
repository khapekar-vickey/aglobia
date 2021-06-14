<?php 
/*
* Display Theme menus
*/
?>

<div class="container">
  	<div class="menubar">
  		<div class="row m-0">
	    	<div class="menubox col-lg-11 col-md-10 col-6">
	      		<div class="innermenubox ">
		          	<div class="toggle-nav mobile-menu">
		            	<span onclick="openNav()"><i class="fas fa-bars"></i></span>
		          	</div>
		         	<div id="mySidenav" class="nav sidenav">
			            <nav id="site-navigation" class="main-navigation">
			              	<a href="javascript:void(0)" class="closebtn mobile-menu" onclick="closeNav()"><i class="fas fa-times"></i></a>
			              	<?php 
			                	wp_nav_menu( array( 
			                  	'theme_location' => 'primary-menu',
			                  	'container_class' => 'menu clearfix' ,
			                  	'menu_class' => 'clearfix',
			                  	'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
			                  	'fallback_cb' => 'wp_page_menu',
			                	) ); 
			              	?>
			            </nav>
	          		</div>
          			<div class="clearfix"></div>
        		</div>
	    	</div>
	    	<div class=" col-lg-1 col-md-2 col-6">
	    		<div class="search-box">
			        <span><i class="fas fa-search"></i></span>
			    </div>
	      	</div>
	    </div>
	    <div class="serach_outer">
	      	<div class="serach_inner">
	        	<?php get_search_form(); ?>
	        </div>
      	</div>
  	</div>
</div>