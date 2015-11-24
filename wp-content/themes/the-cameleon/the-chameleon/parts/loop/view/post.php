<?php 
 	 global $i;		
 	 global $data;
	 global $TheChameleon_options;
	 global	$TheChameleon_term_options;

	$data['title_size']  	 = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['title_size'] ) ) ? $TheChameleon_term_options['title_size'] : 'full_title';		
	$data['meta_pattern']    = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['meta_pattern'] ) ) ? $TheChameleon_term_options['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$data['excerpt_size']    = ( !empty( $TheChameleon_term_options ) and !empty( $TheChameleon_term_options['excerpt_size'] ) ) ? $TheChameleon_term_options['excerpt_size'] : 'full_excerpt';
	$data['title_tag']       = ( !empty( $data ) and !empty( $data['title_tag'] ) ) ? $data['title_tag'] : 'h2';
 ?>


<article id="post-<?php the_ID(); ?>" <?php post_class('col100 post-loop'); ?> itemscope itemtype="http://schema.org/Article">

	<?php	
	$format = get_post_format();
	if ( false === $format )
		$format = 'standard';

			get_template_part( 'parts/loop/formats/post', $format ); 
	?>
	
</article>