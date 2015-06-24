<?php
/*
$param_line .= '<select name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$param['param_name'].' '.$param['type'].'">';

foreach ( $param['value'] as $text_val => $val ) {
	if ( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
		$text_val = $val;
	}
	$text_val = __($text_val, "ish-sc-plugin");
	//$val = strtolower(str_replace(array(" "), array("_"), $val));
	//$val = strtolower(str_replace(array(" "), array("_"), $val)); //issue #464 github
	$selected = '';
	if ( $val == $param_value ) $selected = ' selected="selected"';
	$param_line .= '<option class="ish_cd_'.$val.'" value="'.$val.'"'.$selected.'>'.$text_val.'</option>';
}
$param_line .= '</select>';

// Do not forget to echo the variable
echo $param_line;

*/

$dependency = vc_generate_dependencies_attributes($settings);

$value = __($param_value, "ish-sc-plugin");
$value = htmlspecialchars($value);
//$value = $param_value;
$param_line .= '<div class="'.$param['type'].'_container ish_btnlist_container">';
$param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].'" type="hidden" value="'.$value.'" ' . $dependency . '/>';
$param_line .= '<ul class="'.$param['type'].'_list ish_btnlist_list">';

foreach ( $param['value'] as $text_val => $val ) {
	if ( '' == $val ){
		$class = 'ish-icon-noneselected';
	}
	else{
		$class = $val;
	}

	if ( $value == $val){
		$param_line .= '<li class="active">';
	}
	else{
		$param_line .= '<li>';
	}

	$text = ( 'advanced' == $val || '' == $val) ? ' ' : substr($text_val, 5);
	$class = ( 'advanced' == $val ) ? ' ish-icon-cog' : $class;

	$param_line .= '<a class="'.$param['type'].'_item ish_btnlist_item ' . $class . '" data-ish-value="' . $val . '" href="#" title="' . $text_val . '">' . $text . '</a></li>';
}

$param_line .= '</ul>';
$param_line .= '</div>';



// Do not forget to echo the variable
echo $param_line;