<?php

vc_map( array(
	'name' => __( 'Post Media', 'ishyoboy_assets' ),
	'base' => 'ish_blog_media',
	'class' => '',
	'show_settings_on_create' => false,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'The post media', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-video',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(

		),
		$ish_global_params
	)
) );