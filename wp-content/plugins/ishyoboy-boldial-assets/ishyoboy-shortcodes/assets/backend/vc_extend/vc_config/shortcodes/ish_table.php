<?php

vc_map( array(
	'name' => __( 'Table', 'ishyoboy_assets' ),
	'base' => 'ish_table',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-table',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Table Code', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-table',
				'param_name' => 'content',
				'value' => '
				<table>
					<thead>
						<tr>
							<th>Header 1</th>
							<th>Header 2</th>
							<th>Header 3</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Value 1</td>
							<td>Value 2</td>
							<td>Value 3</td>
						</tr>
						<tr>
							<td>Value 1</td>
							<td>Value 2</td>
							<td>Value 3</td>
						</tr>
						<tr>
							<td>Value 1</td>
							<td>Value 2</td>
							<td>Value 3</td>
						</tr>
					<tbody>
				</table>',
				'description' => __( 'To add more table rows or columns, switch to "Text" tab and edit the HTML code.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Highlight Even Rows', 'ishyoboy_assets' ),
				'param_name' => 'striped',
				'value' => array(
					__( 'No', 'ishyoboy_assets' ) => '',
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
				),
				//'description' => __( 'change color of tooltip', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Text Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Table Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Table Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Header Background Color', 'ishyoboy_assets' ),
				'param_name' => 'header_bg_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Header Text Color', 'ishyoboy_assets' ),
				'param_name' => 'header_text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Table Border Color', 'ishyoboy_assets' ),
				'param_name' => 'border_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshDefaultView',
) );