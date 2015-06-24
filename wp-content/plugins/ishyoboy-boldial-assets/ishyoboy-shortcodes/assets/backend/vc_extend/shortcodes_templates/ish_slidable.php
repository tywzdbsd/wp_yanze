<?php

// Global variables
global $slidable_count, $ish_options;
$slidable_count++;

// Default SC attributes
$defaults = array(
	'autoslide' => '',
	'animation' => '',
	'interval' => '',
	'navigation' => '',
	'prevnext' => '',
	'nav_color' => '',
	'prevnext_color' => '',
	'nav_align' => '',
	'max_height' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

wp_enqueue_script( 'ish-flexslider' );

// Add ID if empty
if ( empty( $sc_atts['id'] ) ){
	$sc_atts['id'] = 'ish-slidablesc-' . $slidable_count;
}

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_slidable ish-slidable';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['nav_color'] ) ? ' ish-nav-' . esc_attr( $sc_atts['nav_color'] ) : '' ;
$class .= ( '' != $sc_atts['prevnext_color'] ) ? ' ish-prevnext-' . esc_attr( $sc_atts['prevnext_color'] ) : '' ;
$class .= ( '' != $sc_atts['nav_align'] ) ? (' ish-nav-' . $sc_atts['nav_align'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['max_height'] && is_numeric( $sc_atts['max_height'] ) ) ? ' ish-max-height' : '';

$class = apply_filters( 'ish_sc_classes', $class, $tag );
$return .= $class;
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style'] || ( '' != $sc_atts['max_height'] && is_numeric( $sc_atts['max_height'] ) ) ){
	$return .= ' style="';

	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= ( '' != $sc_atts['max_height'] && is_numeric( $sc_atts['max_height'] ) ) ? 'max-height: ' . $sc_atts['max_height'] . 'px;"' : '';

	$return .= '"';

}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : '';
$return .= ( 'no' != $sc_atts['autoslide'] ) ? ' data-autoslide="yes"' : '';
$return .= ( 'fade' == $sc_atts['animation'] ) ? ' data-animation="fade"' : '';
$return .= ( '' != $sc_atts['interval'] ) ? ' data-interval="' . esc_attr( $sc_atts['interval'] ) . '"' : '';
$return .= ( 'no' == $sc_atts['navigation'] ) ? ' data-navigation="no"' : '';
$return .= ( 'no' == $sc_atts['prevnext'] ) ? ' data-prevnext="no"' : '';
$return .= '>';

$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div>';

echo $return;