<?php

$setting = array (
	'icon' => 'ish-icon-doc-text-inv',
	'weight' => 1000,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'params' => array_merge(
		array(
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"heading" => __("Text", "js_composer"),
				"param_name" => "content",
				"value" => __("<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", "js_composer")
			),
			/*$add_css_animation,
			array(
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
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				//'std' => '',
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
);

vc_map_update('vc_column_text', $setting);




/*vc_remove_param( 'vc_column_text', 'css' );
vc_remove_param( 'vc_column_text', 'el_class' );
vc_remove_param( 'vc_column_text', 'css_animation' );*/

$setting = array (
	'icon' => 'ish-icon-code',
	'weight' => 800,
	'category' => Array( __('Structure', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
);

vc_map_update('vc_raw_html', $setting);

$setting = array (
	'icon' => 'ish-icon-code',
	'weight' => 800,
	'category' => Array( __('Structure', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
);

vc_map_update('vc_raw_js', $setting);
/*
$setting = array (
	'icon' => 'ish-icon-vcard',
	'weight' => 800,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
);

if ( is_plugin_active('contact-form-7/wp-contact-form-7.php') ) {
	vc_map_update('contact-form-7', $setting);
}
*/
