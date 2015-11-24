<?php
	global $data;

	$title_size    	 = isset( $data['title_size'] )   ? $data['title_size']   : 'full_title';		
	$meta_pattern    = isset( $data['meta_pattern'] ) ? $data['meta_pattern'] : 'By %author% on %date% in %categories% | %comments%';
	$excerpt_size    = isset( $data['excerpt_size'] ) ? $data['excerpt_size'] : 'full_excerpt';
	?>

	<?php if ( $meta_pattern != 'hide' or $meta_pattern =='' ) : ?>			
		<section class="col100 post-meta  post-meta-single">
   											
	   	  <?php	echo get_meta_view( $meta_pattern ); ?>	
   				
	   	</section>														
	<?php endif; ?>
	
	
	<section class="col100 post-content post-content-single">
	
		<?php if ( TheChameleon_has_post_media( $post->ID ) or has_post_thumbnail() ) : ?>	

			<figure class="post-media post-media-standard post-media-single post-media-standard-single alignleft">				

				<?php echo TheChameleon_get_post_featured_media(  $post->ID, 'standard', array() ); ?>
		
			</figure>

		<?php endif; ?>
	
	
		<?php	
			$author = get_post_meta( get_the_ID(), 'quote_author_name', TRUE );		
			$author = ! empty( $author ) ? $author : '';
	
	        echo '<q class="col100">'. get_the_content()	.'</q><br /><i>'. $author .' Petar Petrovic</i>'; ?>

	</section>

	<footer class="col100 post-footer">

		<span  itemprop="keywords"><?php echo get_the_term_list( $post->ID, 'post_tag', 'Tags: ', ', ', '' ); ?></span>

	</footer>