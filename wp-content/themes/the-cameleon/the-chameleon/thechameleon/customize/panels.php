<?php

if ( ! function_exists( 'TheChameleon_add_panel_group__customize_register' ) ) :
	/**
     * Add Controls Settings
     *
     */
	function TheChameleon_add_panel_group__customize_register($wp_customize){

		$wp_customize->add_panel( 
			'TheChameleon_options', 
			array(
		   	 	'priority'       => 10,
			    'capability'     => 'edit_theme_options',
			    'theme_supports' => '',
			    'title'          => 'Theme Options',
			    'description'    => '',
			) 
		);

	}
	add_action('customize_register', 'TheChameleon_add_panel_group__customize_register');

endif;?>