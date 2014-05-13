	
	jQuery(document).ready(function(){

		var _chk = jQuery("#rcp_retargeting_chk").is(":checked");
		var _tagID = jQuery("#rcp_retargeting_tagID");
		var _meta_class = ".rcp_retargeting_resp_meta_field";
		/**
		 * formatter
		 * for forcing input types
		 */
		
		_tagID.formance('format_number');
		var this_checked = function () {
			if(_chk) {
				_tagID.show();
			}
				
			if(_chk && jQuery(_meta_class + " :input[name=tag_id]").val().length > 0) {
				jQuery("#rcp_retargeting_tagLabel").show();
			}
			
			if(_chk && jQuery(_meta_class + " :input[name=tag_label]").val().length > 0) {
				jQuery("#rcp_retargeting_tagParams").show();		
			}
				
			if(_chk && jQuery(_meta_class + " :input[name=tag_params]").val().length > 0) {
				jQuery("#rcp_retargeting_tagRemarket").show();
			}
		};this_checked();
		jQuery('#rcp_retargeting_add').bind('click',function() {
			var _e = jQuery(this);
			
			if(jQuery(_meta_class + " input").val().length > 0) {
					jQuery(_meta_class).slideToggle();
			} else {
				_tagID.slideToggle();
			}
			_e.toggleClass('button-primary button-secondary');
			
			if(_chk) {
				jQuery("#rcp_retargeting_chk").attr('checked',false);
			} else {
				jQuery("#rcp_retargeting_chk").attr('checked',true);
			}
			
			if (_e.hasClass('button-primary')) {
				_e.text('Add');
			} else {
				_e.text('Remove');
			}
			this_checked();
		});
		jQuery(_meta_class + " :input[name=tag_id]").on('keyup change', function(){
			jQuery("#rcp_retargeting_tagLabel").show();
		});
		
		jQuery(_meta_class + " :input[name=tag_label]").on('keyup change', function(){
				jQuery("#rcp_retargeting_tagParams").show();
		});
		
		jQuery(_meta_class + " :input[name=tag_params]").on('keyup change', function(){
				jQuery("#rcp_retargeting_tagRemarket").show();
		});
	});
	
	
	
	