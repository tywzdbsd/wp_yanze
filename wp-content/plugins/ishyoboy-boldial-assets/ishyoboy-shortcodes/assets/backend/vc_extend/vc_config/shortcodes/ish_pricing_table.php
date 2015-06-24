<?php


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
class WPBakeryShortCode_Ish_Pricing_Table extends WPBakeryShortCodesContainer {

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

class WPBakeryShortCode_Ish_Pricing_Row extends WPBakeryShortCode {

}

vc_map( array(
	'name' => __( 'Pricing Table', 'ishyoboy_assets' ),
	'base' => 'ish_pricing_table',
	'as_parent' => array( 'only' => 'ish_pricing_row' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => false,
	'content_element' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-table',
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Highlight Even Rows', 'ishyoboy_assets' ),
				'param_name' => 'striped',
				'value' => array(
					__( 'Yes', 'ishyoboy_assets' ) => '',
					__( 'No', 'ishyoboy_assets' ) => 'no',
				),
				//'description' => __( 'change color of tooltip', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Text Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'std' => 'center',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Table Background Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'std' => 'color3',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Table Text Color', 'ishyoboy_assets' ),
				'param_name' => 'text_color',
				'std' => 'color1',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Table Border Color', 'ishyoboy_assets' ),
				'param_name' => 'border_color',
				'std' => 'color13',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
				//'value' => $ish_theme_colors,
			),
		),
		$ish_global_params
	),
	'default_content' =>
		'[ish_pricing_row text_content="HEADER" text_size="h3" icon="ish-icon-spin5" button_text="Text on the button" button_size="small" color="color1" text_color="color3" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]
		[ish_pricing_row text_content="Value 1" icon="ish-icon-spin5" button_text="Text on the button" button_size="small" color="color1" text_color="color3" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]
		[ish_pricing_row text_content="Value 2" icon="ish-icon-spin5" button_text="Text on the button" button_size="small" color="color1" text_color="color3" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]
		[ish_pricing_row text_content="Value3" icon="ish-icon-spin5" button_text="Text on the button" button_size="small" color="color1" text_color="color3" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]
		[ish_pricing_row text_content="Value 4" icon="ish-icon-spin5" button_text="Text on the button" button_size="small" color="color1" text_color="color3" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]
		[ish_pricing_row text_content="Value 5" icon="ish-icon-spin5" button_text="Text on the button" button_size="small" color="color1" text_color="color3" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]
		[ish_pricing_row type="button" text_content="Row Value" icon="ish-icon-spin5" button_text="Button" url="url:%23||" button_size="small" color="color8" text_color="color4" button_icon_align="left" tooltip_color="color1" tooltip_text_color="color3"]',
	'js_view' => 'IshPricingTableView',
) );

vc_map( array(
	'name' => __( 'Pricing Row', 'ishyoboy_assets' ),
	'base' => 'ish_pricing_row',
	'as_child' => array( 'only' => 'ish_pricing_table' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-minus',
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Type', 'ishyoboy_assets' ),
				'param_name' => 'type',
				'admin_label' => false,
				'value' => array(
					__( 'Text', 'ishyoboy_assets' ) => '',
					__( 'Icon', 'ishyoboy_assets' ) => 'icon',
					__( 'Button', 'ishyoboy_assets' ) => 'button'
				),
			),

			// TEXT
			array(
				'type' => 'textfield',
				'heading' => __( 'Row Text', 'ishyoboy_assets' ),
				'holder' => 'div',
				'class' => 'ish-pricing-row',
				'param_name' => 'text_content',
				'value' => __( 'Row Value', 'ishyoboy_assets' ),
				//'description' => __( 'Text on the button.', 'ishyoboy_assets' ),
				//'admin_label' => true,
				'dependency' => Array( 'element' => 'type', 'value' => '' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Text Size', 'ishyoboy_assets' ),
				'param_name' => 'text_size',
				'value' => array(
					__( 'Text', 'ishyoboy_assets' ) => '',
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'Choose Text size', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => '' ),
			),

			// ICON
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons_no_empty,
				'description' => __( 'Choose an icon.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
				'dependency' => Array( 'element' => 'type', 'value' => Array( 'icon' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'icon_size',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Number - icon size in pixels', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => 'icon' ),
			),

			// BUTTON
			array(
				'type' => 'textfield',
				'heading' => __( 'Button Text', 'ishyoboy_assets' ),
				'param_name' => 'button_text',
				'value' => __( 'Text on the button', 'ishyoboy_assets' ),
				//'description' => __( 'Text on the button.', 'ishyoboy_assets' ),
				//'admin_label' => true,
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'URL', 'ishyoboy_assets' ),
				'param_name' => 'url',
				'value' => '',
				//'description' => __( 'Select target URL', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Size', 'ishyoboy_assets' ),
				'param_name' => 'button_size',
				'value' => array(
					__( 'Small', 'ishyoboy_assets' ) => 'small',
					__( 'Medium', 'ishyoboy_assets' ) => 'medium',
					__( 'Big', 'ishyoboy_assets' ) => 'big',
				),
				//'description' => __( 'Choose element size', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Button Icon', 'ishyoboy_assets' ),
				'param_name' => 'button_icon',
				'value' => $ish_available_icons,
				'description' => __( 'Choose an icon which will be displayed inside the button.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Icon alignment', 'ishyoboy_assets' ),
				'param_name' => 'button_icon_align',
				'value' => $ish_alignmment_params_reduced,
				'description' => __( 'Choose alignment for the icon', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'type', 'value' => 'button' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshPricingRowView',
) );