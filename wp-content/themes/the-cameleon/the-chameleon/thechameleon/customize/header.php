<?php
if ( ! function_exists( 'TheChameleon_header_customize_register' ) ) :
	/**
     * Header Settings
     *
     */				
	function TheChameleon_header_customize_register($wp_customize){

		global $TheChameleon_column_options;
	
	    $wp_customize->add_section(
			'header_customize', 
			array(
	       	 	'title'     => __('Header', 'the_chameleon'),
		        'priority'  => 140,
				'panel'  	=> 'TheChameleon_options',
	    	)
		);
 
		/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[header_col]', 
			array(
	   	    	'default'        => 'col-2-30x70',
		       'capability'     => 'edit_theme_options',
		       'type'           => 'option',
			   'transport'   	=> 'refresh', //postMessage,refresh
			   'sanitize_callback' 	 => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback'=> 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'TheChameleon_options_header', 
			array(
	     	   'settings' => 'TheChameleon_options[header_col]',
		       'label'    => __('Layout', 'the_chameleon'),
		       'section'  => 'header_customize',
		       'type'     => 'select',
		       'choices'  =>  $TheChameleon_column_options
	  		)
		);

		/* = Logo Type
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[logo_type]', 
			array(
	      	   'default'              => 'image',
		       'capability'           => 'edit_theme_options',
		       'type'                 => 'option',
			   'transport'   	   	  => 'refresh',
			   'sanitize_callback'    => 'TheChameleon_sanitize_callback'	,
			   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		));

	    $wp_customize->add_control( 
			'logo_type', 
			 array(
	     		  'settings' => 'TheChameleon_options[logo_type]',
			      'label'   => 'Logo Type',
			      'section' => 'header_customize',
			      'type'    => 'select',
			      'choices' =>  array(
									'image'	=> "Image",
									'text'	=> "Text",
								)
			   		)
		);
	
		/* = Logo
		-------------------------------------------------------------- */
		$wp_customize->add_setting(
			'TheChameleon_options[logo]', 
			array(
	      	    'default'              => get_template_directory_uri().'/img/logo.png',
		        'capability'           => 'edit_theme_options',
		        'type'           	   => 'option',
				'sanitize_callback'    => 'TheChameleon_sanitize_callback',
				'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	    	)
	     );

	    $wp_customize->add_control( 
			new WP_Customize_Image_Control($wp_customize, 'logo', 
					array(
			       	 	'label'    => __('Logo', 'the_chameleon'),
				        'section'  => 'header_customize',
				        'settings' => 'TheChameleon_options[logo]',
			    	)
			)
		);

		/* = Favicon
		-------------------------------------------------------------- */
		$wp_customize->add_setting(
			'TheChameleon_options[favicon]', 
			array(
	      	    'default'              => get_template_directory_uri().'/img/favicon.ico',
		        'capability'           => 'edit_theme_options',
		        'type'           	   => 'option',
				'sanitize_callback'    => 'TheChameleon_sanitize_callback'	,
				'sanitize_js_callback' =>'TheChameleon_js_sanitize_callback'
	    	)
		);

	    $wp_customize->add_control( 
			new WP_Customize_Image_Control($wp_customize, 'favicon', 
				array(
	        		'label'    => __('Favicon', 'the_chameleon'),
			        'section'  => 'header_customize',
			        'settings' => 'TheChameleon_options[favicon]',
	    		)
			)
		);
	}
 
	add_action('customize_register', 'TheChameleon_header_customize_register');

endif;
?>