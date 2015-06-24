<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Ishyoboy_CPT' ) ) :

	//require_once( 'assets/backend/classes/class-ish-plugin-base.php' );

	class Ishyoboy_CPT extends Ish_Plugin_Base {

		function __construct() {

			// Necessary to set all global plugin variables
			parent::__construct( __FILE__ );

			define( 'IYB_CPT_PLUGIN_URI', $this->PLUGIN_PLUGIN_URI );

			//require_once( 'assets/backend/includes/updater-client.php' );
			//new IYB_Commercial_Client(); // Activate the IshYoBoy Plugins update checker

			add_action( 'init', array(&$this, 'action_init') );
			add_action( 'after_setup_theme', array(&$this, 'action_after_setup_theme') );
			add_action( 'admin_enqueue_scripts', array(&$this, 'action_admin_scripts_init') );
			add_action( 'wp_enqueue_scripts', array(&$this, 'action_frontend_scripts') );
			add_action( 'ish_theme_options_after_footer_options', array(&$this, 'add_theme_options_portfolio_options') );

		}

		/**
		 * Registers and Endues Frontend Scripts
		 *
		 * @return	void
		 */
		function action_frontend_scripts() {



		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */

		function action_admin_scripts_init() {

			wp_enqueue_script('jquery');

			wp_register_style( 'ish-cpt-admin', IYB_CPT_PLUGIN_URI .'/assets/backend/css/cpt_admin.css' );
			wp_enqueue_style('ish-cpt-admin');

			wp_register_script( 'ish-cpt-admin', IYB_CPT_PLUGIN_URI .'/assets/backend/js/cpt_admin.js', array('jquery'), false,true );
			wp_enqueue_script('ish-cpt-admin');



		}

		/**
		 * Action called in 'init' hook
		 *
		 * Initiates the plugin
		 *
		 * @return void
		 */
		function action_init() {



		}


		/**
		 * Action called in 'after_setup_theme' hook
		 *
		 * Registers all widgets
		 *
		 * @return void
		 */
		function action_after_setup_theme() {

			require_once( $this->locate_template_in_plugin( 'assets/backend/cpt/portfolio-post.php' ) );
			//require_once( $this->locate_template_in_plugin( 'assets/backend/cpt/slider-post.php' ) );
			require_once( $this->locate_template_in_plugin( 'assets/backend/includes/ishyo-meta-box.php' ) );

			if ( is_admin() ){
				require_once( $this->locate_template_in_plugin( 'assets/backend/includes/custom-meta-boxes.php' ) );
			}

		}


		/**
		 * Adds Theme Options page
		 *
		 * Adds Theme Options page to themes by IshYoBoy using the  "ish_theme_options_after_footer_options" hook
		 *
		 * @return void
		 */
		function add_theme_options_portfolio_options(){

			global $of_options, $of_pages, $of_sidebars;

			do_action( 'ish_theme_options_before_portfolio_options' );

			/* *************************************************************************************************************
			 * 4. Portfolio Settings
			 */
			$of_options[] = array(  'name' => __( 'Portfolio Options', 'ishyoboy_assets' ),
				'class' => 'portfoliooptions',
				'type' => 'heading');

			$url =  ADMIN_DIR . 'assets/images/portfolio-styles/';

			// PORTFOLIO PAGE ******************************************************************************************
			$of_options[] = array(  'name' => __( 'Portfolio page', 'ishyoboy_assets' ),
				'desc' => __( 'The page which will serve as Portfolio homepage.', 'ishyoboy_assets' ),
				'id' => 'page_for_custom_post_type_portfolio-post',
				'std' => '',
				'type' => 'select',
				'options' => $of_pages );

			// PORTFOLIO SIDEBAR ***************************************************************************************
			$of_options[] = array(  'name' => __( 'Portfolio Sidebar', 'ishyoboy_assets' ),
				'desc' => __( 'Display Sidebar on Portfolio overview and detail pages.', 'ishyoboy_assets'), //. '<br><br><span style="color: #FF0000;">' . __( '<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy_assets' ) . '</span>',
				'id' => 'show_portfolio_sidebar',
				'std' => 0,
				'folds' => 1,
				'type' => 'switch');

			$of_options[] = array(  'name' => '', //'name' => __( 'Portfolio Sidebar position', 'ishyoboy_assets' ),
				'desc'  => __( 'Choose whether to display the sidebar on the left or on the right side of the page.', 'ishyoboy_assets' ),
				'id'    => 'portfolio_sidebar_position',
				'std'   => 'right',
				'fold'  => 'show_portfolio_sidebar',
				'type'  => 'select',
				'options' => array('left' => 'Left', 'right' => 'Right') );

			$of_options[] = array(  'name' => '', //'name' => __( 'Portfolio Sidebar', 'ishyoboy_assets' ),
				'desc' => __( 'Select which sidebar will be displayed on Portfolio overview and Portfolio detail pages.', 'ishyoboy_assets' ),
				'id' => 'portfolio_sidebar',
				'std' => 'sidebar-portfolio',
				'fold' => 'show_portfolio_sidebar',
				'type' => 'select',
				'options' => $of_sidebars);

			$of_options[] = array(  'name' => __( 'Animation', 'ishyoboy_assets' ),
				'desc' => __( 'Animation style on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_animation',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''              => __( 'Zoom In', 'ish-sc-plugin'),
					'zoomin-rotate' => __( 'Zoom In & Rotate', 'ish-sc-plugin'),
					'flip'          => __( '3D Flip', 'ish-sc-plugin'),
					'3dcube'        => __( '3D Cube', 'ish-sc-plugin'),
				),
			);

			$of_options[] = array(  'name' => '', //__( 'Text Animation', 'ish-sc-plugin' ),
				'desc' => __( 'Text animation on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_text_animation',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''              => __( 'Vertical', 'ish-sc-plugin'), // none - Default is zoomin
					'horizontal'    => __( 'Horizontal', 'ish-sc-plugin'),
				),
			);

			$of_options[] = array(  'name' => '', //__( 'Text Animation', 'ish-sc-plugin' ),
				'desc' => __( 'Text animation on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_direction',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => __( 'Left', 'ish-sc-plugin'), // left - default is left
					'right'     => __( 'Right', 'ish-sc-plugin'),
					'top'       => __( 'Top', 'ish-sc-plugin'),
					'bottom'    => __( 'Bottom', 'ish-sc-plugin'),
				),
			);

			$of_options[] = array(  'name' => '', //__( 'Text Animation', 'ish-sc-plugin' ),
				'desc' => __( 'Direction of the animation on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_inverse',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => __( 'Title & Category', 'ish-sc-plugin'),
					'inverse'   => __( 'Image', 'ish-sc-plugin'),
				),
			);

			$of_options[] = array(  'name' => __( 'Display Filter', 'ish-sc-plugin' ),
				'desc' => __( 'Categories buttons for users to filter the items.', 'ishyoboy_assets' ),
				'id' => 'portfolio_filter',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''          => __( 'No filter', 'ish-sc-plugin'),
					'fade'      => __( 'Fade', 'ish-sc-plugin'),
					'organize'  => __( 'Fade & Reorganize', 'ish-sc-plugin'),
					'link'      => __( 'Link to category page', 'ish-sc-plugin'),
				),
			);

			$of_options[] = array(  'name'  => '', //__( '', 'ishyoboy_assets' ),
				'desc'  => __( 'The title displayed above the filters.', 'ishyoboy_assets' ),
				'id'    => 'portfolio_filter_title',
				'std'   => __( 'Categories', 'ishyoboy_assets' ),
				'type'  => 'text');

			$of_options[] = array(  'name' => __( 'Items Order', 'ish-sc-plugin' ),
				'desc' => __( 'Which Portfolio items to display first.', 'ishyoboy_assets' ),
				'id' => 'portfolio_order',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''      => __( 'Latest First'),
					'ASC'   => __( 'Oldest First'),
				),
			);

			// Pagination must be set to 'pagination' => always display

			$of_options[] = array(  'name' => __( 'Items per page', 'ish-sc-plugin' ),
				'desc' => __( 'Number of items to display per page. Set "-1" to see all.', 'ishyoboy_assets' ),
				'id' => 'portfolio_per_page',
				'std' => '9',
				'type' => 'text');

			$of_options[] = array(  'name' => __( 'Columns Count', 'ish-sc-plugin' ),
				'desc' => __( 'Number of columns to display in the Portfolio Grid', 'ishyoboy_assets' ),
				'id' => 'portfolio_columns',
				'std' => '4',
				'type' => 'select',
				'options' => Array(
					'8' => '8',
					'7' => '7',
					'6' => '6',
					'5' => '5',
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
			);

			$of_options[] = array(  'name' => __( 'Masonry Layout', 'ish-sc-plugin' ),
				'desc' => __( 'Display items with different heights and widths.', 'ishyoboy_assets' ),
				'id' => 'portfolio_masonry',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''      => __( 'No', 'ish-sc-plugin'),
					'yes'   => __( 'Yes', 'ish-sc-plugin'),
				),
			);

			$of_options[] = array(  'name' => __( 'Show Categories', 'ish-sc-plugin' ),
				'desc' => __( 'Display item category on mouse over.', 'ishyoboy_assets' ),
				'id' => 'portfolio_show_categories',
				'std' => '',
				'type' => 'select',
				'options' => Array(
					''      => __( 'No', 'ish-sc-plugin'),
					'yes'   => __( 'Yes', 'ish-sc-plugin'),
				),
			);

			do_action( 'ish_theme_options_after_portfolio_options' );
		}

	}
	$ish_plugins_cpt = new Ishyoboy_CPT;

endif;

?>