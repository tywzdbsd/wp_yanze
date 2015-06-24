<?php

if ( ! function_exists( 'vc_build_link' ) ){
	function vc_build_link($value) {
		return vc_parse_multi_attribute($value, array('url' => '', 'title' => '', 'target' => ''));
	}
}

if ( ! function_exists( 'vc_parse_multi_attribute' ) ){
	function vc_parse_multi_attribute($value, $default = array()) {
		$result = $default;
		$params_pairs = explode('|', $value);
		foreach($params_pairs as $pair) {
			$param = preg_split('/\:/', $pair);
			if(!empty($param[0]) && isset($param[1])) {
				$result[$param[0]] = rawurldecode($param[1]);
			}
		}
		return $result;
	}
}

if ( ! function_exists( 'wpb_js_remove_wpautop' ) ) {
	function wpb_js_remove_wpautop($content, $autop = false) {

		if($autop) { // Possible to use !preg_match('('.WPBMap::getTagsRegexp().')', $content)
			$content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");
		}
		return do_shortcode( shortcode_unautop($content) );
	}
}