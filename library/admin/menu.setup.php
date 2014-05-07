<?php 

/*
|--------------------------------------------------------------------------
| add menu pages here
| all Menus must start with "*RCP" and edited with ACF
| Naming should correspond to the functionality naming
|--------------------------------------------------------------------------
*/
	global $menu_pages;
	$menu_pages = array_merge( $menu_pages, array(
			'*RCP CLS',
			''
		));
/*
|--------------------------------------------------------------------------
| add main menu item
|--------------------------------------------------------------------------
*/
	add_action('admin_menu', 'response_core_settings');
	function response_core_settings() {
		add_menu_page( __( '*RCP Core', 'response_core' ), __( '*RCP Core', 'response_core' ), 'manage_options', 'response-core', 'resp_main_admin', 'dashicons-nametag' ); 
	}
/*
|--------------------------------------------------------------------------
| add sub menu pages for acf
|--------------------------------------------------------------------------
*/
	function my_acf_options_page_settings( $settings ) {
		global $menu_pages;
		
		// merger all new menu
		$local_pages = array_merge($settings['pages'], $menu_pages);
		$settings['pages'] = $local_pages;
		return $settings;
	}
 
	add_filter('acf/options_page/settings', 'my_acf_options_page_settings');
/*
|--------------------------------------------------------------------------
| enque admin js to move menus
|--------------------------------------------------------------------------
*/
	function rs_wp_admin_style() {
        wp_register_script( 'rs_admin_scripts', plugins_url('Response-Core-Plugin/library/scripts/admin.js'), true, '1.0.0' );
        wp_enqueue_script( 'rs_admin_scripts' );
	}
	add_action( 'admin_enqueue_scripts', 'rs_wp_admin_style' );