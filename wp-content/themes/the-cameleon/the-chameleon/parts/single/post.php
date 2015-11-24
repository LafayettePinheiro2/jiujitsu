<?php

	global $data;


if ( have_posts() ) :  
	while ( have_posts() ) : the_post(); 

	$format = get_post_format();
	if ( false === $format )
		$format = 'standard'; ?>
			
<article id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?> itemscope itemtype="http://schema.org/Article">
			
	<?php get_template_part( 'parts/single/formats/post', $format ); 	?>
	

	<footer class="post-footer post-footer-single">
		
		<?php
				$defaults = array(
					'before'           => '<p>' . __( 'Pages:', 'the_chameleon'),
					'after'            => '</p>',
					'link_before'      => '',
					'link_after'       => '',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'nextpagelink'     => __( 'Next page', 'the_chameleon' ),
					'previouspagelink' => __( 'Previous page', 'the_chameleon' ),
					'pagelink'         => '%',
					'echo'             => 1 
				 );

		        wp_link_pages( $defaults ); 	
		  ?>
		<div class="col-2">
			<?php dynamic_sidebar( !empty( $data['sidebar'] ) ? $data['sidebar'] : 'Post Footer' ); ?>
		</div>
		
		<section class="col100 comment-wrap comment-wrap-single">
 			<?php comments_template( '', false );  	?>
		</section>

	<footer>

</article>

<?php endwhile; 
	endif; 
wp_reset_query(); ?>