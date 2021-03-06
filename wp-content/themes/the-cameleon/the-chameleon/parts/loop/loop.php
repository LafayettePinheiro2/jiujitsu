<?php 	
	global $data;
	global $i;	
	global $TheChameleon_options;
	global $TheChameleon_term_options;
	global $posts_per_page;

	$tax 	  = "cat";
	$term_id  = array();
	$pagename = "";
	$view  	  = 'post';
	
	$posts_per_page = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['posts_per_page'] ) ) ? $TheChameleon_term_options['posts_per_page']  : $posts_per_page ; 
	
	if ( is_category() ) :	 //CATEGORY	VARS

		$tax	 	= "cat";
		$category 	= get_category_by_slug( get_query_var('category_name' ) ); 	
		$term_id 	= $category->term_id; 


	elseif ( is_tax() ) :	//TAXONOMY VARS

		$tax 	 		= $wp_query->query_vars['taxonomy'];
		$term_id 		= $wp_query->query_vars['term'];		
		$tax_post_type 	= $wp_query->posts[0]->post_type;

	elseif ( is_search() ) :  	//SEARCH VARS

		 if ( have_posts() ) : ?>
				
					<header class="col100 post-title  post-title-loop">

						<h2 itemprop="name"><?php echo __( 'Search results for', 'the_chameleon' ) .': "'. get_search_query(); ?>"</h2>

					</header>


					<section class="col100 post-content post-content-loop">

							<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					   			<input type="text" class="search-page" style="width:100%;" placeholder="Search..." value="<?php the_search_query(); ?>" name="s" id="s" />		  
							</form>
							
					</section>
		
					
		<?php	global $wp_query;
			
				query_posts(
					array_merge(
						array( 'post_status' => 'publish' ), //exclude category "hats"
						$wp_query->query
					)
				);
		
				//The Query
				if ( have_posts() ) :  
					while ( have_posts() ) : the_post();
		
						get_template_part( 'parts/loop/view/post', $view ); 		
		
					 endwhile;
				 endif;
				wp_reset_query(); ?>
					
		<!-- Nothing Found -->
		<?php else : ?>	
								
			<header class="col100 post-title  post-title-loop">

				<h2 itemprop="name"><?php _e( 'Nothing Found', 'the_chameleon' ); ?></h2>

			</header>


			<section class="col100 post-content post-content-loop">
	
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.',  'the_chameleon' ); ?></p>
								
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
			   			<input type="text" class="search-page" style="width:100%;" placeholder="Search..." value="<?php the_search_query(); ?>" name="s" id="s" />		  
					</form>
			</section>
	
		<?php endif;

	//OTHER
	endif; 
		
			
	if ( is_author() ) :	 //Author	
		
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			query_posts(
				array_merge(
					array( 'post_type' =>array_merge( get_post_types( $args, 'names' ), array( 'post' ) ),), //exclude category "hats"
					$wp_query->query
				)
			);

		 if ( have_posts() ) :  	$i=0; 					
			 while ( have_posts() ) : the_post();  $i++; 
					get_template_part( 'parts/loop/view/post', $view ); 
	 		endwhile; 
   		endif; 
		wp_reset_query();
		
 
	elseif ( is_date() ) : 	 //Date	
		
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			query_posts(
				array_merge(
					array('post_type' =>array_merge( get_post_types( $args, 'names' ), array( 'post' ) ),), //exclude category "hats"
					$wp_query->query
				)
			);

		 if ( have_posts() ) :  	$i=0; 					
			 while ( have_posts() ) : the_post();  $i++; 
					get_template_part( 'parts/loop/view/post', $view ); 
	 		endwhile; 
   		endif; 
		wp_reset_query();
		
	elseif ( is_archive() ) : 	 //Archive	

			query_posts(
				array_merge(
					array( 'posts_per_page' => $posts_per_page ), //exclude category "hats"
					$wp_query->query
				)
			);

		 if ( have_posts() ) :  	$i=0; 					
			 while ( have_posts() ) : the_post();  $i++; 
					get_template_part( 'parts/loop/view/post', $view ); 
	 		endwhile; 
   		endif; 
		wp_reset_query();
	
	elseif ( is_main_query() and !is_search() ) :  //Main query	
					
			$args = array(
						'post_status' 	 => 'publish',
					    'post_type'	  	 => ( ! empty( $tax_post_type ) ) ? $tax_post_type : 'post', 
						'paged' 	  	 => $paged, 
						"$tax"		  	 => $term_id ,
						'posts_per_page' => $posts_per_page,
					);


			//The Query
			$query = new WP_Query($args);

			if ( have_posts() ) :  
				while ( have_posts() ) : the_post(); 

						get_template_part( 'parts/loop/view/post', $view ); 

		 		endwhile; 
	   		endif; 
			wp_reset_query();

	
	else:	//Other	
		
		if ( is_front_page() ) : 
		
			$paged = $wp_query->query_vars['page'];
			
		else:
			
			$paged = (get_query_var('paged' ) ) ? get_query_var('paged' ) : 0;	
			
		endif;
		


		$args = array(
					'post_status' 	 => 'publish',
				    'post_type'	  	 => ( ! empty( $tax_post_type ) ) ? $tax_post_type : 'post', 
					'paged' 	  	 => $paged, 
					"$tax"		  	 => $term_id ,
					'posts_per_page' => $posts_per_page,
				);
					

		//The Query
		$query = new WP_Query($args);
	
		if ( ! is_search() ) : 
		
			if ( $query->have_posts() ) :  
				while ( $query->have_posts() ) : $query->the_post(); 

						get_template_part( 'parts/loop/view/post', $view ); 

		 		endwhile; 
	   		endif; 
			wp_reset_query();
			
		 endif; 
		
	endif; ?>
	
		<!-- PAGINATION -->	
		<section id="pagination" class="pagination col100">
				
		  		<?php // count posts for pagination
				if ( is_category() ) :	
									
					$max_num_pages = ceil( $category->count / $posts_per_page );	
					
				elseif ( is_search()  or is_archive() ):	
						
					$max_num_pages  = $wp_query->max_num_pages;	
										
				elseif ( is_main_query() ):							
		
					 $max_num_pages = $query->max_num_pages;
									
				else:	
					$max_num_pages = ceil( wp_count_posts( $post_type, $args )->publish / $posts_per_page );					
				endif; ?>
				
				<!-- PAGINATION SETTING	-->
				<?php echo paginate_links( array(
							'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
							'format' 		=> '?paged=%#%',
							'current'		=> $paged,
						 	'prev_text'		=> __('&laquo; Previous', 'chameleon-theme'),
							'next_text'		=> __('Next &raquo;', 'chameleon-theme'),
							'end_size'		=> 3,
							'mid_size'		=> 2,
							'total' 		=> $max_num_pages ,
							) ); ?>
							
							
		</section><!--pagination-->