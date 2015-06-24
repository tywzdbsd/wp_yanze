<?php

// Global variables
global $map_count, $ish_options;
$map_count++;

// Default SC attributes
$defaults = array(
	'color' => '',
	'zoom' => '15',
	'invert_colors' => '',
	'height' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Add ID if empty as it is necessary for Google Maps to work
if ( empty( $sc_atts['id'] ) ){
	$sc_atts['id'] = 'ish-gmap-' . $map_count;
}

// Make sure to include the scripts for Google Maps and the Generation of the marker infoboxes on click
wp_enqueue_script( 'ish-gmaps' );

// Convert color class to color value
if ( isset( $ish_options[ $sc_atts['color'] ] ) ){
	$sc_atts['color'] = $ish_options[ $sc_atts['color'] ];
}

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="' . apply_filters( 'ish_sc_classes', 'ish-sc_map_container', $tag ) . '"><div class="';

// CLASSES
$class = 'ish-sc_map';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
//$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= $class;
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style'] || '' != $sc_atts['height']  ){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['height'] ) ? ' height: ' . esc_attr( $sc_atts['height'] ) . 'px;' : '';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';

}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= ( '' != $sc_atts['zoom'] ) ? ' data-zoom="' . esc_attr( $sc_atts['zoom'] ) . '"' : ''  ;
$return .= ( 'yes' == $sc_atts['invert_colors'] ) ? ' data-invert="' . esc_attr( $sc_atts['invert_colors'] ) . '"' : ''  ;
$return .= ( '' != $sc_atts['color'] ) ? ' data-color="' . esc_attr( $sc_atts['color'] ) . '"' : '' ;
$return .= '>';

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div></div>';

echo $return;