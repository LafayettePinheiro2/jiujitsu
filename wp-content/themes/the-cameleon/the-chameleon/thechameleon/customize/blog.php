<?php

if ( ! function_exists( 'TheChameleon_blog_customize_register' ) ) :
	/**
     * Blog Settings
     *
     */
	function TheChameleon_blog_customize_register($wp_customize){
	
	
		global $TheChameleon_column_options;
				
	    $wp_customize->add_section(
			'blog_customize', 
			array(
	       	 	'title'    		=> __('Blog', 'the_chameleon'),
		        'priority' 		=> 180,
				'description'	=> __('Choice default settings for Blog.', 'the_chameleon'),
				'panel'  		=> 'TheChameleon_options',
	    	)
		);
 
  		/* = Template 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[blog_template]', 
			array(
	    	   'default'        	  => 'loop-right-sidebar',
		       'capability'     	  => 'edit_theme_options',
		       'type'           	  => 'option',
			   'transport'   		  => 'refresh',//postMessage,refresh
			   'sanitize_callback'    => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'blog_template', 
			array(
	       		'settings' => 'TheChameleon_options[blog_template]',
		        'label'    => __('Template', 'the_chameleon'),
		        'section'  => 'blog_customize',
		        'type'     => 'select',
		        'choices'  => array(
								'loop-fullwidth'		  => 'Full Width',
								'loop-left-sidebar'		  => 'Left Sidebar',
								'loop-right-sidebar'	  => 'Right Sidebar',
								'loop-left-right-sidebar' => 'Double Sidebars',
								'loop-two-right-sidebar'  => 'Double Right Sidebars',
								'loop-two-left-sidebar'	  => 'Double Left Sidebars',
							   )

		   	)
		);

	 	/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[blog_col]', 
			array(
	       		'default'        	   => 'col-1',
	       		'capability'     	   => 'edit_theme_options',
	       		'type'           	   => 'option',
		   		'transport'   		   => 'refresh', //postMessage, refresh
		   		'sanitize_callback'    => 'TheChameleon_sanitize_callback',
		   		'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'blog_col', 
			array(
	       		'settings' => 'TheChameleon_options[blog_col]',
	       		'label'    => __('Layout', 'the_chameleon'),
	       		'section'  => 'blog_customize',
	       		'type'     => 'select',
	       		'choices'  =>  $TheChameleon_column_options
	   		)
		);


	}
 
	add_action('customize_register', 'TheChameleon_blog_customize_register');
	
endif;	 ?>