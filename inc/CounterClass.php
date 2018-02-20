<?php 
/*
 * CounterClass.php
 * 
 * Copyright 2018 @Nicole Grant <xyz@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
?>
<?php 
class CounterClass{
	public $post_type_name;
	public $post_type_variables;
	public $post_type_labels;
	public $meta_keys;
	public $post_type_args=array();
	public $result= array();
	/**
	 * pseudo-constructor
	 *
	 * @since   1.0.2
	 */
	public static function instance() {
		new self();
	}
	public function __construct( ) {

		 $this->post_type_name = "project" ;
		 $this->post_type_variables = array(
											'has_archive' => TRUE,
													'menu_position' => 10,
													'rewrite' => array(
														'slug' => 'project',
														'with_front' => FALSE,
													),
													'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'revisions' ),
													'menu_icon' => AD_URL . '/resources/img/adlogo.png'
											);
		$this->post_type_labels = array();
		if( ! post_type_exists ( $this-> post_type_name ) ){

			add_action ('init', array( &$this, 'register_post_type' ) );
			$this->add_meta_box( 'Project Fields' , array(
				'project_date' => array("label"=>"Expiry date","classes"=>'datepicker'),
				)
			);

		 }

		 $this->save();

	} //------------end construct------------------------------------------


	public function register_post_type() {

		$name       = ucwords( str_replace( '_', ' ', $this->post_type_name ) );
		$plural     = $name . 's';

		$labels = array_merge(

		// Default
		array(
			'name'                  => _x( $plural, 'post type general name' ),
			'singular_name'         => _x( $name, 'post type singular name' ),
			'add_new'               => _x( 'Add New', strtolower( $name ) ),
			'add_new_item'          => __( 'Add New ' . $name ),
			'edit_item'             => __( 'Edit ' . $name ),
			'new_item'              => __( 'New ' . $name ),
			'all_items'             => __( 'All ' . $plural ),
			'view_item'             => __( 'View ' . $name ),
			'search_items'          => __( 'Search ' . $plural ),
			'not_found'             => __( 'No ' . strtolower( $plural ) . ' found'),
			'not_found_in_trash'    => __( 'No ' . strtolower( $plural ) . ' found in Trash'), 
			'parent_item_colon'     => '',
			'menu_name'             => $plural
		),


		$this->post_type_labels

		);


		$args = array_merge(


		array(
			'label'                 => $plural,
			'labels'                => $labels,
			'public'                => true,
			'show_ui'               => true,
			'supports'              => array( 'title', 'editor', 'thumbnail', ),
			'show_in_nav_menus'     => true,
			'_builtin'              => false,
		),
		// Given args
		$this->post_type_args

		);
		//echo "<pre>"; print_r($args); die;
		// Register the post type
		$this->result[]=register_post_type( $this->post_type_name, $args );    
	}


	/* attach the taxonomy to the post type */
	public function add_taxonomy( $name, $args = array(), $labels = array() ) {

		 if( ! empty( $name ) ) {
		$post_type_name = $this->post_type_name;

		// Taxonomy properties
		$taxonomy_name      = strtolower( str_replace( ' ', '_', $name ) );
		$taxonomy_labels    = $labels;
		$taxonomy_args      = $args;

		if( ! taxonomy_exists( $taxonomy_name ) ) {

		//Capitilize the words and make it plural
		$name       = ucwords( str_replace( '_', ' ', $name ) );
		$plural     = $name . 's';

		// Default labels, overwrite them with the given labels.
		$labels = array_merge(

		// Default
			array(
				'name'                  => _x( $plural, 'taxonomy general name' ),
				'singular_name'         => _x( $name, 'taxonomy singular name' ),
				'search_items'          => __( 'Search ' . $plural ),
				'all_items'             => __( 'All ' . $plural ),
				'parent_item'           => __( 'Parent ' . $name ),
				'parent_item_colon'     => __( 'Parent ' . $name . ':' ),
				'edit_item'             => __( 'Edit ' . $name ),
				'update_item'           => __( 'Update ' . $name ),
				'add_new_item'          => __( 'Add New ' . $name ),
				'new_item_name'         => __( 'New ' . $name . ' Name' ),
				'menu_name'             => __( $name ),
		),

			// Given labels
			$taxonomy_labels

		);

		// Default arguments, overwritten with the given arguments
		$args = array_merge(

		// Default
		array(
			'label'                 => $plural,
			'labels'                => $labels,
			'public'                => true,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'_builtin'              => false,
		),

		// Given
		$taxonomy_args

		);

		// Add the taxonomy to the post type
		add_action( 'init', function() use( $taxonomy_name, $post_type_name, $args ) {
			register_taxonomy( $taxonomy_name, $post_type_name, $args );
			});

		} else {

			add_action( 'init', function() use( $taxonomy_name, $post_type_name ) {
				register_taxonomy_for_object_type( $taxonomy_name, $post_type_name );
			});

		}


		}
	}

	/* Attaches meta boxes to the post type */
	public function add_meta_box( $title, $fields = array(), $context = 'normal', $priority = 'default' ) {

		// We need to know the Post Type name again
		$post_type_name = $this->post_type_name;

		// Meta variables
		$box_id         = strtolower( str_replace( ' ', '_', $title ) );
		$box_title      = ucwords( str_replace( '_', ' ', $title ) );
		$box_context    = $context;
		$box_priority   = $priority;

		// Make the fields global
		global $custom_fields;
		$custom_fields[$title] = $fields;

		add_action( 'admin_init', function() use( $box_id, $box_title, $post_type_name, $box_context, $box_priority, $fields ) {

		add_meta_box( $box_id, $box_title, function( $post, $data ) {
				global $post;

				// Nonce field for some validation
				wp_nonce_field( plugin_basename( __FILE__ ), 'custom_post_type' );

				// Get all inputs from $data
				$custom_fields = $data['args'][0];

				// Get the saved values
				$meta = get_post_custom( $post->ID ,true);

				// Check the array and loop through it
				if( ! empty( $custom_fields ) ) {
					/* Loop through $custom_fields */
					foreach( $custom_fields as $key => $field ) {
						$i=0;
						$field_id_name  = strtolower( str_replace( ' ', '_', $data['id'] ) ) . '_' . strtolower( str_replace( ' ', '_', $key ) );
						$metavalue=$meta[$field_id_name][0];
						$classes=isset($field['classes']) ? $field['classes'] : "";
						$html="";
						$html.="<div class='wqa_ad_q'>";
						$html.= '<label for="' . $field_id_name . '">'.$field['label'].'</label>';
						$html.='<input type="text" class="'.$classes.'" name="custom_meta[' . $field_id_name . ']" id="' . $field_id_name . '" value="' . $metavalue . '" />';
						$html.="</div>";
					}
					echo $html;
				}},
				$post_type_name,
				$box_context,
				$box_priority,
				array( $fields )
				);
			});

	}



	/* Listens for when the post type being saved */
	public function save() {

		   // Need the post type name again
	$post_type_name = $this->post_type_name;

	add_action( 'save_post', function() use( $post_type_name ) {
			// Deny the WordPress autosave function
			if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
			if ( ! wp_verify_nonce( $_POST['custom_post_type'], plugin_basename(__FILE__) ) ) return;

			global $post;
			$post_type_name=strtolower( str_replace( ' ', '',$post_type_name ) );;
			if( isset( $_POST ) && isset( $post->ID ) && get_post_type( $post->ID ) == $post_type_name )
			{
				global $custom_fields;
				// Loop through each meta box
				foreach( $custom_fields as $title => $fields )
				{
					// Loop through all fields
					foreach( $fields as $label => $type )
					{
						$field_id_name  = strtolower( str_replace( ' ', '_', $title ) ) . '_' . strtolower( str_replace( ' ', '_', $label ) );

						update_post_meta( $post->ID, $field_id_name, $_POST['custom_meta'][$field_id_name] );
					}

				}
			}
		});

	}
}
?>
