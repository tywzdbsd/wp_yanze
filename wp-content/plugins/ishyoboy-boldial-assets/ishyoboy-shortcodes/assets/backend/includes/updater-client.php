<?php
/*
 * Plugin Name: IshYoBoy Updater
 * Plugin URI: http://ishyoboy.com/
 * Description: A client plugin for showing updates for non-WordPress.org plugins
 * Author: IshYoBoy
 * Version: 0.1
 * Author URI: http://ishyoboy.com
 */


if ( ! class_exists( 'IYB_Commercial_Client' ) ){
	class IYB_Commercial_Client {

		/**
		 * The plugin remote update path
		 * @var string
		 */
		public $update_path = 'http://updates.ishyoboy.com/plugins/';

		/**
		 * Plugin Prefix (prefix-plugin_directory/prefix-plugin_file.php)
		 * @var string
		 */
		public $plugins_prefix = 'ishyoboy-';

		/**
		 * Plugin Slug (plugin_directory/plugin_file.php)
		 * @var string
		 */
		public $plugin_slug;

		/**
		 * Plugin name (plugin_file)
		 * @var string
		 */
		public $slug;

		/**
		 * Plugins data old (Array for all or just one plugin)
		 * @var array
		 */
		public $plugin_data_old = Array();

		/**
		 * Plugin data new (Array for all or just one plugin)
		 * @var array
		 */
		public $plugin_data_new = Array();

		/**
		 * Initialize a new instance of the WordPress Auto-Update class
		 * @param string $update_path
		 * @param string $plugin_slug
		 */
		function __construct( $plugin_slug = null )
		{

			//echo ' IYB_Commercial_Client: [CONSTRUCT - ' . $plugin_slug . ']'.'<br>';

			// Set the class public variables
			$this->plugin_slug = $plugin_slug;

			if ( $plugin_slug ){
				list ($t1, $t2) = explode('/', $plugin_slug);
				$this->slug = str_replace('.php', '', $t2);
			}

			// define the alternative API for updating checking
			add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_update'));

			// Define the alternative response for information checking
			add_filter('plugins_api_result', array(&$this, 'check_info'), 10, 3);
		}

		/**
		 * Add our self-hosted autoupdate plugin to the filter transient
		 *
		 * @param $transient
		 * @return object $ transient
		 */
		public function check_update( $transient )
		{
			//echo ' IYB_Commercial_Client: [check_update]'.'<br>';

			if ( empty( $transient->checked ) ) {
				return $transient;
			}

			if ( empty( $this->plugin_data_new ) ){

				// Get the plugins data
				$this->plugin_data_new = $this->getRemote_information();

			}

			if ( $this->plugin_data_new ){

				foreach ( $this->plugin_data_new as $key => $data ) {

					$obj = new stdClass();
					$obj->id = ( 90000 + rand(100, 90000) );
					$obj->slug = $data->slug;
					$obj->new_version = $data->version;
					$obj->url = $this->update_path;
					$obj->tested = $data->tested;
					$obj->package = $data->download_link;
					$transient->response[ $key ] = $obj;

				}

			}

			return $transient;
		}

		/**
		 * Add our self-hosted description to the filter
		 *
		 * @param boolean $false
		 * @param array $action
		 * @param object $arg
		 * @return bool|object
		 */
		public function check_info( $res, $action, $args)
		{

			//echo ' IYB_Commercial_Client: [check_info]'.'<br>';

			if ( isset( $args ) && is_array( $args ) && isset( $args['body'] ) && isset( $args['body']['request'] ) ){
				$request  = maybe_unserialize( $args['body']['request'] );
				$args = $request;
			}

			$all_plugins = $this->getRemote_information();
			$plugin = ( 'plugin_information' == $action ) && isset( $args->slug ) && ( isset( $all_plugins[ $args->slug ] ) );

			// If our plugin matches the request, set our own plugin data, else return the default response
			if ( $plugin ){
				return $all_plugins[ $args->slug ];
			}
			else{
				return $res;
			}
		}

		/**
		 * Get information about the remote version
		 * @return bool|object
		 */
		public function getRemote_information()
		{

			if ( empty( $this->plugin_data_new ) ) {

				if ( empty( $this->plugin_data_old ) ){

					// Get a list of all plugins
					$all_plugins = get_plugins();

					// Filter only ishyoboy plugins
					$ish_plugins = Array();


					if ( ! empty( $this->plugin_slug ) ){

						foreach ( $all_plugins as $key => $val ){
							if ( $key ==  $this->plugin_slug ) {
								$ish_plugins[ $key ] = $val;
							}
						}

					}
					else{

						foreach ( $all_plugins as $key => $val ){
							if ( 0 === strpos( $key, $this->plugins_prefix ) ){
								$ish_plugins[ $key ] = $val;
							}
						}

					}

					$plugins = Array();
					foreach ( $ish_plugins as $key => $val ){
						$plugins[$key] = $val['Version'];
					}

					$this->plugin_data_old = $plugins;
				}

				include ABSPATH . WPINC . '/version.php';

				// If your plugin has a key that you want to check on the server side,
				// you should include it in the 'body' element of this array.
				$options = array(
					'timeout'    => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 3 ),
					'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
					'body'       => array(
						'action' => 'info',
						'plugins' => $this->plugin_data_old,
					)
				);

				//echo ' IYB_Commercial_Client: [getRemote_information]'.'<br>';


				$request = wp_remote_post( $this->update_path, $options );

				if ( !is_wp_error($request) || wp_remote_retrieve_response_code( $request ) === 200) {

					$return = unserialize( $request['body'] );
					return $return;

				}
				return false;
			}
			else{
				return $this->plugin_data_new;
			}
		}

		/**
		 * Return the status of the plugin licensing
		 * @return boolean $remote_license
		 */
		public function getRemote_license()
		{
			//echo ' IYB_Commercial_Client: [getRemote_license]'.'<br>';

			$request = wp_remote_post($this->update_path, array('body' => array('action' => 'license')));
			if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
				return $request['body'];
			}
			return false;
		}
	}
}