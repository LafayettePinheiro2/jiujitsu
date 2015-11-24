<?php
if ( ! function_exists( 'TheChameleon_primany_menu_customize_register' ) ) :
	/**
     * Primary Menu Settings
     *
     */				
	function TheChameleon_primany_menu_customize_register($wp_customize){

		global $TheChameleon_column_options;
	
	    $wp_customize->add_section(
			'primany_menu_customize', 
			array(
	        	'title'     => __('Primary Menu', 'the_chameleon'),
		        'priority'  => 140,
				'panel'     => 'TheChameleon_options',
	    	)
		);
 
	  	/* = Menu 
		-------------------------------------------------------------- */		
	    $wp_customize->add_setting(
			'TheChameleon_options[primary_menu_type]', 
			array(
	      	    'default'              => 'header',
		       'capability'           => 'edit_theme_options',
		       'type'                 => 'option',
			   'transport'   	      => 'refresh', //postMessage, refresh
			   'sanitize_callback'    => 'TheChameleon_sanitize_callback',
			   'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
	   		)
		); 

	   $wp_customize->add_control( 
			'primary_menu_type', 
			array(
	      	   'settings' => 'TheChameleon_options[primary_menu_type]',
		       'label'    => __('Type', 'the_chameleon'),
		       'section'  => 'primany_menu_customize',
		       'type'     => 'select',
		       'choices'  =>  array(
					        	'header-b'	=>'The menu next to the logo',
				        		'header'	=>'The menu below the logo',
				        		'header-d'	=>'Without the menu',
					         ),
		     )
		);

		/* = has_children 
		-------------------------------------------------------------- */
		$wp_customize->add_setting(
			 'TheChameleon_options[menu_has_children]', 
			  array(
		  	      'default'        		 => '',
			      'capability'      	 => 'edit_theme_options',
			      'type'           		 => 'option',
			 	  'sanitize_callback' 	 => 'TheChameleon_sanitize_callback',
				  'sanitize_js_callback' => 'TheChameleon_js_sanitize_callback'
		  		)
		);

		$wp_customize->add_control(
			'menu_has_children', 
			array(
	    	  'label'      => __('Has Children Icon', 'the_chameleon'),
		      'section'    => 'primany_menu_customize',
		      'settings'   => 'TheChameleon_options[menu_has_children]',	
	  		)
		);
	
		/* = sub_has_children 
		-------------------------------------------------------------- */
		$wp_customize->add_setting(
			'TheChameleon_options[menu_sub_has_children]', 
			array(
		      	 'default'             => '',
			     'capability'          => 'edit_theme_options',
			     'type'           		=> 'option',
				 'sanitize_callback'   => 'TheChameleon_sanitize_callback',
				 'sanitize_js_callback'=> 'TheChameleon_js_sanitize_callback'
		  	)
		);

		 $wp_customize->add_control(
			'menu_sub_has_children', 
			array(
	     	   'label'      => __('Sub Has Children Icon', 'the_chameleon'),
		       'section'    => 'primany_menu_customize',
		       'settings'   => 'TheChameleon_options[menu_sub_has_children]',
	  		)
		);

	}
 
	add_action('customize_register', 'TheChameleon_primany_menu_customize_register');
	
endif;

?>