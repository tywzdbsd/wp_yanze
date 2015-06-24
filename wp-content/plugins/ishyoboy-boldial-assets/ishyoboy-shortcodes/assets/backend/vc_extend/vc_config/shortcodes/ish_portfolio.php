<?php

vc_map( array(
	'name' => __( 'Portfolio', 'ishyoboy_assets' ),
	'base' => 'ish_portfolio',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	//'description' => __( 'aaa', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-briefcase',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Open on click', 'ishyoboy_assets' ),
				'param_name' => 'open_type',
				'admin_label' => true,
				'value' => Array(
					__( 'Detail Page', 'ishyoboy_assets') => '',
					__( 'Pop-up window with image', 'ishyoboy_assets') => 'image',
				),
				'description' => __( 'Define what to open after a user clicks on a portfolio item.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Animation', 'ish-sc-plugin' ),
				'param_name' => 'animation',
				'admin_label' => true,
				'value' => Array(
					__( 'Zoom In', 'ish-sc-plugin') => '', // zoomin - Default is zoomin
					__( 'Zoom In & Rotate', 'ish-sc-plugin') => 'zoomin-rotate',
					__( '3D Flip', 'ish-sc-plugin') => 'flip',
					__( '3D Cube', 'ish-sc-plugin') => '3dcube',
				),
				'description' => __( 'Animation style on mouse over.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Text Animation', 'ish-sc-plugin' ),
				'param_name' => 'text_animation',
				'admin_label' => true,
				'value' => Array(
					__( 'Vertical', 'ish-sc-plugin') => '', // none - Default is zoomin
					__( 'Horizontal', 'ish-sc-plugin') => 'horizontal',
				),
				'description' => __( 'Text animation on mouse over.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'animation', 'value' => array('', 'zoomin-rotate') ),
			),
			array(
				//'type' => 'dropdown',
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Animation Direction', 'ish-sc-plugin' ),
				'param_name' => 'direction',
				'admin_label' => true,
				'value' => Array(
					__( 'Left', 'ish-sc-plugin') => '', // left - default is left
					__( 'Right', 'ish-sc-plugin') => 'right',
					__( 'Top', 'ish-sc-plugin') => 'top',
					__( 'Bottom', 'ish-sc-plugin') => 'bottom',
				),
				'description' => __( 'Direction of the animation on mouse over.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'animation', 'value' => array('flip', '3dcube') ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display on Mouse Over', 'ish-sc-plugin' ),
				'param_name' => 'inverse',
				'admin_label' => true,
				'value' => Array(
					__( 'Title & Category', 'ish-sc-plugin') => '',
					__( 'Image', 'ish-sc-plugin') => 'inverse',
				),
				'description' => __( 'Direction of the animation on mouse over.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Categories', 'ish-sc-plugin' ),
				'param_name' => 'category',
				'std' => '',
				'value' => $ish_portfolio_categories,
				'description' => __( 'Comma separated list of categories to be displayed.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_autosuggest',
				'heading' => __( 'Exclude categories', 'ish-sc-plugin' ),
				'param_name' => 'exclude_category',
				'std' => '',
				'value' => $ish_portfolio_categories,
				'description' => __( 'Comma separated list of categories not to be excluded.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Display Filter', 'ish-sc-plugin' ),
				'param_name' => 'filter',
				'admin_label' => true,
				'value' => Array(
					__( 'No filter', 'ish-sc-plugin') => '',
					__( 'Fade', 'ish-sc-plugin') => 'fade',
					__( 'Fade & Reorganize', 'ish-sc-plugin') => 'organize',
					__( 'Link to category page', 'ish-sc-plugin') => 'link',
				),
				'description' => __( 'Categories buttons for users to filter the items.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Filter Title', 'ishyoboy_assets' ),
				'param_name' => 'filter_title',
				'value' => '',
				'description' => __( 'The title displayed above the filters.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'filter', 'not_empty' => true ),

			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Items Order', 'ish-sc-plugin' ),
				'param_name' => 'order',
				'admin_label' => true,
				'value' => Array(
					__( 'Latest First') => '', // DESC
					__( 'Oldest First') => 'ASC',
				),
				'description' => __( 'Which Portfolio items to display first.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Items Count', 'ish-sc-plugin' ),
				'param_name' => 'per_page',
				'value' => '',
				'description' => __( 'Number of items to display (when pagination active - number of items per page). Leave empty or set to -1 to see all items.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Pagination', 'ish-sc-plugin' ),
				'param_name' => 'pagination',
				'admin_label' => true,
				'value' => Array(
					__( 'No') => '',
					__( 'Yes', 'ish-sc-plugin') => 'yes',
				),
				'description' => __( 'Display Pagination under the portfolio. If more portfolios are displayed on one page, ony the first will have pagination displayed.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Columns Count', 'ish-sc-plugin' ),
				'param_name' => 'columns',
				'admin_label' => true,
				'std' => 4,
				'value' => Array(
					'8' => 8,
					'7' => 7,
					'6' => 6,
					'5' => 5,
					'4' => 4,
					'3' => 3,
					'2' => 2,
				),
				'description' => __( 'Number of columns to display in the Portfolio Grid', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Masonry Layout', 'ish-sc-plugin' ),
				'param_name' => 'masonry',
				'admin_label' => true,
				'value' => Array(
					__( 'No', 'ish-sc-plugin') => '',
					__( 'Yes', 'ish-sc-plugin') => 'yes',
				),
				'description' => __( 'Display items with different heights and widths.', 'ishyoboy_assets' ),

			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Show Categories', 'ish-sc-plugin' ),
				'param_name' => 'show_categories',
				'admin_label' => true,
				'value' => Array(
					__( 'No', 'ish-sc-plugin') => '',
					__( 'Yes', 'ish-sc-plugin') => 'yes',
				),
				'description' => __( 'Display item category on mouse over.', 'ishyoboy_assets' ),
			),

		),
		$ish_global_params
	)
) );