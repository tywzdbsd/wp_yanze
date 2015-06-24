<?php

/**
 * General class for IshYoBoy Plugins to use for extending. All IshYoBoy plugins share a set of functions located in
 * this base class.
 *
 * @author IshYoBou.com (VlooMan)
 *
 * @version 1.0
 *
 */

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ish_Plugin_Base' ) ) :
	class Ish_Plugin_Base {

		public $visual_composer_active = false ;
		public $FILE;
		public $PLUGIN_DIR_NAME;
		public $PLUGIN_DIR_PATH;
		public $theme_locate_path;
		public $helper;

		function __construct( $plugin_file ) {

			// Necessary for symlinks to work
			$this->FILE = basename(dirname( $plugin_file )) . '/' . basename( $plugin_file );
			$this->PLUGIN_DIR_NAME = basename(dirname($plugin_file));
			$this->theme_locate_path = 'ish-plugins/' . $this->PLUGIN_DIR_NAME;
			$this->PLUGIN_DIR_PATH = plugin_dir_path($plugin_file);
			$this->PLUGIN_PLUGIN_URI = untrailingslashit(plugin_dir_url( $this->FILE ));

		}


		/**
		 * Detects if theme uses IshYoBoy PageBuilder
		 *
		 * @return	bool
		 */
		function pagebuilder_active() {

			return defined('IYB_PAGEBUILDER');

		}


		/**
		 * Detects if Visual Composer plugin is active
		 *
		 * @return	bool
		 */
		function visual_composer_active() {

			if ( ! $this->visual_composer_active ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				$this->visual_composer_active = is_plugin_active( 'js_composer/js_composer.php' );
			}

			return $this->visual_composer_active;
		}


		/**
		 * Retrieve the name of the highest priority template file that exists.
		 *
		 * Searches in the STYLESHEETPATH then TEMPLATEPATH and then in PLUGIN so that themes which
		 * inherit from a parent theme can just overload one file.
		 *
		 * @param string|array $template_names Template file(s) to search for, in order.
		 * @param bool $load If true the template file will be loaded if it is found.
		 * @param bool $require_once Whether to require_once or require. Default true. Has no effect if $load is false.
		 *
		 * @return string The template filename if one is located.
		 */
		function locate_template_in_plugin( $template_names, $load = false, $require_once = true ){

			$located = '';

			foreach ( (array) $template_names as $template_name ) {

				// Exit if no filename provided
				if ( !$template_name ) continue;

				// Look in child theme
				$file = $this->theme_locate_path . '/' . $template_name;
				$child_theme_file = STYLESHEETPATH . '/' . $file;
				$parent_theme_file = TEMPLATEPATH . '/' . $file;
				$plugin_theme_file = $this->PLUGIN_DIR_PATH . $template_name;

				// Look in child theme
				if ( file_exists( $child_theme_file ) ) {
					$located = $child_theme_file;
					break;
				}

				// ELSE look in parent theme
				else if ( file_exists( $parent_theme_file ) ) {
					$located = $parent_theme_file;
					break;
				}

				// ELSE look in plugin
				else if ( file_exists( $plugin_theme_file ) ) {
					$located = $plugin_theme_file;
					break;
				}

				$located = apply_filters( 'ish_locate_template_in_plugin', $located, $template_name );

			}

			if ( $load && '' != $located ){
				if ( $require_once )
					require_once( $located );
				else
					require( $located );
			}

			return $located;
		}

	}

endif;