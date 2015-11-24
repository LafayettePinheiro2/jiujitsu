<?php

	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$wrap = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['block_a_wrap'] ) ) ? $TheChameleon_post_options['page_bulder']['block_a_wrap'] : 'normal';

	TheChameleon_display_template( array(
		
		 					array(  'id'	 => 'main',
									'tag'	 => 'main',
									'class'	 => 'main temp-col-1',
 				            		'wrap'	 =>  $wrap,
	 				               	'parts'	 =>  array( 	
														array(	'id'	 => 'main-content',
                												'tag'	 => 'section',
                												'class'	 => 'main-content-page col-item col-1',						
																'part'	 => 'page',
                										 ),

	 			 	                			 ),

	 		 		         ),

			 				
			 				

				 ) ); ?>