<?php

/*
vc_remove_param( 'vc_column', 'el_class' );
vc_remove_param( 'vc_column_inner', 'el_class' );
*/

$setting = array (
	'js_view' => 'IshVcColumnView',
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Content Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	)
);
vc_map_update('vc_column', $setting);

$setting = array (
	'params' => array_merge(
		array(
			array(
				'type' => 'ish_alignment_selector',
				'heading' => __( 'Content Alignment', 'ishyoboy_assets' ),
				'param_name' => 'align',
				'value' => $ish_alignmment_params,
				//'description' => __( 'Align element', 'ishyoboy_assets' ),
			),
		),
		$ish_global_params
	)
);
vc_map_update('vc_column_inner', $setting);