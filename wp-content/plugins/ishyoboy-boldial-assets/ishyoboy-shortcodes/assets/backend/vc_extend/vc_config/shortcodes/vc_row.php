<?php

vc_map( array(
	'name' => __( 'Row', 'js_composer' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'ish-icon-progress-0',
	'show_settings_on_create' => false,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'weight' => 1000,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Make row as section', 'ish-sc-plugin' ),
				'param_name' => 'section',
				'value' => Array(
					__( 'No', 'ish-sc-plugin') => '',
					__( 'Yes', 'ish-sc-plugin') => 'yes',
				),
				'description' => __( 'Adds bottom padding to the row to make it as a standalone section', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Section Type', 'ish-sc-plugin' ),
				'param_name' => 'full_width',
				'value' => Array(
					__( 'Regular', 'ish-sc-plugin' ) => '',
					__( 'Full-width', 'ish-sc-plugin' ) => 'full',
					__( 'Full-width with padding', 'ish-sc-plugin' ) => 'padding',
					__( 'Full-height - Regular', 'ish-sc-plugin' ) => 'full-height',
					__( 'Full-height - Full-width', 'ish-sc-plugin' ) => 'full-full-height',
					__( 'Full-height - Full-width with padding', 'ish-sc-plugin' ) => 'padding-full-height',
				),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Top Decoration', 'ish-sc-plugin' ),
				'param_name' => 'top_svg',
				'value' => Array(
					__( 'No Decoration', 'ish-sc-plugin' ) => '',
				    __( 'Arrow Outside', 'ish-sc-plugin' ) => 'arrow-outside',
				    __( 'Arrow Inside', 'ish-sc-plugin' ) => 'arrow-inside',
				    __( 'Clouds Outside', 'ish-sc-plugin' ) => 'clouds-outside',
					__( 'Clouds Inside', 'ish-sc-plugin' ) => 'clouds-inside',
				    __( 'Curtain Outside', 'ish-sc-plugin' ) => 'curtain-outside',
					__( 'Curtain Inside', 'ish-sc-plugin' ) => 'curtain-inside',
				    __( 'Rounded Outside', 'ish-sc-plugin' ) => 'rounded-outside',
				    __( 'Rounded Inside', 'ish-sc-plugin' ) => 'rounded-inside',
				    __( 'Slope Left', 'ish-sc-plugin' ) => 'slope-left',
				    __( 'Slope Left with shadow', 'ish-sc-plugin' ) => 'slope-left-shadow',
				    __( 'Slope Right', 'ish-sc-plugin' ) => 'slope-right',
				    __( 'Slope Right with shadow', 'ish-sc-plugin' ) => 'slope-right-shadow',
				    __( 'Triangle Outside', 'ish-sc-plugin' ) => 'triangle-outside',
				    __( 'Triangle Inside', 'ish-sc-plugin' ) => 'triangle-inside',
				    __( 'Zigzag', 'ish-sc-plugin' ) => 'zigzag',
				),
				'description' => __( 'Adds top decoration to the section.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Bottom Decoration', 'ish-sc-plugin' ),
				'param_name' => 'bottom_svg',
				'value' => Array(
					__( 'No Decoration', 'ish-sc-plugin' ) => '',
					__( 'Arrow Outside', 'ish-sc-plugin' ) => 'arrow-outside',
					__( 'Arrow Inside', 'ish-sc-plugin' ) => 'arrow-inside',
					__( 'Clouds Outside', 'ish-sc-plugin' ) => 'clouds-outside',
					__( 'Clouds Inside', 'ish-sc-plugin' ) => 'clouds-inside',
					__( 'Curtain Outside', 'ish-sc-plugin' ) => 'curtain-outside',
					__( 'Curtain Inside', 'ish-sc-plugin' ) => 'curtain-inside',
					__( 'Rounded Outside', 'ish-sc-plugin' ) => 'rounded-outside',
					__( 'Rounded Inside', 'ish-sc-plugin' ) => 'rounded-inside',
					__( 'Slope Left', 'ish-sc-plugin' ) => 'slope-left',
					__( 'Slope Left with shadow', 'ish-sc-plugin' ) => 'slope-left-shadow',
					__( 'Slope Right', 'ish-sc-plugin' ) => 'slope-right',
					__( 'Slope Right with shadow', 'ish-sc-plugin' ) => 'slope-right-shadow',
					__( 'Triangle Outside', 'ish-sc-plugin' ) => 'triangle-outside',
					__( 'Triangle Inside', 'ish-sc-plugin' ) => 'triangle-inside',
					__( 'Zigzag', 'ish-sc-plugin' ) => 'zigzag',
				),
				'description' => __( 'Adds bottom decoration to the section.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Background Decoration', 'ish-sc-plugin' ),
				'param_name' => 'bg_svg',
				'value' => Array(
					__( 'No Decoration', 'ish-sc-plugin' ) => '',
					__( 'Glow', 'ish-sc-plugin' ) => 'glow',
					__( 'Diamonds', 'ish-sc-plugin' ) => 'diamonds',
					__( 'Triangles', 'ish-sc-plugin' ) => 'triangles',
					__( 'Squared', 'ish-sc-plugin' ) => 'squared',
					__( 'Abstract', 'ish-sc-plugin' ) => 'abstract',
					__( 'Stripes', 'ish-sc-plugin' ) => 'stripes',
				),
				'description' => __( 'Adds a glow to the background of the section if no background image is used.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'section', 'value' => array('yes')),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			/*array(
				'type' => 'textfield',
				'heading' => __('Padding', 'wpb'),
				'param_name' => 'padding',
				'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels. ', 'wpb')
			),
			array(
				'type' => 'textfield',
				'heading' => __('Bottom margin', 'wpb'),
				'param_name' => 'margin_bottom',
				'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels. ', 'wpb')
			),*/
			array(
				'type' => 'textfield',
				'heading' => __( 'Background Opacity', 'ishyoboy_assets' ),
				'param_name' => 'bg_opacity',
				'value' => '', //__( '100', 'ishyoboy_assets' ),
				'description' => __( 'Number (0 - 100) representing the row opacity in %. 100 - visible, 0 - invisible.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'attach_image',
				'heading' => __('Background Image', 'wpb'),
				'param_name' => 'bg_image',
				'description' => ''
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Parallax Effect', 'ish-sc-plugin' ),
				'param_name' => 'parallax',
				'value' => Array(
					__( 'No', 'ish-sc-plugin') => '',
					__( 'Static', 'ish-sc-plugin') => 'static',
					__( 'Dynamic', 'ish-sc-plugin') => 'dynamic',
				),
				'description' => __( 'Adds parallax effect to the background image. The "dynamic" uses easing.', 'ishyoboy_assets' ),
				'dependency' => Array('element' => 'bg_image', 'not_empty' => true)
			),
			array(
				'type' => 'dropdown',
				'heading' => __('Background Repeat', 'wpb'),
				'param_name' => 'bg_image_repeat',
				'value' => array(
					__( 'Default', 'wpb') => '',
					__( 'Cover', 'wpb') => 'cover',
					__( 'Contain', 'wpb') => 'contain',
					__( 'No Repeat', 'wpb') => 'no-repeat'
				),
				'description' => '',
				'dependency' => Array('element' => 'parallax', 'value' => Array( '', 'dynamic' ))
			),
			array(
				// Also update in vc_row_inner
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Vertical Columns Align', 'ish-sc-plugin' ),
				'param_name' => 'vertical_align',
				'value' => Array(
					__( 'Default Alignment', 'ish-sc-plugin') => '',
					//__( 'Top', 'ish-sc-plugin') => 'top',
					__( 'Middle', 'ish-sc-plugin') => 'middle',
					//__( 'Bottom', 'ish-sc-plugin') => 'bottom',
				),
				'description' => '', //__( '', 'ishyoboy_assets' ),
			),
			/*array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),*/
		),
		$ish_global_params
	),
	'js_view' => 'IshVcRowView'
) );

vc_map( array(
	'name' => __( 'Row', 'js_composer' ), //Inner Row
	'base' => 'vc_row_inner',
	'content_element' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'weight' => 1000,
	'show_settings_on_create' => false,
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => array_merge(
		array(
			/* array(
				"type" => "textfield",
				"heading" => __("Extra class name", "js_composer"),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
			),
			array(
				"type" => "css_editor",
				"heading" => __('Css', "js_composer"),
				"param_name" => "css",
				// "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
				"group" => __('Design options', 'js_composer')
			)*/
			array(
				// Also update in vc_row
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Vertical Columns Align', 'ish-sc-plugin' ),
				'param_name' => 'vertical_align',
				'value' => Array(
					__( 'Default Alignment', 'ish-sc-plugin') => '',
					//__( 'Top', 'ish-sc-plugin') => 'top',
					__( 'Middle', 'ish-sc-plugin') => 'middle',
					//__( 'Bottom', 'ish-sc-plugin') => 'bottom',
				),
				'description' => '', //__( '', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'VcRowView'
) );