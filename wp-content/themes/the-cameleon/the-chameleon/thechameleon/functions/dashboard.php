<?php

	if ( ! function_exists( 'TheChameleon_dashboard_widgets' ) ) :		
		/**
		 * 	Custom dashboard 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/		
		add_action('wp_dashboard_setup', 'TheChameleon_dashboard_widgets');  
		function TheChameleon_dashboard_widgets() {  
		     global $wp_meta_boxes;  
		     // remove unnecessary widgets  
		     // var_dump( $wp_meta_boxes['dashboard'] ); // use to get all the widget IDs  
		     unset(  
		          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],  
		          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_secondary'],  
		          $wp_meta_boxes['dashboard']['normal']['core']['dashboard_primary']  
		     );  
		     // add a custom dashboard widget  
		     wp_add_dashboard_widget( 'dashboard_custom_feed', 'The Chameleon', 'TheChameleon_dashboard_custom_feed_output' ); //add new RSS feed output  
		}  


	endif;
		
	if ( ! function_exists( 'TheChameleon_dashboard_custom_feed_output' ) ) :	
		/**
		 * 	Dashboard feed
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/		
 		function TheChameleon_dashboard_custom_feed_output() {  
 	         echo '<div class="rss-widget">';  
 	         wp_widget_rss_output(array(  
 	              'url' => 'http://www.chameleonthemes.net/rss',  //put your feed URL here  
 	              'title' => 'What\'s up from Chameleon Themes',  
 	              'items' => 2, //how many posts to show  
 	              'show_summary' => 1,  
 	              'show_author' => 0,  
 	              'show_date' => 1  
 	         ));  
 	         echo "</div>";  
 		}

	endif;
?>