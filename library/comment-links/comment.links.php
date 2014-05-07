<?php
/*
|--------------------------------------------------------------------------
| remove links from comments
|--------------------------------------------------------------------------
*/ 

	global $rcp_author_cls;
	global $rcp_html_cls;
	global $rcp_cls;
	
	if (!is_admin() && function_exists('make_clickable')) {
		if ($rcp_html_cls) remove_filter('comment_text', 'make_clickable', 9);
		function preprocess_comment_handler( $commentdata ) { 
			global $rcp_author_cls;
			global $rcp_html_cls;
			global $rcp_cls;

			// Always remove the URL from the comment author's comment
			if ($rcp_author_cls) $commentdata['comment_author_url'] = '#';
			
			if ($rcp_html_cls) {
				// Always remove auto linking in comments
				
				//stip obsene html
				if ($rcp_html_cls) $commentdata['comment_content'] = strip_tags($commentdata['comment_content'], '<p><span><ul><li><ol>');
				// If the user is speaking in all caps, lowercase the comment
				if( $commentdata['comment_content'] == strtoupper( $commentdata['comment_content'] )) {
					$commentdata['comment_content'] = strtolower( $commentdata['comment_content'] );
				}
			}
			
			return $commentdata;

		}
		add_action( 'preprocess_comment' , 'preprocess_comment_handler' );
	}
?>