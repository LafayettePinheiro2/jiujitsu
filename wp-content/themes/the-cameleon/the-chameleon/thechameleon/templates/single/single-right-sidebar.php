<?php 

	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_first' ] ) ) ? $TheChameleon_post_options[ 'sidebar_first' ] : 'Post' ;


	TheChameleon_display_template( array(		
										array(  'id'		=> 'main',
												'tag'		=> 'main', 
												'class'		=> 'temp-col-2-70x30',   		
							       				'parts'	 	=> array( 
	
																	array(	'id'	  => 'main-content',
																			'tag'	  => 'section',
																			'class'	  => 'main-content-single col-item col-1',	
																			'part'	  => 'single',
																			'setting' => array( 'view'  => 'post' )
																	),

																	array(	'id'	  => 'sidebar',
																			'tag'	  => 'aside',
																			'class'	  => 'sidebar-single col-item col-1',
																			'part'	  => 'sidebar',
																			'setting' => array(
																							'name'	 => $sidebar['sidebar_first'], 
																							'option' => 'sidebar_first'
																						)	
																	),

										                	 ),

										),	
								) ); ?>