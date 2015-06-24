<?php


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
class WPBakeryShortCode_Ish_Map extends WPBakeryShortCodesContainer {

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

class WPBakeryShortCode_Ish_Location extends WPBakeryShortCode {

}

vc_map( array(
	'name' => __( 'Google Map', 'ishyoboy_assets' ),
	'base' => 'ish_map',
	'as_parent' => array( 'only' => 'ish_location' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => false,
	'content_element' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-map',
	'description' => __( 'Google Map with custom locations', 'ishyoboy_assets' ),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Inverted Map Colors', 'ishyoboy_assets' ),
				'param_name' => 'invert_colors',
				'value' => array(
					__( 'Regular', 'ishyoboy_assets' ) => '',
					__( 'Inverted', 'ishyoboy_assets' ) => 'yes',
				),
				'description' => __( 'Inverted colors add a "nightly" effect since dark colors become light and vice versa.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Map Zoom', 'ishyoboy_assets' ),
				'param_name' => 'zoom',
				'value' => '8',
				'description' => __( 'Number "0" corresponds to a map of the Earth fully zoomed out, and higher zoom levels zoom in at a higher resolution.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Optional Map Height', 'ishyoboy_assets' ),
				'param_name' => 'height',
				'value' => '',
				'description' => __( 'A number to set the height of the map in pixels. E.g.: "450".', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Default Color', 'ishyoboy_assets' ),
				'param_name' => 'color',
				'value' => array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			),
		),
		$ish_global_params
	),
	'default_content' => '
	[ish_location lat_lng="-34.397, 150.644" title="Location Title" color="color1" text_color="color4"]This is the text displayed in the Map Location bubble.[/ish_location]
	',
	'js_view' => 'IshMapView',
) );

vc_map( array(
	'name' => __( 'Map Location', 'ishyoboy_assets' ),
	'base' => 'ish_location',
	"as_child" => array( 'only' => 'ish_map' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-location',
	'params' => array_merge(
		array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Location Title', 'ishyoboy_assets' ),
				'param_name' => 'headline',
				'holder' => 'div',
				'value' => __( 'Location Title', 'ishyoboy_assets' ),
				'description' => __( 'It will not be displayed in the Map Location bubble. Serves for better orientation in the page builder.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Location Latitude & Longitude', 'ishyoboy_assets' ),
				'param_name' => 'lat_lng',
				'value' => __( 'A, B', 'ishyoboy_assets' ),
				'description' => sprintf( __( 'To get the coordinates of any address use %s or google for "Address to Latitude longitude".', 'ishyoboy_assets' ), '<a href="http://itouchmap.com/latlong.html" target="_blank">' . __( 'This Page', 'ishyoboy_assets' ) . '</a>' )
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Location Content', 'ishyoboy_assets' ),
				'param_name' => 'content',
				'value' => __( 'This is the text displayed in the Map Location bubble.', 'ishyoboy_assets' ),
				//'description' => __( '', 'ishyoboy_assets' ),
			),
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
	'js_view' => 'IshDefaultView',
) );