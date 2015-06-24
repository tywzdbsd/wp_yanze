<?php

// Default SC attributes
$defaults = array(
	'color' => 'color1',
	'text_color' => 'color4',
	'lat_lng' => '',
	'title' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_map_location';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '';
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '';
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';


// STYLE
if ( '' != $sc_atts['style'] ){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= ( '' != $sc_atts['lat_lng'] ) ? ' data-latlng="' . esc_attr( $sc_atts['lat_lng'] ) . '"' : ''  ;
$return .= ( '' != $sc_atts['title'] ) ? ' data-title="' . esc_attr( $sc_atts['title'] ) . '"' : ''  ;
$return .= '>';

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div>';

echo $return;