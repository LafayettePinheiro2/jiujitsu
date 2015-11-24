<?php


if ( ! function_exists( 'TheChameleon_copyright_customize_register' ) ) :
	/**
     * Copyright Settings
     *
     */		
	function  TheChameleon_copyright_customize_register($wp_customize){

		global $TheChameleon_column_options;
					
	    $wp_customize->add_section(
			'copyright_customize', 
			array(
	        	'title'     => __('Copyright', 'the_chameleon'),
	        	'priority'  => 280,
				'panel'  	=> 'TheChameleon_options',
	    	)
		);
 

		/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[copyright_col]', 
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
			'copyright_col', 
			array(
	      	 	'settings' => 'TheChameleon_options[copyright_col]',
		       'label'    => __('Layout', 'the_chameleon'),
		       'section'  => 'copyright_customize',
		       'type'     => 'select',
		       'choices'  => $TheChameleon_column_options
	   		)
		);

	

		/* = text 
		-------------------------------------------------------------- */
		$copyright = 'Copyright &copy; %year% '.get_bloginfo('name').'. Generate by <a href="http://www.chameleonthemes.net">The Chameleon Theme</a>';
		
		$wp_customize->add_setting(
			'TheChameleon_options[copyright]', 
			array(
		    	 'default'        		=> "$copyright",
			     'capability'     		=> 'edit_theme_options',
			     'type'           		=> 'option',
				 'transport'   			=> 'refresh', //postMessage,refresh
				 'sanitize_callback' 	=> 'TheChameleon_sanitize_callback',
				 'sanitize_js_callback'	=> 'TheChameleon_js_sanitize_callback'
		  	)
		);

		$wp_customize->add_control(
			'copyright', 
			array(
		      	'label'      => __('Text', 'the_chameleon'),
			    'section'    => 'copyright_customize',
			    'settings'   => 'TheChameleon_options[copyright]',
		  	)
		);

	}
 
	add_action('customize_register', 'TheChameleon_copyright_customize_register');
endif;
?>