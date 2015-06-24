<?php


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
class WPBakeryShortCode_Ish_Slidable extends WPBakeryShortCodesContainer {

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

class WPBakeryShortCode_Ish_Slide extends WPBakeryShortCodesContainer  {

	public function contentAdmin($atts, $content = null) {
		$width = $el_class = '';
		$output = parent::contentAdmin( $atts, $content );

		$title = '<span class="ish-tab-title-holder">' . __( $this->settings['name'] , 'ishyoboy_assets' ) . '</span>';

		// Get the Tab Title if set
		if ( isset( $this->settings['params']) ) {

			foreach ($this->settings['params'] as $param) {

				if ( 'tab_title' == $param['param_name'] ) {
					$title = '<span class="ish-tab-title-holder">' . $param['value'] . '</span>';
				}

			}

		}

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
	'name' => __( 'Slidable', 'ishyoboy_assets' ),
	'base' => 'ish_slidable',
	'as_parent' => array( 'only' => 'ish_slide' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'as_child' => array('except' => 'vc_column_inner'),
	'show_settings_on_create' => true,
	'content_element' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-easel',
	'description' => __( 'Content slideshows', 'ishyoboy_assets' ),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Animation', 'ishyoboy_assets' ),
				'param_name' => 'animation',
				'value' => array(
					__( 'Slide', 'ishyoboy_assets' ) => 'slide',
					__( 'Fade', 'ishyoboy_assets' ) => 'fade',
				),
				'description' => __( 'Choose the transition between slides', 'ishyoboy_assets' ),
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
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Interval', 'ishyoboy_assets' ),
				'param_name' => 'interval',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Time interval in seconds before switching the slide. If empty, the default is "4" seconds.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Maximum Height', 'ish-sc-plugin' ),
				'param_name' => 'max_height',
				'value' => '',
				'description' => __( 'The max. height a slider can have.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[ish_slide title="Slide Title"]This is the text displayed in the Map Location bubble.[/ish_slide]
	',
	'js_view' => 'IshVcSlidableView', //'VcColumnView',
) );

vc_map( array(
	'name' => __( 'Single Slide', 'ishyoboy_assets' ),
	'base' => 'ish_slide',
	//'as_parent' => array( 'only' => 'vc_row,vc_row_inner' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	//'as_child' => array( 'only' => 'ish_slidable' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'is_container' => true,
	'icon' => 'ish-icon-picture-1',
	'params' => array_merge(
		array(
		),
		$ish_global_params
	),
	'default_content' => '
	[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]
	',
	'js_view' => 'IshVcSlideView', //'VcColumnView',
) );