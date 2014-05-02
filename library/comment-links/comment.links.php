<?php
/*
|--------------------------------------------------------------------------
| remove links from comments
|--------------------------------------------------------------------------
*/

remove_filter(‘comment_text’, ‘make_clickable’, 9);

function preprocess_comment_handler( $commentdata ) { 

	// Always remove the URL from the comment author's comment
	unset( $commentdata['comment_author_url'] );

	// If the user is speaking in all caps, lowercase the comment
	if( $commentdata['comment_content'] == strtoupper( $commentdata['comment_content'] )) {
		$commentdata['comment_content'] = strtolower( $commentdata['comment_content'] );
	}
	
	//stip obsene html
	$commentdata['comment_content'] = strip_tags($commentdata['comment_content'], '<p><span><ul><li><ol>');
	
	return $commentdata;

 }

add_action( 'preprocess_comment' , 'preprocess_comment_handler' );
?>