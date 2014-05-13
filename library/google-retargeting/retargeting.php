<?php
/*
Plugin Name: Response Retargeting
Plugin URI: www.thepowertoprovoke.com
Description: Adds remarketing code to page with given variables.
Version: 1.0
Author: Al Ramos
Author URI: www.thepowertoprovoke.com
*/




//Add meta box
add_action('add_meta_boxes','resp_add_meta');
//Saving
add_action('save_post','resp_save_data');
//Remarketing Code
add_action('wp_footer', 'resp_retarget_code');

add_action( 'admin_enqueue_scripts', 'load_resp_script' );



function load_resp_script() {
	

	// link to jquery resource on github
	// https://github.com/omarshammas/jquery.formance/blob/master/lib/jquery.formance.min.js

	wp_register_script( 'masking_script', plugins_url( RP_PLUG_FOLDER.'/library/scripts/jquery.formancs.min.js' ), array( 'jquery' ) );  
	wp_register_script( 'retarget_script', plugins_url( 'js/retarget_script.js', __FILE__ ), array( 'jquery' ) );  
	wp_register_style( 'retarget_css', plugins_url( 'css/retargeting.css', __FILE__ ) );

	wp_enqueue_script( 'masking_script' );

	wp_enqueue_script( 'retarget_script' );
	
	wp_enqueue_style( 'retarget_css' );
	 
}

function resp_add_meta() {
	add_meta_box('resp_meta','Response Retargeting Tags','resp_meta_box','post','side','high');
	add_meta_box('resp_meta','Response Retargeting Tags','resp_meta_box','page','side','high');
}

//Render meta box
function resp_meta_box($post) {
	
	$values = get_post_custom ($post->ID);
	
	//esc_attr to stop people from typing scripts into field
	$tag_id = '';
	$tag_label = '';
	$tag_params = '';
	$tag_remarket = '';
	
	$tag_id = isset( $values['tag_id'] ) ? esc_attr( $values['tag_id'][0] ) : '';
	$tag_label = isset( $values['tag_label'] ) ? esc_attr( $values['tag_label'][0] ) : '';
	$tag_params = isset( $values['tag_params'] ) ? esc_attr( $values['tag_params'][0] ) : '';
	$tag_remarket = isset( $values['tag_remarket'] ) ? esc_attr( $values['tag_remarket'][0] ) : '';

	$chk = get_post_meta($post->ID, 'checker', true);	
	//echo 'tag_id=' . $tag_id;
	
	if($chk && $tag_id == '') 
		$tag_id = get_option('sett_id');
		
	if($chk && $tag_label == '') 
		$tag_label = get_option('sett_label');
		
	if($chk && $tag_params == '') 
		$tag_params = get_option('sett_params');

	if($chk && $tag_remarket == '') 
		$tag_remarket = get_option('sett_remark');
		
	wp_nonce_field('resp_meta_nonce','resp_nonce');
	?>
	
	<div id="rcp_retargeting">
		
		<input id = "rcp_retargeting_chk" type = "checkbox" name = "checker" value = "Yes"  <?php echo ((get_post_meta($post->ID, 'checker', true))=='on'? 'checked = checked' : ''); ?>>
		
		<div class = "rcp_retargeting_resp_meta_field" id = "rcp_retargeting_tagID" style="display:none;">
			<label for = "tag_id"> Tag ID: (numeric only) </label><br>
			<input type = "text" name = "tag_id" id = "rcp_retargeting_tag_id" value = "<?php echo $tag_id; ?>" />
			<br/>
		</div>
		
		<div class = "rcp_retargeting_resp_meta_field" id = "rcp_retargeting_tagLabel" style="display:none;">
			<label for = "tag_label"> Tag Label: </label><br>
			<input type = "text" name = "tag_label" id = "rcp_retargeting_tag_label" value = "<?php echo $tag_label; ?>" />
			<br/>
		</div>
		
		<div class = "rcp_retargeting_resp_meta_field" id = "rcp_retargeting_tagParams" style="display:none;">
			<label for = "tag_params"> Tag Parameters: </label><br>
			<input type = "text" name = "tag_params" id = "rcp_retargeting_tag_params" value = "<?php echo $tag_params; ?>" />
			<br/>
		</div>
		
		<div class = "rcp_retargeting_resp_meta_field" id = "rcp_retargeting_tagRemarket" style="display:none;">
			<label for = "tag_remarket"> Retargeting: </label><br>
			<span class="rcp_retargeting_radio">
				<input type = "radio" name = "tag_remarket" id = "rcp_retargeting_tag_remarket" value = "true" <?php echo ($tag_remarket == 'true')? 'checked="checked"':''; ?>>True</input>
			</span>
			<span class="rcp_retargeting_radio">
				<input type = "radio" name = "tag_remarket" id = "rcp_retargeting_tag_remarket" value = "false" <?php echo ($tag_remarket == 'false')? 'checked="checked"':''; ?>>False</input>
			</span>
		</div>
		<div id="major-publishing-actions">
			<div id="publishing-action">
				<label for = "checker" class="rcp_retargeting_main"> Add a unique marketing tag to this page/post. </label>
				<span class="spinner"></span>
						<span id="rcp_retargeting_add" name="retarget" type="submit" class="button <?php echo ((get_post_meta($post->ID, 'checker', true))=='on'? 'button-secondary' : 'button-primary'); ?> button-large" id="retargeting" accesskey="r" ><?php echo ((get_post_meta($post->ID, 'checker', true))=='on'? 'Remove' : 'Add'); ?></span>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php
}

//Save meta data
function resp_save_data($post_id) {
	//if no nonce don't save
	if( !isset( $_POST['resp_nonce'] ) || !wp_verify_nonce( $_POST['resp_nonce'], 'resp_meta_nonce' ) ) 
		return $post_id;
	
	//if user can't edit posts don't save	
	if( !current_user_can( 'edit_post', get_the_ID() ) ) 
		return $post_id;
	
	//if doing an autosave	
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
	
	//post meta data
	if( isset( $_POST['tag_id'] ) )
		update_post_meta( $post_id, 'tag_id', $_POST['tag_id'] );
		
	if( isset( $_POST['tag_label'] ) )
		update_post_meta( $post_id, 'tag_label',  $_POST['tag_label'] );
	
	if( isset( $_POST['tag_params'] ) )
		update_post_meta( $post_id, 'tag_params',  $_POST['tag_params'] );	

	if( isset( $_POST['tag_remarket'] ) ) {
		$radio = $_POST['tag_remarket'];
		update_post_meta( $post_id, 'tag_remarket', $radio );
	}
	
	$chk = isset( $_POST['checker'] )  ? 'on' : 'off';  
    update_post_meta( $post_id, 'checker', $chk ); 
	

	
}

function resp_retarget_code($post_id) {
	$chk = get_post_meta(get_the_ID(), 'checker', true);
	$tag_id =  get_post_meta(get_the_ID(), 'tag_id', true);	
	$tag_label = get_post_meta(get_the_ID(), 'tag_label', true);
	$tag_params = get_post_meta(get_the_ID(), 'tag_params', true);
	$tag_remarket = get_post_meta(get_the_ID(), 'tag_remarket', true);
		//echo 'tag_id=' . $tag_id;
		
		if($chk == "off" || $tag_id == '') 
			$tag_id = get_option('sett_id');
			
		if($chk == "off" || $tag_label == '') 
			$tag_label = get_option('sett_label');
			
		if($chk == "off" || $tag_params == '') 
			$tag_params = get_option('sett_params');
	
		if($chk == "off"|| $tag_remarket == '') 
			$tag_remarket = get_option('sett_remark');

    ?>
	<!-- Google Code for <?php echo get_bloginfo('name'); ?> - Tag -->
	<!-- Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. For instructions on adding this tag and more information on the above requirements, read the setup guide: google.com/ads/remarketingsetup -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = <?php echo $tag_id; ?>;
	var google_conversion_label = "<?php echo $tag_label; ?>";
	var google_custom_params = <?php echo $tag_params; ?>;
	var google_remarketing_only = <?php echo $tag_remarket; ?>;
	/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
	</script>
	<noscript>
	<div style="display:inline;">
	<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/<?php echo $tag_id; ?>/?value=0&amp;label=<?php echo $tag_label; ?>&amp;guid=ON&amp;script=0"/>
	</div>
	</noscript>

	<?php
}
?>