<?php

		
if ( ! class_exists('TheChameleon') ) :	

	/**
	   * The Chameleon
	   * 
	   * 
	   * @package    WordPress
	   * @subpackage The Chameleon
	   * @since The Chameleon 3.0
	   * @author     Goran Petrovic <goran.petrovic@godev.rs>
	   */

	class TheChameleon{
		
		var $column_options;
		var $theme_slug = 'TheChameleon_';
		var $sidebars;
		var $skin;
		
		function __construct() {

			$this->theme_skin();
			
			add_action('init', array(&$this, 'register_globals') );	
			add_action('wp', array(&$this, 'register_globals') );	
			
			add_action('wp_head', array(&$this, 'custom_css') );
			
			add_action('login_head', array(&$this, 'custom_login_logo') );
			
			add_action( 'after_setup_theme', array(&$this, 'theme_supports') );
			
			add_action('widgets_init', array(&$this,'register_sidebars'), 1 );	
			
			add_action( 'init', array(&$this, 'register_menus'));
							
		  	add_action( 'admin_print_styles',  array(&$this, 'load_stylesheet') );
		  	add_action( 'wp_print_styles',  array(&$this, 'load_stylesheet') );
		
			add_action( 'admin_print_scripts', array(&$this, 'load_scripts') );	
			add_action( 'wp_enqueue_scripts', array(&$this, 'load_scripts') );	
										
			//widgets setting
			add_filter( 'wp_nav_menu_args', array(&$this, 'custom_walker') );
			
			add_action( 'widgets_init', array(&$this, 'custom_widgets_init') );
			
			add_filter( 'widget_title', array(&$this, 'default_widget_title'), 10, 3 );
								
			add_action( 'widgets_admin_page',  array(&$this, 'custom_sidebars_setting' ), 10, 2);	
					
			//Format WP auto paragraf <p> 
			remove_filter( 'the_content', 'wpautop' );
			add_filter( 'the_content', 'wpautop' , 10);
			
			add_action('after_setup_theme', 'load_theme_textdomain');
			
			include_once('constants.php');
		  }
		
		//regoster globals
		function register_globals(){

			$this->column_options();
			$this->theme_options();
			$this->theme_skin();
			$this->register_global_sidebars();
				
		}	

		//Columnes options 
		function column_options(){
						
			global $TheChameleon_column_options;
		
			$TheChameleon_column_options = array(
				'col-1' 	  	 => __( 'One Column', 'the_chameleon' ),
				'col-2' 	  	 => __( 'Two Columns', 'the_chameleon' ),
				'col-2-30x70' 	 => __( 'Two Columns 30x70%', 'the_chameleon' ),
				'col-2-70x30' 	 => __( 'Two Columns 70x30%', 'the_chameleon' ),
				'col-3'		  	 => __( 'Three Columns', 'the_chameleon' ),
				'col-3-60x25x15' => __( 'Three Columns 60x25x15%', 'the_chameleon' ),
				'col-3-15x25x60' => __( 'Three Columns 15x25x60%', 'the_chameleon' ),
				'col-3-15x60x25' => __( 'Three Columns 15x60x25%', 'the_chameleon' ),
				'col-4'		  	 => __( 'Four Columns', 'the_chameleon' ),
				'col-5'		  	 => __( 'Five Columns', 'the_chameleon' ),
				'col-6'		  	 => __( 'Six Columns', 'the_chameleon' )
			);

			$this->column_options = $TheChameleon_column_options;
		}


		/**
		 * 	Get theme options incude theme slug as prefix
		 **/			
		function theme_options() {	

			global $TheChameleon_options;
			global $TheChameleon_post_options;
			global $TheChameleon_term_options;
			

				$TheChameleon_options = get_option($this->theme_slug .'options');
			
			
			if ( is_single() or is_page() ) :
				
				global $post;
				$TheChameleon_post_options = array(
												'sidebar_first'  => get_post_meta( get_the_ID(), 'sidebar_first' , true),
												'sidebar_second' => get_post_meta( get_the_ID(), 'sidebar_second' , true),
												'page_builder'	 => get_post_meta( get_the_ID(), 'page_builder'   , true)
											);
		
			elseif ( is_category() or is_tax() ) :

				$term_id = get_queried_object()->term_id;		
				$tax 	 = get_queried_object()->taxonomy;
				
				$TheChameleon_term_options = get_option( $tax.'_term_'.$term_id );

			endif;

		}

		// SKIN
		/*-----------------------------------*/
		
  		/**
  	     * Get active skin
  	     */
  		function theme_skin() {
	
 			global $skin;

  	        $TheChameleon_options = get_option( 'TheChameleon_options' );
	
			$this->skin = ( !empty( $TheChameleon_options )  and !empty( $TheChameleon_options['skin'] ) ) ? $TheChameleon_options['skin'] : 'The-Chameleon-Gray' ;
 
  		}	
	
		// HEAD
		/*-----------------------------------*/
		
		/**
		 * 	Custom header background 
		 **/
		function custom_css() {

			echo '<style> #header { background:transparent url("'.get_header_image().'"); } #header h1, #header h2, #header h3, #header h4, #header h5, #header h6, #header h1 a, #header h2 a, #header h3 a, #header h4 a, #header h5 a, #header h6 a, #header p, #header a {color:#'.get_header_textcolor().';} </style>';

		}
		
		/**
		 * 	Custom login logo  
		 **/	
		function custom_login_logo() {
			global $TheChameleon_options;


			if ( !empty( $TheChameleon_options ) and !empty( $TheChameleon_options['logo'] ) ) :

		    echo '<style type="text/css">
		   	        h1 a { background-image:url(' . esc_url( $TheChameleon_options['logo'] ) . ') !important; background-size:100% 100% !important; width:100% !important;}
		   	    </style>';

			endif;

		}
		


 	 	/**
	  	 * Load Chameleon stylesheet  
	  	 **/
	    function load_stylesheet() {

	
			if ( !is_admin() ) :
	  		 
	  			// Style 
	  	   		wp_enqueue_style( 'TheChameleon-style', get_template_directory_uri()  . '/style.css', array());
		  		 		
				// Responsive	
	  		 	wp_enqueue_style( 'TheChameleon-responsive', get_template_directory_uri()  . '/css/responsive.css', array() );	
	
				// Cycle2
				wp_enqueue_style( 'TheChameleon-cycle2', get_template_directory_uri()  . '/js/cycle2/style.css' );
			
				// Skin	  		
		 	    wp_enqueue_style( 'TheChameleon-skin', get_template_directory_uri()  . '/css/skins/'. $this->skin .'/style.css', array() );		

	  		endif;

	    }


		/**
		 * Load Chameleon scripts in head 
		 *
		 **/		
		function load_scripts() {

			// Jquery
			/*wp_enqueue_script( 'jquery' );*/
			
			//easing
			wp_register_script( 'TheChameleon-jquery-easing', get_template_directory_uri()  .'/js/jquery.easing.1.3.js', array( 'jquery' ), '1.3.0', true );			
			wp_enqueue_script( 'TheChameleon-jquery-easing' );
			
			if ( !is_admin() ) :	

				//cycle 2 scripts
			 	wp_register_script('TheChameleon-cycle2', 		    get_template_directory_uri() .'/js/cycle2/cycle2.js',    array('jquery', 'jquery-easing'), '2.1.6');			
				wp_register_script('TheChameleon-cycle-flip', 	    get_template_directory_uri() .'/js/cycle2/Flip.js',      array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');			
				wp_register_script('TheChameleon-cycle-tile', 	    get_template_directory_uri() .'/js/cycle2/Tile.js',      array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');			
				wp_register_script('TheChameleon-cycle-scrollVert', get_template_directory_uri().'/js/cycle2/ScrollVert.js', array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');			
				wp_register_script('TheChameleon-cycle-ie-fade',    get_template_directory_uri().'/js/cycle2/IE-Fade.js',    array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');			
				wp_register_script('TheChameleon-cycle-shuffle',    get_template_directory_uri().'/js/cycle2/Shuffle.js',    array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');			
				wp_register_script('TheChameleon-cycle-carousel',   get_template_directory_uri().'/js/cycle2/Carousel.js',   array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');			
				wp_register_script('TheChameleon-cycle-caption2',   get_template_directory_uri().'/js/cycle2/Caption2.js',   array('jquery', 'jquery-easing', 'cycle2'), '1.0.0');


				//functions			
				wp_register_script( 'TheChameleon-functions', get_template_directory_uri()  .'/js/functions.js', array( 'jquery' ), '1.0.0', true );
				wp_enqueue_script( 'TheChameleon-functions' );

						
				//comments	
				if ( is_singular() && get_option( 'thread_comments' ) )
					wp_enqueue_script( 'comment-reply' );


			endif;



		}


		//THEME SUPPORT
		/*-----------------------------------*/

		/**
		 * 	Theme support 
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function theme_supports() {		
			
		$defaults = array(
						'default-color'          => '',
						'default-image'          => '',
						'default-repeat'         => '',
						'default-position-x'     => '',
						'default-attachment'     => '',
						'wp-head-callback'       => '_custom_background_cb',
						'admin-head-callback'    => '',
						'admin-preview-callback' => ''
					);
			add_theme_support( 'custom-background', $defaults );			
			add_theme_support( 'custom-header' );
			add_theme_support( "title-tag" );
			
			//define content width
			if ( ! isset( $content_width ) ) {
				$content_width = 600;
			}

			$defaults = array(
				'post'       => '500',
				'page'       => '500',
				'attachment' => '650',
				'artist'     => '300',
				'movie'      => '400'
			);
			add_theme_support( 'content-width', $defaults );

			// Register theme support
			if ( function_exists( 'add_theme_support' ) ) { 
				add_theme_support( 'post-thumbnails', array( 'post', 'page', 'slide', 'product') );			
			}
			
			//add editor style
			add_editor_style('css/editor-style.css');
			
			//Add image size 800x600
			add_image_size( 'single-photo', 800, 600 );

			//custom background
			add_theme_support( 'custom-background' );

			// This theme supports a variety of post formats.
			add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'gallery', 'quote',  'status', 'link') );

			//automatic-feed-links
			add_theme_support( 'automatic-feed-links' );

		}
		/**
		 * 	Register sidebars
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 **/
		function register_sidebars(){
			
			$defaul_sidebars = 
				array(
					'Upper'			=> __( 'Upper', 'the_chameleon' ),
					'Header'		=> __( 'Header', 'the_chameleon' ),
					'Top'			=> __( 'Top', 'the_chameleon' ),
					'Page'			=> __( 'Page', 'the_chameleon' ),
					'Post'			=> __( 'Post', 'the_chameleon' ),
					'Post Footer'	=> __( 'Post Footer', 'the_chameleon' ),			
					'Bottom'		=> __( 'Bottom', 'the_chameleon' ),
					'Footer'		=> __( 'Footer', 'the_chameleon' ),
					'Copyright'		=> __( 'Copyright', 'the_chameleon' ),
				);

			
			foreach ( array_merge( $defaul_sidebars, ( get_option( $this->theme_slug.'custom_sidebars' ) ) ? array_combine( get_option(  $this->theme_slug.'custom_sidebars' ) ,  get_option(  $this->theme_slug.'custom_sidebars' ) ) : array() ) as $key => $sidebar ) {

		
			if ( !empty( $key ) ) :
				register_sidebar(
						array(
							'name'          => $key,
							'id'			=> sanitize_title($key),
							'before_widget' => '<section id="%1$s" class="widget %2$s">',
							'after_widget'  => '</section></section><!-- end widget-->',
							'before_title'  => '<header class="widget-header"><h4>',
							'after_title'   => '</h4></header><section class="widget-content">' )
						);
			endif;

			}
			
		}
		
		//register global 
		function register_global_sidebars(){	
					
			global 	$sidebars;			
			$defaul_sidebars = array(
				'',
				'Upper'			=> __( 'Upper', 'the_chameleon' ),
				'Header'		=> __( 'Header', 'the_chameleon' ),
				'Top'			=> __( 'Top', 'the_chameleon' ),
				'Page'			=> __( 'Page', 'the_chameleon' ),
				'Post'			=> __( 'Post', 'the_chameleon' ),
				'Post Footer'	=> __( 'Post Footer', 'the_chameleon' ),			
				'Bottom'		=> __( 'Bottom', 'the_chameleon' ),
				'Footer'		=> __( 'Footer', 'the_chameleon' ),
				'Copyright'		=> __( 'Copyright', 'the_chameleon' ),
			);
			
			$this->sidebars = array_merge( $defaul_sidebars, ( get_option( $this->theme_slug.'custom_sidebars' ) ) ? get_option(  $this->theme_slug.'custom_sidebars' ) : array() );			
			$sidebars = $this->sidebars;
			
		}
		
					
		// Register theme menus		
		function register_menus() {
			register_nav_menus(
				array(
					'primary-menu' 	=> __( 'Primary Menu', 'the_chameleon' ),	
				)
			);
		}
	

	
		//WIDGETS
		/*-----------------------------------*/
	
		/**
		 * 	Register custom widgets, 
		 *  Filter for use shortcodes in text widgets.
		 *
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/		
		function custom_widgets_init() {
	
			if ( !is_blog_installed() )
					return;
						
			register_widget( 'TheChameleon_Advanced_Recent_Posts') ;	
			register_widget( 'TheChameleon_Slider_Widget' );
			register_widget( 'TheChameleon_Widget_Elements' );
			register_widget( 'TheChameleon_Empty_Widget' );
			register_widget( 'TheChameleon_Widget_Media' );
			register_widget( 'TheChameleon_Widget_Social_Networks' );	

		}
	
			
		/**
		 * Add custom  walker menu in custom menu widget
		 *
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @param string $args 
		 * @return void
		 **/
		function custom_walker( $args ) {

		    return array_merge( $args, array(
		        'walker' => new TheChameleon_Walker_Nav_Menu(),
		        // another setting go here ... 
		    ) );
		}


		/**
		 * 	Define default widgets title 
		 *
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return void
		 **/
		function default_widget_title( $title, $instance = NULL ) {

			$instance['title'] = ( ! empty( $instance['title'])) ? $instance['title'] : NULL;
			$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : ( ( !empty( $title ) ) ? $title : ' ');
			return $title;	
		}
	
			
		/** 
		 * Add/delete unlimeted sidebars in widgest arena 
		 *
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return html in widgets section
		 **/	
		function custom_sidebars_setting() { ?>

			<script type="text/javascript">
			    jQuery(document).ready(function() {
					jQuery('.my-widget-holder').hide();
			     // toggles the slickbox on clicking the noted link  
			      jQuery('#my_sidebar-name-arrow, #my_sb').click(function() {			
					var idrel = jQuery(this).attr("data");
			        jQuery('.my-widget-holder').toggle();
			        return false;
			      });
			    });
			</script>

			<div id="available-widgets" class="widgets-holder-wrap" >
				<div class="sidebar-name" style=" margin:0px 10px 0px 6px;" >	
					<div id="my_sidebar-name-arrow" class="sidebar-name-arrow" ><br/></div>
						<h3 id="my_sb"><?php _e( 'Custom Sidebars', 'the_chameleon' ) ?></h3>
							<div class="my-widget-holder" >
								<div style="padding:10px;">
									<?php //add sidebar
										if ( ! empty( $_POST['create_sidebar'] ) ) :

											update_option( $this->theme_slug.'custom_sidebars', array_unique( array_merge( $this->sidebars, array( trim( esc_html( $_POST['create_sidebar'] ) ) ) ) ) );

											echo '<div id="message" class="updated"><p>'. __('New sidebar is successfully added. Please <a href="">refresh page</a>.', 'the_chameleon') .'</p></div>';

										elseif( ! empty( $_POST['delete_sidebar'] ) ) :	

											if ( ( $key = array_search( trim( $_POST['delete_sidebar'] ) , $this->sidebars ) ) !== false ) :
											    unset( $this->sidebars[ $key ] );
											endif;

										    update_option( $this->theme_slug.'custom_sidebars', array_unique( $this->sidebars ) );

											echo '<div id="message" class="updated"><p>' . __('Sidebar is successfully delete. Please <a href="">refresh page</a>.', 'the_chameleon'). '</p></div>';

										endif; ?>

										<form action="" method="POST" accept-charset="utf-8">									
											<div style="width:100%;">											
												<?php echo Form::label('create_sidebar', __( 'Unique Sidebar Name', 'the_chameleon' ) ); ?>
												<br/>
												<?php echo Form::input('create_sidebar', '', array('id'=>'create_sidebar', 'style'=>'min-width:230px;', 'maxlength'=>"30")); ?>									
												<?php echo Form::submit('add', __( 'Create ', 'the_chameleon' ), array('class'=>'button-primary')); ?>
											</div>

											<div style="width:100%;  margin-top:20px;">
												<?php echo Form::select('delete_sidebar', array_combine( $this->sidebars, $this->sidebars ),'',array('style'=>'min-width:230px;') )?>												
												<?php echo Form::submit('delete', __( 'Delete ', 'the_chameleon' ), array('class'=>'button-primary')); ?>	
											</div>
									    </form>
							</div>
						</div>
				</div>
			</div>

		<?php

			}
			
	
			//language in i18n dir
			function load_theme_textdomain(){
			    load_theme_textdomain('the_chameleon', get_template_directory() . '/i18n');
			}


		
	}	
		
	new TheChameleon();	
	
endif;	
			
	//framework
	require_once( get_template_directory()  . '/thechameleon/bootstrap.php');	
	

?>