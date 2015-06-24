<?php

// Default SC attributes
$defaults = array(
	'color' => '',
	'type' => '',
	'align' => '',
	'width_percent' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Reset width if not a number
if ( !is_numeric( $sc_atts['width_percent'] ) ) { $sc_atts['width_percent'] = ''; }

$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_separator';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['type'] ) ? (' ish-separator-' . $sc_atts['type'] ) : ' ish-separator-bold' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style'] || ( '' != $sc_atts['width_percent'] && ( 'bold' != $sc_atts['type'] ) ) ){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['width_percent'] && ( 'bold' != $sc_atts['type'] ) ) ? ' width: ' . esc_attr($sc_atts['width_percent']) . '%;' : '';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= '>';

// NO CONTENT
//$return .= $sc_atts['el_text'];

$return .= '</div>';

echo $return;