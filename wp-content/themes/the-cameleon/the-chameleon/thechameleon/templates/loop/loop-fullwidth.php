<?php 

	global $TheChameleon_options;
	global $TheChameleon_term_options;

	$columns_class['main_content'] = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['col'] ) ) ? $TheChameleon_term_options['col'] : ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options[ 'archive_col' ] ) ? $TheChameleon_options[ 'archive_col' ] : 'col-1' );	

	TheChameleon_display_template( array( 
										array( 	'id'		=>'main',
												'class'		=>'main temp-col-1',
												'tag'		=>'main',
				                	       	   	'parts'		=> array( 
																	array(	'id'	=> 'main-content',
																			'tag'	=> 'section',
	 				                										'class'	=> "main-content-loop col-item $columns_class[main_content]",	
	 				                										'part'	=> 'loop'
																			),
																			
							 			 	                		),
	 		 		                	),

									)); ?>
	
	
