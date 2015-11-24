<?php
/**
 * TheChameleon_Widget_Media
 *
 * @version 1.0.0
 */
class TheChameleon_Widget_Media extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_media', 'description' => __( "Use this widget to add media.", 'the_chameleon' ) );
		parent::__construct('TheChameleon_Widget_Media', __('Media', 'the_chameleon'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );		
			
		$title 			= apply_filters('widget_title', empty( $instance['title'] ) ? ' ' : $instance['title'], $instance, $this->id_base);					
		$media_url 		= isset ( $instance ['media_url'] ) ?  esc_url( $instance ['media_url'] ) : '';
		$width 	    	= isset ( $instance ['width'] )  	? esc_attr( $instance ['width'] ) 	  : '100%';
		$height     	= isset ( $instance ['height'] )  	? esc_attr( $instance ['height'] ) 	  : '320';

		echo $before_widget;
		
		if ( $title )	
		
		echo $before_title . $title . $after_title; 

			if ( !empty( $media_url ) ) : 
				
				echo wp_oembed_get( $media_url, array('width'=>	$width , 'height'=>	$height) ) ; 
				
			endif; 	

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		
		$instance 		= $new_instance;				
		$title 			= isset ( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';	
		$media_url 		= isset ( $instance['media_url'] ) ? esc_url( $instance['media_url'] )  : '';		
		$width 	    	= isset ( $instance['width'] )     ? esc_attr( $instance['width'] ) 	: '100%';
		$height     	= isset ( $instance['height'] )    ? esc_attr( $instance['height'] ) 	: '320';

		return $instance;
	}

	
	function form( $instance ) { 
				
		$instance 		= wp_parse_args( (array) $instance, array( 'title' => '') );
		$title 			= esc_attr( $instance['title'] );							
		$media_url 		= isset ( $instance['media_url'] ) ?  esc_url( $instance['media_url'] ) : '';									
		$width 	    	= isset ( $instance['width'] )     ? esc_attr( $instance['width'] ) 	: '100%';
		$height     	= isset ( $instance['height'] )    ? esc_attr( $instance['height'] ) 	: '320'; 
				
		?>
			
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'the_chameleon' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
	
		<p><label for="<?php echo $this->get_field_id('media_url'); ?>"><?php _e('Media url:', 'the_chameleon'); ?>
		<input id="<?php echo $this->get_field_id('media_url'); ?>" name="<?php echo $this->get_field_name('media_url'); ?>" type="text" value="<?php echo $media_url; ?>" class="widefat" /></label></p>

		<p><small><?php _e('Size:', 'the_chameleon'); ?></small>
		<input type="text" size="4" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $width; ?>" title="Width" /> 
		<input type="text" size="4" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $height; ?>" title="Height" /></p>
				
		<p><a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank"><i><?php _e( 'Okay, So What Sites Can I Embed From?', 'the_chameleon' ) ?></i></a></p>

<?php
	}

}


