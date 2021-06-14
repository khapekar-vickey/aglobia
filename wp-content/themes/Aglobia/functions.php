<?php
/**
 * icarefurnishers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package icarefurnishers
 */

if ( ! function_exists( 'icarefurnishers_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function icarefurnishers_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on icarefurnishers, use a find and replace
		 * to change 'icarefurnishers' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'icarefurnishers', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'icarefurnishers' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'icarefurnishers_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'icarefurnishers_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function icarefurnishers_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'icarefurnishers_content_width', 640 );
}
add_action( 'after_setup_theme', 'icarefurnishers_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function icarefurnishers_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'icarefurnishers' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'icarefurnishers' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'icarefurnishers_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function icarefurnishers_scripts() {
	wp_enqueue_style( 'icarefurnishers-style', get_stylesheet_uri() );

	wp_enqueue_script( 'icarefurnishers-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'icarefurnishers-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'icarefurnishers_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
* Custom feature image
*/
function wpcustom_featured_image() {
   //Execute if singular
   if ( is_singular() ) {
       $id = get_queried_object_id ();
       // Check if the post/page has featured image
       if ( has_post_thumbnail( $id ) ) {
           // Change thumbnail size, but I guess full is what you'll need
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
           $url = $image[0];
       } else {
           //Set a default image if Featured Image isn't set
           $url = '';
       }
   }
   return $url;
}
// End custom featured image

//login Page Css
function media_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'media_login_stylesheet' );

function media_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'media_login_logo_url' );


/* ******************************************* */
/* ****************** Vickey ***************** */
/* *********** Date : 23-05-2020 ************* */
/* for testimonials */
/* ******************************************* */


// for testimonials
// Testimonial Custom Post Type



// for testimonials
// Testimonial Custom Post Type

add_action( 'init', 'testimonials_post_type' );
function testimonials_post_type() {
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' =>  'No Testimonials found',
        'not_found_in_trash' => 'No Testimonials in the trash',
        'parent_item_colon' => '',
    );
 
    register_post_type( 'testimonials', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
        'supports' => array( 'editor' ),
        'register_meta_box_cb' => 'testimonials_meta_boxes', // Callback function for custom metaboxes
    ) );
}


// Adding a Metabox
function testimonials_meta_boxes() {
    add_meta_box( 'testimonials_form', 'Testimonial Details', 'testimonials_form', 'testimonials', 'normal', 'high' );
}
 
function testimonials_form() {
    $post_id = get_the_ID();
    $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
    $name = ( empty( $testimonial_data['name'] ) ) ? '' : $testimonial_data['name'];
    $address = ( empty( $testimonial_data['address'] ) ) ? '' : $testimonial_data['address'];
    $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
 
    wp_nonce_field( 'testimonials', 'testimonials' );
    ?>
    <p>
        <label>Client's Name (optional)</label><br />
        <input type="text" value="<?php echo $name; ?>" name="testimonial[name]" size="40" />
    </p>
    <p>
        <label>Business/Site Name (optional)</label><br />
        <input type="text" value="<?php echo $address; ?>" name="testimonial[address]" size="40" />
    </p>
    <p>
        <label>Link (optional)</label><br />
        <input type="text" value="<?php echo $link; ?>" name="testimonial[link]" size="40" />
    </p>
    <?php
}

// Saving the Custom Meta
add_action( 'save_post', 'testimonials_save_post' );
function testimonials_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['testimonials'] ) && ! wp_verify_nonce( $_POST['testimonials'], 'testimonials' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'testimonials' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'testimonials_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => 'Testimonial - ' . $post_id
        ) );
 
        add_action( 'save_post', 'testimonials_save_post' );
    }
 
    if ( ! empty( $_POST['testimonial'] ) ) {
        $testimonial_data['name'] = ( empty( $_POST['testimonial']['name'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['name'] );
        $testimonial_data['address'] = ( empty( $_POST['testimonial']['address'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['address'] );
        $testimonial_data['link'] = ( empty( $_POST['testimonial']['link'] ) ) ? '' : esc_url( $_POST['testimonial']['link'] );
 
        update_post_meta( $post_id, '_testimonial', $testimonial_data );
    } else {
        delete_post_meta( $post_id, '_testimonial' );
    }
}

// Customizing the List View
add_filter( 'manage_edit-testimonials_columns', 'testimonials_edit_columns' );
function testimonials_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'testimonial' => 'Testimonial',
        'testimonial-client-name' => 'Client\'s Name',
        'testimonial-address' => 'Business/Site',
        'testimonial-link' => 'Link',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
add_action( 'manage_posts_custom_column', 'testimonials_columns', 10, 2 );
function testimonials_columns( $column, $post_id ) {
    $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
    switch ( $column ) {
        case 'testimonial':
            the_excerpt();
            break;
        case 'testimonial-client-name':
            if ( ! empty( $testimonial_data['name'] ) )
                echo $testimonial_data['name'];
            break;
        case 'testimonial-address':
            if ( ! empty( $testimonial_data['address'] ) )
                echo $testimonial_data['address'];
            break;
        case 'testimonial-link':
            if ( ! empty( $testimonial_data['link'] ) )
                echo $testimonial_data['link'];
            break;
    }
}

// Display Testimonials
/**
 * Display a testimonial
 *
 * @param  int $post_per_page  The number of testimonials you want to display
 * @param  string $orderby  The order by setting  https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 * @param  array $testimonial_id  The ID or IDs of the testimonial(s), comma separated
 *
 * @return  string  Formatted HTML
 */
function get_testimonial( $posts_per_page = 1, $orderby = 'none', $testimonial_id = null ) {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'testimonials',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );
    if ( $testimonial_id )
        $args['post__in'] = array( $testimonial_id );
 
    $query = new WP_Query( $args  );
 
    $testimonials = '';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
            $post_id = get_the_ID();
            $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
            $name = ( empty( $testimonial_data['name'] ) ) ? '' : $testimonial_data['name'];
            $address = ( empty( $testimonial_data['address'] ) ) ? '' : ' - ' . $testimonial_data['address'];
            $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $name . $address . '</a>' : $name . $address;
 
            $testimonials .= '<aside class="testimonial">';
            $testimonials .= '<span class="quote">&ldquo;</span>';
            $testimonials .= '<div class="entry-content">';
            $testimonials .= '<p class="testimonial-text">' . get_the_content() . '<span></span></p>';
            $testimonials .= '<p class="testimonial-client-name"><cite>' . $cite . '</cite>';
            $testimonials .= '</div>';
            $testimonials .= '</aside>';
 
        endwhile;
        wp_reset_postdata();
    }
 
    return $testimonials;
}




add_shortcode( 'testimonial_post_slider', 'testimonial_post_slider_SC' );
function testimonial_post_slider_SC() {
$html = '';
$html = '
	<div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	    </ol>

		<!-- Wrapper for slides -->
	    <div class="carousel-inner testimonial-slider">
	      	<div class="item active">
		        <blockquote>
					<p>Sed vel lorem et velit dictum rhoncus eget sed orci. Vestibulum ante ipsum primis in faucibus orci luctus et.</p>
					<footer>John Doe <figure>River Side Apartments</figure></footer>
				</blockquote>
	      	</div>

	      	<div class="item">
	        	<blockquote>
					<p>Ut ornare in dolor sit amet mollis. Aliquam molestie venenatis mi in efficitur. Lorem ipsum dolor sit amet</p>
					<footer>Peter Brown  <figure>LTJ Investments</figure></footer>
				</blockquote>
	      	</div>
	    
	      	<div class="item">
				<blockquote>
					<p>Quisque eleifend tempor odio, sit amet maximus tortor hendrerit sollicitudin. Quisque mollis non justo id bibendum</p>
					<footer>Suzane J. Bright <figure>Archits Company</figure></footer>
				</blockquote>
	      	</div>
	    </div>
  	</div>';
return $html;
}


add_shortcode( 'logo_owl_carousel', 'logo_owl_carousel_SC' );
function logo_owl_carousel_SC() {
$html = '';
$html = '
<section class="latest-blog-posts bg-white pt60 pb60">
	<div class="container-fluid">
		<div id="owl-demo-2" class="owl-carousel owl-theme">
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-04.png" alt="" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-05.png" alt="" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-06.png" alt="" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-06.png" alt="" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-08.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-09.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/01e795fe893e12e7afd15ef843189d26.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/b159606d503bf9705a74f2e342003b3c.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/b159606d503bf9705a74f2e342003b3c.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/cf274412fc263ce720965ff70ec8c607.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/d7d0675a714accc8ec051c353a1db8bf.png" alt="image" />
			</article>
			<article class="thumbnail item">
				<img src="http://aglobia.icarefurnishers.com/wp-content/uploads/sites/5/2020/05/Logo-03.png" alt="image" />
			</article>
		</div>
<!-- #owl-demo-2 -->
		<div class="customNavigation"></div>
	</div>
<!-- .container -->

</section>';

return $html;
}



include('footer_details.php');

/**
* Load Theme Setup Page
*/
require get_template_directory() . '/textlocal_sms/textlocal.class.php';
require get_template_directory() . '/sendsms_function.php';
require get_template_directory() . '/commen_function.php';
require get_template_directory() . '/woo_extraprice.php';
require get_template_directory() . '/function_partner_list.php';
require get_template_directory() . '/function_interior_list.php';
require get_template_directory() . '/function_homepage_slider.php';
require get_template_directory() . '/add_term_metabox.php';

//Creating custom-shop-menu
function wpb_custom_shop_menu() {
  register_nav_menus(
    array(
      'custom-shop-menu' => __( 'Custom Shop Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'wpb_custom_shop_menu' );

// custom product link 
add_filter( 'woocommerce_loop_product_link', 'custom_product_permalink_shop', 99, 2 );
 
function custom_product_permalink_shop( $link, $product ) {
   $this_product_id = $product->get_id();
   $link = '/customize/?pid='.$this_product_id;
   return $link;
}
// temp code
// /* changes the "select options" text. */
// add_filter( 'woocommerce_product_add_to_cart_text', function( $text ) {
// global $product;
// if ( $product->is_type( 'variable' ) ) {
//     $text = $product->is_purchasable() ? __( 'More Options', 'woocommerce' ) : __( 'Read more', 'woocommerce' );
// }
// return $text;
// }, 10 );

// /** * replacing add to cart buttons link on shop archive page */
// add_filter( 'woocommerce_loop_add_to_cart_link', 'replacing_add_to_cart_button', 10, 2 );
// function replacing_add_to_cart_button( $button, $product  ) {
// if ( $product->is_type( 'simple' ) ) {
//     $this_product_id = $product->get_id();
//     $link = '/customize/?pid='.$this_product_id;
//     $button_text = __("View product", "woocommerce");
//     $button = '<a class="button" href="' . $link . '">' . 
//     $button_text . '</a>';
// }
// return $button;
// }
// temp code


/***********************************************************/
/* ***************** Date :- 15-06-2020 ****************** */
/* ********************** Vickey ************************* */
/***********************************************************/
	/* ****************** Prpduct Category list ******************** */

	add_shortcode( 'get_me_list_of_SC', 'get_me_list_of' );
	function get_me_list_of(){
		$orderby = 'name';
		$order = 'asc';
		$hide_empty = false ;
		$cat_args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'parent' => 0
		);
	 
	$product_categories = get_terms( 'product_cat', $cat_args );
	 //echo "<pre>";
	 //print_r($product_categories);
	 //echo "</pre>";
	if( !empty($product_categories) ){
	    echo '
	 <div class="prodcut-category-section">
	 
	<ul class="prodcut-category-list">';
	    foreach ($product_categories as $key => $category) {
$taxonomy = $category->taxonomy;
	
	$temp = $category->term_id;
	$show_hide = get_field( 'show_hide', $taxonomy . '_' . $temp );
	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
	$image = wp_get_attachment_url( $thumbnail_id );
	if( $show_hide == 'Show' ): 	
		
		echo '<a id="'.$category->term_id.'" href="'.get_term_link($category).'" >';
		echo '<li class="prodcut-category-list-items" style="background-image:url('.$image.')">';
		//echo '<li class="prodcut-category-list-items">';
		
		
		//echo '<img class="category-img" id="img_'.$temp.'" src="'.$image.'">';
		echo '<p>- '.$category->name.'<p>';
		echo '</li>';
		echo '</a>';
	endif;
	}
	
    echo '</ul>
	 </div>
	 
	';
	}
}

/*

add_shortcode( 'product_reviews', 'bbloomer_product_reviews_shortcode' );
 
function bbloomer_product_reviews_shortcode( $atts ) {
    
   if ( empty( $atts ) ) return '';
 
   if ( ! isset( $atts['id'] ) ) return '';
       
   $comments = get_comments( 'post_id=' . $atts['id'] );
    
   if ( ! $comments ) return '';
    
   $html .= '<div class="woocommerce-tabs"><div id="reviews"><ol class="commentlist">';
    
   foreach ( $comments as $comment ) {   
      $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
      $html .= '<li class="review">';
      $html .= get_avatar( $comment, '60' );
      $html .= '<div class="comment-text">';
      if ( $rating ) $html .= wc_get_rating_html( $rating );
      $html .= '<p class="meta"><strong class="woocommerce-review__author">';
      $html .= get_comment_author( $comment );
      $html .= '</strong></p>';
      $html .= '<div class="description">';
      $html .= $comment->comment_content;
      $html .= '</div></div>';
      $html .= '</li>';
   }
    
   $html .= '</ol></div></div>';
    
   return $html;
}

*/


/* 
******************* Distcription :- Creating Custom Advertisement Post Type *****************
**************************** Developer Name :- Vickey ******************************
****************************** Date :- 29-06-2020 **********************************
*/


/* ************ Advertisement Custom Post Type ************ */

add_action( 'init', 'advertisements_post_type' );
function advertisements_post_type() {
    $labels = array(
        'name' => __( 'Advertisements' ),
        'singular_name' => __( 'Advertisement' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Advertisement' ),
        'edit_item' => __(  'Edit Advertisement' ),
        'new_item' => __( 'New Advertisement' ),
        'all_items'          => __( 'All Advertisement' ),
        'view_item' => __( 'View Advertisement' ),
        'search_items' => __( 'Search Advertisements' ),
        'not_found' =>  __( 'No Advertisements found' ),
        'not_found_in_trash' => __( 'No Advertisements in the trash' ),
        'featured_image'     => 'Poster',
        'set_featured_image' => 'Add Poster'

    );
     register_post_type( 'Advertisements', array(
        'labels' => $labels,
        'description'       => 'Holds our Advertisement Pop-up post specific data',
        'public' => true,
        'menu_position' => 10,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive' => true,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,        
        'query_var' => true,
    ) );
}

/* *********** Adding a Metabox ************** */
function advertisements_meta_boxes() {
    add_meta_box( 'advertisements_form', 'Advertisement Details', 'advertisements_form', 'advertisements', 'normal', 'high' );
}
 
function advertisements_form() {
    $post_id = get_the_ID();
    $advertisement_data = get_post_meta( $post_id, '_advertisement', true );
}

/* ************** Saving the Custom Meta ************** */
add_action( 'save_post', 'advertisements_save_post' );
function advertisements_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['advertisements'] ) && ! wp_verify_nonce( $_POST['advertisements'], 'advertisements' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'advertisements' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'advertisements_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            // 'post_title' => 'Advertisement - ' . $post_id
        ) );
 
        add_action( 'save_post', 'advertisements_save_post' );
    }
    else {
        delete_post_meta( $post_id, '_advertisement' );
    }
}

/* *********** Customizing the List View ********************/
add_filter( 'manage_edit-advertisements_columns', 'advertisements_edit_columns' );
function advertisements_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'Advertisement' => 'Advertisement',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
