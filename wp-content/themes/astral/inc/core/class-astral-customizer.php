<?php
/**
 * astral: Customizer
 *
 * @package Astral
 * @since 0.1
 */
class astral_Customizer extends astral_Abstract_Main {

	public function __construct() {

		add_action( 'customize_register', array( $this, 'astral_customize_register' ) );

	}

	public function init() {
	}

	function astral_customize_register( $wp_customize ) {

		wp_enqueue_style( 'astral-customizer-style', get_template_directory_uri() . '/css/customizr.css' );

		//All our sections, settings, and controls will be added here
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		/* create panel */

		$wp_customize->add_panel( 'astral_theme_option', array(
			'title'    => __( 'Theme Settings', 'astral' ),
			'priority' => 1, // Mixed with top-level-section hierarchy.
		) );
		
		/* social icon section */
		$wp_customize->add_section( 'astral_general_settings', array(
			'title'      => __( 'General Settings', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );
		
		$wp_customize->add_setting( 'astral_frontpage_show', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'astral_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'astral_frontpage_show', array(
			'label'    => __( 'Frontpage Template', 'astral' ),
			'description' => __( 'Click to keep the frontpage template?', 'astral' ),
			'type'     => 'checkbox',
			'section'  => 'astral_general_settings',
			'settings' => 'astral_frontpage_show',
		) );

		/* footer section */
		$wp_customize->add_section( 'astral_footer', array(
			'title'      => __( 'Footer Options', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );

		$wp_customize->add_setting( 'footer_text', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'footer_text', array(
			'label'    => __( 'Footer Text', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_footer',
			'settings' => 'footer_text',
		) );

		$wp_customize->add_setting( 'footer_copyright', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'footer_copyright', array(
			'label'    => __( 'Footer Copyright', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_footer',
			'settings' => 'footer_copyright',
		) );

		$wp_customize->add_setting( 'footer_link', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'footer_link', array(
			'label'    => __( 'Footer Link', 'astral' ),
			'type'     => 'url',
			'section'  => 'astral_footer',
			'settings' => 'footer_link',
		) );

		/* inner header image */
		$wp_customize->add_section( 'astral_inner_banner', array(
			'title'      => __( 'Inner banner', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );
		$wp_customize->add_setting( 'inner_header_image', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'inner_header_image', array(
			'label'    => __( 'Inner banner Image', 'astral' ),
			'description' => __( 'background image show before breadcrumb area', 'astral' ),
			'section'  => 'astral_inner_banner',
			'settings' => 'inner_header_image'
		) ) );

		/* Slider options */
		$wp_customize->add_section(
			'slider_section',
			array(
				'title'           => __( 'Slider Options', 'astral' ),
				'panel'           => 'astral_theme_option',
				'description'     => 'Here you can add slider images',
				'capability'      => 'edit_theme_options',
				'priority'        => 35,
				'active_callback' => 'is_front_page',
			)
		);

		for($i=1;$i<=3;$i++) {
		$wp_customize->add_setting( 'astral_dropdown_pages_'.$i,
		   array(
			'type'              => 'theme_mod',
			  'default' => '',
			  'sanitize_callback' => 'absint',
			  'capability'        => 'edit_theme_options',
		   )
		);
		$wp_customize->add_control( 'astral_dropdown_pages_'.$i,
			array(
				'label' => 'Select page for slider '.$i,
				'description' => esc_html__( 'Add Featured image in page' ,'astral' ),
				'section' => 'slider_section', 
				'type' => 'dropdown-pages',
			)
		);
		}

		/* callout section */
		$wp_customize->add_section( 'astral_callout', array(
			'title'      => __( 'About Us Section', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );

		$wp_customize->add_setting( 'astral_callout_show', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'astral_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'astral_callout_show', array(
			'label'    => __( 'About Section On/Off', 'astral' ),
			'description' => __( 'Click above checkbox to show about section on front page', 'astral' ),
			'type'     => 'checkbox',
			'section'  => 'astral_callout',
			'settings' => 'astral_callout_show',
		) );

		$wp_customize->add_setting( 'astral_about_section',
		   array(
			'type'              => 'theme_mod',
			  'default' => '',
			  'sanitize_callback' => 'absint',
			  'capability'        => 'edit_theme_options',
		   )
		);
		$wp_customize->add_control( 'astral_about_section',
			array(
				'label' => __( 'Select about us page','astral' ),
				'description' => esc_html__( 'Select page to show on about us section on frontpage template', 'astral' ),
				'section' => 'astral_callout', 
				'type' => 'dropdown-pages',
			)
		);


		/* service section */
		$wp_customize->add_section( 'astral_service', array(
			'title'      => __( 'Service Settings', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );
		
		$wp_customize->add_setting( 'astral_service_show', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'astral_sanitize_checkbox',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'astral_service_show', array(
			'label'    => __( 'Service Section On/Off', 'astral' ),
			'description' => __( 'Click above checkbox to show service section on front page', 'astral' ),
			'type'     => 'checkbox',
			'section'  => 'astral_service',
			'settings' => 'astral_service_show',
		) );


		$wp_customize->add_setting( 'astral_service_title', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'astral_service_title', array(
			'label'    => __( 'Service Title ', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_service',
			'settings' => 'astral_service_title',
		) );

		$wp_customize->add_setting( 'astral_service_desc', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'astral_service_desc', array(
			'label'    => __( 'Service description ', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_service',
			'settings' => 'astral_service_desc',
		) );
		
		/* */
		for($j=1;$j<=3;$j++) {
		$wp_customize->add_setting(
		'astral_service_'.$j,
			array(
			'type'=>'theme_mod',
			'default'=>'',
			'sanitize_callback'=>'absint',
			'capability'        => 'edit_theme_options',
		) );
		$wp_customize->add_control( new astral_service( 
		$wp_customize, 'astral_service_'.$j,
		array(
			'label'    => 'Select post for service '.$j, 
			'section'  => 'astral_service',
			'settings' => 'astral_service_'.$j,	
		) ) );
		}
		/* */


		/* blog section */
		$wp_customize->add_section( 'astral_blog', array(
			'title'      => __( 'Blog Options', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );

		$wp_customize->add_setting( 'astral_blog_title', array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( 'astral_blog_title', array(
			'label'    => __( 'Blog Title ', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_blog',
			'settings' => 'astral_blog_title',
		) );

		$wp_customize->add_setting( 'astral_blog_desc', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'astral_blog_desc', array(
			'label'    => __( 'Blog description ', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_blog',
			'settings' => 'astral_blog_desc',
		) );

		/* contact section */
		$wp_customize->add_section( 'astral_contact', array(
			'title'      => __( 'Topbar Section', 'astral' ),
			'description'=>__( 'Only Show on Topbar', 'astral' ),
			'panel'      => 'astral_theme_option',
			'capability' => 'edit_theme_options',
			'priority'   => 35,
		) );

		$wp_customize->add_setting( 'astral_phoneno', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'astral_phoneno', array(
			'label'    => __( 'Phone no. ', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_contact',
			'settings' => 'astral_phoneno',
		) );

		$wp_customize->add_setting( 'astral_address', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'astral_address', array(
			'label'    => __( 'Address ', 'astral' ),
			'type'     => 'text',
			'section'  => 'astral_contact',
			'settings' => 'astral_address',
		) );

		$wp_customize->add_setting( 'astral_email', array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'capability'        => 'edit_theme_options',
			)
		);
		$wp_customize->add_control( 'astral_email', array(
			'label'    => __( 'Email ', 'astral' ),
			'type'     => 'email',
			'section'  => 'astral_contact',
			'settings' => 'astral_email',
		) );

		function astral_sanitize_checkbox( $input ) {
			return $input;
		}
		

		
		//astral_Dropdown_Posts_Custom_Control
	}
}



new astral_Customizer();