<?php
/**
 * Plugin Name: WP Document Revision Extension
 * Plugin URI: http://thepowertoprovoke.com
 * Description: This plugin adds a presave filter to the content area removing the revision information when adding a document link to the content of a page/post/custom post type.
 * Version: 1.0
 * Author: Bryan Bielefeldt
 * Author URI: http://thepowertoprovoke.com
 * License: GPL2
 */

/**
 * sanitize_document_version strips the revision query from urls placed in the content on post/page/custom post type
 * @param  String $content from wp_post.post_content
 * @return String          Stripped query
 */

function sanitize_document_version( $content ) {
    $pattern = '(&amp;revision=?[0-9]|&revision=?[0-9]|&\#038;revision=?[0-9])';
	$replacement = '';
	return preg_replace($pattern, $replacement, $content);
}

add_filter( 'content_save_pre' , 'sanitize_document_version' , 10, 1);

?>