<?php


class WPBakeryShortCode_Ish_Box extends WPBakeryShortCodesContainer  {

	public function contentAdmin($atts, $content = null) {
		$width = $el_class = '';
		$output = parent::contentAdmin( $atts, $content );

		$title = '<span class="ish-tabs-title-holder">' . __( $this->settings['name'] , 'ishyoboy_assets' ) . '</span>';

		//$search = '<div '.$this->containerHtmlBlockParams($width, 1).'>';
		$search = '<div class="wpb_element_wrapper">';
		$replace = $search . '<h4 class="wpb_element_title">' . $title . '</h4>';

		// Replace the content just once!
		$pos = strpos( $output,$search );
		if ($pos !== false) {
			$output = substr_replace( $output, $replace, $pos, strlen($search) );
		}

		return $output;
	}

}

vc_map( array(
	'name' => __( 'Box', 'ishyoboy_assets' ),
	'base' => 'ish_box',
	'as_parent' => array( 'only' => 'vc_row' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'as_child' => array('except' => 'vc_column_inner'),
	'show_settings_on_create' => true,
	'description' => __( 'Colored content box', 'ishyoboy_assets' ),
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'is_container' => false,
	'icon' => 'ish-icon-stop',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]
	',
	'js_view' => 'IshBoxView',
) );