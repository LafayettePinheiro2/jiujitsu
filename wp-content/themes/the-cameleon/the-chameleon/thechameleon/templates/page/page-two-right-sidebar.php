<?php
	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$sidebar['sidebar_first'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_first' ] ) ) ? $TheChameleon_post_options[ 'sidebar_first' ] : 'Page' ;
	$sidebar['sidebar_second'] 	   = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options[ 'sidebar_second' ] ) ) ? $TheChameleon_post_options[ 'sidebar_second' ] : 'Post' ;

	TheChameleon_display_template( array(

								 		array( 	'id'		=>'main',
												'tag'		=>'main',
		 				                   		'class'		=>'main temp-col-3-60x25x15',
				                	       	   	'parts'		=> array(
																			array(	'id'	=> 'main-content',
																					'tag'	=> 'section',
						              												'class'	=> 'main-content-page col-item col-1',	
						              												'part'	=> 'page'
																					),
										
																			array(	'id'	  => 'sidebar',
																					'tag'	  => 'aside',
																					'class'	  => 'sidebar-page col-item col-1',
																					'part' 	  => 'sidebar',	
																					'setting' => array( 'name'	=> $sidebar['sidebar_first'] 'Post', 'option'=>'sidebar_first'),
																					),
																											
																			array(	'id'	  => 'sidebar-two',
																					'tag'	  => 'aside',
																					'class'	  => 'sidebar sidebar-page col-item col-1',
																					'part'	  => 'sidebar',
																					'setting' => array('name'	=> $sidebar['sidebar_second'] , 'option'=>'sidebar_second'),
																					),

					 			 	                				),

					 		 		                	),

									)); ?>