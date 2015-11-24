<?php
if ( ! function_exists( 'TheChameleon_upper_customize_register' ) ) :
	
	/**
     * Upper settings
     *
     */								
	function TheChameleon_upper_customize_register($wp_customize){
	
		global $TheChameleon_column_options;
					
	    $wp_customize->add_section(
			'upper_customize', 
			array(
	       	 	'title'     => __('Upper', 'the_chameleon'),
		        'priority'  => 120,
				'panel'  	=> 'TheChameleon_options',
	    	)
		);
 
		/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[upper_col]', 
			array(
	     	   'default'        	  => 'col-2',
		       'capability'     	  => 'edit_theme_options',
		       'type'           	  => 'option',
			   'transport'   		  => 'refresh', //postMessage,refresh
			   'sanitize_callback' 	  => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'upper_col', 
			array(
	      	   'settings' 	=> 'TheChameleon_options[upper_col]',
		       'label'   	=> __('Layout', 'the_chameleon'),
		       'section' 	=> 'upper_customize',
		       'type'    	=> 'select',
		       'choices' 	=>  $TheChameleon_column_options,
	   		)
		);

	}
 
	add_action('customize_register', 'TheChameleon_upper_customize_register');

endif;
?>