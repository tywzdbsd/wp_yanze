<?php
global $ish_options;

$param['type'] = 'ish_color_selector';
//$param['value'] = ishyoboy_get_theme_colors_array();
$param['value'] = array_merge( array( __( 'No Color', 'ishyoboy_assets' ) => ''), ishyoboy_get_theme_colors_array() );

$param_line = '';
$param_line .= '<div class="'.$param['type'].'_container ish_btnlist_container ish_meta_param">';
$param_line .= '<input name="'. $id .'" class="'. $id .' '. $param['type'] .'" type="hidden" value="'. $value .'"/>';
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

	$text = ( 'advanced' == $val || '' == $val) ? ' ' : substr( $text_val, 5 );
	$class = ( 'advanced' == $val ) ? ' ish-icon-cog' : $class;

	$param_line .= '<a class="'.$param['type'].'_item ish_btnlist_item ' . $class . '" data-ish-value="' . $val . '" href="#" title="' . $text_val . '">' . $text . '</a></li>';
}

$param_line .= '</ul>';
$param_line .= '</div>';

// Do not forget to echo the variable
echo $param_line;