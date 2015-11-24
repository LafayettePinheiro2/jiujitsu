<?php

if ( ! function_exists( 'TheChameleon_footer_customize_register' ) ) :
	/**
     * Footer Settings
     *
     */		
	function TheChameleon_footer_customize_register($wp_customize){
	
		global $TheChameleon_column_options;
					
	    $wp_customize->add_section(
			'footer_customize',
			 array(
	       	 	'title'    => __('Footer', 'the_chameleon'),
		        'priority' => 240,
				'panel'    => 'TheChameleon_options',
	    	)
		);
 
  
		/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[footer_col]', 
				array(
	     		   'default'        	  => 'col-3',
			       'capability'     	  => 'edit_theme_options',
			       'type'           	  => 'option',
				   'transport'   		  => 'refresh', //postMessage, refresh
				   'sanitize_callback'    => 'TheChameleon_sanitize_callback',
				   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   			)
		);

	   $wp_customize->add_control( 
			'footer_col', 
				array(
	     		   'settings' => 'TheChameleon_options[footer_col]',
			       'label'   => __('Layout', 'the_chameleon'),
			       'section' => 'footer_customize',
			       'type'    => 'select',
			       'choices' => $TheChameleon_column_options
	   			)
	  );

	}
 
	add_action('customize_register', 'TheChameleon_footer_customize_register');
	
endif;
?>