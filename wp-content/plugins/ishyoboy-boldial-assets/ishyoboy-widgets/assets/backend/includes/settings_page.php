<?php

// Prevent direct access to the file
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Add an option page
if ( is_admin() ) {
	add_action('admin_menu', 'ishyoboy_twitter_widget_menu');
	add_action('admin_init', 'ishyoboy_twitter_widget_register_settings');
}

function ishyoboy_twitter_widget_menu() {
	add_options_page( __( 'IshYoBoy Twitter Widget Options', 'ishyoboy_assets' ), __( 'Twitter Options', 'ishyoboy_assets' ), 'manage_options', 'ishyoboy_twitter_widget_settings', 'ishyoboy_twitter_widget_settings_output');
}

function ishyoboy_twitter_widget_settings() {
	$tdf = array();
	$tdf[] = array('name'=>'twitter_widget_consumer_key','label' => __( 'Consumer Key', 'ishyoboy_assets' ) );
	$tdf[] = array('name'=>'twitter_widget_consumer_secret','label'=> __( 'Consumer Secret', 'ishyoboy_assets' ) );
	$tdf[] = array('name'=>'twitter_widget_access_token','label'=> __( 'Access Token', 'ishyoboy_assets' ) );
	$tdf[] = array('name'=>'twitter_widget_access_token_secret', 'label' => __( 'Access Token Secret', 'ishyoboy_assets' ) );
	return $tdf;
}

function ishyoboy_twitter_widget_register_settings() {
	$settings = ishyoboy_twitter_widget_settings();
	foreach($settings as $setting) {
		register_setting('ishyoboy_twitter_widget_settings',$setting['name']);
	}
}


function ishyoboy_twitter_widget_settings_output() {
	$settings = ishyoboy_twitter_widget_settings();

	echo '<div class="wrap">';

	echo '<h2>' . __( 'IshYoBoy Twitter Widget Options', 'ishyoboy_assets' ) . '</h2>';

	echo '<br>';

	echo '<p>To be able to use the Twitter Widget you need to create an application under your twitter account which will allow your widget to communicate with twitter servers and receive your latest posts. Please follow each of the steps below:</p>
<ol>
<li>Add a new Twitter application by visiting: <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a></li>
<li>Log in with your twitter account</li><li>Click on the "Create a new application" button or use an already existing one.</li>
<li>Fill in all fields and Callback URL (Website and URLs should start with "http://").</li>
<li>Agree to the rules, fill out the captcha, and submit your application.</li>
<li>After successful creation, generate an access token by clicking the "Generate my access token." button</li>
<li>Wait for a few seconds for the server to reflect the changes and refresh the page.</li>
<li>Copy all the keys into the fields below. Make sure not to copy the URLs but the random strings.</li>
<li>Save all changes. You can now create your Twitter Widget in "Appearance -&gt; Widgets".</li>
</ol>
</div>';

	echo '<br><hr />';

	echo '<form method="post" action="options.php">';

	settings_fields('ishyoboy_twitter_widget_settings');

	echo '<table>';
	foreach($settings as $setting) {
		echo '<tr>';
		echo '<td>'.$setting['label'].'</td>';
		echo '<td><input type="text" style="width: 400px" name="'.$setting['name'].'" value="'.get_option($setting['name']).'" /></td>';
		echo '</tr>';
	}
	echo '</table>';

	submit_button();

	echo '</form>';

	echo '</div>';

}