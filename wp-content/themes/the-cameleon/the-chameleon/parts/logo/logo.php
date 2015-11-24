<?php
	global $data;
	global $TheChameleon_options;
	
	$logo_text 	= get_bloginfo( 'name' );
	$type   	= ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['logo_type'] ) ) ? $TheChameleon_options['logo_type']  : 'image';
	$url    	= ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['logo'] ) ) ? $TheChameleon_options['logo'] : get_template_directory_uri() .'/img/logo.png' ;

	if ( $type == "image" ) : ?>
		<figure class="logo">
			<a href="<?php echo site_url(); ?>"><img src="<?php echo esc_url( $url ) ?>" alt="<?php echo $logo_text ?>" class="logo"/></a>
		</figure>
	<?php else :
		$logo_text 		= get_bloginfo( 'name' );
		$logo_sub_text 	= get_bloginfo( 'description' ) ;
		echo '<hgroup class="logo"><h1 class="site-name"><a href="'.esc_url( site_url() ).'">'. $logo_text .'</a></h1>'.
			  '<h3 class="site-description">'. $logo_sub_text .'</h3></hgroup>';
	
	endif ; ?>