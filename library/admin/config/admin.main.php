<?php
/**
 * set config for updater
 */
	global $admin_config;
	if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$admin_config = array(
			'update' => array(
				'screenshot' => 'updater.png',
				'url' => 'admin.php?page=response-updater',
				'name' => 'Update '.RP_PLUG_NAME
			),
			'comments' => array(
				'screenshot' => 'comment-links.png',
				'url' => 'admin.php?page=acf-options-rcp-cls',
				'name' => 'Comment Link Security'
			),
		);

	}

?>