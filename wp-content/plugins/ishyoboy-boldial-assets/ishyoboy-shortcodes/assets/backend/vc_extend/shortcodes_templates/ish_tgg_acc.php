<?php

// Global variables
global $ish_options, $ish_tgg_options;

// Default SC attributes
$defaults = array(
	'behavior' => '',
	'color' => '',
	'text_color' => '',
	'contents_color' => '',
	'contents_text_color' => '',
	'tag' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Set up Global variable for inner shortcodes
$ish_tgg_options= Array(
	'color' => $sc_atts['color'],
	'text_color' => $sc_atts['text_color'],
	'contents_color' => $sc_atts['contents_color'],
	'contents_text_color' => $sc_atts['contents_text_color'],
	'tag' => $sc_atts['tag'],
	'categories' => '',
);

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_tgg_acc';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['behavior'] ) ? ' ish-' . esc_attr( $sc_atts['behavior'] ) : ' ish-toggle' ;
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

$content = wpb_js_remove_wpautop($content, true);
$content = do_shortcode( $content );

// OUTPUT FILTERS
if ( '' != $ish_tgg_options['categories'] ){
	$return .= '<span class="ish-tgg-acc-filter">';

	$cats = explode(',' , $ish_tgg_options['categories']);
	$final_cats = Array();
	$i = 0;

	foreach ( $cats as $category ){

		$category = trim( $category );
		if ( '' != $category ){
			$final_cats[ strtolower($category) ] = $category;
		}

	}

	if ( ! empty( $final_cats ) ){

		$return .= '<a href="#all" class="ish-active">' . __( 'All', 'ishyoboy_assets' ) . '</a>';

		foreach ( $final_cats as $category ){

			$category = trim( $category );
			if ( '' != $category ){

				// Delimiter
				if ( $i < count( $final_cats ) ) { $return .= ' / '; }
				$i++;

				$return .= '<a href="#ish-filter-' . esc_attr( strtolower( str_replace(' ', '-', $category ) ) ) . '">' . esc_html($category) . '</a>';
			}

		}

	}

	$return .= '</span>';
}


// CONTENT
$return .= $content;

// SHORTCODE END
$return .= '</div>';

echo $return;