<?php

vc_map(
	array(
		'name' => __( 'Separator', 'ishyoboy_assets' ),
		'base' => 'ish_separator',
		'class' => '',
		'show_settings_on_create' => false,
		'description' => __( 'Horizontal separator', 'ishyoboy_assets' ),
		'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
		'icon' => 'ish-icon-ellipsis',
		'weight' => 900,
		'params' => array_merge(
			array(
				array(
					'type' => 'ish_color_selector',
					'heading' => __( 'Color', 'ish-sc-plugin' ),
					'param_name' => 'color',
					'std' => 'color1',
					'value' => $ish_theme_colors,
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Separator Type', 'ishyoboy_assets' ),
					'param_name' => 'type',
					'admin_label' => true,
					'value' => array(
						__( 'Bold Line', 'ishyoboy_assets' ) => 'bold',
						__( 'Thin Line', 'ishyoboy_assets' ) => 'thin',
						__( 'Thin & Bold Line', 'ishyoboy_assets' ) => 'thin-bold',
					),
					//'description' => __( 'Choose element size', 'ishyoboy_assets' ),
				),
				array(
					'type' => 'ish_alignment_selector',
					'heading' => __( 'Alignment', 'ishyoboy_assets' ),
					'param_name' => 'align',
					'value' => $ish_alignmment_params,
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Width in %', 'ish-sc-plugin' ),
					'param_name' => 'width_percent',
					'value' => '',
					'description' => __( 'Enter number to set the percentual width. E.g. "100" for 100%.', 'ishyoboy_assets' ),
					'dependency' => Array( 'element' => 'type', 'value' => Array( 'thin', 'thin-bold' ) ),
				),
			),
			$ish_global_params
		),
		'js_view' => 'IshDefaultView',
	)
);