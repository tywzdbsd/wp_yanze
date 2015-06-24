<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ishyoboy_Shortcodes' ) ) :

	//require_once( 'assets/backend/classes/class-ish-plugin-base.php' );

	class Ishyoboy_Shortcodes extends Ish_Plugin_Base {

		private $global_sc_atts = array();
		private $config;
		private $SC_TEMPLATES_DIR;
		private $icon_sets_folder_path;
		public $ishyoboy_shortcodes;
		private $cache;
		protected static $_instance = null;

		/**
		 * Main Plugin Instance
		 *
		 * Ensures only one instance of plugin is loaded or can be loaded.
		 *
		 * @static
		 * @return Main instance
		 */
		public static function instance( $plugin_file ) {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self( $plugin_file );
			}
			return self::$_instance;
		}

		public function __construct() {

			// Necessary to set all global plugin variables
			parent::__construct( __FILE__ );

			// Necessary for symlinks to work
			$this->SC_TEMPLATES_DIR = 'assets/backend/vc_extend/shortcodes_templates/';

			// ICON SETS (SVG ICONS) PATH
			$this->icon_sets_folder_path = 'assets/frontend/images/icon-sets/';

			$this->config = Array(
				'global_shortcode_class' => 'ish-sc-element',

			);

			/**
			 * TEXT WIDGET SHORTCODE FILTERS
			 */
			global $wp_embed;
			add_filter( 'widget_text', 'do_shortcode', 10 );
			add_filter( 'widget_title', 'do_shortcode', 10 );
			add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
			add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );



			define( 'IYB_SC_PLUGIN_URI', $this->PLUGIN_PLUGIN_URI );

			//require_once( 'assets/backend/includes/updater-client.php' );
			//new IYB_Commercial_Client(); // Activate the IshYoBoy Plugins update checker

			// Actions
			add_action( 'init', array(&$this, 'action_init'), 10 );
			add_action( 'admin_enqueue_scripts', array(&$this, 'action_admin_scripts_init') );
			add_action( 'wp_enqueue_scripts', array(&$this, 'action_frontend_scripts') );

			$this->global_sc_atts = array(
				'global_atts' => '',
				'id' => '',
				'css_class' => '',
				'style' => '',
				'tooltip' => '',
				'tooltip_color' => '',
				'tooltip_text_color' => '',
			);


		}

		/**
		 * Registers Frontend Scripts
		 *
		 * @return	void
		 */
		public function action_frontend_scripts() {

			// JS - Global necessary to all shortcodes
			wp_enqueue_script('jquery' );
			wp_enqueue_script('ish-shortcodes', IYB_SC_PLUGIN_URI . '/assets/frontend/js/ishyoboy-shortcodes.js' , 'jquery', '1.0', true);

			if ( ! $this->pagebuilder_active() ){
				wp_register_style( 'ish-fontello', IYB_SC_PLUGIN_URI . '/assets/frontend/css/ish-fontello.css');
				wp_enqueue_style( 'ish-fontello' );
			}


			$user_font = $this->get_user_fontello_font();
			if ( ! empty( $user_font ) && isset( $user_font['json']->name ) ){
				if ( empty( $user_font['json']->name ) ) {$user_font['json']->name = 'fontello'; }
				wp_register_style( 'ish-user-fontello', $user_font['uri'] . 'fontello/css/' . $user_font['json']->name . '.css' );
				wp_enqueue_style( 'ish-user-fontello' );
			}

			// JS - Will be enqued inside each shortcode when used
			wp_register_script( 'ish-flexslider', IYB_SC_PLUGIN_URI . '/assets/frontend/js/jquery.flexslider-min.js', array('jquery'), false, true );
			//wp_register_script( 'ish-easy-pie-chart', IYB_SC_PLUGIN_URI . '/assets/frontend/js/jquery.easy-pie-chart.js', array('jquery'), false, true );
			wp_register_script( 'ish-gmaps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize', array('jquery'), false, true );



			// CSS
			wp_enqueue_style( 'ish-fe-shortcodes', IYB_SC_PLUGIN_URI . '/assets/frontend/css/shortcodes.css', false, '1.0', 'all' );
		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */
		public function action_admin_scripts_init() {

			// css - Adds styles to the DropDown Menu of the buttons
			wp_enqueue_style( 'ish-admin-shortcodes', IYB_SC_PLUGIN_URI . '/assets/backend/css/admin-shortcodes.css', false, '1.0', 'all' );

			if ( ! $this->pagebuilder_active() ){
				wp_register_style( 'ish-fontello', IYB_SC_PLUGIN_URI . '/assets/frontend/css/ish-fontello.css');
				wp_enqueue_style( 'ish-fontello' );
			}

			$user_font = $this->get_user_fontello_font();
			if ( ! empty( $user_font ) && isset( $user_font['json']->name ) ){
				if ( empty( $user_font['json']->name ) ) {$user_font['json']->name = 'fontello'; }
				wp_register_style( 'ish-user-fontello', $user_font['uri'] . 'fontello/css/' . $user_font['json']->name . '.css' );
				wp_enqueue_style( 'ish-user-fontello' );
			}

			// js
			wp_enqueue_script( 'jquery' );
			wp_localize_script( 'jquery', 'ishyoboy_shortcodes', array('plugin_folder' => IYB_SC_PLUGIN_URI) );

			$this->vc_theme_colors_css();

			wp_register_script( 'ish-custom-views', IYB_SC_PLUGIN_URI . '/assets/backend/js/composer-views-extend.js', array('wpb_js_composer_js_custom_views'), false, true );
			wp_enqueue_script('ish-custom-views');

			wp_localize_script( 'ish-custom-views', 'iyb_pagebuilder', Array(
				'main_button_title' => __( 'Switch to Page Builder', 'ishyoboy_assets' ),
				'main_button_title_revert' => __( 'Switch to WordPress Editor', 'ishyoboy_assets' ),
				'path_child' => get_stylesheet_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path,
				'path_parent' => get_template_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path,
				'path_plugin' => $this->PLUGIN_PLUGIN_URI . '/' . $this->icon_sets_folder_path,
				'trans_strings' => Array(
					'accordion' => __( 'Accordion', 'ishyoboy_assets' ),
					'toggle' => __( 'Toggle', 'ishyoboy_assets' ),
				)
			) );
		}

		/**
		 * Returns the shortcode HTML for the front-end
		 *
		 * @param array $atts - Shortcode attributes specified in the visual composer
		 * @param string $content - Shortcode content
		 * @param string $tag - Shortcode "tag" [tag]
		 *
		 * @return string
		 */
		public function shortcode_callback( $atts, $content = null, $tag ){

			do_action('ish_before_sc_callback', $atts, $content, $tag );

			$sc_filename = $tag . '.php';

			$output = '';

			// LOOK FOR TEMPLATE IN THEME
			$template = locate_template( $this->theme_locate_path . '/' . $this->SC_TEMPLATES_DIR . $sc_filename );

			if ( !$template ) {
				// LOOK IN PLUGIN
				$template = $this->PLUGIN_DIR_PATH . $this->SC_TEMPLATES_DIR . $sc_filename;
			}

			// LOAD TEMPLATE
			if ( file_exists($template) ) {
				ob_start();
				include( $template );
				$output = ob_get_contents();
				ob_end_clean();
			} else {
				trigger_error(sprintf( __( 'Wrong template for `%s` shortcode. Please make sure the template exists.', 'ishyoboy_assets' ), $tag) );
			}

			do_action('ish_after_sc_callback', $atts, $content, $tag );

			return $output;

		}

		/**
		 * Returns the contrast color for a given hex color value (e.g. #ffffff)
		 *
		 * @param string $hexcolor - The color in hex format "#ffffff"
		 * @return string
		 */
		public function get_color_contrast( $hexcolor ){

			if ( function_exists( 'ishyoboy_get_color_contrast' ) ) {
				// Theme function has a bigger priority
				return ishyoboy_get_color_contrast( $hexcolor );
			}
			else{
				// Remove the "#" from the beginning
				$hexcolor = substr( $hexcolor, 1);

				$r = hexdec(substr($hexcolor,0,2));
				$g = hexdec(substr($hexcolor,2,2));
				$b = hexdec(substr($hexcolor,4,2));
				$yiq = (($r*299)+($g*587)+($b*114))/1000;
				return ($yiq >= 128) ? '#000000' : '#ffffff';
			}
		}

		/**
		 * Adds <style> necessary for theme colors param type
		 *
		 * Loads all theme colors and adds <style> element if viewed in admin section to make theme color selector display
		 * the correct colors.
		 *
		 * @return array - color classes "color1", "color2", ...
		 */
		public function vc_theme_colors_css() {

			global $ish_options;

			echo '<style type="text/css">';

			for ($i = 1; $i <= IYB_COLORS_COUNT; $i++ ){

				if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
					echo '.ish_color_selector_item color' . $i . ', .ish_color_selector_container [data-ish-value="color' . $i . '"] { background-color: ' . $ish_options['color' . $i] . "; color: #ffffff; }\n";
				}
				else {
					echo '.ish_color_selector_item color' . $i . ', .ish_color_selector_container [data-ish-value="color' . $i . '"] { background-color: ' . $ish_options['color' . $i] . "; color: " . $this->get_color_contrast( $ish_options['color' . $i] ) . "; }\n";
				}

				// Row
				echo '.wpb_row_container[data-ish-color="color' . $i . '"] > .wpb_vc_column > div { background: ' . $ish_options['color' . $i] . ";}\n";
				//echo '.wpb_row_container[data-ish-color^="color' . $i . '"] .wpb_vc_column_inner { background-color: rgba(255, 255, 255, 0.2)' . ";}\n";
				//echo '.wpb_row_container[data-ish-color^="color' . $i . '"] .wpb_content_element > .wpb_element_wrapper { background-color: rgba(255, 255, 255, 0.8)' . ";}\n";

				// Back-end elements
				if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
					echo '.wpb_content_element[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_element[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before { background-color: ' . $ish_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_content_element[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_element[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class*=" wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before, .wpb_content_holder[class^="wpb_ish_"] > .wpb_element_wrapper.ish-color' . $i . ':before { background-color: ' . $ish_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ish_options['color' . $i] ) . ";}\n";
				}


				// Skills
				if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
					echo '.wpb_ish_skills > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_skill > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ish_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_skills > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_skill > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ish_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ish_options['color' . $i] ) . ";}\n";
				}

				// Tabs
				if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
					echo '.wpb_ish_tabs > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tab > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ish_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_tabs > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tab > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ish_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ish_options['color' . $i] ) . ";}\n";
				}

				// Toggle
				if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
					echo '.wpb_ish_tgg_acc > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tgg_acc_item > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ish_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_tgg_acc > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_tgg_acc_item > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ish_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ish_options['color' . $i] ) . ";}\n";
				}

				// Pricing Tables
				if ( $i > IYB_BASE_COLORS_COUNT && '#ffffff' != strtolower($ish_options['color' . $i]) ){
					echo '.wpb_ish_pricing_table > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_pricing_row > .wpb_element_wrapper:not([class*=" ish-color"]):before { background-color: ' . $ish_options['color' . $i] . '; color: #ffffff;' . "}\n";
				}
				else {
					echo '.wpb_ish_pricing_table > .wpb_element_wrapper.ish-color' . $i . ' .wpb_ish_pricing_row > .wpb_element_wrapper:not([class*=" ish-color"]):before  { background-color: ' . $ish_options['color' . $i] . '; color: ' . $this->get_color_contrast( $ish_options['color' . $i] ) . ";}\n";
				}


			}

			echo '</style>' . "\n";
		}

		/**
		 * Calls the main config file to enhance VC functionality
		 *
		 * @return void
		 */
		public function load_vc_config() {
			$filename = 'assets/backend/vc_extend/vc_config/config.php';

			// LOOK FOR FILE IN THEME
			$config = locate_template( $filename );

			if ( !$config ) {
				// LOOK IN PLUGIN
				$config = $this->PLUGIN_DIR_PATH . $filename;
			}

			// LOAD FILE
			if ( file_exists( $config ) ) {

				require_once( $config );

			} else {

				trigger_error( __( 'Missing config file. Please make sure the file exists.', 'ishyoboy_assets' ) );

			}

		}

		/**
		 * Returns the HTML necessary for custom parameter types
		 *
		 * @param array $settings
		 * @param string $value
		 *
		 * @return string - color classes "color1", "color2", ...
		 */
		public function custom_params_callback( $settings, $value ) {

			// Necessary for compatibility with default vc params
			$param = $settings;
			$param_value = $value;
			$param_line = '';

			ob_start();
			include( 'assets/backend/vc_extend/vc_params/' . $param['type'] . '.php');
			$output = ob_get_contents();
			ob_end_clean();
			return $output;

		}

		/**
		 * Return a array of all available theme colors
		 *
		 * Tries to load all available colors from IshYoBoy themes and returns an array
		 *
		 * @return array - color classes "color1", "color2", ...
		 */
		public function get_theme_colors_array() {

			global $ish_options;

			$ish_theme_colors = Array();

			if ( ! empty( $ish_options ) ){

				for ($i = 1; $i <= IYB_COLORS_COUNT; $i++ ){

					if ( isset( $ish_options['color' . $i ] ) ){
						//$ish_theme_colors[ sprintf( __( 'Color %d', 'ishyoboy_assets' ), $i )  ] = 'color' . $i  ;
						$ish_theme_colors[ 'Color' . $i ] = 'color' . $i  ;
					}

				}

			}
			//$ish_theme_colors[ __( 'Advanced', 'ishyoboy_assets' ) ] = 'advanced';

			return $ish_theme_colors;

		}

		/**
		 * Return a array of all available categories
		 *
		 * @param string - taxonomy to load results from
		 * @return array - catgeory name, category slug
		 */
		public function get_available_taxonomy_terms( $taxonomy = 'category' ) {

			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 0,
				'hierarchical'             => 1,
				'exclude'                  => '',
				'include'                  => '',
				'number'                   => '',
				'taxonomy'                 => $taxonomy,
				'pad_counts'               => false

			);

			$categories = get_categories( $args );
			$return = Array();

			if ( ! empty( $categories ) ){

				foreach ( $categories as $category ){
					$return[ __( $category->name, 'ishyoboy_assets' ) ] = $category->slug;
				}

			}

			return $return;

		}

		/**
		 * Return a array of all available post formats
		 *
		 * @return array
		 */
		public function get_available_post_formats() {

			$post_formats = get_theme_support( 'post-formats' );
			$return = Array();

			if ( is_array( $post_formats[0] ) ) {

				foreach ( $post_formats[0] as $format ){
					$return[ $format ] = $format;
				}

			}

			return $return;

		}

		/**
		 * Return an array of all available ish-fontello icons
		 *
		 * Tries to load the ish-fontello config.json from the theme (if exists) or from the plugin and creates a list of
		 * all available icons in the icoinc font.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_available_icons_array() {

			global $ish_options;

			if ( $this->pagebuilder_active() ){
				$icons_config_path = get_template_directory() . '/assets/frontend/font/config.json';
			}
			else{
				$icons_config_path = $this->PLUGIN_DIR_PATH . '/assets/frontend/font/config.json';
			}


			ob_start();
			include( $icons_config_path );
			$json = ob_get_contents();
			ob_end_clean();
			$json = json_decode($json);

			$output = Array();
			//$output['No icon'] = '';

			foreach ( $json->glyphs as $key => $val ){
				$icon_class = $json->css_prefix_text . $val->css;
				$output[ $icon_class ] = $icon_class;
			}

			return $output;

		}


		/**
		 * Return an array of all available image sizes
		 *
		 * @return array - associative array of Size Name and value
		 */
		public function get_available_image_sizes_array() {

			global $_wp_additional_image_sizes;

			//var_dump( $_wp_additional_image_sizes );

			$sizes_names = apply_filters( 'image_size_names_choose', array(
				'thumbnail' => __('Thumbnail'),
				'medium'    => __('Medium'),
				'large'     => __('Large'),
				'full'      => __('Full Size'),
			) );

			//var_dump( $sizes_names );

			$sizes = array();

			foreach( get_intermediate_image_sizes() as $s ){
				$sizes[ $s ] = array( 0, 0 );
				if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
					$sizes[ $s ][0] = get_option( $s . '_size_w' );
					$sizes[ $s ][1] = get_option( $s . '_size_h' );
					if ( $s != 'thumbnail' ){
						$sizes[ $s ][1] = '9999';
					}
				}else{
					if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
						$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
				}
			}

			//var_dump( $sizes );

			foreach ( $sizes_names as $size_key => $size_val ){
				if ( isset ( $sizes[$size_key] ) && is_array($sizes[$size_key]) ){
					if ( '9999' == $sizes[$size_key][1] ) { $sizes[$size_key][1] = 'variable'; }
					$sizes_names[$size_key] = $size_val . ' - ' . $sizes[$size_key][0] . ' x ' . $sizes[$size_key][1] . ' px';
				}
			}

			$sizes_names = array_flip( $sizes_names );

			return $sizes_names;

		}


		/**
		 * Return an array of all available IshYoBoy Slides
		 *
		 * Loads a list of all available sliders from IshYoBoy Slider located in IshYoBoy CPT Plugin
		 *
		 * @return array - "id" and "Slider name" pairs associative array
		 */
		public function get_available_sliders_array() {

			global $ish_options;

			// Disable IshYoBoy Slider completely
			//$sliders = get_terms( 'slides_categories', Array( 'hide_empty' => false ) );

			$output = '';

			if ( ! empty( $sliders ) ){
				foreach ( $sliders as $slider ){
					$output[ $slider->name ] = $slider->term_id;
				}
			}

			return $output;

		}

		/**
		 * Return an array of all available sidebars
		 *
		 * Loads a list of all available sidebars from Set in Appearance -> Widgets
		 *
		 * @return array - "id" and "Sidebar name" pairs associative array
		 */
		public function get_available_sidebars_array() {

			global $ish_options;

			$output = '';

			foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
				$output[ $sidebar['name'] ] = $sidebar['id'];
			}

			return $output;

		}

		/**
		 * Return an array of all available Menus
		 *
		 * Loads a list of all available Menus from Set in Appearance -> Menus
		 *
		 * @return array - "id" and "Menu name" pairs associative array
		 */
		public function get_available_menus_array() {

			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false, 'taxonomy' => 'tax_nav_menu' ) );

			$output = '';

			if ( ! empty( $menus ) && is_array( $menus ) ) {

				foreach ( $menus as $menu ) {
					$output[ $menu->name ] = $menu->term_id;
				}
			}

			return $output;
		}


		public function get_user_fontello_font(){

			if ( empty( $this->cache['user_fontello'] ) ){

				$this->cache['user_fontello']['path'] = $this->locate_template_in_plugin('fontello/config.json');

				if ( ! empty( $this->cache['user_fontello']['path'] ) ){

					ob_start();
					include( $this->cache['user_fontello']['path'] );
					$json = ob_get_contents();
					ob_end_clean();
					$this->cache['user_fontello']['json'] = json_decode( $json );

					if ( false !== strpos( $this->cache['user_fontello']['path'], STYLESHEETPATH ) ){
						$this->cache['user_fontello']['uri'] = 	get_stylesheet_directory_uri() . '/' . $this->theme_locate_path . '/';
					} elseif ( false !== strpos( $this->cache['user_fontello']['path'], TEMPLATEPATH ) ) {
						$this->cache['user_fontello']['uri'] = 	get_template_directory_uri() . '/' . $this->theme_locate_path . '/';
					}
					else{
						$this->cache['user_fontello'] = Array();
					}
				}
			}

			return $this->cache['user_fontello'];

		}


		/**
		 * Return an array of user icons
		 *
		 * Tries to load the ish-fontello config.json from the theme (if exists) or from the plugin and creates a list of
		 * all available icons in the icoinc font.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_user_fontello_icons_array() {

			global $ish_options;

			$icons_config_path = $this->locate_template_in_plugin('fontello/config.json');

			ob_start();
			include( $icons_config_path );
			$json = ob_get_contents();
			ob_end_clean();
			$json = json_decode($json);

			$output = Array();

			if ( ! empty( $json ) ){
				foreach ( $json->glyphs as $key => $val ){
					$icon_class = $json->css_prefix_text . $val->css;
					$output[ $icon_class ] = $icon_class;
				}
			}

			return $output;

		}


		/**
		 * Return an array of all available ish-fontello icons with list icons in front
		 *
		 * Tries to load the ish-fontello config.json from the theme (if exists) or from the plugin and creates a list of
		 * all available icons in the icoinc font. The algorithm places the pre-defined list icons in front positions.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_available_lists_icons_array() {

			global $ish_options;

			// List of icon-classes to be prioritized. Value is not important
			$priority_list = array(
				'ish-icon-ok' => 'ish-icon-ok',
				'ish-icon-cancel' => 'ish-icon-cancel',
				'ish-icon-plus' => 'ish-icon-plus',
				'ish-icon-minus' => 'ish-icon-minus',
				'ish-icon-circle' => 'ish-icon-circle',
				'ish-icon-circle-empty' => 'ish-icon-circle-empty',
				//'ish-icon-dot-circled' => 'ish-icon-dot-circled',
				'ish-icon-stop' => 'ish-icon-stop',
				//'ish-icon-check-empty' => 'ish-icon-check-empty',
				'ish-icon-check-empty-1' => 'ish-icon-check-empty-1',
				'ish-icon-right-open' => 'ish-icon-right-open',
			);

			if ( $this->pagebuilder_active() ){
				$icons_config_path = get_template_directory() . '/assets/frontend/font/config.json';
			}
			else{
				$icons_config_path = $this->PLUGIN_DIR_PATH . '/assets/frontend/font/config.json';
			}


			ob_start();
			include( $icons_config_path );
			$json = ob_get_contents();
			ob_end_clean();
			$json = json_decode($json);

			$output = Array();
			$empty['No icon'] = '';

			foreach ( $json->glyphs as $key => $val ){
				$icon_class = $json->css_prefix_text . $val->css;
				if ( ! isset( $priority_list[ $icon_class ] ) ){
					$output[ $icon_class ] = $icon_class;
				}
			}

			return array_merge($empty, $priority_list, $output);

		}


		/**
		 * Create an Array of files from a given path
		 *
		 * @param string $icons_path
		 * @param array $ignored_folders
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_icon_sets_icon_uri( $icon ){
			// icon == "folder_name/icon_file_name.svg"

			$icon_data = explode( '/' , $icon );

			if ( count( $icon_data ) < 3 ){
				// Compatibility with 2 params version
				$icon_data[2] = $icon_data[1];
				$icon_data[1] = $icon_data[0];
				$icon_data[0] = 'path_plugin';
			}

			if ( isset( $this->cache['icon_sets'][ $icon_data[1] ] ) ){
				return $this->cache['icon_sets'][ $icon_data[1] ] . $icon_data[1] . '/' .  $icon_data[2] ;
			}
			else{

				// 1. LOOK IN CHILD THEME
				$icons_path = STYLESHEETPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
				$folder_uri = get_stylesheet_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
				$icon_uri = $folder_uri . $icon_data[1] . '/' .  $icon_data[2];
				if ( ! file_exists( $icons_path . $icon_data[1] ) ) {

					// 2. LOOK IN PARENT THEME
					$icons_path = TEMPLATEPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
					$folder_uri = get_template_directory_uri() . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
					$icon_uri = $folder_uri . $icon_data[1] . '/' .  $icon_data[2];
					if ( ! file_exists( $icons_path . $icon_data[1] ) ) {

						// 3. LOOK IN PLUGIN
						$icons_path = $this->PLUGIN_DIR_PATH . '/' . $this->icon_sets_folder_path;
						$folder_uri = $this->PLUGIN_PLUGIN_URI . '/' . $this->icon_sets_folder_path;
						$icon_uri = $folder_uri . $icon_data[1] . '/' .  $icon_data[2];
						if ( ! file_exists( $icons_path . $icon_data[1] ) ) {
							return false;
						}
						else{
							$this->cache['icon_sets'][ $icon_data[1] ] = $folder_uri;
						}
					}
					else{
						$this->cache['icon_sets'][ $icon_data[1] ] = $folder_uri;
					}

				} else{
					$this->cache['icon_sets'][ $icon_data[1] ] = $folder_uri;
				}

				return $icon_uri;

			}

		}

		/**
		 * Create an Array of files from a given path
		 *
		 * @param string $icons_path
		 * @param string $path_id
		 * @param array $ignored_folders
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_icon_sets_from_path( $icons_path, $path_id, &$ignored_folders ){

			$icon_sets = Array();

			if (  file_exists( $icons_path ) && $handle = opendir( $icons_path ) ) {
				while ( false !== ( $entry = readdir( $handle ) ) ) {
					if ( '.' != $entry  && '..' != $entry ) {

						// Remove all spaces from folder names
						// $key = str_replace(' ', '_', $entry );

						// Ignore folders starting with underscore
						if ( '_' == $entry[0] ){
							$ignored_folders[substr( $entry, 1)] = true;
						}
						else{

							if ( ! isset( $ignored_folders[ $entry ] ) ){

								$icon_sets[ $entry ] = Array();

								// Open Folder and list all icons filenames
								if ( $handle_inner = opendir( $icons_path . $entry ) ) {
									while ( false !== ( $icon = readdir( $handle_inner ) ) ) {
										if ( '.' != $icon  && '..' != $icon ) {
											$key = str_replace(' ', '_', $icon );
											$icon_sets[ $entry ][$key] = Array(
												'icon' => $icon,
												'path' => $path_id,
											);
										}
									}
									closedir( $handle_inner );
								}

							}

						}
					}
				}
				closedir( $handle );
			}

			return $icon_sets;

		}


		/**
		 * Load and all SVG icons from Child Theme, Theme and Plugin
		 *
		 * The function collects all icons from the Child Theme, Parent Theme and the Plugin itself with this priority.
		 * If the folder names differ, the icons are joined together from all three sources. If two folder names are
		 * equal, the one with the biggest priority is chosen and the rest are ignored.
		 *
		 * E.g.: If the folder "example" is available in all three sources. Only the ones from the Child Theme are
		 * used. The rest ( in Parent theme and Plugin) are ignored.
		 *
		 * To disable an icon set completely change the name to start with underscore (E.g.: "_example" ). This will
		 * disable the icons from all three sources.
		 *
		 * @return array - icon classes "ish-icon-*"
		 */
		public function get_available_icon_sets_array() {

			global $ish_options;

			$icon_sets = Array();
			$ignored_folders = Array();

			// 1. LOOK IN CHILD THEME
			$icons_path = STYLESHEETPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
			$icons = $this->get_icon_sets_from_path( $icons_path, 'path_child', $ignored_folders );
			$icon_sets = array_merge( $icon_sets, $icons);

			// 2. LOOK IN PARENT THEME
			$icons_path = TEMPLATEPATH . '/' . $this->theme_locate_path . '/' . $this->icon_sets_folder_path;
			$icons = $this->get_icon_sets_from_path( $icons_path, 'path_parent', $ignored_folders );
			$icon_sets = array_merge( $icon_sets, $icons);

			// 3. LOOK IN PLUGIN
			$icons_path = $this->PLUGIN_DIR_PATH . '/' . $this->icon_sets_folder_path;
			$icons = $this->get_icon_sets_from_path( $icons_path, 'path_plugin', $ignored_folders );
			$icon_sets = array_merge( $icon_sets, $icons);

			return $icon_sets;

		}



		/**
		 * A filter to dd the global shortcode element class
		 *
		 * @param string $classes - shortcode classes
		 * @param string $tag - shortcode name
		 *
		 * @return string - shortcode classes
		 */
		public function add_global_sc_class( $classes, $tag ){
			$class = ( '' != $this->config['global_shortcode_class'] ) ? ( $this->config['global_shortcode_class'] . ' ' ) : '';
			return $class . $classes;
		}

		/**
		 * Extract all attributes after merging them with defaults and global atts
		 *
		 * @param array $defaults - Shortcode specific atts
		 * @param array $atts - Shortcode attributes as entered in Visual composer
		 *
		 * @return array - Array containing all final shortcode attributes values
		 */
		public function extract_sc_attributes( $defaults, $atts){
			$output = shortcode_atts(
				array_merge(
					$this->global_sc_atts,
					$defaults
				),
				$atts
			);

			// Empty global atts if not used
			if ( ! isset($atts['global_atts']) || 'yes' != $atts['global_atts']){
				foreach ( $this->global_sc_atts as $key => $val ){
					$output[$key] = '';
				}
			}

			return $output;
		}

		/*
		 * Detect if the current admin page is of the given post type
		 *
		 * @param string - the slug of the CPT
		 *
		 * @return boolean
		 */
		public function is_post_type_admin_edit_page( $cpt ){
			global $pagenow;

			if ( ( ( 'post.php' == $pagenow && isset($_GET['post']) && $cpt == get_post_type($_GET['post']) )
				|| ( 'post-new.php' == $pagenow && isset($_GET['post_type']) && $cpt == $_GET['post_type']) ) )
			{
				return true;
			}

			return false;
		}



		/**
		 * Include "vc_build_link" & "vc_parse_multi_attribute" to be able to parse URLs outside VC
		 *
		 * @return void
		 */
		public function load_helpers(){
			require_once( '/assets/backend/vc_extend/helpers/vc-functions.php');
		}

		/**
		 * REGISTERS TINYMCE RICH EDITOR BUTTONS
		 *
		 * @return void
		 */
		public function action_init() {

			// Filters
			add_filter( 'ish_sc_classes', array(&$this, 'add_global_sc_class'), 10, 2);

			global $ishyoboy_shortcodes;

			$ishyoboy_shortcodes = Array(
				'ish_button' => '',
				'ish_divider' => '',
				'ish_separator' => '',
				'ish_headline' => '',
				'ish_icon' => '',
				'ish_svg_icon' => '',
				'ish_icon_button_set' => '',
				'ish_image' => '',
				'ish_list' => '',
				'ish_quote' => '',
				'ish_skills' => '',
				'ish_skill' => '',
				'ish_table' => '',
				'ish_pricing_table' => '',
				'ish_pricing_row' => '',
				'ish_embed' => '',
				'ish_map' => '',
				'ish_location' => '',
				'ish_social_share' => '',
				'ish_slidable' => '',
				'ish_slide' => '',
				'ish_sidebar' => '',
				'ish_menu' => '',
				'ish_portfolio' => '',
				'ish_portfolio_prev_next' => '',
				'ish_portfolio_categories' => '',
				'ish_portfolio_gallery' => '',
				'ish_blog_media' => '',
				'ish_recent_posts' => '',
				'ish_tabs' => '',
				'ish_tab' => '',
				'ish_tgg_acc' => '',
				'ish_tgg_acc_item' => '',
				'ish_cf7' => '',
				'ish_box' => '',
			);

			$ishyoboy_shortcodes = apply_filters( 'ish_default_sc_list', $ishyoboy_shortcodes );

			// Register all shortcodes
			foreach ( $ishyoboy_shortcodes as $tag => $func ){
				add_shortcode( $tag, Array( &$this, 'shortcode_callback' ) );
			}

			if ( $this->pagebuilder_active() ){
				// IYB Pagebuilder active
				//echo 'Theme';

				// Filters
				add_filter( 'ish_theme_options_section_content', array(&$this, 'add_theme_options_settings'), 10, 2);

				add_action( 'init', array(&$this, 'remove_default_vc_shortcodes'), 11 );
				$this->load_vc_config();

			} else{
				// IYB Pagebuilder NOT active

				if ( $this->visual_composer_active() ){
					//echo 'VComposer';
					$this->load_vc_config();

				}
				else{
					//echo 'NADA!!!!!!';
					add_action( 'ish_before_sc_callback',  array( &$this, 'load_helpers' ) );

				}

				require_once( 'assets/backend/includes/theme-plugin-functions.php' );
			}

		}

		/**
		 * Removes the default Visual Composer shortcodes
		 *
		 * Removes the default Visual Composer shortcodes unless set differently in Theme Options
		 *
		 * @return void
		 */
		public function remove_default_vc_shortcodes(){
			global $ish_options, $vc_manager;

			if ( ! isset( $ish_options ) || ! isset( $ish_options['plugin_sc_enable_vc_shortcodes'] ) || ( '0' == $ish_options['plugin_sc_enable_vc_shortcodes'] ) ){
				if ( function_exists('vc_remove_element') ){

					// VC Shotcodes
					vc_remove_element('vc_separator');
					vc_remove_element('vc_text_separator');
					vc_remove_element('vc_message');
					vc_remove_element('vc_facebook');
					vc_remove_element('vc_tweetmeme');
					vc_remove_element('vc_googleplus');
					vc_remove_element('vc_pinterest');
					vc_remove_element('vc_toggle');
					vc_remove_element('vc_single_image');
					vc_remove_element('vc_gallery');
					vc_remove_element('vc_images_carousel');
					vc_remove_element('vc_tabs');
					vc_remove_element('vc_tour');
					vc_remove_element('vc_tab');
					vc_remove_element('vc_accordion');
					vc_remove_element('vc_accordion_tab');
					vc_remove_element('vc_teaser_grid');
					vc_remove_element('vc_posts_slider');
					vc_remove_element('vc_widget_sidebar');
					vc_remove_element('vc_button');
					vc_remove_element('vc_button2');
					vc_remove_element('vc_cta_button');
					vc_remove_element('vc_cta_button2');
					vc_remove_element('vc_video');
					vc_remove_element('vc_gmaps');
					//vc_remove_element('vc_raw_html');
					//vc_remove_element('vc_raw_js');
					vc_remove_element('vc_flickr');
					vc_remove_element('vc_progress_bar');
					vc_remove_element('vc_pie');

					// 3-rd party plugins
					if ( is_admin() ) { vc_remove_element('contact-form-7'); };
					//vc_remove_element('layerslider_vc');
					//vc_remove_element('rev_slider_vc');
					//vc_remove_element('gravityform');

					// Widgets
					vc_remove_element('vc_wp_search');
					vc_remove_element('vc_wp_meta');
					vc_remove_element('vc_wp_recentcomments');
					vc_remove_element('vc_wp_calendar');
					vc_remove_element('vc_wp_pages');
					vc_remove_element('vc_wp_tagcloud');
					vc_remove_element('vc_wp_custommenu');
					vc_remove_element('vc_wp_text');
					vc_remove_element('vc_wp_posts');
					vc_remove_element('vc_wp_links');
					vc_remove_element('vc_wp_categories');
					vc_remove_element('vc_wp_archives');
					vc_remove_element('vc_wp_rss');

					// Remove the "VC: Custom Teaser" metabox
					global $vc_teaser_box;
					if ( is_object( $vc_teaser_box ) ){
						remove_action( 'admin_init', array( $vc_teaser_box, 'jsComposerEditPage' ), 6 );
					}


					//$vc_posts_grid_instance = $vc_manager->vc()->getShortCode('vc_posts_grid');
					//remove_action( 'admin_init', array( $vc_posts_grid_instance, 'jsComposerEditPage' ), 6 );
					vc_remove_element('vc_posts_grid');

					//$vc_carousel_instance = $vc_manager->vc()->getShortCode('vc_carousel');
					//remove_action( 'admin_init', array( $vc_carousel_instance, 'jsComposerEditPage' ), 6 );
					vc_remove_element('vc_carousel');

					vc_remove_element('vc_custom_heading');
					vc_remove_element('vc_empty_space');


				}

			}
		}

		/**
		 * A filter to add a set of options to existing Theme Options section
		 *
		 * @param array $options - Array containing the section options
		 * @param string $section_class - The "name" of the section
		 *
		 * @return array - The filtered $options array
		 */
		public function add_theme_options_settings( $options, $section_class = null ) {

			if ( ! empty( $section_class ) && 'pluginsoptions' == $section_class ){
				$options[] = array(  'name'  => __( 'Visual Composer Shortcodes', 'ishyoboy_assets' ),
					'desc'  => __( 'Enable or disable the default Visual Composer shortcodes in IshYoBoy Pagebuilder', 'ishyoboy_assets'),
					'id'    => 'plugin_sc_enable_vc_shortcodes',
					'std'   => 0,
					'on'    => __( 'Enable', 'ishyoboy_assets' ),
					'off'   => __( 'Disable', 'ishyoboy_assets' ),
					'folds' => 0,
					'type'  => 'switch');
			}

			return $options;

		}

	}

	/**
	 * Returns the main instance of Plugin to prevent the need to use globals.
	 *
	 * @return Ishyoboy_Shortcodes
	 */
	function ISH_SC() {
		return Ishyoboy_Shortcodes::instance( __FILE__ );
	}

	// Global for backwards compatibility.
	$GLOBALS['ish_plugins_shortcodes'] = ISH_SC();

endif;

/**
 * Global Functions
 */

if ( ! function_exists( 'ishyoboy_colors_to_hex' ) ) {
	function ishyoboy_colors_to_hex($input){
		global $current_colors;
		$output = $input;

		$output = str_replace('color1', $current_colors['color1'], $output);
		$output = str_replace('color2', $current_colors['color2'], $output);
		$output = str_replace('color3', $current_colors['color3'], $output);
		$output = str_replace('color4', $current_colors['color4'], $output);

		return $output;
	}
}

if ( ! function_exists( 'ishyoboy_custom_excerpt' ) ) {
	function ishyoboy_custom_excerpt($custom_content, $limit, $search = null) {
		$content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $custom_content);  # strip shortcodes, keep shortcode content
		$content = wp_strip_all_tags($content, true);
		$content = preg_replace('/\[.+\]/','', $content);

		if ( isset($search)){
			$content = explode(' ', $content);
			$index = ishyoboy_array_find($search, $content);
			$start = ( ($index - $limit / 2) < 0 ) ? 0 : $index - $limit / 2;
			$content = array_slice($content, $start, $limit);
		} else{
			$content = explode(' ', $content, $limit);
		}

		if ( count($content) >= $limit ) {
			array_pop($content);
			$content = implode( ' ', $content ) . '...';
		} else {
			$content = implode( ' ', $content );
		}
		//$content = preg_replace('/\[.+\]/','', $content);
		if ( isset($search)){
			$content = apply_filters('the_content', $content);
		}
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = str_replace("&nbsp;", ' ', $content);
		//$content = str_ireplace($search, '<mark>' . $search . '</mark>' , $content);
		//$content = ishyoboy_search_excerpt_highlight($content);
		/**/
		return $content;
	}
}

?>