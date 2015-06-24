<?php


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
class WPBakeryShortCode_Ish_Tgg_Acc extends WPBakeryShortCodesContainer {

	public function contentAdmin($atts, $content = null) {
		$width = $el_class = '';
		$output = parent::contentAdmin( $atts, $content );

		$title = '<span class="ish-tggacc-title-holder">' . __( $this->settings['name'] , 'ishyoboy_assets' ) . '</span>';

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

class WPBakeryShortCode_Ish_Tgg_Acc_Item extends WPBakeryShortCodesContainer  {

	public function contentAdmin($atts, $content = null) {
		$width = $el_class = '';
		$output = parent::contentAdmin( $atts, $content );

		$title = '<span class="ish-tgg-acc-title-holder">' . __( $this->settings['name'] , 'ishyoboy_assets' ) . '</span>';

		// Get the Toggle Title if set
		if ( isset( $this->settings['params']) ) {

			foreach ($this->settings['params'] as $param) {

				if ( 'el_title' == $param['param_name'] ) {
					$title = '<span class="ish-tgg-acc-title-holder">' . $param['value'] . '</span>';
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
	'name' => __( 'Toggle & Accordion', 'ishyoboy_assets' ),
	'base' => 'ish_tgg_acc',
	'as_parent' => array( 'only' => 'ish_tgg_acc_item' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'as_child' => array('except' => 'vc_column_inner'),
	'show_settings_on_create' => true,
	'content_element' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-indent-right',
	//'description' => __( 'Tabbed container', 'ishyoboy_assets' ),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Behavior', 'ish-sc-plugin' ),
				'param_name' => 'behavior',
				'value' => Array(
					__( 'Toggle', 'ish-sc-plugin' ) => '',
					__( 'Accordion', 'ish-sc-plugin' ) => 'accordion',
				),
				'description' => __( 'Accordion allows only one opened item. Toggle allows multiple.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Navigation Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'std' => 'color1',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Navigation Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Item Background Color', 'ish-sc-plugin' ),
				'param_name' => 'contents_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Item Text Color', 'ish-sc-plugin' ),
				'param_name' => 'contents_text_color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Navigation HTML Element', 'ishyoboy_assets' ),
				'param_name' => 'tag',
				'value' => array(
					__( 'Div', 'ishyoboy_assets' ) => '',
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'HTML element for the titles of all items.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[ish_tgg_acc_item el_title="Item Title"][/ish_tgg_acc_item]
	',
	'js_view' => 'IshVcTggAccView', //'VcColumnView',
) );

vc_map( array(
	'name' => __( 'Toggle/Accordion Item', 'ishyoboy_assets' ),
	'base' => 'ish_tgg_acc_item',
	'as_parent' => array( 'only' => 'vc_row,vc_row_inner' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'as_child' => array( 'only' => 'ish_tgg_acc' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'is_container' => true,
	'icon' => 'ish-icon-indent-right',
	'params' => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Item Title', 'ishyoboy_assets' ),
				'param_name' => 'el_title',
				'value' => __( 'Item Title', 'ishyoboy_assets' ),
				//'description' => __( 'Text on the button.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Item Categories', 'ishyoboy_assets' ),
				'param_name' => 'categories',
				'value' => '', //__( '', 'ishyoboy_assets' ),
				'description' => __( 'Comma separated list of category names to make a the items filterable.', 'ishyoboy_assets' ),
				//'admin_label' => true,
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Opened by default', 'ishyoboy_assets' ),
				'param_name' => 'active',
				'value' => array(
					__( 'No', 'ishyoboy_assets' ) => '',
					__( 'Yes', 'ishyoboy_assets' ) => 'yes',
				),
				//'description' => __( 'Please make sure only one tab is active.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_fontello_icons_selector',
				'heading' => __( 'Icon', 'ishyoboy_assets' ),
				'param_name' => 'icon',
				'value' => $ish_available_icons,
				'description' => __( 'Choose an icon which will be displayed next to the Item tile.', 'ishyoboy_assets' ) . ' ' . sprintf( __( 'To add your own set of icons go to %s, download your custom font and unzip it in "ish-plugins/ishyoboy-shortcodes/fontello/" folder inside the child theme root.', 'ishyoboy_assets' ), '<a href="http://fontello.com/" target="_blank">Fontello.com</a>' ),
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
				'heading' => __( 'Navigation HTML Element', 'ishyoboy_assets' ),
				'param_name' => 'tag',
				'value' => array(
					__( 'Inherit from parent container', 'ishyoboy_assets' ) => '',
					__( 'Div', 'ishyoboy_assets' ) => 'div',
					__( 'H1', 'ishyoboy_assets' ) => 'h1',
					__( 'H2', 'ishyoboy_assets' ) => 'h2',
					__( 'H3', 'ishyoboy_assets' ) => 'h3',
					__( 'H4', 'ishyoboy_assets' ) => 'h4',
					__( 'H5', 'ishyoboy_assets' ) => 'h5',
					__( 'H6', 'ishyoboy_assets' ) => 'h6',
				),
				'description' => __( 'HTML element for the title of this item.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Navigation Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'Inherit from parent container', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Navigation Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'value' => array_merge( array( __( 'Inherit from parent container', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Content Background Color', 'ish-sc-plugin' ),
				'param_name' => 'contents_color',
				'value' => array_merge( array( __( 'Inherit from parent container', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Content Text Color', 'ish-sc-plugin' ),
				'param_name' => 'contents_text_color',
				'value' => array_merge( array( __( 'Inherit from parent container', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]
	',
	'js_view' => 'IshVcTggAccItemView', //'VcColumnView',
) );