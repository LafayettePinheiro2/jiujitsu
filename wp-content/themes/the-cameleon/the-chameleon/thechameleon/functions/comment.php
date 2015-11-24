<?php

if ( ! function_exists( 'theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own theme_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Chamelone Theme 1.0
 */
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?> comment-depth-<?php echo $depth ?>">
		<section id="comment-<?php comment_ID(); ?>" class="comment-wrap comment-wrap-depth-<?php echo $depth?>">

			
				<section class="comment-author vcard">
					
					<?php echo get_avatar( $comment, 65 ); ?>			
			
					<section class="comment-meta commentmetadata">
			
						<?php printf( __( '%s', 'chameleon-themes' ),  /*sprintf*/ sprintf( '<strong class="comment-author-name left">%s</strong>', get_comment_author_link() ) ) ; ?>

						<!--	/* translators: 1: date, 2: time */-->
						<?php printf( __( '<span class="comment-date">%1$s at %2$s</span>', 'chameleon-themes' ), get_comment_date(),  get_comment_time() ); ?>
						&nbsp;
						<?php edit_comment_link( __( '(Edit)', 'chameleon-themes' ), ' ' );	?>
		
					</section><!-- .comment-meta .commentmetadata -->
			
			
				</section><!-- .comment-author .vcard -->
		
		
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><div class="message notice"><div class="message-inner"> <?php _e( 'Your comment is awaiting moderation.', 'chameleon-themes' ); ?></div></div></em>
					<br />
				<?php endif; ?>

				<section class="comment-body"><?php comment_text(); ?></section>

				<section class="reply reply-depth-1 reply-depth-<?php echo $depth ?>">
				
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			
				</section><!-- .reply -->
				

	</section><!-- #comment-##  comment-wrap -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'chameleon-themes'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)','chameleon-themes' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
?>