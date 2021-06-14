<?php
/**
 * Dynamic css
*/
if (! function_exists('construction_light_dynamic_css')){

	function construction_light_dynamic_css(){

        $primary_color    = get_theme_mod('construction_light_primary_color','#ffc107');
        $px = 70;

		$construction_light_dynamic = '';

        // Theme Primary Background Colors.
        $construction_light_dynamic .= "
            .top-bar-menu ul.sp_socialicon li a:hover .fab, 
            .top-bar-menu ul.sp_socialicon li a:hover .fas,
            .nav-classic .nav-menu .box-header-nav,
            .box-header-nav .main-menu .children>.page_item:hover>a, 
            .box-header-nav .main-menu .children>.page_item.focus>a, 
            .box-header-nav .main-menu .sub-menu>.menu-item:hover>a, 
            .box-header-nav .main-menu .sub-menu>.menu-item.focus>a,

            .box-header-nav .main-menu .children>.page_item.current_page_item>a, 
            .box-header-nav .main-menu .sub-menu>.menu-item.current-menu-item>a,
            .conslight-search-container .search-submit,
            .conslight-search-close,

            .headertwo .nav-classic,
            .nav-classic .header-nav-toggle div,

            .btn-primary,
            .btn-border:hover,
            .cons_light_feature .feature-list .icon-box,
            .cons_light_feature .feature-list .box h3 a:after,
            .section-title:before,
            .cons_light_portfolio-cat-name:hover, 
            .cons_light_portfolio-cat-name.active,
            .video_calltoaction_wrap .box-shadow-ripples,
            .articlesListing .article .info div:after,
            .cons_light_counter:before,
            .cons_light_counter:after,
            .owl-theme .owl-dots .owl-dot.active,
            .owl-theme .owl-dots .owl-dot:hover,
            .owl-carousel .owl-nav button.owl-next:hover, 
            .owl-carousel .owl-nav button.owl-prev:hover,
            .cons_light_team_layout_two ul.sp_socialicon li a i,
            .cons_light_team_layout_two ul.sp_socialicon li a i:hover,
            .cons_light_client_logo_layout_two .owl-theme .owl-dots .owl-dot.active,
            .post-format-media-quote,
            .sub_footer ul.sp_socialicon li a i:hover,
            .widget_product_search a.button, 
            .widget_product_search button, 
            .widget_product_search input[type='submit'], 
            .widget_search .search-submit,
            .page-numbers,
            .reply .comment-reply-link,
            a.button, button, input[type='submit'],
            .wpcf7 input[type='submit'], 
            .wpcf7 input[type='button'],
            .calendar_wrap caption{
            
            background-color: $primary_color;
            
        }\n";

        $construction_light_dynamic .= "
            .cons_light_portfolio-caption{
            
            background-color: $primary_color$px;
            
        }\n";


        // Theme Primary Font Colors.
        $construction_light_dynamic .= "
            .top-bar-menu ul li a:hover, 
            .top-bar-menu ul li.current_page_item a,
            .top-bar-menu ul li .fa, .top-bar-menu ul li .fas, 
            .top-bar-menu ul li a .fa, 
            .top-bar-menu ul li a .fas, 
            .top-bar-menu ul li a .fab,
            .nav-classic .header-middle-inner .contact-info .quickcontact .get-tuch i,
            .cons_light_feature .feature-list .box h3 a:hover,
            .about_us_front .achivement-items .timer::after,
            .cons_light_portfolio-cat-name,
            .cons_light_portfolio-caption a,
            .cons_light_counter-icon,
            .cons_light_testimonial .client-text h4,
            .cons_light_team_layout_two .box span,
            .cons_light_team_layout_two .box h4 a:hover,
            .cons_light_feature.layout_two .feature-list .bottom-content a.btn-primary:hover,
            
            .widget-area .widget a:hover, 
            .widget-area .widget a:hover::before, 
            .widget-area .widget li:hover::before,
            .page-numbers.current,
            .page-numbers:hover,
            .breadcrumb h2,
            .breadcrumb ul li a,
            .breadcrumb ul li a:after,
            .entry-content a,
            .prevNextArticle a:hover,
            .comment-author .fn .url:hover,
            .logged-in-as a,
            .wpcf7 input[type='submit']:hover, 
            .wpcf7 input[type='button']:hover,

            .site-footer .widget a:hover, 
            .site-footer .widget a:hover::before, 
            .site-footer .widget li:hover::before,
            .site-footer .textwidget ul li a,
            .cons_light_copyright a, 
            .cons_light_copyright a.privacy-policy-link:hover,
            a:hover, a:focus, a:active{

            color: $primary_color;
            
        }\n";

        // Theme Primary Border Colors.
        $construction_light_dynamic .= "
            .btn-primary,
            .btn-border:hover,
            .cons_light_feature .feature-list .icon-box,
            .cons_light_portfolio-cat-name:hover, 
            .cons_light_portfolio-cat-name.active,
            .cons_light_counter,
            .cons_light_testimonial .client-img,
            .cons_light_team_layout_two.layout_two .box figure,
            .cons_light_team_layout_two ul.sp_socialicon li a i:hover,
            .site-footer .widget h2.widget-title:before,
            .sub_footer ul.sp_socialicon li a i:hover,

            .cross-sells h2:before, .cart_totals h2:before, 
            .up-sells h2:before, .related h2:before, 
            .woocommerce-billing-fields h3:before, 
            .woocommerce-shipping-fields h3:before, 
            .woocommerce-additional-fields h3:before, 
            #order_review_heading:before, 
            .woocommerce-order-details h2:before, 
            .woocommerce-column--billing-address h2:before,
            .woocommerce-column--shipping-address h2:before, 
            .woocommerce-Address-title h3:before, 
            .woocommerce-MyAccount-content h3:before, 
            .wishlist-title h2:before, 
            .woocommerce-account .woocommerce h2:before, 
            .widget-area .widget .widget-title:before, 
            .comments-area .comments-title:before,
            .page-numbers,
            .page-numbers:hover,
            .prevNextArticle .hoverExtend.active span,
            .wpcf7 input[type='submit'], 
            .wpcf7 input[type='button'],
            .wpcf7 input[type='submit']:hover, 
            .wpcf7 input[type='button']:hover{

            border-color: $primary_color;
            
        }\n";


        $construction_light_dynamic .= "@media (max-width: 992px){
            .box-header-nav .main-menu .children>.page_item:hover>a, .box-header-nav .main-menu .sub-menu>.menu-item:hover>a {

                color: $primary_color !important;
            }
        }\n";



        wp_add_inline_style( 'construction-light-style', $construction_light_dynamic );
	}
}
add_action( 'wp_enqueue_scripts', 'construction_light_dynamic_css', 99 );