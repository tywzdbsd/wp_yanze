<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_Ish_Acc_tab extends WPBakeryShortCode_VC_Accordion_tab {

	public function mainHtmlBlockParams($width, $i) {
		return 'data-element_type="'.$this->settings["base"].'" class=" wpb_vc_accordion_tab"'.$this->customAdminBlockParams();
	}

}

class WPBakeryShortCode_Ish_Accordion extends WPBakeryShortCode_VC_Accordion {


	protected function findShortcodeTemplate() {
		// Check template path in shortcode's mapping settings
		if(!empty($this->settings['html_template']) && is_file($this->settings('html_template'))) {
			return $this->setTemplate($this->settings['html_template']);
		}
		// Check template in theme directory
		$user_template = WPBakeryVisualComposer::getUserTemplate($this->getFilename().'.php');
		if(is_file($user_template)) {
			return $this->setTemplate($user_template);
		}
		// Check default place
		$default_dir = WPBakeryVisualComposer::defaultTemplatesDIR();
		if(is_file($default_dir.$this->getFilename().'.php')) {
			return $this->setTemplate($default_dir.$this->getFilename().'.php');
		}
	}

	public function getElementHolder($width) {
		$output = '';
		$column_controls = $this->getColumnControls($this->settings('controls'));
		$css_class = 'wpb_vc_accordion wpb_content_element wpb_sortable'.(!empty($this->settings["class"]) ? ' '.$this->settings["class"] : '');
		$output .= '<div data-element_type="'.$this->settings["base"].'" class="'.$css_class.'">';
		$output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width), $column_controls);
		$output .= $this->getCallbacks($this->shortcode);
		$output .= '<div class="wpb_element_wrapper '.$this->settings("wrapper_class").'">';
		$output .= '%wpb_element_content%';
		$output .= '</div>'; // <!-- end .wpb_element_wrapper -->';
		$output .= '</div>'; // <!-- end #element-'.$this->shortcode.' -->';
		return $output;
	}

}

