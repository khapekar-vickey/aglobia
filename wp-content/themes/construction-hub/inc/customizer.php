<?php
/**
 * Construction Hub: Customizer
 *
 * @package Construction Hub
 * @subpackage construction_hub
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function construction_hub_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'construction_hub_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Custom Home page', 'construction-hub' ),
	    'description' => __( 'Description of what this panel does.', 'construction-hub' ),
	) );

	//Sidebar Position
	$wp_customize->add_section('construction_hub_sidebar_position',array(
        'title'         => __('Sidebar Position', 'construction-hub'),
        'priority'      => 21,
        'panel' => 'construction_hub_panel_id'
    ) );

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('construction_hub_sidebar_post_layout',array(
        'default' => __('right','construction-hub'),        
        'sanitize_callback' => 'construction_hub_sanitize_choices'	        
	));
	$wp_customize->add_control('construction_hub_sidebar_post_layout',array(
        'type' => 'radio',
        'label'     => __('Theme Sidebar Position', 'construction-hub'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'construction-hub'),
        'section' => 'construction_hub_sidebar_position',
        'choices' => array(
            'full' => __('Full','construction-hub'),
            'left' => __('Left','construction-hub'), 
            'right' => __('Right','construction-hub'),
            'three-column' => __('Three Columns','construction-hub'),
            'four-column' => __('Four Columns','construction-hub'),
            'grid' => __('Grid Layout','construction-hub')
        ),
	) );

	// Add Settings and Controls for Page Layout
	$wp_customize->add_setting('construction_hub_sidebar_page_layout',array(
        'default' => __('right','construction-hub'),        
        'sanitize_callback' => 'construction_hub_sanitize_choices'	        
	));
	$wp_customize->add_control('construction_hub_sidebar_page_layout',array(
        'type' => 'radio',
        'label'     => __('Page Sidebar Position', 'construction-hub'),
        'description'   => __('This option work for pages.', 'construction-hub'),
        'section' => 'construction_hub_sidebar_position',
        'choices' => array(
            'full' => __('Full','construction-hub'),
            'left' => __('Left','construction-hub'), 
            'right' => __('Right','construction-hub')
        ),
	) );

	$wp_customize->add_section( 'construction_hub_topbar', array(
    	'title'      => __( 'Contact Details', 'construction-hub' ),
    	'description' => __( 'Add your contact details', 'construction-hub' ),
		'priority'   => 30,
		'panel' => 'construction_hub_panel_id'
	) );

	$wp_customize->add_setting('construction_hub_call_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_call_text',array(
		'label'	=> __('Add Call Text','construction-hub'),
		'section'=> 'construction_hub_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('construction_hub_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_call',array(
		'label'	=> __('Add Phone Number','construction-hub'),
		'section'=> 'construction_hub_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('construction_hub_mail_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_mail_text',array(
		'label'	=> __('Add Email Text','construction-hub'),
		'section'=> 'construction_hub_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('construction_hub_mail',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_mail',array(
		'label'	=> __('Add Mail Address','construction-hub'),
		'section'=> 'construction_hub_topbar',
		'type'=> 'text'
	));

	//home page slider
	$wp_customize->add_section( 'construction_hub_slider_section' , array(
    	'title'      => __( 'Slider Section', 'construction-hub' ),
		'priority'   => 30,
		'panel' => 'construction_hub_panel_id'
	) );

	$wp_customize->add_setting('construction_hub_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('construction_hub_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','construction-hub'),
       'section' => 'construction_hub_slider_section',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'construction_hub_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'construction_hub_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'construction_hub_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'construction-hub' ),
			'section'  => 'construction_hub_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	//Our Project Section
	$wp_customize->add_section('construction_hub_about_section',array(
		'title'	=> __('Our Project Section','construction-hub'),
		'panel' => 'construction_hub_panel_id',
	));	

	$wp_customize->add_setting('construction_hub_our_project_title',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_our_project_title',array(
		'label'	=> __('Section Title','construction-hub'),
		'section'	=> 'construction_hub_about_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('construction_hub_our_project_para',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_our_project_para',array(
		'label'	=> __('Subtitle','construction-hub'),
		'section'	=> 'construction_hub_about_section',
		'type'		=> 'text'
	));

	for ( $count = 1; $count <= 3; $count++ ) {

		$wp_customize->add_setting( 'construction_hub_about_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'construction_hub_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'construction_hub_about_page' . $count, array(
			'label'    => __( 'Select Service Page', 'construction-hub' ),
			'section'  => 'construction_hub_about_section',
			'type'     => 'dropdown-pages'
		));
	}
	
	//footer
	$wp_customize->add_section('construction_hub_footer_section',array(
		'title'	=> __('Footer Text','construction-hub'),
		'description'	=> __('Add copyright text.','construction-hub'),
		'panel' => 'construction_hub_panel_id'
	));
	
	$wp_customize->add_setting('construction_hub_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('construction_hub_footer_text',array(
		'label'	=> __('Copyright Text','construction-hub'),
		'section'	=> 'construction_hub_footer_section',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'construction_hub_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'construction_hub_customize_partial_blogdescription',
	) );

}
add_action( 'customize_register', 'construction_hub_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Construction Hub 1.0
 * @see construction_hub_customize_register()
 *
 * @return void
 */
function construction_hub_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Construction Hub 1.0
 * @see construction_hub_customize_register()
 *
 * @return void
 */
function construction_hub_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Construction_Hub_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Construction_Hub_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Construction_Hub_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Construction Hub Pro', 'construction-hub' ),
					'pro_text' => esc_html__( 'Upgrade Pro', 'construction-hub' ),
					'pro_url'  => esc_url('https://www.themespride.com/themes/construction-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'construction-hub-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'construction-hub-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Construction_Hub_Customize::get_instance();