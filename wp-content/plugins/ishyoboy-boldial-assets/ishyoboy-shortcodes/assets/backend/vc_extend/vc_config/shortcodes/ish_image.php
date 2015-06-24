<?php

class WPBakeryShortCode_Ish_Image extends WPBakeryShortCode {



	public function singleParamHtmlHolder($param, $value) {
		$output = '';
		// Compatibility fixes
		$old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
		$new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
		$value = str_ireplace($old_names, $new_names, $value);
		//$value = __($value, "js_composer");
		//
		$param_name = isset($param['param_name']) ? $param['param_name'] : '';
		$type = isset($param['type']) ? $param['type'] : '';
		$class = isset($param['class']) ? $param['class'] : '';

		if ( isset($param['holder']) === true && $param['holder'] !== 'hidden' ) {
			$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
		} elseif(isset($param['holder']) === true && $param['holder'] == 'input') {
			$output .= '<'.$param['holder'].' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'">';
		} elseif(isset($param['holder']) === true && in_array($param['holder'], array('img', 'iframe'))) {
			$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="'.$value.'">';
		} elseif ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
			$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			if ( ( $param['type']) == 'attach_image' ) {
				$img = wpb_getImageBySize(array( 'attach_id' => (int)preg_replace('/[^\d]/', '', $value), 'thumb_size' => 'full' ));
				$output .= ( $img ? $img['full'] : '<img width="70" height="70" src="" class="attachment-thumbnail"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />')
				. '<img src="" class="no_image_image' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '" /><div class="ish-add-image' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '"><a href="#" class="column_edit_trigger button">' . __( 'Add image', 'js_composer' ) . '</a></div>';
			}
		}

		if(isset($param['admin_label']) && $param['admin_label'] === true) {
			$output .= '<span class="vc_admin_label admin_label_'.$param['param_name'].(empty($value) ? ' hidden-label' : '').'"><label>'.__($param['heading'], 'js_composer').'</label>: '.$value.'</span>';
		}

		return $output;


		/*if ( isset($param['holder']) == false || $param['holder'] == 'hidden' ) {
			$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			if ( ( $param['type']) == 'attach_image' ) {
				$img = wpb_getImageBySize(array( 'attach_id' => (int)preg_replace('/[^\d]/', '', $value), 'thumb_size' => 'thumbnail' ));
				$output .= ( $img ? $img['thumbnail'] : '<img width="70" height="70" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />') . '<img src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/elements_icons/single_image.png') . '" class="no_image_image' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && !empty($img['p_img_large'][0]) ? ' image-exists' : '' ) . '">' . __( 'Add image', 'js_composer' ) . '</a>';
			}
		}
		else {
			$output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">'.$value.'</'.$param['holder'].'>';
		}
		return $output;*/
	}
}

vc_map( array(
	'name' => __( 'Image', 'ishyoboy_assets' ),
	'base' => 'ish_image',
	'class' => '',
	'show_settings_on_create' => true,
	'category' => Array( __('Content', 'js_composer'), __('IshYoBoy', 'ishyoboy_assets') ),
	'icon' => 'ish-icon-picture-1',
	//'admin_enqueue_js' => array( IYB_SC_PLUGIN_URI . '/assets/backend/js/vc_shortcodes/' . 'ish_icon' . '.js' ),
	//'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
	'weight' => 900,
	'params' => array_merge(
		array(
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'ishyoboy_assets' ),
				'param_name' => 'image',
				'value' => '',
				'description' => __( 'Select image from media library.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Image Style', 'ishyoboy_assets' ),
				'param_name' => 'image_style',
				//'admin_label' => true,
				'value' => array(
					'Regular' => '',
					'Rounded' => 'rounded'
				),
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image Size', 'ishyoboy_assets' ),
				'param_name' => 'size',
				//'admin_label' => true,
				'value' => $ish_image_sizes,
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Stretch to Full-width', 'ishyoboy_assets' ),
				'param_name' => 'stretch_image',
				'std' => '',
				'value' => array(
					'No' => '',
					'Yes' => 'yes'
				),
				'description' => __( 'Stretch the image to full width if image is smaller than container.', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image Link', 'ishyoboy_assets' ),
				'param_name' => 'link_type',
				'admin_label' => true,
				'value' => Array(
					__( 'No Link', 'ish-sc-plugin' ) => '',
					__( 'Large Image', 'ish-sc-plugin' ) => 'image',
					__( 'Custom Link', 'ish-sc-plugin' ) => 'custom',
				),
				//'description' => __( '', 'ishyoboy_assets' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link URL', 'ishyoboy_assets' ),
				'param_name' => 'link_url',
				'value' => '',
				'description' => __( 'URL for the image link.', 'ishyoboy_assets' ),
				'dependency' => Array( 'element' => 'link_type', 'value' => 'custom' ),
			),
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Image Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
				'admin_label' => true,
			),
			array(
				'type' => 'ish_buttons_selector_full',
				'heading' => __( 'Display Image Caption', 'ishyoboy_assets' ),
				'param_name' => 'show_caption',
				'std' => '',
				'value' => array(
					'No' => '',
					'Yes' => 'yes'
				),
				'description' => __( 'Display the image caption if set in its settings.', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	),
	'js_view' => 'IshImageView',
) );