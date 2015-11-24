<?php


if ( ! function_exists( 'TheChameleon_bottom_customize_register' ) ) :
	/**
     * Bottom Settings
     *
     */
	function TheChameleon_bottom_customize_register($wp_customize){
	
		global $TheChameleon_column_options;
	
	    $wp_customize->add_section(
			'bottom_customize', 
			array(
	        	'title'     => __('Bottom', 'the_chameleon'),
		        'priority' 	=> 220,
				'panel'  	=> 'TheChameleon_options',
	    	)
		);
  
		/* = Columnes 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[bottom_col]', 
			array(
	    	   'default'        	 => 'col-2',
		       'capability'     	 => 'edit_theme_options',
		       'type'           	 => 'option',
			   'transport'   		 => 'refresh', 
			   'sanitize_callback' 	 => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback'=> 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'bottom_col', 
			array(
	       		'settings'=> 'TheChameleon_options[bottom_col]',
		       'label'   => __('Layout', 'the_chameleon'),
		       'section' => 'bottom_customize',
		       'type'    => 'select',
		       'choices' =>  $TheChameleon_column_options
	   		)
		);

	}
 
	add_action('customize_register', 'TheChameleon_bottom_customize_register');
	
endif; ?>