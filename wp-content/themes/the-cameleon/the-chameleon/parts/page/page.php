<!-- PAGE -->		
	<?php 
	global $data; 
	global $TheChameleon_post_options;	  

	$sidebar['block_a'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_a_sidebar'] ) ) ? $TheChameleon_post_options['page_builder']['block_a_sidebar'] : NULL;
	$sidebar['block_b'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_b_sidebar'] ) ) ? $TheChameleon_post_options['page_builder']['block_b_sidebar'] : NULL;
	$sidebar['block_c'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_c_sidebar'] ) ) ? $TheChameleon_post_options['page_builder']['block_c_sidebar'] : NULL;
	$sidebar['block_d'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_d_sidebar'] ) ) ? $TheChameleon_post_options['page_builder']['block_d_sidebar'] : NULL;		
	$sidebar['block_e'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_e_sidebar'] ) ) ? $TheChameleon_post_options['page_builder']['block_e_sidebar'] : NULL;
	
	$columns['block_a'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_a_col'] ) ) ? $TheChameleon_post_options['page_builder']['block_a_col'] : NULL;
	$columns['block_b'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_b_col'] ) ) ? $TheChameleon_post_options['page_builder']['block_b_col'] : NULL;
	$columns['block_c'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_c_col'] ) ) ? $TheChameleon_post_options['page_builder']['block_c_col'] : NULL;
	$columns['block_d'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_d_col'] ) ) ? $TheChameleon_post_options['page_builder']['block_d_col'] : NULL;		
	$columns['block_e'] = ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_e_col'] ) ) ? $TheChameleon_post_options['page_builder']['block_e_col'] : NULL;
	
	$wrap['block_a'] 	= ( ( !empty( $TheChameleon_post_options ) ) and !empty( $TheChameleon_post_options['page_builder']['block_a_wrap'] ) ) ? $TheChameleon_post_options['page_builder']['block_a_wrap'] : NULL;
	
	
	if ( $wrap['block_a'] == 'fullwidth' ) : ?>
		
		<section id="page-<?php the_ID(); ?>" <?php post_class( 'col100' ); ?> >
			<div id="page-<?php the_ID(); ?>-container" class="container page-container page-container-<?php the_ID(); ?>">
					
	<?php else: ?>
	
		<section id="page-<?php the_ID(); ?>" <?php post_class( 'col100' ); ?> >

	<?php endif; ?>	
	
			<section id="page-content-<?php the_ID();?>" class="col100 <?php echo !empty( $sidebar['block_a'] ) ?  'page-content-widgets' : 'page-content' ; ?> page-content-<?php the_ID();?>">

				<?php if ( !empty( $sidebar['block_a'] ) ) : //if is active page builder ?>
					                                         
							<?php if ( !empty( $sidebar['block_a'] ) ) : ?>
		                                                     
								<section class="col100 page-widgets page-widgets-block-a <?php echo $columns['block_a'] ?>">
					                                         
										<?php $data = array( 'sidebar' => $sidebar['block_a'] );
							                                 
											  get_template_part( 'parts/widgets/widgets' ) ; 
										?>	                     
	                                                         
								</section>                       
		                                                     
							<?php 	endif;  ?>	                 
					                                         
							<?php if ( !empty( $sidebar['block_b'] ) ) : ?>
                                                             
								<section class="col100 page-widgets page-widgets-block-b <?php echo $columns['block_b'] ?>">
                                                             
										<?php $data = array( 'sidebar' => $sidebar['block_b'] );
                                                             
											  get_template_part( 'parts/widgets/widgets' ) ; 
										?>	                     
                                                             
								</section>                       
                                                             
							<?php 	endif;  ?>                   
				                                             
							<?php if ( !empty( $sidebar['block_c'] ) ) : ?>
                                                             
								<section class="col100 page-widgets page-widgets-block-c <?php echo $columns['block_c'] ?>">
                                                             
										<?php $data = array( 'sidebar' => $sidebar['block_c'] );
                                                             
											  get_template_part( 'parts/widgets/widgets' ) ; 
										?>	                     
                                                             
								</section>                       
                                                             
							<?php 	endif;  ?>                   
				                                             
							<?php if ( !empty( $sidebar['block_d'] ) ) : ?>
                                                             
								<section class="col100 page-widgets page-widgets-block-d <?php echo $columns['block_d'] ?>">
                                                             
										<?php $data = array( 'sidebar' => $sidebar['block_d'] );
                                                             
											  get_template_part( 'parts/widgets/widgets' ) ; 
										?>	                     
                                                             
								</section>                       
                                                             
							<?php 	endif;  ?>                   
				                                             
							<?php if ( !empty( $sidebar['block_e'] ) ) : ?>
                                                             
								<section class="col100 page-widgets page-widgets-block-d <?php echo $columns['block_e'] ?>">
                                                             
										<?php $data = array( 'sidebar' => $sidebar['block_e'] );
                                                             
											  get_template_part( 'parts/widgets/widgets' ) ; 
										?>	                     
                                                             
								</section>                       
                                                             
							<?php 	endif;  ?>                   
		  
                                                             
				<?php elseif ( is_home() ) :                     
                                                             
						global $wp_query;                        
                                                             
						query_posts ( array( 'pagename' => 'home', 'posts_per_page' => -1, 'post_type'=>'page' ) );
                                                             
                                                             
					elseif ( is_404() ) :                    
                                                             
							$page = get_page_by_path( 'page-404' );	
                                                             
							 if ( !empty( $page ) ) :           
                               
								echo  do_shortcode( $page->post_content ); 
                                  
							 else: ?>	                         

								<h1><?php _e('Error 404 - Page not found!', 'the_chameleon'); ?></h1>
                                          
							<?php endif; ?>                          
   
                                            
				<?php elseif ( is_archive() ) :                  
                                                             
						$post_type = get_post_type();            
                                                             
						if ( $post_type ) {                      
						    $post_type_data = get_post_type_object( $post_type );
						    $post_type_slug = $post_type_data->rewrite['slug'];		  
						}                                        
                                                             
						$page = get_page_by_path( $post_type_slug ); 
                                   
						echo do_shortcode( $page->post_content ); 
					     
                                                             
				 	else: ?>                                   
                                                             
						<?php if ( have_posts() ) : ?>			    
							<?php while ( have_posts()) : the_post(); ?>
                      
									<?php the_content(); ?>
                                                             
							<?php endwhile; ?>                   
						<?php endif; ?>                          
						<?php wp_reset_query(); ?>	             
			                                                 
				<?php endif; ?>                                  
		
			</section><!--#page-content-->
	
		<?php echo ( $wrap['block_a'] == 'fullwidth' ) ? '</div>' : NULL; ?>
	
</section><!-- #page -->