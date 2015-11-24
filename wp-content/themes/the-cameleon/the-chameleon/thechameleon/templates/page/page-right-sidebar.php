<?php 
	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_first' ] ) ) ? $TheChameleon_post_options[ 'sidebar_first' ] : 'Page' ;

	TheChameleon_display_template( array(	
	
								array(  'id'		=> 'main',
										'tag'		=> 'main', 
										'class'		=> 'temp-col-2-70x30',   		
					       				'parts'	 	=> array( 
	
															array(	'id'	  => 'main-content',
																	'tag'	  => 'section',
																	'class'	  => 'main-content-page col-item col-1',	
																	'part'	  => 'page',
																	'setting' => array()
															),


															array(	'id'	  => 'sidebar',
																	'tag'	  => 'aside',
																	'class'	  => 'sidebar-page col-item col-1',
																	'part'	  => 'sidebar',
																	'setting' => array(
																					'name'	 => $sidebar['sidebar_first'], 
																					'option' => 'sidebar_first'
																				)	
															),

								                	 ),

								),	
						) ); ?>
					
					