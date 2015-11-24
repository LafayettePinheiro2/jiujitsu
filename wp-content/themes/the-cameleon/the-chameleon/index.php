<?php get_header(); 
		
		if ( is_main_query() ) :
	
			$template = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['template'] ) ) ? $TheChameleon_term_options['template'] : ( ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options[ 'blog_template' ] ) ) ? $TheChameleon_options[ 'blog_template' ] : 'loop-right-sidebar' );
						
			get_template_part( '/thechameleon/templates/loop/'. $template );
			
		else:
			
	
			get_template_part( '/thechameleon/templates/page/page-fullwidth' );
			
		endif;	
		
 	get_footer(); ?>