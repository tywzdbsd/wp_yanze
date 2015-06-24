<?php

// Default SC attributes
$defaults = array(
	'align' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';

global $ish_options;

if ( isset( $ish_options['addthis_share'] ) && '' != $ish_options['addthis_share'] ){

	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_social_share';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
	$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
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


	// CONTENT
	$return .= str_replace(array("\r\n", "\n", "\r", "<br />", "<br>"), '', $ish_options['addthis_share']);

	// SHORTCODE END
	$return .= '</div>';
}

echo $return;