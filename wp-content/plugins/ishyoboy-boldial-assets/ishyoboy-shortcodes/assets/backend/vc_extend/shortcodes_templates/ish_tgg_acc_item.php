<?php

// Global variables
global $ish_tgg_options;

// Default SC attributes
$defaults = array(
	'el_title' => '',
	'icon' => '',
	'icon_align' => '',
	'active' => '',
	'tag' => '',

	'color' => '',
	'text_color' => '',
	'contents_color' => '',
	'contents_text_color' => '',

	'categories' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Override Item settings with Parent ones if necessary
if ( '' == $sc_atts['color'] ) { $sc_atts['color'] = $ish_tgg_options['color']; }
if ( '' == $sc_atts['text_color'] ) { $sc_atts['text_color'] = $ish_tgg_options['text_color']; }
if ( '' == $sc_atts['contents_color'] ) { $sc_atts['contents_color'] = $ish_tgg_options['contents_color']; }
if ( '' == $sc_atts['contents_text_color'] ) { $sc_atts['contents_text_color'] = $ish_tgg_options['contents_text_color']; }

if ( '' == $sc_atts['tag'] ) { $sc_atts['tag'] = ( '' != $ish_tgg_options['tag'] ) ? $ish_tgg_options['tag'] : 'div' ; }

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_tgg_acc_item';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';

// CATEGORIES FILTER
if ( '' != $sc_atts['categories'] ){

	$cats = explode(',' , $sc_atts['categories']);
	$i = 0;

	foreach ( $cats as $category ){

		$category = trim( $category );

		if ( '' != $category ){

			$class .=  ' ish-filter-' . esc_attr( strtolower( str_replace(' ', '-', $category ) ) );

		}

	}



	$ish_tgg_options['categories'] .= ',' . $sc_atts['categories'];
}

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

$content = wpb_js_remove_wpautop($content, true);




// ICON
$before = '';
$after = '';
if ( '' != $sc_atts['icon'] ){

	if ( 'left' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['el_title'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$before .= $icon;
	}
	elseif ( 'right' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['el_title'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$after .= $icon;
	}
}

// NAVIGATION
$class = ( 'yes' == $sc_atts['active'] ) ? ' ish-active' : '';
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$return .= '<' . $sc_atts['tag'] . ' class="ish-tgg-acc-title' . $class . '"><i class="pointer ish-icon-right-open"></i>' . $before . $sc_atts['el_title'] . $after . '</' . $sc_atts['tag'] . '>';

// CONTENT
$class = '';
$class .= ( '' != $sc_atts['contents_color'] ) ? ' ish-' . esc_attr( $sc_atts['contents_color'] ) : '' ;
$class .= ( '' != $sc_atts['contents_text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['contents_text_color'] ) : '' ;
$return .= '<div class="ish-tgg-acc-content' . $class . '">' . do_shortcode( $content ) . '</div>';

// SHORTCODE END
$return .= '</div>';

echo $return;