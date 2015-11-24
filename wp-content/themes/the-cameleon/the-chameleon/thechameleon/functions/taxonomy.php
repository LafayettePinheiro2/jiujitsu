<?php
if ( ! class_exists('TheChameleon_Taxonomy') ) :	
	/**
	   * The Chameleon Taxonomy
	   * 
	   * 
	   * @package    WordPress
	   * @subpackage The Chameleon
	   * @since The Chameleon 1.0
	   * @author     Goran Petrovic <goran.petrovic@godev.rs>
	   */	
	class TheChameleon_Taxonomy extends TheChameleon{
						
		 function __construct() {

			parent::register_globals();
			
			// CATEGORY
			add_action('category_edit_form_fields', array( $this, 'term_custom_setting') );
			add_action('edited_category', array( $this,  'save_term_setting' ), 10, 2);

			add_action('category_add_form_fields',array( $this,  'term_custom_setting' ) );
			add_action('created_category', array( $this, 'save_term_setting'), 10, 2);

			// TAG	
			add_action('post_tag_edit_form_fields', array( $this, 'term_custom_setting') );
			add_action('edited_post_tag',  array( $this, 'save_term_setting') );

			add_action('post_tag_add_form_fields', array( $this,  'term_custom_setting' ) );
			add_action('created_post_tag', array( $this, 'save_term_setting') , 10, 2);

			//register term globals
			add_action('wp',  array( $this, 'register_globals_term_options') );
		}
		
		
		/**
		 * Hook, get all trem meta
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/
		function register_globals_term_options() {

			if ( is_category() or is_tax() ) :

				global $TheChameleon_term_options;

				$term_id = get_queried_object()->term_id;		
				$tax 	 = get_queried_object()->taxonomy;
				
				$TheChameleon_term_options = get_option( $tax.'_term_'.$term_id );

			endif;
		}
	
		
		/**
		 * Hook, save  trem meta
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/
		function save_term_setting( $term_id ) {

			// Check the user's permissions.
			if ( ! current_user_can( 'manage_categories', $term_id ) )
				return $term_id;
								
			if ( ! $term_id ) return;

			$tax = ( !empty( $_POST['taxonomy_name'] ) ) ? $_POST['taxonomy_name'] : NULL;

			if ( ! empty( $_POST ) and ! empty( $tax ) ) 
				update_option( $tax.'_term_'.$term_id, $_POST );

		}
		
		/**
		 * Terms setting
		 *
		 * @author Goran Petrovic
		 * @since 1.0
		 *
		 * @return 
		 **/		
		function term_custom_setting( $tag ) {

			$tax = ( $_GET['taxonomy'] ) ? $_GET['taxonomy'] : '';

			if ( ! empty( $tag->term_id ) ) :	
				$data = get_option( $tax.'_term_'.$tag->term_id) ;
			endif;  	 ?>   
					
		    <tr class="form-field">
		        <th scope="row" valign="top">
					<label for="template"><?php _e( 'Template', 'the_chameleon' ) ?></label>
				</th>
		        <td>
					<input type="hidden" name="taxonomy_name" value="<?php echo $tax ?>" >

					<?php 	$options = 	array(	
											''							=> 'Default ',
											'loop-fullwidth'			=> 'Full Width',
											'loop-left-sidebar'			=> 'Left Sidebar',
											'loop-right-sidebar'		=> 'Right Sidebar',
											'loop-left-right-sidebar'	=> 'Double Sidebars',
											'loop-two-left-sidebar'		=> 'Double Left Sidebars',
											'loop-two-right-sidebar'	=> 'Double Right Sidebars'
										);

					echo Form::select( 'template', $options, ( !empty( $data ) and !empty( $data['template'] ) ) ? $data['template'] : NULL , array('id'=>'template', 'class'=>'postform', 'style'=>'width:210px;') ); ?>				
					<p class="description"><?php _e( 'The Template is possibility the term page show on a wide range of ways.', 'the_chameleon' ) ?></p>				
		        </td>
		    </tr>

		    <tr class="form-field">
		        <th scope="row" valign="top">
					<label for="view"><?php _e( 'Layout', 'the_chameleon' ) ?></label>
				</th>
		        <td>
					<?php echo Form::select( 'col', $this->column_options, ( !empty($data) and !empty( $data['col'] ) ) ? $data['col'] : NULL , array( 'id'=>'col', 'class'=>'postform', 'style'=>'width:210px;') ); ?>
		            <p class="description"><?php _e( 'The Layout is possibility that show posts in multiple columns.', 'the_chameleon' ) ?></p>
		        </td>
		    </tr>

		    <tr class="form-field">
		        <th scope="row" valign="top">
					<label for="posts_per_page"><?php _e( 'Posts per page', 'the_chameleon' ) ?></p></label>
				</th>
		        <td>
					<?php echo Form::input('posts_per_page', (  !empty($data) and !empty( $data['posts_per_page'] ) ) ? $data['posts_per_page'] : '', array('id'=>'posts_per_page', 'class'=>'postform',  'type'=>'number', 'style'=>'width:50px;') ) ?>
		            <p class="description"><?php _e( 'Number of posts that will be shown in this term.', 'the_chameleon' ) ?></p>
		        </td>
		    </tr>

		    <tr class="form-field">
		        <th scope="row" valign="top">
					<label for="product_package_ship_price"><?php _e( 'Sidebars', 'the_chameleon' ) ?></label>
				</th>
				
		        <td>
			  		<?php echo Form::select('sidebar_first',  array_combine( array_unique( $this->sidebars )  , array_unique( $this->sidebars )  ),   ( !empty( $data ) and !empty( $data['sidebar_first'] ) ) ? $data['sidebar_first'] : NULL  ,  array( 'id' => 'sidebar_first', 'class'=>'postform', 'title' => 'First Sidebar', 'style'=>'width:210px;' ) ); ?>
					<br />
					<?php echo Form::select('sidebar_second', array_combine( array_unique( $this->sidebars )  , array_unique( $this->sidebars )  ) ,  ( !empty( $data ) and !empty( $data['sidebar_second'] ) ) ? $data['sidebar_second'] : NULL , array( 'id' => 'sidebar_second', 'class'=>'postform', 'title' => 'Secund Sidebar', 'style'=>'width:210px;' ) ); ?>		
		            <p class="description"><?php _e( 'SThe Sidebars is possibility to choose different sidebars for left and right side. <a href="<?php echo site_url() ?>/wp-admin/widgets.php" target="_new">Add new sidebar</a>', 'the_chameleon' ) ?></p>
		        </td>
		    </tr>

			<tr class="form-field">
			    <th scope="row" valign="top">
					<label for="title_size"><?php _e( 'Title', 'the_chameleon' ) ?></label>
				</th>
			    <td>
					<?php $options 	= 	array(	
											''			=> 'Default',
											'hide'		=> 'Hide',						
											'20'		=> "20",										
											'25'		=> "25",
											'30'		=> "30",	
											'35'		=> "35",	
											'40'		=> "40",
											'45'		=> "45",		
											'50'		=> "50",
											'55'		=> "55",
											'60'		=> "60",
											'65'		=> "65",
											'70'		=> "70",
											'75'		=> "75",
											'80'		=> "80",
											'85'		=> "85",
											'90'		=> "90",
											'95'		=> "95",
											'100'		=> "100",
											'120'		=> "120",
											'140'		=> "140",
											'160'		=> "160",
											'180'		=> "180",
											'210'		=> "210"
										);

						echo Form::select( 'title_size', $options, ( !empty( $data ) and !empty( $data['title_size'] ) ) ? $data['title_size'] : '' , array( 'id' => 'title_size', 'class'=>'postform', 'style'=>'width:210px;' ) ); ?>						
			            <p class="description"><?php _e( 'The Title is possibility to reduce the title of articles. Usually can be used when you choose layout in two or more columns to align more posts.', 'the_chameleon' ) ?></p>
			        </td>
			    </tr>

			 <tr class="form-field">
		        <th scope="row" valign="top">
					<label for="post_title"><?php _e( 'Meta', 'the_chameleon' ) ?></label>
				</th>
		        <td>
					<?php echo Form::input( 'meta_pattern', ( !empty( $data ) and !empty( $data['meta_pattern'] ) ) ? $data['meta_pattern'] : '', array( 'id' => 'meta_pattern', 'class'=>'postform', 'style'=>'width:100%;' ) ); ?>	
		            <p class="description"><?php _e( 'The Meta is an option to define hoe to display meta appearance details with help of patterns. The available options are %author%, %date%, %category%, %comments% or to enter off and unplug meta completely. Example Example ( By %author% on %date% in %category% | %comments% ).', 'the_chameleon' ) ?></p>
		        </td>
		    </tr>

			 <tr class="form-field">
		        <th scope="row" valign="top">
					<label for="excerpt_size"><?php _e( 'Text', 'the_chameleon' ) ?></label>
				</th>
		        <td><?php $options = array(	
										'full_excerpt' 	=> 'Default',
										'hide'			=> 'Hide',
										'full_content'	=> "Full Content",
										'80'			=> "80",
										'100'			=> "100",
										'120'			=> "120",
										'140'			=> "140",	
										'160'			=> "160",
										'180'			=> "180",
										'200'			=> "200",
										'220'			=> "220",
										'240'			=> "240",
										'280'			=> "280",
										'300'			=> "300",
										'320'			=> "320",
										'340'			=> "340",
										'360'			=> "360",
										'380'			=> "380",
										'420'			=> "420"
									);

					echo Form::select( 'excerpt_size', $options, ( !empty( $data ) and !empty( $data['excerpt_size'] ) ) ? $data['excerpt_size'] : '' , array( 'id' => 'excerpt_size', 'class'=>'postform', 'style'=>'width:210px;' ) ); ?>
		            <p class="description"><?php _e( 'The Text is possibility to short or extend text that appears in posts as a brief description or to display it in entirety.', 'the_chameleon' ) ?></p>
		        </td>
		    </tr>

		    <?php
		}
	
	}
	
	new TheChameleon_Taxonomy();
		
endif;	


