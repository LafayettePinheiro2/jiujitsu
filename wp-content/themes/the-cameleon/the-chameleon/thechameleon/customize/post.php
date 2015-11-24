<?php
if ( ! function_exists( 'TheChameleon_post_customize_register' ) ) :
	/**
     * Single post settings
     *
     */						
	function TheChameleon_post_customize_register($wp_customize){
	
		global $TheChameleon_column_options;
							
	    $wp_customize->add_section(
			'post_customize', 
			array(
	       	 	'title'    => __('Single Post', 'the_chameleon'),
		        'priority' => 200,
				'panel'    => 'TheChameleon_options',
	    	)
		);
 

	 	/* = Template 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[post_template]', 
			array(
	      	 	'default'        	   => 'single-right-sidebar',
		        'capability'     	   => 'edit_theme_options',
		        'type'           	   => 'option',
			    'transport'   	 	   => 'refresh',
			    'sanitize_callback'    => 'TheChameleon_sanitize_callback',
			    'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		);

	    $wp_customize->add_control( 
			'post_template', 
			 array(
				 'label'   => __('Template', 'the_chameleon'),
	     	  	 'settings'=> 'TheChameleon_options[post_template]',
			     'section' => 'post_customize',
			     'type'    => 'select',
			     'choices' =>  
				  		array(	
							'single-fullwidth'			=> 'Full Width',
							'single-left-sidebar'		=> 'Left Sidebar',
							'single-right-sidebar'		=> 'Right Sidebar',
							'single-left-right-sidebar'	=> 'Double Sidebars',
							'single-two-right-sidebar'	=> 'Double Right Sidebars',
							'single-two-left-sidebar'	=> 'Double Left Sidebars',
						),

			  )
		);

	}
 
	add_action('customize_register', 'TheChameleon_post_customize_register');

endif;
?>