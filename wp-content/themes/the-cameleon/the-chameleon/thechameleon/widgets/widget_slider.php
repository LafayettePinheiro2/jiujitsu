<?php
/**
 * TheChameleon_Slider_Widget
 *
 * @version 1.0.0
 */
class TheChameleon_Slider_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_slider', 'description' => __( "Display image slider from image post format.", 'the_chameleon' ) );
		parent::__construct('TheChameleon_Slider_Widget', __('Slider', 'the_chameleon'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );		
					
		$title 				= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Slider', 'chameleon-theme' ) : $instance['title'], $instance, $this->id_base);					
		$tag 			  = isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
		$category 		  = isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';			
		$orderby 		  = isset ( $instance['orderby'] ) 		? $instance['orderby'] : '';
		$order 			  = isset ( $instance['order'] ) 		? $instance['order'] : '';	
		$number_of_slides = isset ( $instance['number_of_slides'] ) && is_numeric ( $instance['number_of_slides'] ) ? esc_attr ( $instance ['number_of_slides'] ) : '5';	
		$effect			  = isset ( $instance['effect'] ) ? $instance ['effect'] : 'scrollHorz';		
		$easing			  = isset ( $instance['easing'] ) 		 ? $instance ['easing'] : 'easeInQuad';					
		$timeout 		  = isset ( $instance['timeout'] ) && is_numeric ( $instance['timeout'] ) ? esc_attr ( $instance['timeout'] ) : '5000';
		$speed 			  = isset ( $instance['speed'] ) && is_numeric ( $instance['speed'] ) ? esc_attr ( $instance['speed'] ) : '800';			
		$caption 		  = isset ( $instance['caption'] ) 		 ? ( bool ) $instance['caption'] : '0';
		$pager 		  	  = isset ( $instance['pager'] ) 		 ? ( bool ) $instance['pager'] : '0';
	
		//style
		wp_enqueue_style(  'TheChameleon-cycle2' );
			
		echo $before_widget;
		
			if ( $title )
		
		echo $before_title . $title . $after_title;  ?>
			
			<figure id="<?php echo $this->id ?>-cycle" class="cycle-slideshow"	
				data-cycle-fx="<?php echo $effect  ?>"
			    data-cycle-speed="<?php echo $speed  ?>"
				data-cycle-timeout="<?php echo $timeout  ?>"
				data-cycle-easing="<?php echo $easing  ?>"		
				data-cycle-tile-vertical=false
				data-cycle-loader="true"
			 	data-cycle-prev="#cycle-prev-<?php echo $this->id ?>"
			    data-cycle-next="#cycle-next-<?php echo $this->id ?>"
				data-cycle-caption-plugin="caption2"
				data-cycle-pager="#cycle-pager-<?php echo $this->id ?>"
				>
				
				<?php if ( $caption == true )  : //if have caption ?>
					<div class="cycle-caption"></div>
			    	<div class="cycle-overlay"></div>
				<?php endif;?>
				
			 		<!-- prev/next links -->	
				   	<div id="cycle-prev-<?php echo $this->id ?>" class="cycle-prev"></div>
				   	<div id="cycle-next-<?php echo $this->id ?>" class="cycle-next"></div>

					<?php query_posts( array(
										'post_status' 	 => array('publish', 'draft') ,	
										'tag_id'		 => ( $tag !='-1') ? $tag : NULL, 
										'cat'	 	 	 => ( $category !='-1') ? $category : NULL, 																														
										'orderby' 		 => $orderby, 
										'order' 		 => $order,						
										'paged' 		 => 0, 
										'posts_per_page' => $number_of_slides,
										'nopagging' 	 => true
										));

					  if ( have_posts() ) : 
						 while ( have_posts() ) : the_post(); 	
								if ( has_post_thumbnail() ) :
									
									$imagedata 	= simplexml_load_string( get_the_post_thumbnail() ); ?>
									<img src="<?php echo $imagedata->attributes()->src ?>" alt="-"  <?php if( $caption ==true )  : ?> data-cycle-title="<?php echo get_the_title() ?>" data-cycle-desc="<?php echo get_the_content() ?>" <?php endif; ?> />

							<?php endif;
						endwhile; 
					endif;			
					wp_reset_query(); ?>
					
				<?php if ( $pager == true )  :  ?>	
			   		<!-- empty element for pager links -->
			    	<div id="cycle-pager-<?php echo $this->id ?>" class="cycle-pager"></div>
				<?php endif; ?>
			</figure>
			
			
		<?php
			
			
		echo $after_widget;
		
		//scripts
		wp_enqueue_script( 'TheChameleon-cycle2'); 	
		wp_enqueue_script( 'TheChameleon-cycle-flip');			
		wp_enqueue_script( 'TheChameleon-cycle-tile');
		wp_enqueue_script( 'TheChameleon-cycle-scrollVert');	
		wp_enqueue_script( 'TheChameleon-cycle-ie-fade');				
		wp_enqueue_script( 'TheChameleon-cycle-shuffle');
		wp_enqueue_script( 'TheChameleon-cycle-carousel');
		wp_enqueue_script( 'TheChameleon-cycle-caption2');
	}

	function update( $new_instance, $old_instance ) {
		
		$instance 		  = $new_instance;			
		$title 			  = isset ( $instance['title'] ) ? esc_attr ( $instance['title'] ) : '';
		$tag 			  = isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
		$category 		  = isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';			
		$orderby 		  = isset ( $instance['orderby'] ) 		? $instance['orderby'] : '';
		$order 			  = isset ( $instance['order'] ) 		? $instance['order'] : '';	
		$number_of_slides = isset ( $instance['number_of_slides'] ) && is_numeric ( $instance['number_of_slides'] ) ? esc_attr ( $instance ['number_of_slides'] ) : '5';	
		$effect			  = isset ( $instance['effect'] ) ? $instance ['effect'] : 'scrollHorz';	
		$tile_vertical    = isset ( $instance['tile_vertical'] ) ? ( bool ) $instance['tile_vertical'] : '0';	
		$easing			  = isset ( $instance['easing'] ) 		 ? $instance ['easing'] : 'easeInQuad';					
		$timeout 		  = isset ( $instance['timeout'] ) && is_numeric ( $instance['timeout'] ) ? esc_attr ( $instance['timeout'] ) : '5000';
		$speed 			  = isset ( $instance['speed'] ) && is_numeric ( $instance['speed'] ) ? esc_attr ( $instance['speed'] ) : '800';			
		$caption 		  = isset ( $instance['caption'] ) 		 ? ( bool ) $instance['caption'] : '0';
		$pager 		  	  = isset ( $instance['pager'] ) 		 ? ( bool ) $instance['pager'] : '0';
	
		return $instance;
	}
		
	function form( $instance ) { 

		$instance 		  = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title 			  = esc_attr( $instance['title'] );		
		$tag 			  = isset ( $instance ['tag'] ) 		? esc_attr ( $instance ['tag'] ) : '';
		$category 		  = isset ( $instance ['category'] ) 	? esc_attr ( $instance ['category'] ) : '';			
		$orderby 		  = isset ( $instance['orderby'] ) 		? $instance['orderby'] : '';
		$order 			  = isset ( $instance['order'] ) 		? $instance['order'] : '';	
		$number_of_slides = isset ( $instance['number_of_slides'] ) && is_numeric ( $instance['number_of_slides'] ) ? esc_attr ( $instance ['number_of_slides'] ) : '5';	
		$effect			  = isset ( $instance['effect'] ) ? $instance ['effect'] : 'scrollHorz';	
		$tile_vertical    = isset ( $instance['tile_vertical'] ) ? ( bool ) $instance['tile_vertical'] : '0';	
		$easing			  = isset ( $instance['easing'] ) 		 ? $instance ['easing'] : 'easeInQuad';					
		$timeout 		  = isset ( $instance['timeout'] ) && is_numeric ( $instance['timeout'] ) ? esc_attr ( $instance['timeout'] ) : '5000';
		$speed 			  = isset ( $instance['speed'] ) && is_numeric ( $instance['speed'] ) ? esc_attr ( $instance['speed'] ) : '800';			
		$caption 		  = isset ( $instance['caption'] ) 		 ? ( bool ) $instance['caption'] : '0';
		$pager 		  	  = isset ( $instance['pager'] ) 		 ? ( bool ) $instance['pager'] : '0';
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
				<option value="date"  <?php echo 'date'  == $orderby ? 'selected="selected"' : '' ?>><?php _e('Date', 'the_chameleon'); ?></option>
				<option value="ID"    <?php echo 'ID'    == $orderby ? 'selected="selected"' : '' ?>><?php _e('ID', 'the_chameleon'); ?></option>
				<option value="title" <?php echo 'title' == $orderby ? 'selected="selected"' : '' ?>><?php _e('Title','the_chameleon'); ?></option>	
				<option value="rand"  <?php echo 'rand'  == $orderby ? 'selected="selected"' : '' ?>><?php _e('Random', 'the_chameleon'); ?></option>
			</select></p>

		<p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'the_chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" class="widefat">
				<option value="DESC" <?php echo 'DESC' == $order ? 'selected="selected"' : '' ?>><?php _e('DESC', 'the_chameleon'); ?></option>
				<option value="ASC"  <?php echo 'ASC'  == $order ? 'selected="selected"' : '' ?>><?php _e('ASC', 'the_chameleon'); ?></option>
			</select></p>

		<p><label for="<?php echo $this->get_field_id('number_of_slides'); ?>"><?php _e('Number of slides to show:', 'the_chameleon'); ?> 
			<input id="<?php echo $this->get_field_id('number_of_slides'); ?>" name="<?php echo $this->get_field_name('number_of_slides'); ?>" type="number" max="20" value="<?php echo $number_of_slides; ?>" style="width:50px;"/></label></p>
			
						
		<p><label for="<?php echo $this->get_field_id('effect'); ?>"><?php _e('Effect:', 'the_chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('effect'); ?>" name="<?php echo $this->get_field_name('effect'); ?>" class="widefat">						
			<?php $effects = array( 
								'fade', 
								'fadeout', 
								'none', 
								'scrollHorz', 
								'scrollVert', 
								'tileBlind', 
								'tileSlide'
							);
			?>		
			<?php foreach ( $effects as $value ) : ?>			
				<option value="<?php echo $value ?>" <?php echo $value == $effect ? 'selected="selected"' : '' ?>><?php echo $value ?></option>			
			<?php endforeach; ?>				
		</select></p>
				
		<p><label for="<?php echo $this->get_field_id('easing'); ?>"><?php _e('Easing:', 'the_chameleon'); ?></label>
			<select id="<?php echo $this->get_field_id('easing'); ?>" 	name="<?php echo $this->get_field_name('easing'); ?>" class="widefat">
			<?php 	$easings = 	array( 'linear' ,'swing' ,'easeInQuad' , 'easeOutQuad' , 'easeInOutQuad' , 'easeInCubic' , 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart', 'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack' , 'easeInBounce' , 'easeOutBounce' , 'easeInOutBounce' );			
			 foreach ( $easings as $value ) : ?>
				<option value="<?php echo $value ?>" <?php echo $value == $easing ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
			<?php endforeach; ?>
		</select></p>

		<p><label for="<?php echo $this->get_field_id('timeout'); ?>"><?php _e('Timeout:', 'the_chameleon'); ?> 
			<input id="<?php echo $this->get_field_id('timeout'); ?>" name="<?php echo $this->get_field_name('timeout'); ?>" type="number" step="100" value="<?php echo $timeout; ?>" style="width:60px;" /></label></p>	
			
		<p><label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Speed:', 'the_chameleon'); ?> 
			<input id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="number" step="100" value="<?php echo $speed; ?>" style="width:60px;" /></label></p>
	
		<p><input id="<?php echo $this->get_field_id('caption'); ?>" name="<?php echo $this->get_field_name('caption'); ?>" type="checkbox" <?php checked($caption); ?>  class="checkbox" /> 
			<label for="<?php echo $this->get_field_id('caption'); ?>"><?php _e('Show caption', 'the_chameleon'); ?></label></p>
			
		<p><input id="<?php echo $this->get_field_id('pager'); ?>" name="<?php echo $this->get_field_name('pager'); ?>" type="checkbox" <?php checked($pager); ?>  class="checkbox" /> 
			<label for="<?php echo $this->get_field_id('pager'); ?>"><?php _e('Show pager', 'the_chameleon'); ?></label></p>

<?php
	}

}


