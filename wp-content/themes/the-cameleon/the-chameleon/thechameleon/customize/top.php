<?php
if ( ! function_exists( 'TheChameleon_top_customize_register' ) ) :
	/**
     * Top settings
     *
     */						
	function TheChameleon_top_customize_register($wp_customize){
	
		global $TheChameleon_column_options;
						
	    $wp_customize->add_section(
			'top_customize', 
			array(
	      	    'title'     => __('Top', 'the_chameleon'),
		        'priority'  => 160,
				'panel'  	=> 'TheChameleon_options',
	    	)
		);
 
		/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[top_col]', 
			array(
	      	 	'default'        	  => 'col-2-70x30',
		       'capability'     	  => 'edit_theme_options',
		       'type'           	  => 'option',
			   'transport'   		  => 'refresh',
			   'sanitize_callback'    => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'top_col', 
			array(
	      	   'settings' => 'TheChameleon_options[top_col]',
		       'label'   => __('Layout', 'the_chameleon'),
		       'section' => 'top_customize',
		       'type'    => 'select',
		       'choices' =>  $TheChameleon_column_options
	   		)
		);

	}
 
	add_action('customize_register', 'TheChameleon_top_customize_register');
	
endif;
?>