<?php

// Default SC attributes
$defaults = array(
	'sidebar_name' => '',
	'text_color' => '',
	'link1_color' => '',
	'link2_color' => '',
	'block_bg_color' => '',
	'block_text_color' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_sidebar';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['link1_color'] ) ? ' ish-link1-' . esc_attr( $sc_atts['link1_color'] ) : '' ;
$class .= ( '' != $sc_atts['link2_color'] ) ? ' ish-link2-' . esc_attr( $sc_atts['link2_color'] ) : '' ;
$class .= ( '' != $sc_atts['block_bg_color'] ) ? ' ish-block-bg-' . esc_attr( $sc_atts['block_bg_color'] ) : '' ;
$class .= ( '' != $sc_atts['block_text_color'] ) ? ' ish-block-text-' . esc_attr( $sc_atts['block_text_color'] ) : '' ;
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

global $sidebar_width;
$sidebar_width = 12; // Used when displaying widgets

$content = '<div class="ish-row ish-row-notfull"><div class="ish-row_inner">';

ob_start();
dynamic_sidebar( $sc_atts['sidebar_name'] );
$content .= ob_get_contents();
ob_end_clean();

$content .= '</div></div>';

//$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );

// SHORTCODE END
$return .= '</div>';

echo $return;