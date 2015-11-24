<?php

	global $TheChameleon_options;
	global $TheChameleon_term_options;

	$columns_class['main_content'] = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['col'] ) ) ? $TheChameleon_term_options['col'] : ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options[ 'archive_col' ] ) ? $TheChameleon_options[ 'archive_col' ] : 'col-1' );	
	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options[ 'sidebar_first' ] ) ) ? $TheChameleon_term_options[ 'sidebar_first' ] : 'Page' ;
	$sidebar['sidebar_second'] 	   = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options[ 'sidebar_second' ] ) ) ? $TheChameleon_term_options[ 'sidebar_second' ] : 'Post' ;

	TheChameleon_display_template( array(

							 		array( 	'id'		=>'main',
											'tag'		=>'main',
	 				                   		'class'		=>'main temp-col-3-60x25x15',
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
																				'setting' => array( 'name' => $sidebar['sidebar_second'] ),
																				),
																											
																		array(	'id'	  => 'sidebar-two',
																				'tag'	  => 'aside',
																				'class'	  => 'sidebar sidebar-loop col-item col-1',
																				'part'	  => 'sidebar',
																				'setting' => array( 'name' => $sidebar['sidebar_first'] ),
																				),

				 			 	                				),

				 		 		                	),

								)); ?>														