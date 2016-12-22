<?php
/**
 * SSM External Resources
 *
 * @package   SSM_External_Resources
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_External_Resources
 */
class SSM_External_Resources_Registrations {

	public $post_type = 'external-resource';

	public $taxonomies = array( 'external-resource-type' );

	public function init() {
		// Add the SSM External Resources and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_External_Resources_Registrations::register_post_type()
	 * @uses SSM_External_Resources_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'External Resources', 'ssm-external-resources' ),
			'menu_name'               => __( 'Ext. Resources', 'ssm-external-resources' ),
			'singular_name'      => __( 'External Resource', 'ssm-external-resources' ),
			'add_new'            => __( 'Add Resource', 'ssm-external-resources' ),
			'add_new_item'       => __( 'Add New Resource', 'ssm-external-resources' ),
			'edit_item'          => __( 'Edit Resource', 'ssm-external-resources' ),
			'new_item'           => __( 'New Resource', 'ssm-external-resources' ),
			'view_item'          => __( 'View Resource', 'ssm-external-resources' ),
			'search_items'       => __( 'Search Resources', 'ssm-external-resources' ),
			'not_found'          => __( 'No resources found', 'ssm-external-resources' ),
			'not_found_in_trash' => __( 'No resources in the trash', 'ssm-external-resources' ),
		);

		$supports = array(
			'title',
		);

		$args = array(
			'labels'          		=> $labels,
			'supports'        		=> $supports,
			'public'          		=> false,
			'capability_type' 		=> 'page',
			'publicly_queriable'	=> true,
			'show_ui' 						=> true,
			'show_in_nav_menus' 	=> false,
			'rewrite'         		=> false,
			'menu_position'   		=> 30,
			'menu_icon'       		=> 'dashicons-admin-links',
			'has_archive'					=> false,
			'exclude_from_search'	=> true,
		);

		$args = apply_filters( 'SSM_External_Resources_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Resource Types', 'ssm-external-resources' ),
			'singular_name'              => __( 'Resource Type', 'ssm-external-resources' ),
			'menu_name'                  => __( 'Type', 'ssm-external-resources' ),
			'edit_item'                  => __( 'Edit Resource Type', 'ssm-external-resources' ),
			'update_item'                => __( 'Update Resource Type', 'ssm-external-resources' ),
			'add_new_item'               => __( 'Add New Resource Type', 'ssm-external-resources' ),
			'new_item_name'              => __( 'New Resource Type Name', 'ssm-external-resources' ),
			'parent_item'                => __( 'Parent Resource Type', 'ssm-external-resources' ),
			'parent_item_colon'          => __( 'Parent Resource Type:', 'ssm-external-resources' ),
			'all_items'                  => __( 'All Reource Types', 'ssm-external-resources' ),
			'search_items'               => __( 'Search Reource Types', 'ssm-external-resources' ),
			'popular_items'              => __( 'Popular Resource Types', 'ssm-external-resources' ),
			'separate_items_with_commas' => __( 'Separate resource types with commas', 'ssm-external-resources' ),
			'add_or_remove_items'        => __( 'Add or remove resource types', 'ssm-external-resources' ),
			'choose_from_most_used'      => __( 'Choose from the most used resource types', 'ssm-external-resources' ),
			'not_found'                  => __( 'No resource types found.', 'ssm-external-resources' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => false,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => false,
			'hierarchical'      => true,
			'rewrite'           => false,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'SSM_External_Resources_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}