<?php

// Default SC attributes
$defaults = array(
	'category' => '',
	'exclude_category' => '',
	'order' => '',
	'columns' => '',
	'count' => '',

	'show_title_icon' => '',
	'show_media' => '',
	'show_date' => '',
	'show_categories' => '',
	'show_read_more' => '',
	'show_excerpt' => '',
	'show_likes' => '',

	'show_author' => '',
	'show_tags' => '',
	'show_comments' => '',

	'slideshow' => 'no',
	'autoslide' => '', //"yes" or "no"
	'animation' => '', // "slide" or "fade"
	'interval' => '', // "slide" or "fade"
	'navigation' => '', // "slide" or "fade"

	'skip' => '', // Number of posts to skip
	'order_by' => '', // Change the ordering criteria, default: 'date' (http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters)
	'post_format' => '',
	'post_format_exclude' => '',
	'post_ids' => '',
	'post_ids_exclude' => '',
	'post_tags' => '',
	'post_tags_exclude' => '',
	// Negative categories added, multiple categories added

	'color' => '',
	'text_color' => '',
	'contents_color' => '',

);

global $ish_sc_count, $ish_sc_paginated_count, $ish_options;

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// Default type of connecting multiple taxonomy "filters". Do not change this!
$tax_query = array(
	'relation' => 'AND'
);


if ( ( isset( $sc_atts['category'] ) && '' != $sc_atts['category'] ) || ( isset( $sc_atts['exclude_category'] ) && '' != $sc_atts['exclude_category'] ) ){
	// Display items from chosen categories

	$cats = explode( ',', $sc_atts['category'] );
	$neg_cats = explode( ',', $sc_atts['exclude_category'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'category' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'category' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {

		$tax_query[] = array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $cats
		);

	}

}
else{
	// Display items from all categories
	// $tax_query = array();
}

// Filter by post format
if ( ( isset( $sc_atts['post_format'] ) && '' != $sc_atts['post_format'] ) || ( isset( $sc_atts['post_format_exclude'] ) && '' != $sc_atts['post_format_exclude'] ) ){
	// Display items from chosen post formats

	if ( 'standard' == $sc_atts['post_format'] ){
		$sc_atts['post_format_exclude'] .= 'quote,video,audio,link,aside,image,chat,gallery,status';
	}

	$cats = explode( ',', $sc_atts['post_format'] );
	$neg_cats = explode( ',', $sc_atts['post_format_exclude'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', 'post-format-' . $cat_slug, 'post_format' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', 'post-format-' . $cat_slug, 'post_format' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {

		$tax_query[] = array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => $cats
		);

	}

}
else{
	// Display items from all categories
	//$tax_query = array();
}

// Filter by tags
if ( ( isset( $sc_atts['post_tags'] ) && '' != $sc_atts['post_tags'] ) || ( isset( $sc_atts['post_tags_exclude'] ) && '' != $sc_atts['post_tags_exclude'] ) ){
	// Display items from chosen tags

	$cats = explode( ',', $sc_atts['post_tags'] );
	$neg_cats = explode( ',', $sc_atts['post_tags_exclude'] );
	$cat_ids = array();
	$neg_cat_ids = array();

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'post_tag' );
			if ($cat) $cat_ids[] = $cat->term_id;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$cat = get_term_by( 'slug', $cat_slug, 'post_tag' );
			if ($cat) $neg_cat_ids[] = $cat->term_id;

		}
	}

	if ( count( $cat_ids ) > 0 || count( $neg_cat_ids ) > 0 ){

		if ( count( $cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_tag',
				'field' => 'id',
				'terms' => $cat_ids
			);
		}

		if ( count( $neg_cat_ids ) > 0 ) {
			$tax_query[] = array(
				'taxonomy' => 'post_tag',
				'field' => 'id',
				'terms' => $neg_cat_ids,
				'operator' => 'NOT IN'
			);
		}

	}
	else {

		$tax_query[] = array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => $cats
		);

	}

}
else{
	// Display items from all categories
	//$tax_query = array();
}

$positive_ids = array();
$negative_ids = array();

// Filter by Post IDs
if ( ( isset( $sc_atts['post_ids'] ) && '' != $sc_atts['post_ids'] ) || ( isset( $sc_atts['post_ids_exclude'] ) && '' != $sc_atts['post_ids_exclude'] ) ){
	// Display items from chosen ids

	$cats = explode( ',', $sc_atts['post_ids'] );
	$neg_cats = explode( ',', $sc_atts['post_ids_exclude'] );

	// Categories IDs list
	if ( ! empty( $cats ) ){
		foreach ( $cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$positive_ids[] = $cat_slug;

		}
	}

	// Excluded Categories IDs list
	if ( ! empty( $neg_cats ) ){
		foreach ( $neg_cats as $cat_slug ){

			$cat_slug = trim( $cat_slug );
			$negative_ids[] = $cat_slug;

		}
	}

}


$thumb_size = 'theme-large';
$grid = 'ish-grid3';

if ( is_numeric( $sc_atts['columns'] ) ){
	switch ( $sc_atts['columns'] ) {
		case '4' :
			$grid = 'ish-grid3';
			$thumb_size = 'theme-half';
			break;
		case '3' :
			$grid = 'ish-grid4';
			$thumb_size = 'theme-half';
			break;
		case '2' :
			$grid = 'ish-grid6';
			$thumb_size = 'theme-large';
			break;
		case '1' :
			$grid = 'ish-grid12';
			$thumb_size = 'theme-large';
			break;
		case '5' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-fourth';
			break;
		case '6' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-fourth';
			break;
		case '7' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-fourth';
			break;
		case '8' :
			$grid = 'ish-grid2';
			$thumb_size = 'theme-fourth';
			break;
		default :
			$grid = 'ish-grid3';
			$thumb_size = 'theme-half';
	}
}

$order = ( 'ASC' == strtoupper($sc_atts['order']) ) ? 'ASC' : 'DESC' ; // ASC OR DESC
$orderby = ( isset( $sc_atts['order_by'] ) && '' != $sc_atts['order_by'] ) ? $sc_atts['order_by'] : 'date';

$offset = ( isset( $sc_atts['skip'] ) && is_numeric( $sc_atts['skip'] ) ) ? $sc_atts['skip'] : '0';

// Get all Portfolio posts
$wpbp = new WP_Query( array(
		'post_type' =>  'post',
		'posts_per_page'  => $sc_atts['count'],
		'order' => $order,
		'orderby' => $orderby,
		'offset' => $offset,
		'post__in' => $positive_ids,
		'post__not_in' => $negative_ids,
		'post_status' => 'publish',
		'tax_query' => $tax_query
	)
);


// SHORTCODE BEGIN
$return = '';

if ( $wpbp->have_posts() ) {

	$return .= '<div class="';

	// CLASSES
	$class = 'ish-sc_recent_posts ';
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

	$return .= ' data-count="' . $sc_atts['columns'] . '"';
	$return .= '>';

	$return .= '<div class="ish-row">';

	$count = 0;

	$contents_color = ( '' != $sc_atts['contents_color'] ) ? ' ish-text-' . esc_attr( $sc_atts['contents_color'] ) : '' ;

	while ( $wpbp->have_posts() ) {
		$wpbp->the_post();
		$count++;
		$terms = get_the_terms(  get_the_ID(), 'category' );

		$color_data = ishyoboy_get_color_data();

		if ( '' != $sc_atts['color'] ) {
			$color_data['bg_class'] = ' ish-' . $sc_atts['color'];
			$color_data['bg_color'] = $sc_atts['color'];
		}
		if ( '' != $sc_atts['text_color'] ) {
			$color_data['text_class'] = ' ish-text-' . $sc_atts['text_color'];
			$color_data['text_color'] = $sc_atts['text_color'];
		}

		// Backup if no colors
		if ( '' == $color_data['bg_color'] ) {
			$color_data['bg_class'] = ' ish-color1';
			$color_data['bg_color'] = 'color1';
		}
		if ( '' == $color_data['text_color'] ) {
			$color_data['text_class'] = ' ish-text-color3';
			$color_data['text_color'] = 'color3';
		}

		$return .= '<div id="rc-post-' . get_the_ID() . '" class="ish-recent_posts_post ' . $grid . $color_data['bg_class'] . $contents_color . '">';

		$format = get_post_format();

		switch ($format){
			case 'video':
				$post_icon = 'ish-icon-movie';
				break;
			case 'audio':
				$post_icon = 'ish-icon-headphones';
				break;
			case 'link':
				$post_icon = 'ish-icon-link';
				break;
			case 'quote':
				$post_icon = 'ish-icon-quote';
				break;
			case 'image':
				$post_icon = 'ish-icon-picture-1';
				break;
			default:
				$post_icon = 'ish-icon-align-left';
		}

		$return .= '<div class="recent_posts_post_content">';



		// Blog title
		if ( 'no' != $sc_atts['show_title_icon']){
			$return .= '<h3><a href="' . get_permalink() . '"><i class="' . $post_icon . '"></i>' . get_the_title() . '</a>' . '</h3>';
		}
		else{
			$return .= '<h3>' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</h3>';
		}

		// Blog post details
		$return .= '<div class="rc-post-details-top">';

		if ( 'no' != $sc_atts['show_date'] ) {
			$return .= '<a href="' . get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') ) . '">' . get_the_time( get_option( 'date_format' ) ) . '</a> ';
		}

		// Comments
		if ( 'no' != $sc_atts['show_comments'] ) {
			$return .= '<a href="' . get_comments_link() .'"><i class="ish-icon-chat"></i>'. get_comments_number() .'</a> ';
		}

		// Likes
		if ( 'no' != $sc_atts['show_likes'] ) {
			if ( function_exists('ishyoboy_get_likes') ){
				$return .= ishyoboy_get_likes( false );
			}
		}

		$return .= '</div>';

		// Blog post media
		switch ($format){

			case 'video':
				if ( 'no' != $sc_atts['show_media']){
					ob_start();
					ishyoboy_the_post_video(get_the_ID());
					$doc = ob_get_clean();
					$return .= str_replace(array("\r\n", "\n", "\r"), '', $doc);
				}
				break;

			case 'audio':
				if ( 'no' != $sc_atts['show_media']){
					ob_start();
					ishyoboy_the_post_audio(get_the_ID());
					$doc = ob_get_clean();
					$return .= str_replace(array("\r\n", "\n", "\r"), '', $doc);
				}
				break;

			case 'link':
				if ( 'no' != $sc_atts['show_excerpt']){
					$return .= '<a href="'.  esc_attr( ishyoboy_get_post_format_url() ) . '" target="_blank" class="ish-button-big pt-link">' . ishyoboy_get_post_format_url_text() . '</a>';
				}
				break;

			case 'quote':
				if ( 'no' != $sc_atts['show_excerpt']){
					ob_start();
					$quote = ishyoboy_get_post_format_quote();
					if ('' != $quote){
						echo '<blockquote class="post-quote-content">';
						echo $quote;

						// Get Quote source
						$quote_source = ishyoboy_get_post_format_quote_source();
						if ('' != $quote_source){

							// Get Quote URL
							$quote_url = ishyoboy_get_post_format_url();
							if ('' != $quote_url){

								echo '<cite><a href="', $quote_url ,'" target="_blank">', $quote_source, '</a></cite>';

							}
							else{

								echo '<cite>', $quote_source, '</cite>';

							}

						}

						echo '</blockquote>';
					}
					$return .= ob_get_clean();
				}
				break;

			default:
				if ( 'no' != $sc_atts['show_media']){
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
						$return .= '<div class="main-post-image"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), $thumb_size) . '</a></div>';
					}
				}
		}

		// Excerpt
		if ( 'no' != $sc_atts['show_excerpt']){
			if ( 'link' != $format ){
				$post = get_post();
				$excerpt = '';
				$excerpt = ishyoboy_custom_excerpt($post->post_content, 30);

				if ( '' != $excerpt ){
					$return .=  "\n\n" . '<div class="excerpt"><p>' . $excerpt . '</p></div>' . "\n\n";
				}
			}
		}

		// Blog post details
		$return .= '<div class="rc-post-details-bottom">';

		if ( 'no' != $sc_atts['show_author'] ) {
			$return .= '<span><span>' . __( 'by', 'ishyoboy_assets') . ' ' . get_the_author() . '</span></span> ';
		}

		if ( 'no' != $sc_atts['show_categories'] ) {
			if ( has_category() ) {
				$return .= '<span><span>' . __( 'in category', 'ishyoboy_assets') . '</span> ';

				if (isset($terms) && '' != $terms ) {
					$i = 0;
					foreach ($terms as $term) {
						$i++;
						$return .= '<a href="' . esc_attr( get_term_link($term)) . '">' . $term->name . '</a>' . " ";
						if (3 == $i ) {
							if ( count($terms) > $i ) { $return .= '...'; }
							break;
						}
					}
				}

				$return .= '</span> ';
			}
		}

		if ( 'no' != $sc_atts['show_tags'] ) {
			if ( has_tag() ) {
				$terms = get_the_tags();
				$return .= '<span><span>' . __( 'tagged as', 'ishyoboy_assets') . '</span> ';

				if (isset($terms) && '' != $terms ) {
					$i = 0;
					foreach ($terms as $term) {
						$i++;
						$return .= '<a href="' . esc_attr(get_term_link($term)) . '">' . $term->name . '</a>' . " ";
						if (3 == $i ) {
							if ( count($terms) > $i ) { $return .= '...'; }
							break;
						}
					}
				}

				$return .= '</span> ';
			}
		}

		$return .= '</div>';

		// Read more link
		if ('no' != $sc_atts['show_read_more']){
			$return .=  '<a class="ish-recent_posts-read_more ish-sc_button ish-left ' . $color_data['bg_class'] . $color_data['text_class'] . '" href="' . get_permalink() . '">' . __( 'Read more', 'ishyoboy_assets') . '</a>';
		}
		$return .= '</div></div>';

		if ( ( $count % $sc_atts['columns'] == 0 ) && ( $count != $sc_atts['count'] ) && ( $count != $wpbp->post_count ) ) {

			if ( 'yes' == $sc_atts['slideshow'] ){
				$return .= '[/slide]
                    [slide class="recent_posts_slide"]';
			}
			else{
				$return .= '</div><div style="clear: both;"></div><div class="ish-row">';
			}
		}


	}// Endwhile

	if ( 'yes' == $sc_atts['slideshow'] ){
		$return .= '[/slide][/slidable]';
	}
	else{
		$return .= '</div>';
	}

	// SHORTCODE END
	$return .= '</div>';

}

wp_reset_query();

echo $return;