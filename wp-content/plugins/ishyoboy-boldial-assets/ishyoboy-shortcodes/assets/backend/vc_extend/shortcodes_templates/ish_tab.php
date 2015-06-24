<?php

// Global variables
global $ish_tabs_navigation, $ish_tabs_options, $ish_tabs_active_exists;

// Default SC attributes
$defaults = array(
	'tab_title' => '',
	'icon' => '',
	'icon_align' => '',
	'active' => '',

	'color' => '',
	'text_color' => '',
	'contents_color' => '',
	'contents_text_color' => '',
);
// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Override Item settings with Parent ones if necessary
if ( '' == $sc_atts['color'] ) { $sc_atts['color'] = $ish_tabs_options['color']; }
if ( '' == $sc_atts['text_color'] ) { $sc_atts['text_color'] = $ish_tabs_options['text_color']; }
if ( '' == $sc_atts['contents_color'] ) { $sc_atts['contents_color'] = $ish_tabs_options['contents_color']; }
if ( '' == $sc_atts['contents_text_color'] ) { $sc_atts['contents_text_color'] = $ish_tabs_options['contents_text_color']; }

// NO ACTIVE ITEM HANDLING
if ( 'yes' == $sc_atts['active'] ) { $ish_tabs_active_exists = true; }

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_tab';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( 'yes' == $sc_atts['active'] ) ? ' ish-active' : '';
$class .= ( '' == $ish_tabs_navigation ) ? ' ##ISH_ACTIVE##' : '';
$class .= ( '' != $sc_atts['contents_color'] ) ? ' ish-' . esc_attr( $sc_atts['contents_color'] ) : '' ;
$class .= ( '' != $sc_atts['contents_text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['contents_text_color'] ) : '' ;
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
$return .= '>';



$content = wpb_js_remove_wpautop($content, true);

// CONTENT
$return .= do_shortcode( $content );



// ICON
$before = '';
$after = '';
if ( '' != $sc_atts['icon'] ){

	if ( 'left' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['tab_title'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$before .= $icon;
	}
	elseif ( 'right' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['tab_title'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$after .= $icon;
	}
}

// ACTIVE Class
$class = ( 'yes' == $sc_atts['active'] ) ? ' ish-active' : '';
$class .= ( '' == $ish_tabs_navigation ) ? ' ##ISH_ACTIVE##' : '';
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$ish_tabs_navigation .= '<li class="' . $class . '"';

// TOOLTIP
$ish_tabs_navigation .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;
$ish_tabs_navigation .= '>';

$ish_tabs_navigation .= '<a href="#">' . $before . $sc_atts['tab_title'] . $after . '</a></li>';


// SHORTCODE END
$return .= '</div>';

echo $return;