<?php 
	global $TheChameleon_options;
	global $TheChameleon_term_options;

	$columns_class['main_content'] = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['col'] ) ) ? $TheChameleon_term_options['col'] : ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options[ 'archive_col' ] ) ? $TheChameleon_options[ 'archive_col' ] : 'col-1' );	
	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options[ 'sidebar_first' ] ) ) ? $TheChameleon_term_options[ 'sidebar_first' ] : 'Page' ;

	TheChameleon_display_template(array(
										array( 	'id'		=>'main',
												'class'		=>'temp-col-2-70x30',
												'tag'		=>'main',
							    	       	   	'parts'		=> array(	 
																		array(	'id'	=> 'main-content',
																				'tag'	=> 'section',
				                												'class'	=> "main-content-loop col-item $columns_class[main_content]",	
				                												'part'	=> 'loop'
																				),


																		array(	'id'	  => 'sidebar',
																				'tag'	  => 'aside',																	
																				'class'	  => 'sidebar-loop col-item col-1',
																				'part'	  => 'sidebar',
																				'setting' => array( 'name' => $sidebar['sidebar_first'], 'option'=>'sidebar_first'),
																				),
						 			 	                			),

						 		 		              ),

							)); ?>