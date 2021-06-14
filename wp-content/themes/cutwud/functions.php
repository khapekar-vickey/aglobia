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

include('footer_details.php');




/* 
 All product list show in home page
 Developer name : Vickey
 Date : 10-06-2020
*/

if( !function_exists('products_list_in_a_product_category') ) {

    function products_list_in_a_product_category( $atts ) {

        // Shortcode Attributes
        $atts = shortcode_atts(
            array(
                'cat'       => '',
                'limit'     => '15', // default product per page
                'column'    => '4', // default columns
            ),
            $atts, 'productslist'
        );

        // The query
        $posts = get_posts( array(
            'post_type'      => 'product',
            'posts_per_page' => intval($atts['limit'])+1,
            'product_cat'    => $atts['cat'],
        ) );

        $output = '<div class="products-in-'.$atts['cat'].'">';
        $output = '<h3>Products</h3>';
        // The loop
        foreach($posts as $post_obj)
            $ids_array[] = $post_obj->ID;

        // $ids = implode( ',', $ids_array );

        $columns = $atts['column'];

        $output .= do_shortcode ( "[products ids=$ids columns=$columns ]" ) . '</div>';

        return $output;
    }
    add_shortcode( 'productslist', 'products_list_in_a_product_category' );
}

function product_show_category_wise(){
?>

	<ul class="products">
    <?php
        $args = array( 'post_type' => 'product','product_cat' => 'chair' );
        $loop = new WP_Query( $args );
        ?>
        	<h2>chair</h2>
        <?php
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

            

                <li class="product">    

                    <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                        <?php woocommerce_show_product_sale_flash( $post, $product ); ?>

                        <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

                        <h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>                    

                    </a>

                    <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul><!--/.products-->
<?php
}
add_shortcode( 'product_show_category_wise_SC', 'product_show_category_wise' );


/* 
******************* Distcription :- Creating Custom Blog Post Type *****************
**************************** Developer Name :- Vickey ******************************
****************************** Date :- 11-06-2020 **********************************
*/


/* ************ Blog Custom Post Type ************ */
add_action( 'init', 'blogs_post_type' );
function blogs_post_type() {
    $labels = array(
        'name' => 'Blogs',
        'singular_name' => 'Blog',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Blog',
        'edit_item' => 'Edit Blog',
        'new_item' => 'New Blog',
        'view_item' => 'View Blog',
        'search_items' => 'Search Blogs',
        'not_found' =>  'No Blogs found',
        'not_found_in_trash' => 'No Blogs in the trash',
        'parent_item_colon' => '',
    );
 
    register_post_type( 'blogs', array(
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
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'register_meta_box_cb' => 'blogs_meta_boxes', // Callback function for custom metaboxes
    ) );
}

/* *********** Adding a Metabox ************** */
function blogs_meta_boxes() {
    add_meta_box( 'blogs_form', 'Blog Details', 'blogs_form', 'blogs', 'normal', 'high' );
}
 
function blogs_form() {
    $post_id = get_the_ID();
    $blog_data = get_post_meta( $post_id, '_blog', true );
    $client_name = ( empty( $blog_data['client_name'] ) ) ? '' : $blog_data['client_name'];
    $source = ( empty( $blog_data['source'] ) ) ? '' : $blog_data['source'];
    $link = ( empty( $blog_data['link'] ) ) ? '' : $blog_data['link'];
 
    wp_nonce_field( 'blogs', 'blogs' );
    ?>
    <p>
        <label>Client's Name (optional)</label><br />
        <input type="text" value="<?php echo $client_name; ?>" name="blog[client_name]" size="40" />
    </p>
    <p>
        <label>Business/Site Name (optional)</label><br />
        <input type="text" value="<?php echo $source; ?>" name="blog[source]" size="40" />
    </p>
    <p>
        <label>Link (optional)</label><br />
        <input type="text" value="<?php echo $link; ?>" name="blog[link]" size="40" />
    </p>
    <?php
}

/* ************** Saving the Custom Meta ************** */
add_action( 'save_post', 'blogs_save_post' );
function blogs_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['blogs'] ) && ! wp_verify_nonce( $_POST['blogs'], 'blogs' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'blogs' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'blogs_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => 'Blog - ' . $post_id
        ) );
 
        add_action( 'save_post', 'blogs_save_post' );
    }
 
    if ( ! empty( $_POST['blog'] ) ) {
        $blog_data['client_name'] = ( empty( $_POST['blog']['client_name'] ) ) ? '' : sanitize_text_field( $_POST['blog']['client_name'] );
        $blog_data['source'] = ( empty( $_POST['blog']['source'] ) ) ? '' : sanitize_text_field( $_POST['blog']['source'] );
        $blog_data['link'] = ( empty( $_POST['blog']['link'] ) ) ? '' : esc_url( $_POST['blog']['link'] );
 
        update_post_meta( $post_id, '_blog', $blog_data );
    } else {
        delete_post_meta( $post_id, '_blog' );
    }
}

/* *********** Customizing the List View ********************/
add_filter( 'manage_edit-blogs_columns', 'blogs_edit_columns' );
function blogs_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'blog' => 'Blog',
        'blog-client-name' => 'Client\'s Name',
        'blog-source' => 'Business/Site',
        'blog-link' => 'Link',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}
 
add_action( 'manage_posts_custom_column', 'blogs_columns', 10, 2 );
function blogs_columns( $column, $post_id ) {
    $blog_data = get_post_meta( $post_id, '_blog', true );
    switch ( $column ) {
        case 'blog':
            the_excerpt();
            break;
        case 'blog-client-name':
            if ( ! empty( $blog_data['client_name'] ) )
                echo $blog_data['client_name'];
            break;
        case 'blog-source':
            if ( ! empty( $blog_data['source'] ) )
                echo $blog_data['source'];
            break;
        case 'blog-link':
            if ( ! empty( $blog_data['link'] ) )
                echo $blog_data['link'];
            break;
    }
}

/**
 * Display a Blogs
 *
 * @param  int $post_per_page  The number of blogs you want to display
 * @param  string $orderby  The order by setting  https://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
 * @param  array $blog_id  The ID or IDs of the blog(s), comma separated
 *
 * @return  string  Formatted HTML
 */

function get_blogs_data( $posts_per_page = 1, $orderby = 'none', $blog_id = null ) {
    $args = array(
        'posts_per_page' => (int) $posts_per_page,
        'post_type' => 'blogs',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );
    if ( $blog_id )
        $args['post__in'] = array( $blog_id );
 
    $query = new WP_Query( $args  );
 
    $blogs = '';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
            $post_id = get_the_ID();
            $blog_data = get_post_meta( $post_id, '_blog', true );
            $client_name = ( empty( $blog_data['client_name'] ) ) ? '' : $blog_data['client_name'];
            $source = ( empty( $blog_data['source'] ) ) ? '' : ' - ' . $blog_data['source'];
            $link = ( empty( $blog_data['link'] ) ) ? '' : $blog_data['link'];
            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;
 
            $testimonials .= '<aside class="blog">';
            $testimonials .= '<span class="quote">&ldquo;</span>';
            $testimonials .= '<div class="entry-content">';
            $testimonials .= '<p class="blog-text">' . get_the_content() . '<span></span></p>';
            $testimonials .= '<p class="blog-client-name"><cite>' . $cite . '</cite>';
            $testimonials .= '</div>';
            $testimonials .= '</aside>';
 
        endwhile;
        wp_reset_postdata();
    }
 
    return $blogs;
}

add_shortcode( 'get_blogs_data_SC', 'get_blogs_data' );



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
	);
	 
	$product_categories = get_terms( 'product_cat', $cat_args );
	 
	if( !empty($product_categories) ){
	    echo '
	 <div class="prodcut-category-section">
	 <h3 class="product-cat-head">Product Category</h3>
	<ul class="prodcut-category-list">';
	    foreach ($product_categories as $key => $category) {
	        echo '
	 
	<li class="prodcut-category-list-items">';

	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
	$image = wp_get_attachment_url( $thumbnail_id );
	        echo '<a id="'.$category->term_id.'" href="'.get_term_link($category).'" ><span>';
	        echo $category->name;
	        echo '</span><img class="category-img" id="img_'.$category->term_id.'" src="'.$image.'">';
	        echo '</a>';
	        echo '</li>';
	    }
	    echo '</ul>
	 </div>
	 
	';
	}
}




// custom product link for product box
add_filter( 'woocommerce_loop_product_link', 'custom_product_permalink_shop', 99, 2 );

function custom_product_permalink_shop( $link, $product ) {
  $this_product_id = $product->get_id();
  $link = '/customize/?pid='.$this_product_id;
  return $link;
}


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