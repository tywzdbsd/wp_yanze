<?php
/*
Plugin Name: IshYoBoy Boldial Assets
Plugin URI: http://ishyoboy.com/
Description: Enables the necessary assets for Boldial Theme by IshYoBoy
Version: 1.6
Author: IshYoBoy
Author URI: http://ishyoboy.com
*/

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ishyoboy_Boldial_Assets' ) ) :

	require_once( 'assets/backend/classes/class-ish-plugin-base.php' );

	class Ishyoboy_Boldial_Assets extends Ish_Plugin_Base {


		function __construct() {

			require_once( 'assets/backend/includes/updater-client.php' );
			new IYB_Commercial_Client(); // Activate the IshYoBoy Plugins update checker

			require_once( 'ishyoboy-cpt/ishyoboy-cpt.php' );
			require_once( 'ishyoboy-shortcodes/ishyoboy-shortcodes.php' );
			require_once( 'ishyoboy-widgets/ishyoboy-widgets.php' );

			add_action( 'plugins_loaded', array(&$this, 'load_textdomain') );

		}

		/**
		 * Load plugin textdomains.
		 *
		 * @since 1.0.0
		 */
		function load_textdomain() {
			$plugin_file = basename(dirname( __FILE__ )) . '/' . basename( __FILE__ );
			load_plugin_textdomain( 'ishyoboy_assets', false, dirname( plugin_basename( $plugin_file ) ) . '/language/' );
		}
	}

	new Ishyoboy_Boldial_Assets;

endif;

?>