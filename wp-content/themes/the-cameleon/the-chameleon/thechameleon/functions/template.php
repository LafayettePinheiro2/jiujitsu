<?php
	
if ( ! function_exists( 'TheChameleon_display_template' ) ) :
	/**
	* HTML5 template Generator
	*
	* Use this funtion to generate html5 elements (from arrays from framework/templates dir) with id and classes 
	* and call in to them parts from part directory
	*
	* @var $template array()
	* @return html	
	**/
	function TheChameleon_display_template($template) { 

		//VREDNOSTI ZA WRAP-ove
		$wraps 	  		  = array();
		$key 			  = NULL;	
		$element['class'] = NULL;

		if ( !empty( $template ) ) :

			
			foreach ( $template as $element ) : 

				if ( !empty( $element['id'] ) ) :

					$key  			= ( !empty( $element['id'] ) ) ? $element['id'] : '0';
					$custom_class 	= ( !empty( $element['class'] ) ) ? $element['class'] : 'no-class';

					$wrap[ $key ] 	= !empty( $element['wrap'] ) ? $element['wrap'] : ( ( !empty( $wraps ) and !empty( $wraps[ $key ]['wrap'] ) ) ? $wraps[ $key ]['wrap'] : 'normal' ) ;
					
					//html tag
					global $is_IE;
				    if ( $is_IE ): 				
						$tag[ $key ] = ( $element[ 'tag' ] == 'main' ) ? 'div' : $element[ 'tag' ];			
					else:						
						$tag[ $key ] = ( !empty( $element['tag'] ) ) ? $element['tag'] : 'div'; 					
					endif; 	

					//ID
					$id[ $key ] 			= $key;		
					$id_container[ $key ] 	= $key.'-container';

					//custom class			
					$my_class_container[ $key ] = $custom_class .'-container';

					//class	
					$class[ $key ] 			= $key .' col100 '. TheChameleon_get_body_class( $key ).' '.$custom_class;			
					$class_container[$key] 	= 'container '. $key .'-container'.' '.$my_class_container[$key];

					echo strtoupper("<!-- START $key -->"); 

			 		//normal container 
					if ( $wrap[ $key ] == 'normal' and $wrap[ $key ] != 'fullwidth' ) echo '<div id="'. esc_attr( $id_container[ $key ] ) .'" class="'. esc_attr( $class_container[ $key ] ) .'">'; 

				   		//element wrap
				    	echo ' <'.$tag[ $key ].' id="'. esc_attr( $id[ $key ] ) .'" class="'. esc_attr( $class[$key] ) .'"> '; 

				      	   //stretch container 
							if ( $wrap[ $key ] == 'stretch' and $wrap[ $key ] != 'fullwidth' ) echo '<div id="'. esc_attr( $id_container[ $key ] ) .'" class="'. esc_attr( $class_container[ $key ]) .'">';

								//PARTS
								if ( ($element['parts'] ) ):
						
										foreach ( $element['parts'] as $part_key => $value ): 

											$tag[ $part_key ] 	= ( $value['tag'] ) ? $value['tag']  : 'div';
											$id[ $part_key ] 	= $value['id']; 
											$my_class 			= ( ($value['class'] ) ) ? $value['class']: '';			
											$class[ $part_key ] = 'col100 '.$id[ $part_key ] .' '. $my_class;			

												//html tag
												echo ' <' . $tag[ $part_key ] .' id="' . esc_attr( $id[ $part_key ] ) . '" class="' . esc_attr( $class[ $part_key ] ) . '"> ';
					
														global $data; //get part setting	
														$data = !empty( $value['setting'] ) ? $value['setting'] : NULL;

														if ( is_dir( get_template_directory().'/parts/'.$value['part'] ) ):
															
															//define part view
															$view = !empty( $data['view'] )  ? $data['view'] : $value['part'];

															if ( file_exists( get_template_directory().'/parts/'.$value['part'].'/'.$view.'.php' ) ) :
															
																//call part
																get_template_part( 'parts/'. $value['part'] .'/'.$view, $view ); 
																 
															else:	
																echo "View does not exists in $value[part] part";
															endif;	

														else:	

															echo "Part $value[part] does not exists";

														endif; 
								
												//end html tag		
												echo ' </' . $tag[ $part_key ] . '> ';		
		

								 	 endforeach;
							 
								endif;	

				       		 //stretch container 
							 echo ( $wrap[ $key ] == 'stretch' and $wrap[ $key ] != 'fullwidth' ) ? ' </div> ' : ''; 
					
			   			//element wrap
			    		echo ' </'.$tag[ $key ].'> '; 

					 //normal container 
					echo ( $wrap[ $key ] == 'normal' and $wrap[ $key ] != 'fullwidth' ) ? ' </div> ' : '' ; 

					echo strtoupper("<!-- END $key -->"); 
			
			 		unset( $data );
					unset( $element );
				 	unset( $wrap );
							
				endif;

			endforeach; 

		endif;

	}
	
endif ;?>