<?php

vc_map( array(
	'name' => __( 'Sidebar', 'ishyoboy_assets' ),
	'base' => 'ish_sidebar',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'description' => __( 'Widgetized sidebar', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-list-add',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sidebar', 'ish-sc-plugin' ),
				'param_name' => 'sidebar_name',
				'admin_label' => true,
				'value' => $ish_available_sidebars,
				'description' => __( 'Select the sidebar you previously prepared under Appearance -> Widgets.', 'ishyoboy_assets' )
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Widgets Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'std' => 'color2',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Widgets Link1 Color', 'ish-sc-plugin' ),
				'param_name' => 'link1_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Widgets Link2 Color', 'ish-sc-plugin' ),
				'param_name' => 'link2_color',
				'std' => 'color5',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Block Elements Background Color', 'ish-sc-plugin' ),
				'param_name' => 'block_bg_color',
				'std' => 'color2',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Block Elements Text Color', 'ish-sc-plugin' ),
				'param_name' => 'block_text_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
			),
		),
		$ish_global_params
	)
) );