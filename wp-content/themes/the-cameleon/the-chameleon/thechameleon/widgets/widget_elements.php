<?php
/**
 * TheChameleon_Widget_Elements
 *
 * @version 1.0.0
 */
class TheChameleon_Widget_Elements extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'widget_elements', 'description' => __( "Add site elements Logo, Breadcrumb, Title or Copyright.", 'the_chameleon' ) );
		parent::__construct('TheChameleon_Widget_Elements', __('Elements', 'the_chameleon'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );		
		
		$title 		= apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Elements', 'the_chameleon' ) : $instance['title'], $instance, $this->id_base );			
		$element 	= isset ( $instance ['element'] ) 	? esc_attr ( $instance ['element'] ) 	: 'breadcrumb';		
		$delimiter  = isset ( $instance ['delimiter'] ) ? esc_attr ( $instance ['delimiter'] ) 	: '&raquo;';				

		echo $before_widget;
		
			if ( $title )
		
		echo $before_title . $title . $after_title; 

			if ( $element != 'logo' ) :
				
				global $data; 	
				
				$data = array(
							'delimiter' => $delimiter, 
						);
			endif;
			
			get_template_part( 'parts/'.$element.'/'.$element );
	

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		
		$instance 	= $new_instance;				
		$title 		= isset ( $instance ['title'] ) ? esc_attr ( $instance ['title'] ) : '';		
		$element 	= isset ( $instance ['element'] ) 	? esc_attr ( $instance ['element'] ) 	: 'breadcrumb';
		$delimiter 	= isset ( $instance ['delimiter'] ) ? esc_attr ( $instance ['delimiter'] )  : '&raquo;';		

		return $instance;
	}

	function form( $instance ) { 
		
		//Defaults
		$instance 	= wp_parse_args( (array) $instance, array( 'title' => '') );
		$title 		= esc_attr( $instance['title'] );					
		$element 	= isset ( $instance ['element'] ) 	? esc_attr ( $instance ['element'] ) 	: 'breadcrumb';
		$delimiter 	= isset ( $instance ['delimiter'] ) ? esc_attr ( $instance ['delimiter'] ) 	: '&raquo;';
	 	?>	
				
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __( 'Title:', 'the_chameleon' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('element'); ?>"><?php _e('Element:', 'the_chameleon'); ?></label>
		<select id="<?php echo $this->get_field_id('element'); ?>" name="<?php echo $this->get_field_name('element'); ?>" class="widefat">	
						
			<?php $elements = array(
								'logo'		 => 'Logo', 
								'breadcrumb' => 'Breadcrumb', 
								'title'		 => 'Title', 
								'date'		 => 'Date', 
								'copyright'	 => 'Copyright'
							  );
			?>					
			<?php foreach ( $elements as $key => $value ) : ?>
				<option value="<?php echo $key ?>" <?php echo $key == $element ? 'selected="selected"' : '' ?>><?php echo $value ?></option>
			<?php endforeach; ?>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('delimiter'); ?>"><?php _e('Breadcrumb delimiter:', 'the_chameleon'); ?></label>
		<select id="<?php echo $this->get_field_id('delimiter'); ?>" name="<?php echo $this->get_field_name('delimiter'); ?>" class="widefat">					
		
			<?php $delimiters = array(
									'&rsaquo;'	=> '›', 
									'&raquo;'	=> '»', 
									'/'			=> '/', 
									'|'			=> '|', 
									'&#9679;'	=> '●', 
									'&#8226;'	=> '•',
									'&rarr;'	=> '→'
								);
			?>		
			<?php foreach ( $delimiters as $value ) : ?>	
				<option value="<?php echo $value ?>" <?php echo $value == $delimiter ? 'selected="selected"' : '' ?>><?php echo $value ?></option>	
			<?php endforeach; ?>				
		</select></p>		

	
<?php
	}

}