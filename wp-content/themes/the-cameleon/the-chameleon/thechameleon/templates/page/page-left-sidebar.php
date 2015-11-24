<?php 

	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_first' ] ) ) ? $TheChameleon_post_options[ 'sidebar_first' ] : 'Page' ;

	TheChameleon_display_template( array(
						array( 'id'			=>'main',
							   'tag'		=>'main',
							   'class'		=>'main temp-col-2-30x70',   		
	 				           'parts'	 	=>  array(
													array( 'id'		  => 'sidebar',
															'tag'	  => 'aside',
															'class'	  => 'sidebar-page col-item col-1',
															'part'	  => 'sidebar',	
															'setting' => array(
																			'name'	 => sidebar['sidebar_first'] , 
																			'option' => 'sidebar_first'
																		  ), 
													),
													
														
 				                					array(	'id'	 => 'main-content',
              												'tag'	 => 'section',
              												'class'	 => 'main-content-loop col-item col-1',	
              												'part'	 => 'page',
													),

		 			 	                	),

		 		 		   ),

				   ) ); ?>
				
	


				