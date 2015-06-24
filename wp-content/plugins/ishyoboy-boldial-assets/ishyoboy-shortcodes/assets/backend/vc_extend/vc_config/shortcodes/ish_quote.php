<?php

vc_map( array(
	'name' => __( 'Quote', 'ishyoboy_assets' ),
	'base' => 'ish_quote',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-quote',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Quote Author', 'ishyoboy_assets' ),
				'param_name' => 'author',
				'value' => 'The Author',
				//'description' => __( 'Please enter the content of the quote.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'URL', 'ishyoboy_assets' ),
				'param_name' => 'url',
				'value' => '',
				//'description' => __( 'Select target URL', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Quote content', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-list',
				'param_name' => 'content',
				'value' => __( 'I am a quote. Click edit button to change this text.', 'ishyoboy_assets' ),
				//'description' => __( 'Please enter the content of the quote.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Regular size', 'ishyoboy_assets' ) => '',
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'Choose text size', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => array(
					__( 'Align Left', 'ishyoboy_assets' ) => 'left',
					__( 'Align Center', 'ishyoboy_assets' ) => 'center',
					__( 'Align Right', 'ishyoboy_assets' ) => 'right',
				),
				//'description' => __( 'Choose ', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),

			),
		),
		$ish_global_params
	),
	'js_view' => 'IshDefaultView',
) );