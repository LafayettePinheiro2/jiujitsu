<?php
	$logo_text 		= get_bloginfo( 'name' );
	$logo_sub_text 	= get_bloginfo( 'description' ) ;
	
	echo 	
	'<hgroup class="logo"><h1 class="site-name"><a href="'.site_url().'">'. $logo_text .'</a></h1>'.
	'<h6 class="site-description">'. $logo_sub_text .'</h6></hgroup">';	
?>