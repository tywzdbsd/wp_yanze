<?php
/**
 * Created by PhpStorm.
 * User: VlooMan
 * Date: 12.11.2013
 * Time: 11:03
 */

$dependency = vc_generate_dependencies_attributes($settings);
$value = $param_value;

$param_line .= '<div class="'.$param['type'].'_container ish_btnlist_container">';
$param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.esc_attr( $value ).'" ' . $dependency . '/>';

// USER ICONS LIST
$ish_user_icons = $this->get_user_fontello_icons_array();

// ISHYOBOY ICONS
if ( ! empty( $ish_user_icons ) ) {
	$param_line .= '<span class="' . $param['type'] . '_heading description clear">' . __( 'IshYoBoy Icons', 'ish-sc-plugin' ) . ':' . '</span>';
}
$subline = '<ul class="'.$param['type'].'_list ish_btnlist_list">';

foreach ( $param['value'] as $key => $val ) {
	if ( '' == $val ){
		$class = 'ish-icon-noneselected';
	}
	else{
		$class = $val;
	}

	if ( $value == $val){
		$subline .= '<li class="active">';
	}
	else{
		$subline .= '<li>';
	}
	$subline .= '<a class="'.$param['type'].'_item ish_btnlist_item ' . $class . '" data-ish-value="' . $val . '" href="#" title="' . $key . '"></a></li>';
}

$param_line .= $subline;
$param_line .= '</ul>';

// USER ICONS
if ( ! empty( $ish_user_icons ) ){
	$subline = '<ul class="'.$param['type'].'_list ish_btnlist_list">';

	foreach ( $ish_user_icons as $key => $val ) {

		$class = $val;

		if ( $value == $val){
			$subline .= '<li class="active">';
		}
		else{
			$subline .= '<li>';
		}
		$subline .= '<a class="'.$param['type'].'_item ish_btnlist_item ' . $class . '" data-ish-value="' . $val . '" href="#" title="' . $key . '"></a></li>';
	}

	$subline .= '</ul>';
	$param_line .= '<span class="' . $param['type'] . '_heading description clear">' . __( 'Fontello Icons', 'ish-sc-plugin' ) . ':' . '</span>';
	$param_line .= $subline;
}
$param_line .= '</div>';



// Do not forget to echo the variable
echo $param_line;