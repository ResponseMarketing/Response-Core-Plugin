<?php
	include_once(RP_DIR . '../advanced-custom-fields/acf.php');
	if(function_exists("register_field_group")) {
		register_field_group(array (
			'id' => 'acf_comment-links-security-plugin-options',
			'title' => 'Comment Links Security Plugin Options',
			'fields' => array (
				array (
					'key' => 'field_53692bad1b30e',
					'label' => 'Enable Comment Link Security',
					'name' => 'rcp_cls',
					'type' => 'true_false',
					'instructions' => 'Check this box to enable Comment Link Security.',
					'message' => 'Select this to enable comment link security',
					'default_value' => 1,
				),
				array (
					'key' => 'field_536a8190d5665',
					'label' => 'Author URL Removal',
					'name' => 'rcp_author_cls',
					'type' => 'true_false',
					'instructions' => 'Select this to turn off comment author link.',
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_53692bad1b30e',
								'operator' => '==',
								'value' => '1',
							),
						),
						'allorany' => 'all',
					),
					'message' => '',
					'default_value' => 1,
				),
				array (
					'key' => 'field_536a81e0d5666',
					'label' => 'Remove Comment links and extra HTML',
					'name' => 'rcp_html_cls',
					'type' => 'true_false',
					'instructions' => 'Select this to remove links from comments as well as extra html.',
					'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_53692bad1b30e',
								'operator' => '==',
								'value' => '1',
							),
						),
						'allorany' => 'all',
					),
					'message' => '',
					'default_value' => 1,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'acf-options-rcp-cls',
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
