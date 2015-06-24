<?php


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
class WPBakeryShortCode_Ish_Skills extends WPBakeryShortCodesContainer {

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

class WPBakeryShortCode_Ish_Skill extends WPBakeryShortCode {

}

vc_map( array(
	'name' => __( 'Skills', 'ishyoboy_assets' ),
	'base' => 'ish_skills',
	'as_parent' => array( 'only' => 'ish_skill' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => false,
	'content_element' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-align-left',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Track Color', 'ish-sc-plugin' ),
				'param_name' => 'skill_color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Default Title Position', 'ishyoboy_assets' ),
				'param_name' => 'outside',
				'value' => array(
					__( 'Inside', 'ishyoboy_assets' ) => '',
					__( 'Outside', 'ishyoboy_assets' ) => 'yes',
				),
				'description' => __( 'This title position will be inherited by all skill bars', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[ish_skill percent="90" tooltip_color="color1"]Skill Bar 1[/ish_skill]
	[ish_skill percent="90" tooltip_color="color1"]Skill Bar 2[/ish_skill]
	',
	'js_view' => 'IshSkillsView',
) );

vc_map( array(
	'name' => __( 'Single Skill', 'ishyoboy_assets' ),
	'base' => 'ish_skill',
	'as_child' => array( 'only' => 'ish_skills' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-align-left',
	'params' => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'ishyoboy_assets' ),
				'holder' => 'div',
				'param_name' => 'content',
				'value' => __( 'Skill Bar', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Percentage', 'ishyoboy_assets' ),
				'param_name' => 'percent',
				'value' => '90',
				'description' => __( 'Number - skill percentage. E.g: "90"', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector',
				'heading' => __( 'Title Position', 'ishyoboy_assets' ),
				'param_name' => 'outside',
				'value' => array(
					__( 'Inherit from parent', 'ishyoboy_assets' ) => '',
					__( 'Inside', 'ishyoboy_assets' ) => 'no',
					__( 'Outside', 'ishyoboy_assets' ) => 'yes',
				),
				'description' => __( 'Choose only if you want to override the title position set in the parent container', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Track Color', 'ish-sc-plugin' ),
				'param_name' => 'skill_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshDefaultView',
) );