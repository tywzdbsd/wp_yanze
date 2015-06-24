<?php

// Global variables
global $ish_skills_options;

// Default SC attributes
$defaults = array(
	'color' => '',
	'skill_color' => '',
	'text_color' => '',
	'percent' => '',
	'outside' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Override Skill settings with Parent ones if necessary
if ( '' == $sc_atts['outside'] ) { $sc_atts['outside'] = $ish_skills_options['outside']; }
if ( '' == $sc_atts['color'] ) { $sc_atts['color'] = $ish_skills_options['color']; }
if ( '' == $sc_atts['skill_color'] ) { $sc_atts['skill_color'] = $ish_skills_options['skill_color']; };
if ( '' == $sc_atts['text_color'] ) { $sc_atts['text_color'] = $ish_skills_options['text_color']; };

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_skill';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( 'yes' == $sc_atts['outside'] ) ? ' ish-outside' : ' ish-inside' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['skill_color'] ) ? ' ish-skill-' . esc_attr( $sc_atts['skill_color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
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

$return .= '>';


if ( 'yes' == $sc_atts['outside'] ){
	$return .= '<span>' . do_shortcode( $content ) . '</span>';
}

$return .= '<div class="ish-bar-bg">';
$return .= '<span class="ish-bar"';

$return .= ( '' != $sc_atts['percent'] ) ? ' data-count="' . esc_attr( $sc_atts['percent'] ) . '"' : '';

$return .= '>';

// CONTENT
if ( 'yes' != $sc_atts['outside'] ){
	$return .= do_shortcode( $content );
}

// SHORTCODE END
$return .= '</span></div></div>';

echo $return;