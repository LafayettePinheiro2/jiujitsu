<?php get_header(); 

	global $TheChameleon_options;					
	$template = ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['post_template'] ) ) ? $TheChameleon_options['post_template'] : 'single-right-sidebar';

	get_template_part( '/thechameleon/templates/single/'. $template  );
	
get_footer(); ?>


