<?php
	global $data;

	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';	
	?>
	
	<header class="col100 post-header  post-header-loop">
		
		<?php if ( $title_size == 'full_title' ) : ?>

 				<h2 itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php the_title(); ?></a></h2>

 		<?php elseif ( $title_size != 'hide' ) : ?>
	
 				<h2 title="<?php the_title(); ?>"  itemprop="name"><a href="<?php the_permalink(); ?>#post-<?php the_ID(); ?>" itemprop="url"><?php echo  TheChameleon_the_title_maxlength( get_the_title(), $title_size ); ?></a></h2>

 		<?php endif; ?>
	
	</header>
	
	
	<?php if ( $meta_pattern != 'hide' or $meta_pattern =='' ) : ?>			
		<section class="col100 post-meta  post-meta-loop">
	   											
	   	  <?php echo TheChameleon_get_meta( $meta_pattern ); ?>	
	   				
	   	</section>														
	<?php endif; ?>
		

	<section class="col100 post-content post-content-loop">
		
		<?php if ( TheChameleon_has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	
			
			<figure class="post-media post-media-format-video post-media-loop post-media-video-loop aligncenter">				

				<?php echo TheChameleon_get_post_featured_media( get_the_ID(), 'video', array() ); ?>
			
			</figure>

		<?php endif; ?>
		
		
		<?php if ( $excerpt_size   == 'full_content' ) : 								
				 the_content();													
			elseif ( $excerpt_size == 'full_excerpt' ) : 												
			 	the_excerpt();										
			elseif ( $excerpt_size != 'hide' ) : 								
		 		TheChameleon_the_excerpt_maxlength( $excerpt_size ); 				
		 	endif; ?>
		

	</section>
	
	<footer class="col100 post-footer post-footer-loop">

		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', 'Tags: ', ', ', '' ); ?></span>

	</footer>
	