<?php

// Default SC attributes
$defaults = array(
	'color' => '',
	'text_color' => '',
	'align' => '',
	'prev_text' => '',
	'next_text' => ''
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_portfolio_prev_next';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
//$class .= ( '' != $sc_atts['color'] ) ? ' ish-' . esc_attr( $sc_atts['color'] ) : '' ;
//$class .= ( '' != $sc_atts['text_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['text_color'] ) : '' ;
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
$nav_next = get_permalink( get_adjacent_post( false, '', false ) );
$nav_prev = get_permalink( get_adjacent_post( false, '', true ) );

if ( get_permalink() != $nav_next ){
	$return .= '<div class="ish-portfolio-next-link"><a class="ish-sc_button ish-small' .
		(('' != $sc_atts['color']) ? ' ish-' . esc_attr($sc_atts['color']) : '') .
		(('' != $sc_atts['text_color']) ? ' ish-text-' . esc_attr($sc_atts['text_color']) : '') .
		'" href="' . esc_attr($nav_next) . '">' . ( ('' != $sc_atts['next_text']) ? $sc_atts['next_text'] : __( '&lt; Newer project', 'ishyoboy_assets' ) ) . '</a></div>';
}

if ( get_permalink() != $nav_prev ){
	$return .= '<div class="ish-portfolio-prev-link"><a class="ish-sc_button ish-small' .
		(('' != $sc_atts['color']) ? ' ish-' . esc_attr($sc_atts['color']) : '') .
		(('' != $sc_atts['text_color']) ? ' ish-text-' . esc_attr($sc_atts['text_color']) : '') .
		'" href="' . esc_attr($nav_prev) . '">' . (('' != $sc_atts['prev_text']) ? $sc_atts['prev_text'] : __( 'Older project &gt;', 'ishyoboy_assets' ) ) . '</a></div>';
}

// SHORTCODE END
$return .= '</div>';

echo $return;