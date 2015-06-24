<?php

// Create the post type
if ( !function_exists('ishyoboy_register_slides_posttype') ){
	function ishyoboy_register_slides_posttype() {
		$labels = array(
			'name'              => _x( 'Slides', 'post type general name', 'ishyoboy_assets' ),
			'singular_name'     => _x( 'Slide', 'post type singular name', 'ishyoboy_assets' ),
			'add_new'           => __( 'Add New Slide', 'ishyoboy_assets' ),
			'add_new_item'      => __( 'Add New Slide', 'ishyoboy_assets' ),
			'edit_item'         => __( 'Edit Slide', 'ishyoboy_assets' ),
			'new_item'          => __( 'New Slide', 'ishyoboy_assets' ),
			'view_item'         => __( 'View Slide', 'ishyoboy_assets' ),
			'search_items'      => __( 'Search Slides', 'ishyoboy_assets' ),
			'not_found'         => __( 'Slide', 'ishyoboy_assets' ),
			'not_found_in_trash'=> __( 'Slide', 'ishyoboy_assets' ),
			'parent_item_colon' => __( 'Slide', 'ishyoboy_assets' ),
			'menu_name'         => __( 'Slides', 'ishyoboy_assets' )
		);
		$taxonomies = array();
		$supports = apply_filters( 'ish_cpt_plugin_slides_post_type_supports', array( 'title', 'editor', 'thumbnail', 'page-attributes' ) );
		$post_type_args = array(
			'labels'            => $labels,
			'singular_label'    => __( 'Slide' , 'ishyoboy_assets' ),
			'public'            => true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'publicly_queryable'=> false,
			'exclude_from_search' => true,
			'query_var'         => true,
			'capability_type'   => 'post',
			'has_archive'       => false,
			'hierarchical'      => false,
			'rewrite'           => array(
				'slug' => _x( 'slides', 'URL slug', 'ishyoboy_assets' ), // "URL slug" is necessary for WPML to be able to translate the slug
				'with_front' => false
			),
			'supports'          => $supports,
			'menu_position'     => null,
			'menu_icon'         => null, //get_template_directory_uri() . '/inc/slider/images/icon.png',
			'taxonomies'        => $taxonomies
		);
		register_post_type( 'ishyoboy_slides' , $post_type_args );
	}
}

/*******************************************************************************************************************
 * Create Filter for Slides post type
 */
if ( !function_exists('ishyoboy_register_slides_category') ){
	function ishyoboy_register_slides_category()
	{
		$labels = array(
			'name'                          => __( 'Sliders', 'ishyoboy_assets' ),
			'singular_name'                 => __( 'Slider', 'ishyoboy_assets' ),
			'search_items'                  => __( 'Search Sliders', 'ishyoboy_assets' ),
			'popular_items'                 => __( 'Popular Sliders', 'ishyoboy_assets' ),
			'all_items'                     => __( 'All Sliders', 'ishyoboy_assets' ),
			'parent_item'                   => __( 'Parent Slider', 'ishyoboy_assets' ),
			'edit_item'                     => __( 'Edit Slider', 'ishyoboy_assets' ),
			'update_item'                   => __( 'Update Slider', 'ishyoboy_assets' ),
			'add_new_item'                  => __( 'Add New Slider', 'ishyoboy_assets' ),
			'new_item_name'                 => __( 'New Slider', 'ishyoboy_assets' ),
			'separate_items_with_commas'    => __( 'Separate Sliders with commas', 'ishyoboy_assets' ),
			'add_or_remove_items'           => __( 'Add or remove Slider', 'ishyoboy_assets' ),
			'choose_from_most_used'         => __( 'Choose from most used Sliders', 'ishyoboy_assets' )
		);
		$args = array(
			'labels'                        => $labels,
			'public'                        => true,
			'hierarchical'                  => true,
			'show_ui'                       => true,
			'show_in_nav_menus'             => true,
			'query_var'                     => true
		);
		register_taxonomy( 'slides_categories', 'ishyoboy_slides', $args );
	}
}

/*******************************************************************************************************************
 * Functions necessary for the back-end only
 */
if ( is_admin() ){

	/*******************************************************************************************************************
	 * Backend columns
	 */
	if ( !function_exists('ishyoboy_ishyoboy_slides_edit_columns') ){
		function ishyoboy_ishyoboy_slides_edit_columns( $columns ){
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => __( 'Title', 'ishyoboy_assets' ),
				"slider" => __( 'Slider', 'ishyoboy_assets' ),
				"thumbnail" => __( 'Image', 'ishyoboy_assets' ),
				"menu_order" => __( 'Order', 'ishyoboy_assets' ),
				"author" => __( 'Author', 'ishyoboy_assets' ),
				"date" => __( 'Date', 'ishyoboy_assets' )
			);
			return $columns;
		}
	}
	add_filter("manage_edit-ishyoboy_slides_columns", "ishyoboy_ishyoboy_slides_edit_columns");

	if ( !function_exists('ishyoboy_ishyoboy_slides_custom_columns') ){
		function ishyoboy_ishyoboy_slides_custom_columns($column){
			global $post;

			switch ($column)
			{
				case "thumbnail":
					the_post_thumbnail('thumbnail');
					break;
				case "slider":
					echo get_the_term_list($post->ID, 'slides_categories', '', ', ','');
					break;
				case "menu_order":
					echo $post->menu_order;
					break;
			}
		}
	}
	add_action( 'manage_ishyoboy_slides_posts_custom_column' , 'ishyoboy_ishyoboy_slides_custom_columns', 10, 2 );


	/**
	 * make column sortable
	 */
	if ( !function_exists('ishyoboy_ishyoboy_slides_sortable_columns') ){
		function ishyoboy_ishyoboy_slides_sortable_columns($columns){
			$columns['menu_order'] = 'menu_order';
			/*$columns['slider'] = 'slider';*/
			return $columns;
		}
	}
	add_filter('manage_edit-ishyoboy_slides_sortable_columns','ishyoboy_ishyoboy_slides_sortable_columns');


	/**
	 * Add dropdown filter for sliders
	 */
	if ( !function_exists('restrict_listings_by_business') ){
		function restrict_listings_by_business() {
			global $typenow, $wp_query;
			if ( isset($typenow) && 'ishyoboy_slides' == $typenow ) {

				$taxonomy = 'slides_categories';

				$term = isset( $wp_query->query[$taxonomy]) ? $wp_query->query[$taxonomy] : '';

				$slider_taxonomy = get_taxonomy($taxonomy);
				wp_dropdown_categories(array(
					'show_option_all' =>  __("Show all", 'ishyoboy_assets') . ' ' . $slider_taxonomy->label,
					'taxonomy'        =>  $taxonomy,
					'name'            =>  $taxonomy,
					'orderby'         =>  'name',
					'selected'        =>  $term,
					'hierarchical'    =>  false,
					'depth'           =>  0,
					'show_count'      =>  true, // Show # listings in parens
					'hide_empty'      =>  false, // Don't show businesses w/o listings
				));
			}
		}
	}
	add_action('restrict_manage_posts','restrict_listings_by_business');

	if ( !function_exists('taxonomy_filter_ishyoboy_slides_request') ){
		function taxonomy_filter_ishyoboy_slides_request( $query ) {
			global $pagenow, $typenow;

			if ( isset($pagenow) && 'edit.php' == $pagenow ) {

				$filters = get_object_taxonomies( $typenow );
				if ( isset($filters) && '' != $filters){
					foreach ( $filters as $tax_slug ) {
						$var = &$query->query_vars[$tax_slug];
						if ( isset($var) && '' != $var ) {
							$term = get_term_by( 'id', $var, $tax_slug );
							if ( isset($term) && '' !=  $term ) {
								$var = $term->slug;
							}
						}
					}
				}
			}
		}
	}
	add_filter( 'parse_query', 'taxonomy_filter_ishyoboy_slides_request' );

	if ( !function_exists('ishyoboy_slider_post_thumbnails') ){
		function ishyoboy_slider_post_thumbnails() {

			$supported_types = get_theme_support( 'post-thumbnails' );

			if ( $supported_types === false ) {
				add_theme_support( 'post-thumbnails', array( 'ishyoboy_slides' ) );
			}
			elseif( true === $supported_types){

			}
			elseif( is_array( $supported_types[0] ) ){
				$supported_types[0][] = 'ishyoboy_slides';
				add_theme_support( 'post-thumbnails', $supported_types[0] );
			}

		}
	}

}

/* *********************************************************************************************************************
 * Register post type
 */
add_action( 'init', 'ishyoboy_register_slides_posttype' );
add_action( 'init', 'ishyoboy_register_slides_category', 0 );
//add_action( 'after_theme_setup','ishyoboy_slider_post_thumbnails' );