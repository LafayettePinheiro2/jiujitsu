<?php

if ( ! function_exists( 'TheChameleon_get_the_featured_media' ) ) :
	/**
     * Get featured media. If have video show video if have featured image 
     * show image...
     *
     * @author Goran Petrovic
     * @since 1.0
     *
     * @param int $post_id 
     * @param int $width 		 
     * @param int $height 		 
     * @param array $att html attributes 
     * @param boolean $linked are media have link or not 
     * @param boolean $force_image if have video fors to show image
     * @param array $icons ImaheHover JS script...
     * @return html embed, iframe foe youtube, vimeo, html5 video, image
     **/		
	function TheChameleon_get_post_featured_media( $post_id, $format = 'standard', $attr = array() ){
			
		if ( $format == 'video') :

			//if video have image
				//if audio have image
				if ( has_post_thumbnail( $post_id ) and !is_single() ) :
					
					return the_post_thumbnail( 'full', $attr ) ;
					
				else :
					
					if ( !empty( $post_id ) ) :
						$video_link  = get_post_meta( $post_id, 'featured_media', TRUE );
					else:
						$video_link  = get_theme_post_meta( 'featured_media' );	
					endif;
									
					return  ( $video_link ) ?  wp_oembed_get( $video_link, $attr ) : NULL ;
										
				endif;
		
				
		elseif ( $format == 'audio' ) :
			
				//if audio have image
				if ( has_post_thumbnail( $post_id ) and !is_single() ) : 

					return the_post_thumbnail('full', $attr) ;

				else :
					
					if ( !empty( $post_id ) ) :
						$audio_link  = get_post_meta( $post_id, 'featured_audio', TRUE );
					else:
						$audio_link  = get_theme_post_meta( 'featured_audio' );	
					endif;
				
				 	return ( $audio_link ) ?  wp_audio_shortcode( array( 'src'=>$audio_link ) ) : NULL;
				
				endif;
				
		elseif ($format == 'image'):
			
			if ( has_post_thumbnail( $post_id ) ) : 
				return the_post_thumbnail('full', $attr);  // Other resolutions
			endif;	
			
		else: 
			
			if ( has_post_thumbnail( $post_id ) ) : 
				return the_post_thumbnail( 'thumbnail', $attr );  
			endif;
				
		endif;
		
	}
	
endif;	
	
if ( ! function_exists( 'TheChameleon_has_post_video' ) ) :		
	
		function TheChameleon_the_post_thumbnail_caption() {
		  global $post;

		  $thumbnail_id    = get_post_thumbnail_id($post->ID);
		  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

		  if ($thumbnail_image && isset($thumbnail_image[0])) {
		    echo '<figcaption><span>'.$thumbnail_image[0]->post_excerpt.'</span></figcaption>';
		  }
		}
endif;

if ( ! function_exists( 'TheChameleon_has_post_media' ) ) :	
		/**
		 * Is post have media
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *	 
		 * @param int $post_id 
		 * @return boolean
		 **/
		function TheChameleon_has_post_media( $post_id = NULL ){
	
			global $post;
		
			$post_id = !empty( $post_id ) ? $post_id : $post->ID;	
		
			if ( !empty( $post_id ) ) :
				$have_video  = get_post_meta( $post_id, 'featured_media', TRUE );
			else:
				$have_video  = get_theme_post_meta( 'featured_media' );	
			endif;
		
			if ( $have_video ) :
				return TRUE;
			else:			    
				return FALSE;
			endif;
    
		}
endif;
	
if ( ! function_exists( 'TheChameleon_has_post_audio' ) ) :	
		/**
		 * Has post have audio  
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param int $post_id 
		 * @return boolean
		 **/
		function TheChameleon_has_post_audio( $post_id = NULL ){
	
			global $post;
		
			$post_id = !empty( $post_id ) ? $post_id : $post->ID;	
		
			if ( !empty( $post_id ) ) :
				$have_audio  = get_post_meta( $post_id, 'featured_audio', TRUE );
			else:
				$have_audio  = get_theme_post_meta( 'featured_audio' );	
			endif;
		
			if ( $have_audio ) :
				return TRUE;
			else:				
				return FALSE;
			endif;

		}
endif;
	
	
if ( ! function_exists( 'TheChameleon_get_meta' ) ) :	
		/**
		 * Create meta by pattern  
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param string $pattern '%author%', '%date%', '%categories%','%category%', '%comments%'
		 * @return html meta ordber by pattern in <span>
		 **/	
		function TheChameleon_get_meta($pattern){
		
			global $post;
		
				$meta_autor = '<span class="mta-item meta-author" itemprop="author"><a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a></span>';
				$meta_date = '<span class="meta-item meta-date"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" itemprop="datePublished">' . get_the_date() . '</a></span>';
			
				$post_type = get_post_type();
			
				if ( $post_type == 'post') :
					
					$get_the_categoriy = get_the_category();		
				    $single_category   = '<a href="' . get_category_link( $get_the_categoriy[0]->term_id ).'" >' . $get_the_categoriy[0]->cat_name . '</a>';	
		 
					$categories = '';
					foreach( $get_the_categoriy as $category ) :
					    $categories .= '<a href="'.get_category_link( $category->term_id ).'">' . $category->cat_name . '</a>, ';
					endforeach;
		
				else: 
					$single_category = '';
					$categories 	 = '';
					
				endif;
			
				$meta_category 	 = '<span class="meta-item meta-category" itemprop="articleSection">' . $single_category . '</span>';
				$meta_categories = '<span class="meta-item meta-category meta-categories" itemprop="articleSection">' .rtrim( $categories,', ' ) . '</span>';
				$meta_comments   = '<span class="meta-item meta-comments" ><a href="' . get_permalink() . '#comments" itemprop="commentCount" content="' . get_comments_number('0','1','%') . '">' . get_comments_number('0','1','%') .' ' . __('Comments', 'the_chameleon') . '</a></span>';
			
				$finde 			= array( '%author%', '%date%', '%categories%','%category%', '%comments%' );
				$replace 		= array( $meta_autor, $meta_date, $meta_categories, $meta_category, $meta_comments );
			
				return str_replace( $finde, $replace, $pattern );
	
		}
endif;
	
	
if ( ! function_exists( 'TheChameleon_the_excerpt_maxlength' ) ) :
		/**
		 * Crop excerpt characters to custom length
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param int $charlength 
		 * @param string $link_more show more [...] or hide
		 * @param boolean $echo 
		 * @return string html 
		 **/
		function TheChameleon_the_excerpt_maxlength( $charlength, $link_more = 'show', $echo = TRUE) {
			 
			global $post;
			
			$excerpt = get_the_excerpt();
			$charlength++;

			if ( mb_strlen( $excerpt ) > $charlength ) {
				$subex = mb_substr( $excerpt, 0, $charlength - 5 );
				$exwords = explode( ' ', $subex );
				$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
				if ( $excut < 0 ) {
					$new_excerpt = mb_substr( $subex, 0, $excut );
				} else {
					$new_excerpt = $subex;
				}
			
				if ( $echo ):
					echo $new_excerpt.'<a href="' . get_permalink( $post->ID ) . '"> [...]</a>';
				else:
					return $new_excerpt.'<a href="' . get_permalink( $post->ID ) . '"> [...]</a>';
				endif;
			
			} else {
				
				if ( $echo ):	
					echo $excerpt; 	
				else: 
					return $excerpt;	
				endif;
				
			}
	
		}
endif;
	
if ( ! function_exists( 'TheChameleon_the_title_maxlength' ) ) :	
	/**
	 * 	Short text on character limit
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/
	function TheChameleon_the_title_maxlength( $text, $chars_limit )
	{
	    // Check if length is larger than the character limit
	    if ( strlen( $text ) > $chars_limit )
	    {
	        // If so, cut the string at the character limit
	        $new_text = substr( $text, 0, $chars_limit );
	        // Trim off white space
	        $new_text = trim( $new_text );
	        // Add at end of text ...
	        return $new_text . "...";
	    }
	    // If not just return the text as is
	    else
	    {
	    return $text;
	    }
	}	
endif;	

if ( ! function_exists( 'TheChameleon_custom_permalink' ) ) :			
	/**
	 * 	Custom post permalink
	 *
	 * @author Goran Petrovic
	 * @since 1.0
	 *
	 **/
	function TheChameleon_custom_permalink($url) {
 	  global $post; 
	  $permalink = get_post_meta( $post->ID, 'permalink', TRUE );
		if ( ! empty( $permalink ) ) :
			return 	$permalink;
		else:
			return  get_permalink();						
		endif;	
	}
	add_filter('the_permalink', 'TheChameleon_custom_permalink');
endif; 	?>