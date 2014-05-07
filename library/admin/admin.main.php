<?php
function resp_main_admin() {
	global $admin_config;
	ob_start(); ?>
	
	<div class="wrap">
	    <h2><?php echo RP_PLUG_NAME ?></h2>
	    <div class="theme-browser rendered">
	    	<div class="themes">
			<?php
				foreach ($admin_config as $_options) {
				    ?>
		            <div class="theme" tabindex="0">
		                <div class="theme-screenshot">
		                	<img alt="" src="<?php echo RP_SCREENSHOTS.$_options['screenshot']; ?>">
		                </div>
		                <h3 class="theme-name" id="twentyfourteen-name"><?php echo $_options['name']; ?></h3>

		                <div class="theme-actions">
		                    <a class="button button-primary customize load-customize" href= "<?php echo admin_url().$_options['url']; ?>">Settings</a>
		                </div>
		            </div>
				    <?php
				}
			?>
			</div><br class="clear">
	    </div>

	    <div class="theme-overlay"></div>
	</div>
	<?php ob_end_flush();
}