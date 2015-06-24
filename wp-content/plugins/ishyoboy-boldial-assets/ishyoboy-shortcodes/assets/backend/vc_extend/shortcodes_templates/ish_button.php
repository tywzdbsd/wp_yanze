<?php

// Default SC attributes
$defaults = array(
	'el_text' => '',
	'color' => '',
	'text_color' => '',
	'icon' => '',
	'icon_align' => '',
	'full_width' => '',
	'size' => 'small',
	'url' => '',
	'align' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<a class="';

// CLASSES
$class = 'ish-sc_button';
$class .= ( '' != $sc_atts['size'] ) ? ( ' ish-' . $sc_atts['size'] ) : '' ;
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ('yes' == $sc_atts['full_width'] ) ? ' ish-fullwidth' : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// URL
$url_data = vc_build_link( $sc_atts['url'] );
$return .= ( '' != $url_data['url'] ) ? ' href="' . esc_attr( apply_filters( 'ishyoboy_sc_url', $url_data['url'] ) ) . '"' : '';
$return .= ( false !== strpos( $url_data['target'], '_blank') ) ? ' target="_blank"' : '';

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

	if ( 'left' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['el_text'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$before .= $icon;
	}
	elseif ( 'right' == $sc_atts['icon_align'] ){
		$icon_position = ( '' != $sc_atts['el_text'] ) ? ( ' ish-' . $sc_atts['icon_align'] ) : '';
		$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['icon'] . '"></span></span>';
		$after .= $icon;
	}
}

// CONTENT
$return .= $before . $sc_atts['el_text'] . $after;

// SHORTCODE END
$return .= '</a>';

echo $return;