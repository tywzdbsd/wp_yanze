<?php

if ( is_admin() ){

	do_action( 'ish_sc_before_admin_init' );

	// Register all fields types available in vc_param folder
	$vc_params_path = $this->PLUGIN_DIR_PATH . 'assets/backend/vc_extend/vc_params/';
	if ( is_dir( $vc_params_path ) ) {
		if ($vc_params_dir = opendir( $vc_params_path ) ) {
			while ( ($vc_param = readdir( $vc_params_dir ) ) !== false ) {
				if ( stristr($vc_param, '.php') !== false ) {

					$param_name = strtolower( substr( $vc_param, 0, strpos( $vc_param, '.php') ) );

					add_shortcode_param(
						$param_name,
						Array( &$this, 'custom_params_callback' ),
						IYB_SC_PLUGIN_URI . '/assets/backend/js/vc_params/' . $param_name . '.js'
					);

				}
			}
		}
	}

	// Theme Colors Array
	$ish_theme_colors = $this->get_theme_colors_array();

	// Global attributes available in each shortcode
	$ish_global_params = Array(
		array(
			// OPTIONAL ATTRIBUTES TOGGLE
			'type' => 'ish_buttons_selector_full',
			'heading' => __( 'Use Advanced Global Attributes', 'ishyoboy_assets' ),
			'param_name' => 'global_atts',
			//'description' => __('Display advanced attributes', 'ishyoboy_assets' ),
			'value' => Array(
				__( 'No', 'ishyoboy_assets' ) => '',
				__( 'Yes', 'ishyoboy_assets' ) => 'yes',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Element ID', 'ishyoboy_assets' ),
			'param_name' => 'id',
			'value' => '',
			'description' => __('Use this field to add a unique ID to the element and then refer to it in your css or javascript file.', 'ishyoboy_assets' ),
			'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra CSS Class', 'ishyoboy_assets' ),
			'param_name' => 'css_class',
			'value' => '',
			'description' => __( 'If you wish to style particular content element differently, use this field to add a class name and then refer to it in your css file.', 'ishyoboy_assets' ),
			'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Inline CSS styles', 'ishyoboy_assets' ),
			'param_name' => 'style',
			'value' => '',
			'description' => __( 'Inline CSS style. Used by advanced HTML users to add custom CSS styles', 'ishyoboy_assets' ),
			'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Tooltip text', 'ishyoboy_assets' ),
			'param_name' => 'tooltip',
			'value' => '',
			'description' => __( 'Adds tooltip to the element', 'ishyoboy_assets' ),
			'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			)
		),
		array(
			'type' => 'ish_color_selector',
			'heading' => __( 'Tooltip Background Color', 'ishyoboy_assets' ),
			'param_name' => 'tooltip_color',
			'std' => 'color1',
			'value' => $ish_theme_colors,
			'description' => __( 'Change the color of the tooltip background', 'ishyoboy_assets' ),
			'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			)
		),
		array(
			'type' => 'ish_color_selector',
			'heading' => __( 'Tooltip Text Color', 'ishyoboy_assets' ),
			'param_name' => 'tooltip_text_color',
			'std' => 'color3',
			'value' => $ish_theme_colors,
			'description' => __( 'Change the color of the tooltip text', 'ishyoboy_assets' ),
			'dependency' => array(
				'element' => 'global_atts', // Must be the same as param_name param for shortcode attribute
				'value' => Array('yes'), // List of linked element's values which will allow to display param
			)
		)
	);

	// Global Alignment array
	$ish_alignmment_params = array(
		__( 'No Alignment', 'ishyoboy_assets' ) => '',
		__( 'Align Left', 'ishyoboy_assets' ) => 'left',
		__( 'Align Center', 'ishyoboy_assets' ) => 'center',
		__( 'Align Right', 'ishyoboy_assets' ) => 'right',
	);
	$ish_alignmment_params_reduced = array(
		__( 'Align Left', 'ishyoboy_assets' ) => 'left',
		__( 'Align Right', 'ishyoboy_assets' ) => 'right',
	);

	// Global icons list
	$ish_available_icons_no_empty = $this->get_available_icons_array();
	$ish_available_icons = array_merge( array( __( 'No Icon', 'ishyoboy_assets' ) => ''), $ish_available_icons_no_empty );
	$ish_available_list_icons = $this->get_available_lists_icons_array();
	//$ish_available_icon_sets = $this->get_available_icon_sets_array();

	$ish_available_sliders = $this->get_available_sliders_array();
	$ish_available_sidebars = $this->get_available_sidebars_array();
	$ish_available_menus = $this->get_available_menus_array();
	$ish_image_sizes = $this->get_available_image_sizes_array();

	$ish_post_categories = $this->get_available_taxonomy_terms('category');
	$ish_post_tags = $this->get_available_taxonomy_terms('post_tag');
	$ish_post_formats = $this->get_available_post_formats();
	$ish_portfolio_categories = $this->get_available_taxonomy_terms('portfolio-category');

	// Fix Begin - VC cannot handle empty arrays in "value" field. Either empty string or array with items
	$ish_post_categories = ( empty( $ish_post_categories ) ) ? '' : $ish_post_categories;
	$ish_post_tags = ( empty( $ish_post_tags ) ) ? '' : $ish_post_tags;
	$ish_post_formats = ( empty( $ish_post_formats ) ) ? '' : $ish_post_formats;
	$ish_portfolio_categories = ( empty( $ish_portfolio_categories ) ) ? '' : $ish_portfolio_categories;
	$ish_available_menus = ( empty( $ish_available_menus ) ) ? '' : $ish_available_menus;
	// Fix End

	$ish_sc_paginated_count = 0;

	// Variables necessary for row decorations paddings of previous sections
	global $ish_rows_count, $ish_rows_replace;
	$ish_rows_count = 0;
	$ish_rows_replace = Array();
	// Necessary for content entered before the VC rows by "the_content" filter
	$ish_rows_replace[] = ' ish-decor-padding-0 ';

	// Necessary for Autosuggest fields:
	global $ish_autosuggest_count;
	$ish_autosuggest_count = 0;

	global $pagenow;

	require_once( 'shortcodes/vc_row.php' );
	require_once( 'shortcodes/vc_column.php' );
	require_once( 'shortcodes/ish_button.php' );
	require_once( 'shortcodes/ish_box.php' );
	require_once( 'shortcodes/ish_divider.php' );
	require_once( 'shortcodes/ish_separator.php' );
	require_once( 'shortcodes/ish_headline.php' );
	require_once( 'shortcodes/ish_icon.php' );
	require_once( 'shortcodes/ish_svg_icon.php' );
	require_once( 'shortcodes/ish_icon_button_set.php' );
	require_once( 'shortcodes/ish_image.php' );
	require_once( 'shortcodes/ish_list.php' );
	require_once( 'shortcodes/ish_quote.php' );
	require_once( 'shortcodes/ish_skills.php' );
	require_once( 'shortcodes/ish_table.php' );
	require_once( 'shortcodes/ish_pricing_table.php' );
	require_once( 'shortcodes/ish_embed.php' );
	require_once( 'shortcodes/ish_map.php' );
	require_once( 'shortcodes/ish_social_share.php' );
	require_once( 'shortcodes/ish_slidable.php' );
	require_once( 'shortcodes/ish_sidebar.php' );
	require_once( 'shortcodes/ish_menu.php' );
	require_once( 'shortcodes/ish_portfolio.php' );
	// Shortcodes for single PRTFOLIO-POST only
	if ( $this->is_post_type_admin_edit_page('portfolio-post') || ( defined('DOING_AJAX') && DOING_AJAX ) )
	{
		require_once( 'shortcodes/ish_portfolio_prev_next.php' );
		require_once( 'shortcodes/ish_portfolio_categories.php' );
		require_once( 'shortcodes/ish_portfolio_gallery.php' );
	}
	// Shortcodes for single POST only
	if ( $this->is_post_type_admin_edit_page('post') || ( defined('DOING_AJAX') && DOING_AJAX ) )
	{
		require_once( 'shortcodes/ish_blog_media.php' );
	}
	require_once( 'shortcodes/ish_recent_posts.php' );
	require_once( 'shortcodes/ish_tabs.php' );
	require_once( 'shortcodes/ish_tgg_acc.php' );
	require_once( 'shortcodes/vc_updates.php' );
	require_once( 'shortcodes/ish_cf7.php' );

	do_action( 'ish_sc_after_admin_init' );

}