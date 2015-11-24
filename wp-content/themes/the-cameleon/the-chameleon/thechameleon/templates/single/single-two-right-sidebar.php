<?php

	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_first' ] ) ) ? $TheChameleon_post_options[ 'sidebar_first' ] : 'Post' ;
	$sidebar['sidebar_second'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_second' ] ) ) ? $TheChameleon_post_options[ 'sidebar_second' ] : 'Page' ;

	TheChameleon_display_template( array(

							 		array( 	'id'		=>'main',
											'tag'		=>'main',
	 				                   		'class'		=>'main temp-col-3-60x25x15',
			                	       	   	'parts'		=> array(
																	array(	'id'	  => 'main-content',
																			'tag'	  => 'section',
				              												'class'	  => 'main-content-single col-item col-1',	
				              												'part'	  => 'single',
																			'setting' =>  array(  'view'  => 'post' ),
																			),
									
																	array(	'id'	  => 'sidebar',
																			'tag'	  => 'aside',
																			'class'	  => 'sidebar-single col-item col-1',
																			'part'	  => 'sidebar',	
																			'setting' => array('name' => $sidebar['sidebar_second'] ),
																			),
																										
																	array(	'id'	  => 'sidebar-two',
																			'tag'	  => 'aside',
																			'class'	  => 'sidebar sidebar-single col-item col-1',
																			'part'	  => 'sidebar',
																			'setting' => array('name'	=> $sidebar['sidebar_first'] ),
																			),

				 			 	                				),

				 		 		                	),

								)); ?>