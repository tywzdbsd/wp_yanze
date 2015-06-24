<?php

vc_map( array(
	'name' => __( 'List', 'ishyoboy_assets' ),
	'base' => 'ish_list',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-list',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textarea_html',
				'heading' => __( 'List Items', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-list',
				'param_name' => 'content',
				'value' => '<ul><li>' . __( 'Item', 'ishyoboy_assets' ) . ' 1</li><li>' . __( 'Item', 'ishyoboy_assets' ) . ' 2</li><li>' . __( 'Item', 'ishyoboy_assets' ) . ' 3</li></ul>',
				'description' => __( 'Please enter the items in an unordered list.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Bullet Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),

			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),

			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_list_icons,
				'description' => __( 'Choose an icon which will be displayed as list icon.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshListView',
) );