<?php

if ( ! function_exists( 'TheChameleon_custom_css_customize_register' ) ) :

	/*
	* Custom Css
	*
	*/

	function TheChameleon_custom_css_customize_register( $wp_customize ) {

		$wp_customize->add_section(
			'custom_css',
			array(
				'title'       => __( 'Custom CSS', 'the_chameleon' ),
				'description' => '',
				'priority'    => 150
			)
		);

		$wp_customize->add_setting(
			'TheChameleon_options[custom_css]',
			array(
				'default'              => '',
			    'type'           	   => 'option',
			    'transport'   		   => 'refresh',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'wp_filter_nohtml_kses',
				'sanitize_js_callback' => 'wp_filter_nohtml_kses'
			)
		);

		$wp_customize->add_control(
			'custom_css',
			array(
				'label'    => __( 'CSS', 'the_chameleon' ),
				'section'  => 'custom_css',
				'settings' => 'TheChameleon_options[custom_css]',
				'type'     => 'textarea'
			)
		);
	}
	add_action( 'customize_register', 'TheChameleon_custom_css_customize_register' );

endif;
?>