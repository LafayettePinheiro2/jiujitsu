<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
<?php global $TheChameleon_options; //custom favcon 
	  if ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['favicon'] ) ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url( $TheChameleon_options['favicon'] ) ; ?>" />	
<?php endif; ?>
<meta name="theme" content="The Chameleon <?php echo VERSION ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php
	//WP head
	wp_head();
	
?>
</head>
<body id="body" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">	
<?php get_template_part( '/thechameleon/templates/header/header' ); ?> 