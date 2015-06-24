<?php

// Contact form 7 plugin
include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
	global $wpdb;
	$cf7 = $wpdb->get_results(
		"
  	SELECT ID, post_title
  	FROM $wpdb->posts
  	WHERE post_type = 'wpcf7_contact_form'
  	"
	);
	$contact_forms = array();
	if ($cf7) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms["No contact forms found"] = 0;
	}
	vc_map( array(
		'base' => 'ish_cf7',
		'name' => __("Contact Form 7", "js_composer"),
		'icon' => 'ish-icon-vcard',
		'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
		'weight' => 800,
		"description" => __('Place Contact Form7', 'js_composer'),
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Form title", "js_composer"),
				"param_name" => "title",
				"admin_label" => true,
				"description" => __("What text use as form title. Leave blank if no title is needed.", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Select contact form", "js_composer"),
				"param_name" => "form_id",
				"value" => $contact_forms,
				"description" => __("Choose previously created contact form from the drop down list.", "js_composer")
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Color', 'ish-sc-plugin' ),
				'param_name' => 'color',
				'std' => 'color2',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Background Text Color', 'ish-sc-plugin' ),
				'param_name' => 'bg_text_color',
				'std' => 'color3',
				'value' => $ish_theme_colors,
			),
			array(
				'type' => 'ish_color_selector',
				'heading' => __( 'Text Color', 'ish-sc-plugin' ),
				'param_name' => 'text_color',
				'std' => '',
				'value' => array_merge( array( __( 'Inherit from parent', 'ishyoboy_assets' ) => ''), $ish_theme_colors ),
			)

		)
	) );
} // if contact form7 plugin active