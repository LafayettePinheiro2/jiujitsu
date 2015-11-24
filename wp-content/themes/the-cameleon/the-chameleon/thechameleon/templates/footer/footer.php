<?php

	global $TheChameleon_options;
	global $TheChameleon_post_options;
	
	
	$clomuns['bottom'] 	  = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['bottom_col'] ) ) ? $TheChameleon_post_options['page_bulder']['bottom_col']  : ( ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['bottom_col'] )  ) ? $TheChameleon_options['bottom_col'] : 'col-2' );
	$clomuns['footer'] 	  = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['footer_col'] )  ) ? $TheChameleon_options['footer_col'] : 'col-3';	
	$clomuns['copyright'] = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['copyright_col'] )  ) ? $TheChameleon_options['copyright_col'] : 'col-1';	

	$wrap['bottom'] 	= ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['bottom_wrap'] ) ) ? $TheChameleon_post_options['page_bulder']['bottom_wrap'] : 'normal';
	$wrap['footer'] 	= 'normal';
	$wrap['copyright'] 	= 'normal';

	$sidebar['bottom']  = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['bottom_sidebar'] )  ) ? $TheChameleon_post_options['page_bulder']['bottom_sidebar'] : 'Bottom';


	

	//is actove bottom widgets
	if( is_active_sidebar( "$sidebar[bottom]" ) ) :


			TheChameleon_display_template( array(

												array(	
													'id'	 => 'bottom',
													'tag'	 => 'section',
													'wrap'	 =>  $wrap['bottom'],	
													'parts'  =>  array(
																     array(
															        	'id'	  => 'bottom-content',
															        	'tag'	  => 'section', //in % 
															        	'class'	  => esc_attr( $clomuns['bottom'] ),	
															        	'part'	  => 'widgets', 
															        	'setting' => array( 'sidebar' =>$sidebar['bottom'] )
															              ),
																       ),	
                                       
												),
												//FOOTER
												array(	
													'id'	 => 'footer',
													'tag'	 => 'footer',
													/*	'wrap'	 => '',*/	
													'parts'	 => array(                                      
																	array(	
																		'id'	  => 'footer-content',				
																        'tag'	  => 'section',
																        'class'	  => esc_attr( $clomuns['footer'] ),	
																        'part'	  => 'widgets',
																        'setting' => array( 'sidebar' => 'Footer' )																										
																        ),
																	),
                                        
											  	),
											
												//copyright
												array(	
													'id'	 => 'copyright',
													'tag'	 => 'section',
												/*	'wrap'	 => '',*/
													'parts'	 => array(
																	array(	
																		'id'	  => 'copyright-content',
															            'tag'	  => 'section',
															            'class'	  => esc_attr( $clomuns['copyright'] ),
															            'part'	  => 'widgets', 
															            'setting' => array( 'sidebar' => 'Copyright' ) 
																		),
																	),	

												 ) 
      
								));     
                                        
   else:

		TheChameleon_display_template( array(
											//footer                   
											array(	
												'id'	 => 'footer',
												'tag'	 => 'footer',	
												'class'	 => '',    
												'parts'	 => array( 
											                   	array(	
																	'id'	  => 'footer-content',				
															       	'tag'	  => 'section',
															        'class'	  => esc_attr( $clomuns['footer'] ),	
															        'part'	  => 'widgets',
															        'setting' => array( 'sidebar' => 'Footer')																									
															        ),
															),                      
										 	),                            
										   //copyright                    
											array(	
												'id'	 => 'copyright',
												'tag'	 => 'section', 
												'class'	 => '',        
												'parts'	 => array(     
																array(	
																	'id'	  => 'copyright-content',
															        'tag'	  => 'section',
															        'class'	  => esc_attr( $clomuns['copyright'] ),	
															       	'part'	  => 'widgets', 
															       	'setting' => array( 'sidebar' => 'Copyright')
																	), 
																),	                           
												)                              
                                                               

									));

endif; ?>