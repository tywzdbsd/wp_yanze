<?php

// Default SC attributes
$defaults = array(
	'type' => '',

	// TEXT
	'text_content' => '',
	'text_size' => '',

	// ICON
	'icon' => '',
	'icon_size' => '',

	// BUTTON
	'button_text' => '',
	'url' => '',
	'button_size' => 'small',
	'color' => '',
	'text_color' => '',
	'button_icon' => '',
	'button_icon_align' => '',
);

// Empty the unnecessary values based on the row type
switch ($defaults['type']){
	case 'icon':

		foreach ( $defaults as $key => $val ){
			if ( !in_array( $key, array( 'type', 'icon', 'icon_size' ) ) )
				$defaults[$key] = '';
		}

		break;

	case 'button' :

		foreach ( $defaults as $key => $val ){
			if ( !in_array( $key, array( 'type', 'button_text', 'url', 'button_size', 'color', 'text_color', 'button_icon', 'button_icon_align' ) ) )
				$defaults[$key] = '';
		}

		break;

	default :
		foreach ( $defaults as $key => $val ){
			if ( ! in_array( $key, array( 'type', 'text_content', 'text_size' ) ) )
				$defaults[$key] = '';
		}
}

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<tr class="';

// CLASSES
$class = 'ish-sc_pricing_row';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
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

$return .= '><td>';

switch ( $sc_atts['type'] ){
	case '' :
		$el_tag = ( '' != $sc_atts['text_size'] ) ? $sc_atts['text_size'] : 'p';
		$return .= '<' . $el_tag . '>';
		$return .= do_shortcode($sc_atts['text_content']);
		$return .= '</' . $el_tag . '>';
		break;

	case 'icon' :

		// OUTTER ICON CONTAINER
		$return .= '<div class="ish-sc_icon"';

		if ( '' != $sc_atts['icon_size'] && is_numeric( $sc_atts['icon_size'] ) ){
			$return .= ' style="';
			$return .= 'font-size:' . esc_attr($sc_atts['icon_size']) . 'px;';
			$return .= 'width:' . esc_attr($sc_atts['icon_size']) . 'px;';
			$return .= 'height:' . esc_attr($sc_atts['icon_size']) . 'px;';
			$return .= '"';
		}
		$return .= '>';

		// INNER ICON ELEMENT 1
		$return .= '<span';

		if ('' != $sc_atts['icon_size'] ) {
			$return .= ' style="';
			$return .= 'width:' . esc_attr($sc_atts['icon_size']) . 'px;';
			$return .= 'height:' . esc_attr($sc_atts['icon_size']) . 'px;';
			$return .= '"';
		}

		$return .= '>';

		// INNER ICON ELEMENT 2
		$return .= '<span class="';

		$return .= ( '' != $sc_atts['icon'] ) ? esc_attr( $sc_atts['icon'] ) . '"' : '"' ;

		if ( '' != $sc_atts['icon_size'] ) {
			$return .= ' style="';

			switch ($sc_atts['type']) {
				default:
					$return .= 'font-size:' . esc_attr($sc_atts['icon_size']) . 'px;';
					break;
			}

			$return .= 'line-height:' . esc_attr($sc_atts['icon_size']) . 'px;';
			$return .= '"';
		}

		$return .=  '</span></span>';

		// SHORTCODE END
		$return .= '</div>';
		break;

	case 'button' :

		// SHORTCODE BEGIN
		$return .= '<a class="';

		// CLASSES

		$class = 'ish-sc_button';
		$class .= ( '' != $sc_atts['button_size'] ) ? ( ' ish-' . $sc_atts['button_size'] ) : '' ;
		$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
		$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
		$return .= $class;
		$return .= '"' ;

		// URL
		$url_data = vc_build_link( $sc_atts['url'] );
		$return .= ( '' != $url_data['url'] ) ? ' href="' . esc_attr( apply_filters( 'ishyoboy_sc_url', $url_data['url'] ) ) . '"' : '';
		$return .= ( false !== strpos( $url_data['target'], '_blank') ) ? ' target="_blank"' : '';

		$return .= '>';

		$before = '';
		$after = '';

		// ICON
		if ( '' != $sc_atts['button_icon'] ){

			if ( 'left' == $sc_atts['button_icon_align'] ){
				$icon_position = ( '' != $sc_atts['button_text'] ) ? ( ' ish-' . $sc_atts['button_icon_align'] ) : '';
				$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['button_icon'] . '"></span></span>';
				$before .= $icon;
			}
			elseif ( 'right' == $sc_atts['button_icon_align'] ){
				$icon_position = ( '' != $sc_atts['button_text'] ) ? ( ' ish-' . $sc_atts['button_icon_align'] ) : '';
				$icon = '<span class="ish-icon' . $icon_position . '"><span class="' . $sc_atts['button_icon'] . '"></span></span>';
				$after .= $icon;
			}
		}

		// CONTENT
		$return .= $before . $sc_atts['button_text'] . $after;

		// SHORTCODE END
		$return .= '</a>';
		break;
}

// SHORTCODE END
$return .= '</td></tr>';

echo $return;