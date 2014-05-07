<?php
	include_once(RP_DIR . '../advanced-custom-fields/acf.php');
	if(function_exists("register_field_group")) {
		register_field_group(array (
			'id' => 'acf_wp-document-revisions-extension',
			'title' => 'WP Document Revisions Extension',
			'fields' => array (
				array (
					'key' => 'field_536a9c8484759',
					'label' => 'Media link filter',
					'name' => 'rcp_wpdr_filter',
					'type' => 'true_false',
					'instructions' => 'Would you like to filter past revisions when inserting document revisions into posts or pages?',
					'message' => 'Check this to only link to the most current version from the frontend.',
					'default_value' => 1,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options-rcp-wpdr-ext',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
	}
