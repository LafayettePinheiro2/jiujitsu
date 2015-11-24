<?php
	global $data;

	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';	
	?>

	<?php if ( $meta_pattern != 'hide' or $meta_pattern == '' ) : ?>			
		<section class="col100 post-meta  post-meta-loop">
	   											
	   	  <?php echo TheChameleon_get_meta( $meta_pattern ); ?>	
					
	   	</section>														
	<?php endif; ?>

	<section class="col100 post-content post-content-loop">
	
		<figure class="post-media post-media-standard post-media-loop post-media-standard-loop alignleft">				

			<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 )  ?>	

		</figure>

			<?php the_content(); ?>

		
	</section>
	
	<footer class="col100 post-footer post-footer-loop">

		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', 'Tags: ', ', ', '' ); ?></span>

	</footer>