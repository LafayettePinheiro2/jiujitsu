<?php

	global $data;

	$meta_sidebar 	= 'page';
	$sidebar_name 	= ( ! empty( $data['name'] ) ) ? $data['name'] : 'page';		
	$data['name'] 	= sanitize_title( $data['name'] );	
	$data['option'] = ( ! empty( $data['option'] ) ) ? $data['option'] : NULL ;

	if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( $sidebar_name ) ) : endif;  
?>