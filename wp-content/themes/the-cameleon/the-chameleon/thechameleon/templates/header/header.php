<?php

	global $TheChameleon_options;
	global $TheChameleon_post_options;

	$clomuns['upper']  = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['upper_col'] )  ) ? $TheChameleon_options['upper_col'] : 'col-2';	
	$clomuns['header'] = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['header_col'] )  ) ? $TheChameleon_options['header_col'] : 'col-2-30x70';	
	$clomuns['top']    = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['top_col'] ) ) ? $TheChameleon_post_options['page_bulder']['top_col']  : ( ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['top_col'] )  ) ? $TheChameleon_options['top_col'] : 'col-2-70x30' );

	$wrap['upper'] 	= '';
	$wrap['header'] = '';
	$wrap['top'] 	= ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['top_wrap'] ) ) ? $TheChameleon_post_options['page_bulder']['top_wrap'] : 'normal';

	$sidebar['top'] = ( !empty( $TheChameleon_post_options ) and !empty( $TheChameleon_post_options['page_bulder']['top_sidebar'] )  ) ? $TheChameleon_post_options['page_bulder']['top_sidebar'] : 'Top';


	$upper = ( is_active_sidebar( "upper ") ) ? array(	
													'id'	=> 'upper',	
													'tag'	=> 'section',
													/*'wrap'*/
										  			'parts'	=> array( 
											        				array( 	
																		'id'	  => 'upper-content',
																		'tag'	  => 'section',
														        		'class'	  => esc_attr( $clomuns['upper'] ), 
														        		'part'	  => 'widgets',
														        		'setting' => array( 'sidebar' => 'Upper')	
											        			          ), 
																)
											 		 ) : NULL ;
									

	$top = ( is_active_sidebar( "$sidebar[top]" ) ) ? array(	
														'id'	=>'top',
														'tag'	=>'section',
										        		'wrap'	=> $wrap['top'],
														'class' => '',
										        		'parts'	=>array(
										        						array(	
																			'id'	  => 'top-content',
																			'tag'	  => 'section',
												        					'class'	  => esc_attr( $clomuns['top'] ),
												        					'part'	  => 'widgets',
												        					'setting' => array( 'sidebar' => $sidebar['top'] )	
												        					 ),
								 		        						),	 
										        			) : NULL ;
												

	//TYPE A
	$header['header'] = array(		
							//upper
							$upper, 
						
							//header
							array(	
								'id'	=> 'header',
								'tag'	=> 'header',
								/*	'wrap'*/
								'parts'	=> array(							
												array(
											        'id'	  => 'header-content',	
											        'tag'	  => 'section',	
											        'width'	  => '100',
											        'class'	  => esc_attr( $clomuns['header'] ),
											        'part'	  => 'widgets',
											        'setting' => array( 'sidebar' => 'Header')
											        ),
												),
							 	),
							
							//main menu
							array(	
								'id'	=>'menu-wrap',	
								'tag'   =>'section',
								/*	'wrap'*/
								'parts'	=>array(
											  array(	
												 'id'	   => 'menu',
										         'tag'	   => 'section',
										         'class'   => '',
										         'part'	   => 'menu',
										         'setting' => array('type' =>'horizontal', 'class' =>'primary-menu' )
										         ),
									 		 ), 
								  ),
							//top
							$top
       
						);


	//TYPE B	
	$header['header-b'] = array(
							//upper
							$upper, 
							
							//header
							array(	
								'id'	=>'header',
								'tag'	=>'header',
								/*	'wrap'*/
								'parts'	=> array(
												array(
													'id'	  => 'header-content',	
													'tag'	  => 'section',	
													'width'	  => '30',
													'class'	  => esc_attr( $clomuns['header'] ),
													'part'	  => 'widgets',
													'setting' => array('sidebar'=>'Header' )
													),			
												array( 	
													'id'	  => 'menu-wrap_b',
													'tag'	  => 'section',	
													'class'	  => '',	
													'part'	  => 'menu',
													'setting' => array( 'type' =>'horizontal', 'class' =>'primary-menu_b' )
													),
												),
						  		),
						   //top
						   $top
						);



	//TYPE C
	$header['header-c'] = array(
							//upper
							$upper, 
							
							//header
							array(	
								'id'	=> 'header',
								'tag'	=> 'header',
								/*'wrap'*/
								'parts' => array(   
												array(
										            'id'	  => 'header-content',
										            'tag'	  => 'section',		
										            'class'	  => esc_attr( $clomuns['header'] ),
										            'part'	  => 'widgets',
										            'setting' => array('sidebar'=>'Header' )
										            ),
												),
                   
							 	),
                         
							//main menu c
							array(	'id'	=> 'menu-press-wrap',
									'tag'   => 'section',					
									'parts' => array(
													array(	
														'id'	  => 'menu',
											            'tag'	  => 'section',
											            'class'	  => '',
											            'part'	  => 'menu',
											            'setting' => array('type'	=>'horizontal', 'class'	=> esc_attr( 'primary-menu_c' ) )
											            ),  
									 				), 
								),
                   			//top
							$top     
					  );
	
	
	
	$header['header-d'] = array(
		
							//upper
							$upper, 

							//header
							array(	
								'id'	=>'header',
								'tag'	=>'header',
								/*'wrap'	=>''*/
								'parts'	=> array(
												array(
													'id'	  => 'header-content',
													'tag'	  => 'section',		
													'class'	  => esc_attr( $clomuns['header'] ),
													'part'	  => 'widgets',
													'setting' => array('sidebar'=>'Header' )
													),
												),

						 	   ),

							//top 										
							$top

						);


$type =  ( !empty( $TheChameleon_options ) and  !empty( $TheChameleon_options['primary_menu_type'] ) ) ? $TheChameleon_options['primary_menu_type'] : 'header' ;
TheChameleon_display_template( $header[ $type ] ); ?>