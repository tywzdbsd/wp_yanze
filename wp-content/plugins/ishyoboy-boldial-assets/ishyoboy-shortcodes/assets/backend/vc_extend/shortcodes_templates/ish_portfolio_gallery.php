<?php

// Default SC attributes
$defaults = array(
	'slideshow' => '',
	'autoslide' => '',
	'animation' => '',
	'interval' => '',
	'navigation' => '',
	'prevnext' => '',
	'thumbnail_size' => '',
	'nav_color' => '',
	'prevnext_color' => '',
	'nav_align' => '',
	'max_height' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );


// Pre-set thumbnail size
$image_size = 'theme-large';
if ( $sc_atts['thumbnail_size'] != '' ) { $image_size = $sc_atts['thumbnail_size']; }
$id = get_the_ID();
$wp_3_5 = function_exists( 'wp_enqueue_media' );

// Load all attached images
if ( $wp_3_5 ){
	$images = array_filter( explode( ',', IshYoMetaBox::get('porfolio_images', true, $id) ) );
}
else{
	$images = get_children(array(
			'post_parent' => $id,
			'post_type' => 'attachment',
			'numberposts' => -1,
			'post_mime_type' => 'image',
		)
	);
}

// Necessary if no images added.
$return = '';

if ( $images ) {

	if ( 'no' != $sc_atts['slideshow'] ){

		wp_enqueue_script( 'ish-flexslider' );

		$return .= '[ish_slidable';

		$return .= ('' != $sc_atts['id']) ? ' id="' . esc_attr($sc_atts['id']) . '"' : '';
		$return .= ' global_atts="yes"';
		$return .= ('' != $sc_atts['css_class']) ? ' css_class="ish-portfolio_images_slideshow ' . esc_attr($sc_atts['css_class']) .'"' : ' css_class="ish-portfolio_images_slideshow"' ;
		$return .= ('' != $sc_atts['style']) ? ' style="' . esc_attr($sc_atts['style']). '"' : '' ;
		$return .= ('' != $sc_atts['tooltip']) ? ' tooltip="' . esc_attr($sc_atts['tooltip']) . '"' : ''  ;
		$return .= ('' != $sc_atts['tooltip_color']) ? ' tooltip_color="' . esc_attr($sc_atts['tooltip_color']) . '"' : '';
		$return .= ('' != $sc_atts['tooltip_text_color']) ? ' tooltip_text_color="' . esc_attr($sc_atts['tooltip_text_color']) . '"' : '';
		$return .= ('' != $sc_atts['autoslide']) ? ' autoslide="' . esc_attr($sc_atts['autoslide']) .'"' : '' ;
		$return .= ('' != $sc_atts['animation']) ? ' animation="' . esc_attr($sc_atts['animation']) .'"' : '' ;
		$return .= ('' != $sc_atts['interval']) ? ' interval="' . esc_attr($sc_atts['interval']) .'"' : '' ;
		$return .= ('' != $sc_atts['navigation']) ? ' navigation="' . esc_attr($sc_atts['navigation']) .'"' : '' ;
		$return .= ('' != $sc_atts['prevnext']) ? ' prevnext="' . esc_attr($sc_atts['prevnext']) .'"' : '' ;
		$return .= ('' != $sc_atts['nav_align']) ? ' nav_align="' . esc_attr($sc_atts['nav_align']) .'"' : '' ;
		$return .= ('' != $sc_atts['nav_color']) ? ' nav_color="' . esc_attr($sc_atts['nav_color']) .'"' : '' ;
		$return .= ('' != $sc_atts['prevnext_color']) ? ' prevnext_color="' . esc_attr($sc_atts['prevnext_color']) .'"' : '' ;
		$return .= ('' != $sc_atts['max_height']) ? ' max_height="' . esc_attr($sc_atts['max_height']) .'"' : '' ;
		$return .= ']';

		if ( $wp_3_5 ){
			if ( $images ){
				foreach ( $images as $attachment_id ) {
					$return .= '[ish_slide class="ish-portfolio-slide"]';
					$return .= '<a href="' . wp_get_attachment_url($attachment_id) . '" rel="ish-portfolio-gallery-' . $id . '" class="openfancybox-image">';
					$return .=  wp_get_attachment_image( $attachment_id, $image_size );
					$return .= '</a>';
					$return .= '[/ish_slide]';
				}
			}
		}
		else{
			foreach( $images as $image ) {
				$return .= '[ish_slide class="ish-portfolio-slide"]';
				$return .= '<a href="' . wp_get_attachment_url($image->ID) . '" rel="ish-portfolio-gallery-' . $id . '" class="openfancybox-image">';
				$return .= wp_get_attachment_image($image->ID, $image_size);
				$return .= '</a>';
				$return .= '[/ish_slide]';
			}
		}

		$return .= '[/ish_slidable]';

	}
	else{
		// SHORTCODE BEGIN
		$return = '';
		$return .= '<div class="';

		// CLASSES
		$class = 'ish-sc_portfolio_gallery';
		$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
		$class .= ( '' != $sc_atts['nav_color'] ) ? ' ish-nav-' . esc_attr( $sc_atts['nav_color'] ) : '' ;
		$class .= ( '' != $sc_atts['prevnext_color'] ) ? ' ish-prevnext-' . esc_attr( $sc_atts['prevnext_color'] ) : '' ;
		$class .= ( '' != $sc_atts['nav_align'] ) ? (' ish-nav-' . $sc_atts['nav_align'] ) : '' ;
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
		if ( $wp_3_5 ){
			if ( $images ){
				foreach ( $images as $attachment_id ) {
					$return .= '<div class="ish-portfolio-image">';
					$return .= '<a href="' . wp_get_attachment_url($attachment_id) . '" rel="ish-portfolio-gallery-' . $id . '" class="openfancybox-image">';
					$return .= wp_get_attachment_image( $attachment_id, $image_size );
					$return .= '</a>';
					$return .= '</div>';
				}
			}
		}
		else{
			if ( $images ){
				foreach( $images as $image ) {
					$return .= '<div class="ish-portfolio-image">';
					$return .= '<a href="' . wp_get_attachment_url($image->ID) . '" rel="ish-portfolio-gallery-' . $id . '" class="openfancybox-image">';
					$return .= wp_get_attachment_image($image->ID, $image_size);
					$return .= '</a>';
					$return .= '</div>';
				}
			}
		}

		// SHORTCODE END
		$return .= '</div>';
	}
}

echo do_shortcode( $return );