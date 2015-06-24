<?php

// Default SC attributes
$defaults = array(
	//'el_text' => '',
	'align' => '',
	'tag' => '',
	'tag_size' => '',
	'color' => '',
	'icon' => '',
	'icon_align' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$el_tag = ( 'h' == $sc_atts['tag'] ) ? $sc_atts['tag_size'] : $sc_atts['tag'];
$return = '';
$return .= '<' . $el_tag . ' class="';

// CLASSES
$class = 'ish-sc_headline';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( 'div' == $sc_atts['tag'] ) ? ' ish-' . $sc_atts['tag_size'] : '';
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

$return .= '>';

$before = '';
$after = '';

// ICON
if ( '' != $sc_atts['icon'] ){
	$icon = '<span class="ish-icon"><span class="' . $sc_atts['icon'] . '"></span></span>';

	if ( 'left' == $sc_atts['icon_align'] ){
		$before .= $icon;
	}
	elseif ( 'right' == $sc_atts['icon_align'] ){
		$after .= $icon;
	}
}

// CONTENT
// $return .= $before . $sc_atts['el_text'] . $after;
$return .= $before . $content . $after;

// SHORTCODE END
$return .= '</' . $el_tag . '>';

echo $return;