<?php

vc_map( array(
	'name' => __( 'SVG Icon', 'ishyoboy_assets' ),
	'base' => 'ish_svg_icon',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-heart',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_icon_sets_selector',
				'heading' => __( 'Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => '',
				'description' => __( 'Choose an icon which will be displayed next to the headline.', 'ishyoboy_assets' ). ' ' .
				__( 'To add your own SVG icons add them in a folder inside "ish-plugins/ishyoboy-shortcodes/assets/frontend/images/icon-sets/" in the child theme root.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Type', 'ishyoboy_assets' ),
				'param_name' => 'type',
				'admin_label' => true,
				'value' => array(
					__( 'Simple', 'ishyoboy_assets' ) => 'simple',
					__( 'Square', 'ishyoboy_assets' ) => 'square',
					__( 'Circle', 'ishyoboy_assets' ) => 'circle',
					__( 'Hexagon', 'ishyoboy_assets' ) => 'hexagon',
					__( 'Hexagon Rounded', 'ishyoboy_assets' ) => 'hexagon_rounded',
				),
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Background Glow', 'ish-sc-plugin' ),
				'param_name' => 'bg_glow',
				'value' => Array(
					__( 'No Glow', 'ish-sc-plugin' ) => '',
					__( 'With Glow', 'ish-sc-plugin' ) => 'yes',
				),
				'description' => __( 'Adds a glow to the background of the icon.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => array( 'square', 'circle', 'hexagon', 'hexagon_rounded' ) ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				//'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				'std' => 'color1',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'type', 'value' => array( 'square', 'circle', 'hexagon', 'hexagon_rounded' ) ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'size',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Number - icon size in pixels', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'URL', 'ishyoboy_assets' ),
				'param_name' => 'url',
				'value' => '',
				//'description' => __( 'Select target URL', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshColorIconView',
) );