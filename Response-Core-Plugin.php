<?php
/**
 * Plugin Name: Response Core Functionalities Plugin
 * Plugin URI: http://thepowertoprovoke.com
 * Description: This WordPress plugin is intended for use by Response Marketing. Support will not be granted to anyone other than Response Marketing Employees
 * Version: 0.2
 * Author: Response Marketing
 * Author URI: http://thepowertoprovoke.com
 * License: GPL2
 */

/*
|--------------------------------------------------------------------------
| include updater
|--------------------------------------------------------------------------
*/
	add_action( 'init', 'github_plugin_updater_test_init' );
	function github_plugin_updater_test_init() {

		include_once('updates/updater.class.php');

		define( 'WP_GITHUB_FORCE_UPDATE', true );
		// set configuration
		include( dirname(__FILE__).'updates/updater.config.php');

	}
/*
|--------------------------------------------------------------------------
| Main functions class with configuration array
|--------------------------------------------------------------------------
*/
	include( dirname(__FILE__).'/library/functions.class.php' );
	$init_config = array (
			//...
		);
	new plugin_BaseClass($init_config);
/*
|--------------------------------------------------------------------------
| remove links from comments
|--------------------------------------------------------------------------
*/
	include( dirname(__FILE__).'/library/comment-links/comment.links.php');
?>