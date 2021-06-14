<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package icarefurnishers
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
	<!-- font-family: 'Open Sans', sans-serif; --> 
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap" rel="stylesheet">
	<!-- font-family: 'Roboto', sans-serif; --> 
<?php wp_head(); ?>
	<!-- Bootstrap -->   
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" rel="shortcut icon" type="image/x-icon" /> 
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/owl.theme.default.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/css/custom.css" rel="stylesheet">

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/OwlCarousel2-2.3.4/dist/owl.carousel.min.js">
	</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>
	<script type="text/javascript">jQuery.noConflict(true);</script>
	
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header class="header">
		<div class="container-fluid top">
			<div class="container no-padding">
				<div class="row no-padding">
					<div class="col-md-3 email"> 
						<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/spacewood/images/mail.jpg" alt="Mail" title="Mail"> 
						<a href="mailto:marketing@spacewood.in">marketing@spacewood.in</a>
					</div>
					<div class="col-md-9 top-link no-padding"> 
						<?php wp_nav_menu( array( 'theme_location' => 'extra-menu' ) ); ?>
					</div>
				</div>
			</div>
			<hr>
		</div>

		<div class="container-fluid top">
			<div class="container no-padding">
				<div class="row no-padding">
					<div class="col-lg-9 col-md-9 col-sm-7 col-xs-12 no-padding animated zoomIn">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand">
							<img src="<?php echo get_theme_mod('header_logo_upload'); ?>" alt="Spacewood" title="Spacewood">
						</a>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12 no-padding">
						<div class="button_box2">
							<form role="search" method="get" id="searchform" class="searchform form-wrapper-2 cf" action="<?php echo home_url( '/' );?>">
								<div class="input-box">
									<input type="text" value="" name="s" id="s" placeholder="Search here...">
								</div>
								<button type="submit" id="searchsubmit">
									<i class="fa fa-search" aria-hidden="true"></i> 
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<nav id="navigation" class="navbar navbar-inverse navbar-expand-lg" role="navigation">
			<div class="container no-padding">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		    		<span class="navbar-toggler-icon"></span>
		  		</button>
		  		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			    <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav navbar-nav  navbar-right','menu_id' => 'spacewood-nav' )); ?>
			</div>
			</div>
		</nav>


    </header>
	
<?php echo do_shortcode("[DkHomepageSlider number='10' posttype='homepage_slider']"); ?>
	<div id="content" class="site-content">
