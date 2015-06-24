<?php

vc_map( array(
	'name' => __( 'Portfolio Gallery', 'ishyoboy_assets' ),
	'base' => 'ish_portfolio_gallery',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	//'description' => __( '', 'ishyoboy_assets' ),
	'icon' => 'ish-icon-briefcase',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Slideshow', 'ishyoboy_assets' ),
				'param_name' => 'slideshow',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',

				),
				'description' => __( 'Display images in a slideshow or as separate images.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Animation', 'ishyoboy_assets' ),
				'param_name' => 'animation',
				'value' => array(
					__( 'Slide', 'ishyoboy_assets' ) => 'slide',
					__( 'Fade', 'ishyoboy_assets' ) => 'fade',
				),
				'description' => __( 'Choose the transition between slides', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'slideshow', 'value' => '' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Navigation', 'ishyoboy_assets' ),
				'param_name' => 'navigation',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',

				),
				'description' => __( 'Display buttons to switch between slides', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'slideshow', 'value' => '' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Navigation Alignment', 'ishyoboy_assets' ),
				'param_name' => 'nav_align',
				'value' => array(
					__( 'Align Left', 'ishyoboy_assets' ) => 'left',
					__( 'Align Center', 'ishyoboy_assets' ) => 'center',
					__( 'Align Right', 'ishyoboy_assets' ) => 'right',
				),
				'dependency' => Array( 'element' => 'navigation', 'value' => '' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Navigation Color', 'ish-sc-plugin' ),
				'param_name' => 'nav_color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'navigation', 'value' => '' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Prev/Next buttons', 'ishyoboy_assets' ),
				'param_name' => 'prevnext',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Display previous and next slide buttons', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'slideshow', 'value' => '' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Prev/Next Color', 'ish-sc-plugin' ),
				'param_name' => 'prevnext_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'prevnext', 'value' => '' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Autoslide', 'ishyoboy_assets' ),
				'param_name' => 'autoslide',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				'description' => __( 'Automatically switch the slides every few seconds.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'slideshow', 'value' => '' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Interval', 'ishyoboy_assets' ),
				'param_name' => 'interval',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Time interval in seconds before switching the slide. If empty, the default is "4" seconds.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'slideshow', 'value' => '' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image size', 'ishyoboy_assets' ),
				'param_name' => 'thumbnail_size',
				//'admin_label' => true,
				'value' => $ish_image_sizes,
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Maximum Height', 'ish-sc-plugin' ),
				'param_name' => 'max_height',
				'value' => '',
				'description' => __( 'The max. height a slider can have.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'slideshow', 'value' => '' ),
			),
		),
		$ish_global_params
	)
) );