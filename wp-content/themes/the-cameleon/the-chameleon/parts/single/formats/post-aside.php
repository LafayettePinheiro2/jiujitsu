
<section class="col100 post-content post-content-single">
	
	<?php if ( TheChameleon_has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	

			<figure class="post-media post-media-standard post-media-single post-media-video-single alignleft">				

					<?php echo TheChameleon_get_post_featured_media(  $post->ID, 'standard', array() ); ?>
			
			</figure>

	<?php endif; ?>
	
	
	<?php the_content();?>
	
</section>