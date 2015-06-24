<?php

vc_map( array(
	'name' => __( 'Headline', 'ishyoboy_assets' ),
	'base' => 'ish_headline',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-text-width',
	//'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Headline Text', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-headline',
				'param_name' => "content",
				'value' => __( 'Headline Text', 'ishyoboy_assets' ),
				//'description' => __( 'Enter the headline text.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Headline Size', 'ishyoboy_assets' ),
				'param_name' => 'tag_size',
				'value' => array(
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'Choose Headline size', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Headline Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Headline Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons,
				'description' => __( 'Choose an icon which will be displayed next to the headline.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Icon alignment', 'ishyoboy_assets' ),
				'param_name' => 'icon_align',
				'value' => $ish_alignmment_params_reduced,
				'description' => __( 'Choose alignment for the icon', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'icon', 'not_empty' => true ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'HTML Element', 'ishyoboy_assets' ),
				'param_name' => 'tag',
				'value' => array(
					__( 'H', 'ishyoboy_assets' ) => 'h',
					__( 'DIV', 'ishyoboy_assets' ) => 'div',
				),
				'description' => __( 'Choose DIV if the regular headline elements are not suitable due to semantic or seo reasons.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshDefaultView',
) );