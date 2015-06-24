<?php

vc_map( array(
	'name' => __( 'Social Share Bar', 'ishyoboy_assets' ),
	'base' => 'ish_social_share',
	'class' => '',
	'show_settings_on_create' => false,
	'category' => Array( __('Social', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-share',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => array(
					__( 'No Alignment', 'ishyoboy_assets' ) => '',
					__( 'Align Left', 'ishyoboy_assets' ) => 'left',
					__( 'Align Right', 'ishyoboy_assets' ) => 'right',
				),
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	)
) );