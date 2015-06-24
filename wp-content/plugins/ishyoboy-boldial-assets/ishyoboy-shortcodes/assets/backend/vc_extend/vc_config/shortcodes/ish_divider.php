<?php

vc_map(
	array(
		'name' => __( 'Divider', 'ishyoboy_assets' ),
		'base' => 'ish_divider',
		'class' => '',
		'show_settings_on_create' => false,
		'description' => __( 'Empty 25px space', 'ishyoboy_assets' ),
		'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
		'icon' => 'ish-icon-minus',
		//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		'weight' => 900,
		'params' => array_merge(
			array(
			),
			$ish_global_params
		)
	)
);