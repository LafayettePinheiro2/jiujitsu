<?php
get_header(); 

	global $TheChameleon_options;
	global $TheChameleon_term_options;

	$template = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['template'] ) ) ? $TheChameleon_term_options['template'] : ( ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options[ 'archive_template' ] ) ) ? $TheChameleon_options[ 'archive_template' ] : 'loop-right-sidebar' );

	get_template_part( '/thechameleon/templates/loop/'. $template );

get_footer();
?>

