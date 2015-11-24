<?php
	global $data;
	
	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';
?>

	<section class="col100 post-content post-content-loop post-content-no-title-loop">

		<?php if ( has_post_thumbnail() ) : ?>	

				<figure class="post-media post-media-standard post-media-loop post-media-standard-loop alignleft">				

						<?php echo TheChameleon_get_post_featured_media(  $post->ID, 'standard', array() ); ?>

				</figure>

		<?php endif; 


		$url = get_post_meta( get_the_ID(), 'link', TRUE );		
		$url = ! empty( $url ) ? $url : '#'; ?>

		<a href="<?php echo $url ?>" target="_blank"><strong><?php echo get_the_title() ?></strong></a> <br />

		<?php the_content(); ?>
	
	
	</section>
	
	<footer class="col100 post-footer post-footer-loop">

		<span itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', 'Tags: ', ', ', '' ); ?></span>

	</footer>