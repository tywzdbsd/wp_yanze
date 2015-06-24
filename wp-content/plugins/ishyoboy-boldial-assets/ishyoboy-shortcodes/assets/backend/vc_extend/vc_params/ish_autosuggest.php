<?php
/**
 * Created by PhpStorm.
 * User: VlooMan
 * Date: 12.11.2013
 * Time: 11:03
 */
global $ish_autosuggest_count;

// This is very important! It is used to pair inputs with data_sources!
$ish_autosuggest_count++;

$dependency = vc_generate_dependencies_attributes( $settings );

wp_enqueue_script('jquery-ui-autocomplete');

$js_array = Array();

if ( ( isset( $param['value'] ) ) && ( is_array( $param['value'] ) ) && ( ! empty( $param['value'] ) ) ){
	foreach ( $param['value'] as $key => $key_value){
		$js_array[] = Array( 'label' => $key, 'value' => $key_value );
	}
}

$value = $param_value;
$value = htmlspecialchars($value);
//$value = $param_value;

if ( isset($param['value']) && is_array( $param['value'] ) ){
	$all = array_flip( $param['value'] );
}
else{
	$all = '';
}

$nice_vals = Array();
if ( ! empty($value) ){
	$vals = explode(',', $value);

	foreach ( $vals as $val){
		$trimmed = trim($val);
		if ( !empty($trimmed) ){
			if ( isset( $all[ $trimmed ] ) ){
				$nice_vals[] = $all[ $trimmed ];
			}
			else{
				$nice_vals[] = $trimmed;
			}
		}
	}
}

$nice_vals = implode(', ', $nice_vals);

$param_line .= '<div class="'.$param['type'].'_container ui-front">';
$param_line .= '<input name="'.$param['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$param['param_name'].' '.$param['type'].' ish-real-field" type="hidden" value="'.$value.'" ' . $dependency . '/>';
$param_line .= '<input class="wpb_vc_param_value wpb-textinput ish-visible-field" type="text" value="' . $nice_vals . '" ' . $dependency . ' data-source="ish_autosuggest_values_' . $ish_autosuggest_count . '" />';
$param_line .= '<script>window.ish_autosuggest_values_' . $ish_autosuggest_count . ' = ' . json_encode( $js_array ) . ';</script>';
$param_line .= '</div>';

// Do not forget to echo the variable
echo $param_line;