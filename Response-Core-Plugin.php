<?php
/**
 * Plugin Name: Response Core Functionalities Plugin
 * Plugin URI: http://thepowertoprovoke.com
 * Description: This WordPress plugin is intended for use by Response Marketing. Support will not be granted to anyone other than Response Marketing Employees
 * Version: 0.5
 * Author: Response Marketing
 * Author URI: http://thepowertoprovoke.com
 * License: GPL2
 */


/*
|--------------------------------------------------------------------------
| Identify Globals
|--------------------------------------------------------------------------
*/
	global $admin_config;
	global $menu_pages;
	$menu_pages = array();
/*
|--------------------------------------------------------------------------
| Define CONSTANTS
|--------------------------------------------------------------------------
*/
	define( 'RP_PLUG_NAME', 'Response Core Plugin' );
	define( 'RP_GITHUB_FORCE_UPDATE', true );
	define( 'RP_GITHUB_PLUGIN_NAME', plugin_basename(__FILE__) );
	define( 'RP_DIR', plugin_dir_path( __FILE__ ) );
	define( 'RP_SCREENSHOTS', plugins_url( 'library/screenshots/' , __FILE__ ) );
	define( 'RP_PLUGINS', plugins_url( 'required-plugins/' , __FILE__ ) );

/*
|--------------------------------------------------------------------------
| include updater
|--------------------------------------------------------------------------
*/
	add_action( 'init', 'github_plugin_updater_test_init' );
	function github_plugin_updater_test_init() {

		include_once( dirname(__FILE__).'/updates/updater.class.php');
		// set configuration
		include( dirname(__FILE__).'/updates/updater.config.php');

	}
/*
|--------------------------------------------------------------------------
| include plugins functionality check if plugins are active
|--------------------------------------------------------------------------
*/
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
  		//plugin is activated
  		require_once( RP_DIR . '../advanced-custom-fields/acf.php' );
  	}
/*
|--------------------------------------------------------------------------
| Required Plugins
|--------------------------------------------------------------------------
*/
	global $additional_plugins;
	$additional_plugins = array (
		// This is an example of how to include a plugin pre-packaged with a theme
		// array(
		// 	'name'     				=> 'WP Document Revision Extension', // The plugin name
		// 	'slug'     				=> 'wp-document-revisions', // The plugin slug (typically the folder name)
		// 	'source'   				=> RP_PLUGINS . 'wp-document-revisions.zip', // The plugin source
		// 	'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
		// 	'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		// 	'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		// 	'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		// 	'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		// ),

		//This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name'				=> 'WP Document Revision',
			'slug'				=> 'wp-document-revisions',
			'required'			=> false,
			'force_activation'	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
	);
	require_once( dirname( __FILE__ ) . '/required-plugins/required.class.php' );
	include( dirname( __FILE__ ) . '/required-plugins/required.plugins.php' );

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
	include('library/acf/cls-fieldgroups.php');
	if ( !is_admin() && get_field('rcp_cls', 'options') ) {
		global $rcp_author_cls;
		global $rcp_html_cls;
		global $rcp_cls;

		$rcp_cls = (get_field('rcp_cls', 'options') ? true : false);
		$rcp_author_cls = (get_field('rcp_author_cls', 'options') ? true : false);
		$rcp_html_cls = (get_field('rcp_html_cls', 'options') ? true : false);
		
		if ($rcp_cls) include( dirname(__FILE__).'/library/comment-links/comment.links.php');
	}

/*
|--------------------------------------------------------------------------
| Detect Advanced custom fields
|--------------------------------------------------------------------------
*/

	// if ( !is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
	//   //plugin is activated
	// }

/*
|--------------------------------------------------------------------------
| include menu and pages setup
|--------------------------------------------------------------------------
*/
	include( dirname(__FILE__).'/library/admin/config/admin.main.php');
	include( dirname(__FILE__).'/library/admin/admin.main.php');
	include( dirname(__FILE__).'/library/admin/menu.setup.php');
	include( dirname(__FILE__).'/updates/updater.admin.php');
	if ( is_plugin_active( 'wp-document-revisions/wp-document-revisions.php' ) ) {
  		//plugin is activated
  		array_push($menu_pages, '*RCP WPDR EXT');
  		include('library/acf/wpdr-fieldgroups.php');
  		$rcp_wpdr_filter = (get_field('rcp_wpdr_filter', 'options') ? true : false);
  		if ($rcp_wpdr_filter) {
  			include( RP_DIR . 'library/wp-document-revisions-extension/wp-document-revisions-extension.php' );

  		}
  	}
	
?>