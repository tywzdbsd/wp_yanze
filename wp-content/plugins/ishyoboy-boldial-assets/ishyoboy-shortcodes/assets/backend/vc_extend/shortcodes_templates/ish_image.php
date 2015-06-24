<?php

// Default SC attributes
$defaults = array(
	'image' => '',
	'size' => '',
	'image_style' => '',
	'link_type' => '',
	'link_url' => '',
	'align' => '',

	'stretch_image' => '',
	'show_caption' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// GET IMAGE
global $_wp_additional_image_sizes;
$thumbnail = '';
$img_size = '';
if ( (!empty( $_wp_additional_image_sizes[ $sc_atts['size'] ]) && is_array($_wp_additional_image_sizes[ $sc_atts['size'] ])) || in_array($sc_atts['size'], array('thumbnail', 'thumb', 'medium', 'large', 'full') ) ) {
	$img_size = $sc_atts['size'];
	$thumbnail = wp_get_attachment_image( $sc_atts['image'], $img_size, false );
} else {
	$img_size = 'medium';
	$thumbnail = wp_get_attachment_image( $sc_atts['image'], $img_size, false );
}

if ( ! empty( $thumbnail ) ){

	// Necessary for the caption max-width
	$thumbnail_data = '';
	if ( '' != $sc_atts['show_caption'] ){
		$thumbnail_data = wp_get_attachment_metadata( $sc_atts['image'] );
		if ( isset( $thumbnail_data['sizes'][ $img_size ] ) ){
			$thumbnail_data = $thumbnail_data['sizes'][ $img_size ]['width'];
		}
		else{
			$thumbnail_data = $thumbnail_data['width'];
		}
	}

	// SHORTCODE BEGIN
	$return = '';
	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_image';
	$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
	$class .= ( '' != $sc_atts['align'] ) ? (' ish-' . $sc_atts['align'] ) : '' ;
	$class .= ( '' != $sc_atts['image_style'] ) ? (' ish-' . $sc_atts['image_style'] ) : '' ;
	$class .= ( '' != $sc_atts['stretch_image'] ) ? (' ish-fullwidth' ) : '' ;
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
	$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
	$return .= apply_filters( 'ish_sc_classes', $class, $tag );
	$return .= '"' ;

	// ID
	$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

	// STYLE
	if ( '' != $sc_atts['style']){
		$return .= ' style="';
		$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
		$return .= '"';
	}

	// TOOLTIP
	$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : '';
	$return .= '>';

	// LINK DATA
	if ( '' != $sc_atts['link_type'] ){

		$return .= '<a ';

		// HREF
		if ( 'custom' == $sc_atts['link_type'] ){
			// Custom Link
			$url_data = vc_build_link( $sc_atts['link_url'] );
			$return .= ( '' != $url_data['url'] ) ? ' href="' . esc_url( apply_filters( 'ishyoboy_sc_url', $url_data['url'] ) ) . '"' : '';
			$return .= ( false !== strpos( $url_data['target'], '_blank') ) ? ' target="_blank"' : '';
		}
		else{
			// Large image
			$img_details = wp_get_attachment_image_src( $sc_atts['image'], 'full' );
			$return .= ( '' != $img_details[0] ) ? ' href="' . esc_url( $img_details[0] ) . '" target="_blank"' : ' href="#"';
		}

		$return .= '>';
	}

	// CONTENT
	$return .= $thumbnail;

	// LINK DATA
	if ( '' != $sc_atts['link_type'] ){
		$return .= '</a>';
	}

	// IMAGE CAPTION
	if ( '' != $sc_atts['show_caption'] ){
		$img_obj = get_post( $sc_atts['image'] );

		if ( is_object( $img_obj ) ){
			$img_caption = $img_obj->post_excerpt;

			if ( ! empty( $img_caption ) ){
				$return .= '<div class="wp-caption"';
				$return .= ( is_numeric( $thumbnail_data ) ) ? 'style="max-width: ' . $thumbnail_data . 'px;"' : '';
				$return .= '><p class="wp-caption-text">' . $img_caption . '</p></div>';
			}
		}
	}

	// SHORTCODE END
	$return .= '</div>';

	echo $return;
}