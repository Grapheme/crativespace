// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/*!
*
*
* Arte Hover 1.0
* http://arte.dp.ua/blog/arte-hover
*
* Web Design Studio 'Arte'
* http://arte.dp.ua
* Copyright 2011, Ustimenko Sergei
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://www.opensource.org/licenses/mit-license.php
* http://www.opensource.org/licenses/gpl-2.0.php
*
* Date: 17 / 05 / 2011
* Depends on library: jQuery 
*
* 
*/
/*!
*
*
* Arte Hover 1.0
* http://arte.dp.ua/blog/arte-hover
*
* Web Design Studio 'Arte'
* http://arte.dp.ua
* Copyright 2011, Ustimenko Sergei
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://www.opensource.org/licenses/mit-license.php
* http://www.opensource.org/licenses/gpl-2.0.php
*
* Date: 17 / 05 / 2011
* Depends on library: jQuery 
*
* 
*/
jQuery.fn.ArteHover = function(animSpeed, overCallback, outCallback) {
	if(animSpeed == undefined) { animSpeed = 250; }

	var checkFunc = function(hItem, overClass, animSpeed){
		if(jQuery(hItem).attr('arth_locked') != 'true' ) {
			jQuery(hItem).attr('arth_checked', 'false');
			if( (jQuery(hItem).attr('arth_overed') == 'false') && (jQuery(hItem).attr('arth_mouseover') == 'true') )	{
				jQuery(hItem).children(overClass).fadeIn(animSpeed, function(){ jQuery(hItem).attr('arth_overed', 'true'); if(overCallback != undefined){ overCallback(); } checkFunc(hItem, overClass, animSpeed); });
			}
			else if( (jQuery(hItem).attr('arth_overed') == 'true') && (jQuery(hItem).attr('arth_mouseover') == 'false') )	{
				jQuery(hItem).children(overClass).fadeOut(animSpeed, function(){ jQuery(hItem).attr('arth_overed', 'false'); if(outCallback != undefined){ outCallback(); } checkFunc(hItem, overClass, animSpeed); });
			}
			else{
				jQuery(hItem).attr('arth_checked', 'true');
			}
		}
	}
	jQuery(this).each(function(){
		jQuery(this).prepend('<div class="thumb_bw" style="background:url('+jQuery(this).children('img').attr('src')+') no-repeat 0% 100%; position:absolute; height:'+jQuery(this).height()+'px; width:'+jQuery(this).width()+'px;"></div> <div class="thumb_norm" style="display:none; background:url('+jQuery(this).children('img').attr('src')+') no-repeat 0% 0%; position:absolute; height:'+jQuery(this).height()+'px; width:'+jQuery(this).width()+'px;"></div>');
		jQuery(this).mouseenter(function(){
			jQuery(this).attr('arth_mouseover', 'true');
			if(jQuery(this).attr('arth_overed') == undefined) {
				jQuery(this).attr('arth_overed', 'false');
			}
			if(jQuery(this).attr('arth_checked') == undefined) {
				jQuery(this).attr('arth_checked', 'true');
			}	
			if(jQuery(this).attr('arth_checked') == "true")	{
				checkFunc(this, '.thumb_norm', animSpeed);
			}
		});
		
		var like = '0';
		
		jQuery(this).click(function() {
		
		
			if(like == '0') {
			like = '1';
			return false;
			}
			if(like == '1') {
				jQuery(this).attr('arth_mouseover', 'false');
				if(jQuery(this).attr('arth_checked') == "true")
				{
					checkFunc(this,'.thumb_norm', animSpeed);
				}
				like = '0';
			}
		});
		
		jQuery(this).mouseleave(function(){
		if (like == '0') {
			jQuery(this).attr('arth_mouseover', 'false');
			if(jQuery(this).attr('arth_checked') == "true")
			{
				checkFunc(this,'.thumb_norm', animSpeed);
			}
		}
		});
		
	});
	return this;
};
