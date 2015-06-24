<?php

vc_map( array(
	'name' => __( 'Portfolio Categories', 'ishyoboy_assets' ),
	'base' => 'ish_portfolio_categories',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'List of categories', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-briefcase',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Link', 'ishyoboy_assets' ),
				'param_name' => 'links',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Link categories to category pages', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display Categories As', 'ish-sc-plugin' ),
				'param_name' => 'behavior',
				'value' => Array(
					__( 'Text only', 'ish-sc-plugin' ) => '',
					__( 'Buttons', 'ish-sc-plugin' ) => 'buttons',
				),
				//'description' => __( '', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'links', 'value' => '' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'behavior', 'value' => 'buttons' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	)
) );