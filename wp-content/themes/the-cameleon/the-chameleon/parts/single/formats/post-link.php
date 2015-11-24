<?php
	global $data;

	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';
	?>
	
	<section class="col100 post-content post-content-single">

		<?php if ( TheChameleon_has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	

			<figure class="post-media post-media-standard post-media-single post-media-standard-single alignleft">				

					<?php echo TheChameleon_get_post_featured_media(  $post->ID, 'standard', array() ); ?>

			</figure>

		<?php endif; ?>
		
		<?php
			$url = get_post_meta( get_the_ID(), 'link', TRUE );		
			$url = ! empty( $url ) ? $url : '#'; ?>

			<a href="<?php echo $url ?>" target="_blank"><strong><?php echo  get_the_title() ?></strong></a> <br/>

			<?php the_content(); ?>

	</section>

	<footer class="col100 post-footer">

		<span  itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', 'Tags: ', ', ', '' ); ?></span>

	</footer>