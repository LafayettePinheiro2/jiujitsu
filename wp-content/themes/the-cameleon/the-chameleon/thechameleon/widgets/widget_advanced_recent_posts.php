<?php
/**
 * TheChameleon_Advanced_Recent_Posts
 *
 * @version 1.0.0
 */
class TheChameleon_Advanced_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_advanced_recent_posts', 'description' => __( "Your site's most recent Posts with advanced functions.", 'the_chameleon' ) );
		parent::__construct('TheChameleon_Advanced_Recent_Posts', __('Advanced Recent Posts', 'the_chameleon'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );		
	
		$title 				= apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'the_chameleon' ) : $instance['title'], $instance, $this->id_base);					
	
		$tag 				= isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
		$category 			= isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';

		$posts_per_page 	= isset ( $instance ['posts_per_page'] ) && is_numeric ( $instance ['posts_per_page'] ) ? esc_attr ( $instance ['posts_per_page'] ) : '4';
		$orderby 			= isset ( $instance ['orderby'] ) 	? $instance ['orderby'] : '';
		$order 				= isset ( $instance ['order'] ) 	? $instance ['order'] : '';

		$show_post_title 	= isset ( $instance ['show_post_title'] ) ? ( bool ) $instance ['show_post_title'] : false;
		$title_length 		= isset ( $instance ['title_length'] ) && is_numeric ( $instance ['title_length'] ) ? $instance ['title_length'] : '';

		$meta_pattern 		= isset ( $instance ['meta_pattern'] ) 	  ? esc_attr ( $instance ['meta_pattern'] ) : '';

		$show_post_media 	= isset ( $instance ['show_post_media'] ) ? ( bool ) $instance ['show_post_media'] : false;
		$width 				= isset ( $instance ['width'] ) && is_numeric ( $instance ['width'] ) ? $instance ['width'] : '60';
		$height 			= isset ( $instance ['height'] ) && is_numeric ( $instance ['height'] ) ? $instance ['height'] : '60';

		$show_post_excerpt 	= isset ( $instance ['show_post_excerpt'] ) ? ( bool ) $instance ['show_post_excerpt'] : false;
		$length 			= isset ( $instance ['length'] ) && is_numeric ( $instance ['length'] ) ? $instance ['length'] : '100';

		$template 			= isset ( $instance ['template'] ) ? $instance ['template'] : 'recent';
		
		echo $before_widget;
		
		if ( $title )
		
		echo $before_title . $title . $after_title; 

		   		query_posts( 
						array( 
							'tag_id'		 => ( $tag !='-1') ? $tag : NULL, 
							'cat'	 	 	 => ( $category !='-1') ? $category : NULL, 
							'posts_per_page' => $posts_per_page, 
							'orderby' 		 => $orderby, 
							'order'		 	 => $order, 
							'nopagging' 	 => true
						));
				?>
					<style type="text/css" media="screen">

						.post-widget img{ max-height:100%;};
						
					</style>
				<?php 
				$i=0; while ( have_posts() ) : the_post(); ?>

						<?php if( $template == 'recent' ) : ?>
							
							
								<article id="post-<?php the_ID(); ?>" <?php post_class(' co100 post-widget'); ?> itemscope itemtype="http://schema.org/Article" style="width:100% !important; padding:0px !important; margin:0px !important; margin-bottom:15px !important; border:0px solid red;">

									<?php	
									$format = get_post_format();
									if ( false === $format )
										$format = 'standard';
										global 	$data;	
										$data =array('title_tag'=>'h6');
											
										get_template_part( 'parts/loop/formats/post', $format ); 
									?>

								</article>
	
						<?php elseif ( $template == 'featured' ) : ?>
	
							<?php if ($i == 0 ) : ?>
		
									
										<article id="post-<?php the_ID(); ?>" <?php post_class(' co100 post-widget'); ?> itemscope itemtype="http://schema.org/Article" style="width:100% !important; padding:0px !important; margin:0px !important; margin-bottom:15px !important;  border:0px solid red;">

											<?php	
											$format = get_post_format();
											if ( false === $format )
												$format = 'standard';

													get_template_part( 'parts/loop/formats/post', $format ); 
											?>

										</article>

							<?php else: ?>
					
					
								
									<article id="post-<?php the_ID(); ?>" <?php post_class(' co100 post-widget'); ?> itemscope itemtype="http://schema.org/Article" style="width:100% !important; padding:0px !important; margin:0px !important; margin-bottom:15px !important;  border:0px solid red;">

										<header class="col100 post-title  post-title-widget">

											<h4 itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h4>

										</header>
									
									</article>
					
							
					
						  <?php endif; ?>
	
					<?php endif; ?>

				<?php $i++;	endwhile;
				wp_reset_query();
				wp_reset_postdata(); 

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		
		$instance 			= $new_instance;				
		$title 				= isset ( $instance ['title'] ) 	? esc_attr ( $instance ['title'] ) : '';
		
		$tag 				= isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
		$category 			= isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';
	
		$posts_per_page 	= isset ( $instance ['posts_per_page'] ) && is_numeric ( $instance ['posts_per_page'] ) ? esc_attr ( $instance ['posts_per_page'] ) : '4';
		$orderby 			= isset ( $instance ['orderby'] ) 	? $instance ['orderby'] : '';
		$order 				= isset ( $instance ['order'] ) 	? $instance ['order'] : '';
	
		$show_post_title 	= isset ( $instance ['show_post_title'] ) ? ( bool ) $instance ['show_post_title'] : false;
		$title_length 		= isset ( $instance ['title_length'] ) && is_numeric ( $instance ['title_length'] ) ? $instance ['title_length'] : '';

		$meta_pattern 		= isset ( $instance ['meta_pattern'] ) 	  ? esc_attr ( $instance ['meta_pattern'] ) : '';

		$show_post_media 	= isset ( $instance ['show_post_media'] ) ? ( bool ) $instance ['show_post_media'] : false;
		$width 				= isset ( $instance ['width'] ) && is_numeric ( $instance ['width'] ) ? $instance ['width'] : '60';
		$height 			= isset ( $instance ['height'] ) && is_numeric ( $instance ['height'] ) ? $instance ['height'] : '60';
	
		$show_post_excerpt 	= isset ( $instance ['show_post_excerpt'] ) ? ( bool ) $instance ['show_post_excerpt'] : false;
		$length 			= isset ( $instance ['length'] ) && is_numeric ( $instance ['length'] ) ? $instance ['length'] : '100';

		$template 			= isset ( $instance ['template'] ) ? $instance ['template'] : 'recent';
		
		return $instance;
	}
	
	function form( $instance ) { ?>

		<?php
		
		//Defaults
		$instance 			= wp_parse_args( (array) $instance, array( 'title' => '') );
		$title 				= esc_attr( $instance['title'] );			
		
		$tag 				= isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
		$category 			= isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';
	
		$posts_per_page 	= isset ( $instance ['posts_per_page'] ) && is_numeric ( $instance ['posts_per_page'] ) ? esc_attr ( $instance ['posts_per_page'] ) : '4';
		$orderby 			= isset ( $instance ['orderby'] ) 	? $instance ['orderby'] : '';
		$order 				= isset ( $instance ['order'] ) 	? $instance ['order'] : '';
	
		$show_post_title 	= isset ( $instance ['show_post_title'] ) ? ( bool ) $instance ['show_post_title'] : false;
		$title_length 		= isset ( $instance ['title_length'] ) && is_numeric ( $instance ['title_length'] ) ? $instance ['title_length'] : '';

		$meta_pattern 		= isset ( $instance ['meta_pattern'] ) 	  ? esc_attr ( $instance ['meta_pattern'] ) : '';

		$show_post_media 	= isset ( $instance ['show_post_media'] ) ? ( bool ) $instance ['show_post_media'] : false;
		$width 				= isset ( $instance ['width'] ) && is_numeric ( $instance ['width'] ) ? $instance ['width'] : '60';
		$height 			= isset ( $instance ['height'] ) && is_numeric ( $instance ['height'] ) ? $instance ['height'] : '60';
	
		$show_post_excerpt 	= isset ( $instance ['show_post_excerpt'] ) ? ( bool ) $instance ['show_post_excerpt'] : false;
		$length 			= isset ( $instance ['length'] ) && is_numeric ( $instance ['length'] ) ? $instance ['length'] : '100';

		$template 			= isset ( $instance ['template'] ) ? $instance ['template'] : 'recent';
		
		?>
				
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'the_chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('tag'); ?>"><?php _e('Tag:', 'the_chameleon'); ?></label>
			<?php $args = array(
					'show_option_all'    => '',
					'show_option_none'   => 'All',
					'orderby'            => 'ID', 
					'order'              => 'ASC',
					'show_count'         => 1,
					'hide_empty'         => 1, 
					'child_of'           => 0,
					'exclude'            => '',
					'echo'               => 1,
					'selected'           => $tag,
					'hierarchical'       => 0, 
					'name'               => $this->get_field_name('tag'),
					'id'                 => 'tag',
					'class'              => 'widefat',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'post_tag',
					'hide_if_empty'      => false,
				); ?>
				<?php wp_dropdown_categories( $args ); ?></p>

		<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:', 'the_chameleon'); ?></label>
			<?php $args = array(
					'show_option_all'    => '',
					'show_option_none'   => 'All',
					'orderby'            => 'ID', 
					'order'              => 'ASC',
					'show_count'         => 1,
					'hide_empty'         => 1, 
					'child_of'           => 0,
					'exclude'            => '',
					'echo'               => 1,
					'selected'           => $category ,
					'hierarchical'       => 1, 
					'name'               => $this->get_field_name('category'),
					'id'                 => 'category',
					'class'              => 'widefat',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'category',
					'hide_if_empty'      => false,
				); ?>
				<?php wp_dropdown_categories( $args ); ?></p>	
					
		<p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by:', 'the_chameleon'); ?></label>
		<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat">			
			<option value="date"   <?php echo 'date'   == $orderby ? 'selected="selected"' : '' ?>><?php _e('Date', 'the_chameleon'); ?></option>
			<option value="ID"     <?php echo 'ID'     == $orderby ? 'selected="selected"' : '' ?>><?php _e('ID', 'the_chameleon'); 	?></option>
			<option value="title"  <?php echo 'title'  == $orderby ? 'selected="selected"' : '' ?>><?php _e('Title','the_chameleon'); ?></option>
			<option value="author" <?php echo 'author' == $orderby ? 'selected="selected"' : '' ?>><?php _e('Author', 'the_chameleon'); ?></option>
			<option value="rand"   <?php echo 'rand'   == $orderby ? 'selected="selected"' : '' ?>><?php _e('Random', 'the_chameleon'); ?></option>
			<option value="comment_count" <?php echo 'comment_count' == $orderby ? 'selected="selected"' : '' ?>><?php _e('Comment count', 'the_chameleon'); ?></option>
		</select></p>

		<p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'the_chameleon'); ?></label>
		<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" class="widefat">
			<option value="DESC" <?php echo 'DESC' == $order ? 'selected="selected"' : '' ?>><?php _e('DESC', 'the_chameleon'); ?></option>
			<option value="ASC" <?php echo 'ASC' == $order ? 'selected="selected"' : '' ?>><?php _e('ASC', 'the_chameleon'); ?></option>
		</select></p>

		<p><label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Number of posts to show:', 'the_chameleon'); ?></label>
			<input id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" size="3" style="width:50px;" value="<?php echo $posts_per_page; ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('show_post_title'); ?>" name="<?php echo $this->get_field_name('show_post_title'); ?>" type="checkbox" <?php checked( $show_post_title ); ?> /> 
			<label for="<?php echo $this->get_field_id('show_post_title'); ?>"><?php _e('Show Post Title', 'the_chameleon'); ?></label>
			<br />
			<small><?php _e('Post title length (characters)', 'the_chameleon'); ?></small>
			<input id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" type="number" step="5" style="width:50px;"  value="<?php echo $title_length; ?>" /><br />	</p>
				
		<p><label for="<?php echo $this->get_field_id('meta_pattern'); ?>"><?php echo __( 'Meta Pattern:', 'the_chameleon' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('meta_pattern'); ?>" name="<?php echo $this->get_field_name('meta_pattern'); ?>" type="text" value="<?php echo $meta_pattern; ?>" /></p>


		<p><input id="<?php echo $this->get_field_id('show_post_media'); ?>" name="<?php echo $this->get_field_name('show_post_media'); ?>" type="checkbox" <?php checked( $show_post_media ); ?> /> 			
	 	   <label for="<?php echo $this->get_field_id('show_post_media'); ?>"><?php _e('Show Post Media', 'the_chameleon'); ?></label>
	 	   <br />
	 	   <small><?php _e('Media size (W-H):', 'the_chameleon'); ?></small>		
	 	   <input type="number" step="5" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>"  style="width:50px;" />px 
	 	   <input type="number" step="5" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" style="width:50px;" />px</p>

		<p><input id="<?php echo $this->get_field_id('show_post_excerpt'); ?>" name="<?php echo $this->get_field_name('show_post_excerpt'); ?>" type="checkbox" <?php checked( $show_post_excerpt ); ?> /> 			
		<label for="<?php echo $this->get_field_id('show_post_excerpt'); ?>"><?php _e('Show Post Excerpt', 'the_chameleon'); ?></label><br />
		<small><?php _e('Post excerpt length (characters)', 'the_chameleon'); ?></small>	
		<input id="<?php echo $this->get_field_id('length'); ?>" name="<?php echo $this->get_field_name('length'); ?>" type="number" step="5" value="<?php echo $length; ?>" style="width:50px;" /></p>	
				

		<p><label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:', 'the_chameleon'); ?></label>
		<select id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>" class="widefat">
			<option value="recent" <?php echo 'recent' == $template ? 'selected="selected"' : '' ?>><?php _e('Recent Posts', 'the_chameleon'); ?></option>
			<option value="featured" <?php echo 'featured' == $template ? 'selected="selected"' : '' ?>><?php _e('Featured 1 of 5', 'the_chameleon'); ?></option>	
		</select></p>	

<?php
	}

}


