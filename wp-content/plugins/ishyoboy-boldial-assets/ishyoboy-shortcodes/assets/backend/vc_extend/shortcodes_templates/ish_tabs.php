<?php

// Global variables
global $tabs_count, $ish_options, $ish_tabs_navigation, $ish_tabs_options, $ish_tabs_active_exists;
$tabs_count++;

// Default SC attributes
$defaults = array(
	'color' => '',
	'text_color' => '',
	'contents_color' => '',
	'contents_text_color' => '',
	'layout' => '',
	'vertical_layout' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// This var will be used to receive all tabs titles and data once each tab is done processing
$ish_tabs_navigation = '';

// Set up Global variable for inner shortcodes
$ish_tabs_options= Array(
	'color' => $sc_atts['color'],
	'text_color' => $sc_atts['text_color'],
	'contents_color' => $sc_atts['contents_color'],
	'contents_text_color' => $sc_atts['contents_text_color'],
);

// No Active item handling
$ish_tabs_active_exists = false;

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_tabs';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';

$class = apply_filters( 'ish_sc_classes', $class, $tag );
$return .= $class;
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
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : '';
$return .= '>';

$cont_class = '';
$nav_class = '';

if ( 'vertical-left' == $sc_atts['layout'] || 'vertical-right' == $sc_atts['layout']){
	// Vertical Layout

	// Set Default value
	if ( '' == $sc_atts['vertical_layout'] ){ $sc_atts['vertical_layout'] = '1-2'; }

	// Count the ratio for the grids
	$ratio = explode('-',  $sc_atts['vertical_layout'] );

	if ( 'vertical-left' == $sc_atts['layout'] ){
		$nav_class = ' ish-grid' . ( 12 / ( (int)$ratio[0] + (int)$ratio[1] ) ) * (int)$ratio[0];
		$cont_class = ' ish-grid' . ( 12 / ( (int)$ratio[0] + (int)$ratio[1] ) ) * (int)$ratio[1];

		$nav_class .= ' ish-tabs-left';
	}
	elseif ( 'vertical-right' == $sc_atts['layout'] ){
		$nav_class = ' ish-grid' . ( 12 / ( (int)$ratio[0] + (int)$ratio[1] ) ) * (int)$ratio[1];
		$cont_class = ' ish-grid' . ( 12 / ( (int)$ratio[0] + (int)$ratio[1] ) ) * (int)$ratio[0];

		$nav_class .= ' ish-tabs-right';
	}

}

$content = wpb_js_remove_wpautop($content, true);

// TABS CONTENT
$tabs_content = '';
$tabs_content .= '<div class="ish-tabs-content' . $cont_class . '">';
$tabs_content .= do_shortcode( $content );
$tabs_content .= '</div>';

// TABS NAVIGATION - It must be handled ONLY after the do_shortcode() has been called on content in order to receive nav data
$tabs_navigation = '';

$class = '';

$tabs_navigation .= '<div class="ish-tabs-navigation';

$class .= $nav_class;
$tabs_navigation .= $class . '"><ul>';

$tabs_navigation .= $ish_tabs_navigation; // It's content is generated by each ish_tab shortcode
$tabs_navigation .= '</ul></div>';

// CONTENT
$content = $tabs_navigation . $tabs_content;
if ( $ish_tabs_active_exists ) { $content = str_replace( ' ##ISH_ACTIVE##', '', $content); } else { $content = str_replace( ' ##ISH_ACTIVE##', ' ish-active', $content); }
$return .= $content;

// SHORTCODE END
$return .= '</div>';

echo $return;