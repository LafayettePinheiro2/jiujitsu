<?php 

	/**
	 * WIDGETS	
	*/	
	$widgets_path = get_template_directory().'/thechameleon/widgets/';	
	foreach ( glob( $widgets_path."*.php" ) as $filename ) :
	    include_once $filename;
	endforeach;

	/**
	 * FUNCTIONS	
	*/ 
	locate_template( '/thechameleon/functions/comment.php', TRUE );
	locate_template( '/thechameleon/functions/common.php', TRUE );	
	locate_template( '/thechameleon/functions/menu.php', TRUE );		
	locate_template( '/thechameleon/functions/post.php', TRUE );
	locate_template( '/thechameleon/functions/taxonomy.php', TRUE);	
	locate_template( '/thechameleon/functions/template.php', TRUE );
	locate_template( '/thechameleon/functions/dashboard.php', TRUE );
	
	
	/**
	 * CUSTOMIZE	
	 */
	locate_template( '/thechameleon/customize/skins.php', TRUE );
	locate_template( '/thechameleon/customize/custom-css.php', TRUE );
	locate_template( '/thechameleon/customize/panels.php', TRUE );		
	locate_template( '/thechameleon/customize/upper.php', TRUE );
	locate_template( '/thechameleon/customize/header.php', TRUE );
	locate_template( '/thechameleon/customize/menu.php', TRUE );
	locate_template( '/thechameleon/customize/top.php', TRUE );	
	locate_template( '/thechameleon/customize/archives.php', TRUE );
	locate_template( '/thechameleon/customize/blog.php', TRUE );
	locate_template( '/thechameleon/customize/post.php', TRUE );
	locate_template( '/thechameleon/customize/bottom.php', TRUE );
	locate_template( '/thechameleon/customize/footer.php', TRUE );
	locate_template( '/thechameleon/customize/copyright.php', TRUE );

	
	/**
	 *  TheChameleon_sanitize_callback 
	 */
	function TheChameleon_sanitize_callback( $value ) {

	    return esc_attr( $value );
	}
	
	/**
	 *  TheChameleon_js_sanitize_callback
	 */
	function TheChameleon_js_sanitize_callback( $value ) {
		
	    return esc_js( $value );
	}

	if ( is_admin() ) :

		/**
		 * HELPERS	
		*/ 
		locate_template( '/thechameleon/helpers/form.php', TRUE ); 
		locate_template( '/thechameleon/helpers/html.php', TRUE ); 			

		/**
		 * CLASSES	
		*/		
		locate_template( '/thechameleon/functions/metabox.php', TRUE );   

	endif;

