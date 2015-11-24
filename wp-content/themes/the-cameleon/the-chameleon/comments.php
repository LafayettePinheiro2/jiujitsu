<?php
/**
 * The template for displaying Comments.
 *
 *
 * @package WordPress
 * @subpackage 
 * @since 
 */
?>


<!--comments-->
<div id="comments" class="comments entry-wrap comments-wrap">
	<div class="comments-inner entry-wrap-inner comments-wrap-inner">
	
		<div class="entry-content-wrap comments-content-wrap">
			<div class="entry-content-wrap-inner comments-content-wrap-inner">

			<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'chameleon-themes' ); ?></p>
			</div>	
		</div><!-- #comments -->
			<?php
					/* Stop the rest of comments.php from being processed,
					 * but don't kill the script entirely -- we still have
					 * to fully load the template.
					 */
					return;
				endif;
			?>

<?php // You can start editing here -- including this comment! ?>
	
<?php 

	global $theme_options;		
	if(!empty($theme_options['comment_scripts'])) :			
		echo $theme_options['comment_scripts'];			
	endif;	?>
	
	
	
<?php $wp_comments_status = !empty($theme_options['wp_comments_status']) ? $theme_options['wp_comments_status'] : 'on';

	if($wp_comments_status!='off') :

	if ( have_comments() ) : ?>
			
			<h3 id="comments-title"><?php
			printf( _n( 'One Comment to %2$s', '%1$s Comments to %2$s', get_comments_number(), 'chameleon-themes'),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'chameleon-themes' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'chameleon-themes' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
				
					wp_list_comments( array( 'callback' => 'theme_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' )) : // Are there comments to navigate through? ?>
	
			<div class="navigation comments-pagination">
		  		<?php paginate_comments_links(); ?> 
		 	</div>
			
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
   if ( ! comments_open() or get_option('default_comment_status')=='closed') : 
?>
	<p class="nocomments"><?php /*_e( 'Comments are closed.', 'chameleon-themes'); */ ?></p>
	
<?php else: ?>

<?php // comment_form(); ?>

<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>


<?php comment_form(); ?>


<?php endif; ?>
			</div>	
		</div>	
		 
	</div><!-- comments-inner -->	
</div><!-- #comments -->

