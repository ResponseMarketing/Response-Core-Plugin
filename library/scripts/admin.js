/**
 * get top menues that have an id that partially matches
 * @return NULL no return values
 */
jQuery(document).ready(function() {
	var submenu = jQuery('li.menu-top').filter(function() {
        return this.id.match(/toplevel_page_acf/);
    }).find("ul.wp-submenu.wp-submenu-wrap");
	
	//console.log(submenu);
	// for each li of said menu find our items and append them to our menu
	jQuery(submenu).find('li').each(function(arr) {
		var _e = jQuery(this);
		var _text = _e.find('a').text();
		var _patt = new RegExp(/^(\*RCP\ )/);
		var _res = _patt.test(_text);
		var _rs_menu = jQuery('#toplevel_page_response-core');
		var _rs_sub_menu = jQuery('#toplevel_page_response-core ul.wp-submenu.wp-submenu-wrap');
		// response core main ID toplevel_page_response-core
		// append lis to ul.wp-submenu.wp-submenu-wrap
		// check if this li contains a link and regex for *RS
		if (_e.has('a') && _res) {
			// check if this element is active if true make our nav active
			if(_e.hasClass('current')) {
				// find the closest top menu and remova active
				_e.closest('li.menu-top').removeClass('wp-has-current-submenu wp-menu-open');
				// remove not current from out nav
				_rs_menu.removeClass('wp-not-current-submenu');
				// add current to our nav
				_rs_menu.addClass('wp-has-current-submenu wp-menu-open');
			}
			// if true move/append to our nav
			_rs_sub_menu.append(_e);

		}
		return;
	});
	return;
});