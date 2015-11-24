<?php
if ( ! function_exists( 'TheChameleon_skin_customize_register' ) ) :
	
	/**
     * Upper settings
     *
     */								
	function TheChameleon_skin_customize_register($wp_customize){
	
		global $TheChameleon_column_options;
					
	    $wp_customize->add_section(
			'skin_customize', 
			array(
	       	 	'title'     => __('Skin', 'the_chameleon'),
		        'priority'  => 10,
				'panel'  	=> 'TheChameleon_options',
	    	)
		);
 
		/* = Layout 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[skin]', 
			array(
	     	   'default'        	  => 'The-Chameleon-Gray',
		       'capability'     	  => 'edit_theme_options',
		       'type'           	  => 'option',
			   'transport'   		  => 'refresh', //postMessage,refresh
			   'sanitize_callback' 	  => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		);

	   $wp_customize->add_control( 
			'skin', 
			array(
	      	   'settings' 	=> 'TheChameleon_options[skin]',
		       'label'   	=> __('Available Skins', 'the_chameleon'),
		       'section' 	=> 'skin_customize',
		       'type'    	=> 'select',
		       'choices' 	=> array(
									'The-Chameleon-Gray'  => 'Gray',
									'The-Chameleon-Green' => 'Green',
									'The-Chameleon-Red'   => 'Red',	
								)
	   		)
		);

	}
 
	add_action('customize_register', 'TheChameleon_skin_customize_register');

endif;
?>