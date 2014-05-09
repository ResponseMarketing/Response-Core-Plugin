<?php 
	function load_custom_wp_admin_style() {
	        wp_register_script( 'masking_script', plugins_url( RP_PLUG_FOLDER.'/library/scripts/jquery.formancs.min.js' ), array( 'jquery' ) );
	        wp_enqueue_script( 'masking_script' );
	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
	global $sett_id;
	global $sett_label;
	global $sett_params;
	global $sett_remark;
	global $messages;
	$messages = false;
	/**
	 * test_POST & test_OPTION both check if is set and return based on type of return requested
	 * @param  $_POST/get_option	$attr
	 * @param  Boolean				$ret_type describes the return type true = value or false = boolean
	 * @return defined by above parameter
	 */
	function test_POST($attr, $ret_type = false) {
		if($ret_type && isset($_POST[$attr])) {
			return $_POST[$attr];
		} elseif (!$ret_type) {
			return isset($_POST[$attr]);
		}
		return false;
	}
	function test_OPTION($attr, $ret_type = false) {
		
		if($ret_type && get_option($attr)) {
			return (get_option($attr) ? get_option($attr) : '');
		} elseif (!$ret_type) {
			return (get_option($attr) ? true : false);
		}
		return false;
	}
	function rcp_messages($type,$message) {
    	global $messages;
    	if( !$messages ) {
	    	$messages = '<div class="' . $type . '"><p><strong>' . $message . '</strong></p></div>';
	    } else {
	    	$messages .= '<div class="' . $type . '"><p><strong>' . $message . '</strong></p></div>';
	    }
	}
	function rcp_retargeting_change( $option, $data ) {
		global $messages;
	    $message = null;
	    $type = null;
	    
	    if ( null !== $data ) {

	        if ( false === get_option( $option ) ) {

	            add_option( $option, $data );
	            $type = 'updated';
	            $message = __( 'Successfully saved', 'rcp_retargeting' );
	            rcp_messages($type,$message);

	        } else if ( $data === get_option( $option ) ) {
	        } else {

	            update_option( $option, $data );
	            $type = 'updated';
	            $message = __( 'Successfully updated', 'rcp_retargeting' );
	            rcp_messages($type,$message);

	        }

	    } else {

	        $type = 'error';
	        $message = __( 'Data can not be empty', 'rcp_retargeting' );
	        rcp_messages($type,$message);

	    }

	    

	}
	if( test_POST('retarg_hidden') == 'Y' ) {
		//Form data sent
		$sett_id = test_POST('sett_id', true);
		rcp_retargeting_change('sett_id', $sett_id);
		
		$sett_label = test_POST('sett_label', true);
		rcp_retargeting_change('sett_label', $sett_label);
		
		$sett_params = test_POST('sett_params', true);
		rcp_retargeting_change('sett_params', $sett_params);
		
		$sett_remark = test_POST('sett_remark', true);
		rcp_retargeting_change('sett_remark', $sett_remark);

		
	} else {
		//Normal page display
		$sett_id = test_OPTION('sett_id', true);
		$sett_label = test_OPTION('sett_label', true);
		$sett_params = test_OPTION('sett_params', true);
		$sett_remark = test_OPTION('sett_remark', true);
	}

//Add to Menu
add_action('admin_menu', 'resp_menu');
function resp_menu() {
	//add_options_page( 'Response Retargeting', 'Response Retargeting', 'manage_options', 'response_retargeting', 'resp_admin');
	add_submenu_page( 'response-core', '*RCP Retargeting', '*RCP Retargeting', 'manage_options', 'response-retargeting', 'resp_admin' );
	
}

function resp_admin() {

	global $sett_id;
	global $sett_label;
	global $sett_params;
	global $sett_remark;
	global $messages;

	ob_start();

		?>

		<div class = "wrap">
			<div style = "width:600px;max-width:100%;">
				<h1>Response Retargeting Instructions</h1>
				<p>To add a Remarketing Tag to a page simply check the box that asks if you would like to add a tag to the page. Then fill out the ID, Label, Params with the information you have for your remarketing tag, and then select a button for remarketing. </p>
				<?php 
					if ( $messages ) {
						echo $messages;
					} else if ( !$messages && test_POST('sett_id') ){
						echo '<div class="updated"><p><strong>Nothing to update. Your settings have stayed the same.</strong></p></div>';
					}
				?>
				<h1> Settings </h1>
				<form name = "retarg_form" method = "post" action = "<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"> 
				
					<input type = "hidden" name = "retarg_hidden" value = "Y">  
					
					<label for = "sett_id"> Tag ID: (numeric only)</label><br>
					<input type = "text" id="sett_ID" name = "sett_id" value = "<?php echo $sett_id; ?>" />
					<br/>
					
					<label for = "sett_label"> Tag Label: </label><br>
					<input type = "text" name = "sett_label" value = "<?php echo $sett_label; ?>" />
					<br/>
					
					<label for = "sett_params"> Tag Parameters: </label><br>
					<input type = "text" name = "sett_params" value = "<?php echo $sett_params; ?>" />
					<br/>
					
					<label for = "sett_remark"> Remarketing: </label><br>
					<input type = "radio" name = "sett_remark" value = "true" <?php echo ($sett_remark == 'true')? 'checked="checked"':''; ?>>True</input> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type = "radio" name = "sett_remark" value = "false" <?php echo ($sett_remark == 'false')? 'checked="checked"':''; ?>>False</input>
					<br><br>
					
					<input class="button-primary" type = "submit" name = "Submit" value = "<?php echo 'Update'; ?>">
				</form>
			</div>
			
		</div>
		<script>
			jQuery('#sett_ID').formance('format_number');
		</script>
	<?php ob_end_flush();
}
	