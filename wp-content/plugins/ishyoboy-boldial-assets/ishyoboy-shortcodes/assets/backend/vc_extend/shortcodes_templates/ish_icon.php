<?php

// Default SC attributes
$defaults = array(
	'type' => '',
	'align' => '',
	'icon' => '',
	'color' => '',
	'text_color' => '',
	'bg_color' => '',
	'size' => '',
	'url' => '',

	'icon_url' => '',
	'bg_glow' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';

// OUTTER ICON CONTAINER
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_icon';
$class .= ( '' != $sc_atts['type'] ) ? ' ish-' . esc_attr( $sc_atts['type'] ) : '' ;
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
$class .= ( '' != $sc_atts['text_color'] && '' == $sc_atts['bg_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
$class .= ( '' != $sc_atts['type'] && 'yes' == $sc_atts['bg_glow'] ) ? ' ish-glow' : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' == $sc_atts['bg_color'] ) {
	if ( '' != $sc_atts['style'] || '' != $sc_atts['icon_url'] || 'square' == $sc_atts['type'] || 'circle' == $sc_atts['type'] || 'simple' == $sc_atts['type'] || 'hexagon' == $sc_atts['type'] || 'hexagon_rounded' == $sc_atts['type'] ){
		$return .= ' style="';
		$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';

		if ( '' != $sc_atts['size'] && is_numeric( $sc_atts['size'] ) ){
			$return .= 'font-size:' . esc_attr($sc_atts['size']) . 'px;';
			$return .= 'width:' . esc_attr($sc_atts['size']) . 'px;';
			$return .= 'height:' . esc_attr($sc_atts['size']) . 'px;';
		}
		$return .= '"';
	}
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= '>';

// URL TEST
$url_data = vc_build_link( $sc_atts['url'] );

// URL OPEN
if ('' != $url_data['url'] ) {
	$return .= '<a href="' . esc_attr( apply_filters( 'ishyoboy_sc_url', $url_data['url'] ) ) . '"';
	$return .= ( false !== strpos( $url_data['target'], '_blank') ) ? ' target="_blank">' : '>' ;
}

// SOCIAL ICONS BAR URL
if ( '' != $sc_atts['icon_url'] ) {
	$return .= '<a href="' . esc_attr( $sc_atts['icon_url'] ) . '"';

	// Add inline style color to <a> too
	if ( '' != $sc_atts['text_color'] ) {
		$return .= ' style="';
		$return .= 'color: ' . esc_attr( $sc_atts['text_color'] ) . '; background-color: ' . esc_attr( $sc_atts['bg_color'] . ';' );
		$return .= '"';
	}

	$return .= ' target="_blank">';
}

// INNER ICON ELEMENT 1
$return .= '<span';

if ('' != $sc_atts['size'] ) {
	$return .= ' style="';
	$return .= 'width:' . esc_attr($sc_atts['size']) . 'px;';
	$return .= 'height:' . esc_attr($sc_atts['size']) . 'px;';
	$return .= '"';
}

$return .= '>';

// Hexagon & hexagon rounded SVG
if ( 'hexagon' == $sc_atts['type'] || 'hexagon_rounded' == $sc_atts['type'] ) {
	$return .= '<svg width="100px" height="100px" viewBox="0 0 572 650"';

	if ('' != $sc_atts['size'] ) {
		$return .= ' style="';
		$return .= 'width:' . esc_attr($sc_atts['size']) . 'px;';
		$return .= 'height:' . esc_attr($sc_atts['size']) . 'px;';
		$return .= '"';
	}

	// Hexagon
	if ( 'hexagon' == $sc_atts['type'] ) {
		$return .= '><polygon points="284.357,649.85 0,487.646 0.301,162.721 284.961,0 569.322,162.204 569.02,487.129" /></svg>';
	}

	// Hexagon rounded
	if ( 'hexagon_rounded' == $sc_atts['type'] ) {
		$return .= '><path d="M553.901,178.69c-1.79-3.97-3.976-7.721-6.519-11.198c-19.332-32.392-216.94-145.165-255.816-146.085
		c-2.269-0.25-4.57-0.388-6.905-0.388c-2.509,0-4.979,0.165-7.41,0.452C236.099,24.391,42.725,135.1,22.422,167.653
		c-2.579,3.504-4.792,7.29-6.603,11.297C-3.06,212.637-3.067,443.009,16.166,472.354c1.523,3.224,3.318,6.291,5.347,9.184
		c16.503,31.159,214.665,144.547,255.519,146.812c2.502,0.305,5.044,0.48,7.629,0.48c3.483,0,6.896-0.298,10.223-0.846
		c0.731-0.12,1.462-0.245,2.185-0.391c0.159-0.031,0.323-0.067,0.485-0.102c0.87-0.183,1.775-0.391,2.721-0.628
		c0.005-0.001,0.01-0.003,0.015-0.004c53.772-13.502,226.592-113.494,246.468-144.499c3.103-4.124,5.705-8.645,7.722-13.473
		C572.138,429.665,572.058,212.169,553.901,178.69z"/></svg>';
	}
}

// INNER ICON ELEMENT 2
$return .= '<span class="';

$return .= ( '' != $sc_atts['icon'] ) ? esc_attr( $sc_atts['icon'] ) . '"' : '"' ;

if ('' != $sc_atts['size'] ) {
	$return .= ' style="';

	switch ($sc_atts['type']) {
		case 'square':
			$return .= 'width:' . esc_attr($sc_atts['size']) . 'px;';
			$return .= 'height:' . esc_attr($sc_atts['size']) . 'px;';
			$return .= 'font-size:' . ( esc_attr($sc_atts['size']) / 1.7 ) . 'px;';
			break;

		case 'circle':
		case 'hexagon':
		case 'hexagon_rounded':
			$return .= 'width:' . esc_attr($sc_atts['size']) . 'px;';
			$return .= 'height:' . esc_attr($sc_atts['size']) . 'px;';
			$return .= 'font-size:' . ( esc_attr($sc_atts['size']) / 2.1 ) . 'px;';
			break;

		default:
			$return .= 'font-size:' . esc_attr($sc_atts['size']) . 'px;';
			break;
	}

	$return .= 'line-height:' . esc_attr($sc_atts['size']) . 'px;';

	$return .= '"';
}

$return .=  '></span></span>';

// CONTENT
//$return .= $before . $sc_atts['el_text'] . $after;

// URL CLOSE
$return .= ( '' != $url_data['url'] ) ? '</a>' : '';

// SOCIAL ICONS BAR URL CLOSE
$return .= ( '' != $sc_atts['icon_url'] ) ? '</a>' : '';

// SHORTCODE END
$return .= '</div>';


echo $return;