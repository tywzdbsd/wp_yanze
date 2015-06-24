<?php

/*******************************************************************************************************************
 * Add custom meta boxes
 */
/*
add_ishyo_meta_box('slides_urls', array(
	'title'     => __('Slide Settings', 'ishyoboy_assets'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('ishyoboy_slides'), 'slides_urls'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => __('Slide type', 'ishyoboy_assets'),
			'id' => 'slide_type',
			'default' => 'content',
			'desc' => '',//__('Choose how the lead content will be displayed. The "unboxed" version is usually used for full-width slider shortcodes.', 'ishyoboy_assets'),
			'type' => 'radio',
			'options' => array(
				'content' => __('Content', 'ishyoboy_assets'),
				'image' => __('Image', 'ishyoboy_assets'),
			)
		),
		array(
			'name' => __('Slide url link', 'ishyoboy_assets'),
			'id' => 'slide_url',
			'default' => '',
			'desc' => __('Enter the url which the slide will link to. E.g. http://www.ishyoboy.com', 'ishyoboy_assets'),
			'type' => 'text',
		),
		array(
			'name' => __('New window', 'ishyoboy_assets'),
			'id' => 'slide_url_nw',
			'default' => 'true',
			'desc' => __('Open link in a new window.', 'ishyoboy_assets'),
			'type' => 'checkbox'
		)
	)
));
*/
add_ishyo_meta_box('ishyoboy_portfolio_images_box', array(
	'title'     => __('Portfolio Gallery', 'ishyoboy_assets'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('portfolio-post'), 'ishyoboy_portfolio_images_box'),
	'context'   => 'side',
	'priority'  => 'default',
	'fields'    => array(
		array(
			'name' => '', //__('Upload images', 'ishyoboy_assets'),
			'id' => 'porfolio_images',
			'default' => '',
			'desc' => '',
			'type' => 'images2',
		)
	)
));

add_ishyo_meta_box('ishyoboy_portfolio_settings', array(
	'title'     => __('Color Settings', 'ishyoboy_assets'),
	'pages'		=> apply_filters( 'ish_metabox_posttypes', array('portfolio-post'), 'ishyoboy_portfolio_settings'),
	'context'   => 'normal',
	'priority'  => 'core',
	'fields'    => array(
		array(
			'name' => __( 'Background color', 'ishyoboy_assets' ),
			'id' => 'color',
			'default' => '',
			'desc' => __( 'Used in Taglines and portfolio Grid overview.', 'ishyoboy_assets'),
			'type' => 'color_selector',
		),
		array(
			'name' => __( 'Text color', 'ishyoboy_assets' ),
			'id' => 'text_color',
			'default' => '',
			'desc' => __( 'Used in Taglines and portfolio Grid overview.', 'ishyoboy_assets'),
			'type' => 'color_selector',
		),
		array(
			'name' => __('Masonry size', 'ishyoboy_assets'),
			'id' => 'masonry_size',
			'default' => '',
			'desc' => __( 'Used in Masonry Grid overview.', 'ishyoboy_assets'),
			'type' => 'radio_random',
			'options' => array(
				'1_1' => __( '1 x 1', 'ishyoboy_assets' ),
				'1_2' => __( '1 x 2', 'ishyoboy_assets' ),
				'2_1' => __( '2 x 1', 'ishyoboy_assets' ),
				'2_2' => __( '2 x 2', 'ishyoboy_assets' ),
			)
		),
	)
));