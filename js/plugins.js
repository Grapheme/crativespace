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

// Place any jQuery/helper plugins in here.
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
jQuery.fn.ArteHover=function(b,e,f){void 0==b&&(b=250);var d=function(a,b,c){"true"!=jQuery(a).attr("arth_locked")&&(jQuery(a).attr("arth_checked","false"),"false"==jQuery(a).attr("arth_overed")&&"true"==jQuery(a).attr("arth_mouseover")?jQuery(a).children(b).fadeIn(c,function(){jQuery(a).attr("arth_overed","true");void 0!=e&&e();d(a,b,c)}):"true"==jQuery(a).attr("arth_overed")&&"false"==jQuery(a).attr("arth_mouseover")?jQuery(a).children(b).fadeOut(c,function(){jQuery(a).attr("arth_overed","false");
void 0!=f&&f();d(a,b,c)}):jQuery(a).attr("arth_checked","true"))};jQuery(this).each(function(){jQuery(this).prepend('<div class="thumb_bw" style="background:url('+jQuery(this).children("img").attr("src")+") no-repeat 0% 100%; position:absolute; height:"+jQuery(this).height()+"px; width:"+jQuery(this).width()+'px;"></div> <div class="thumb_norm" style="display:none; background:url('+jQuery(this).children("img").attr("src")+") no-repeat 0% 0%; position:absolute; height:"+jQuery(this).height()+"px; width:"+
jQuery(this).width()+'px;"></div>');jQuery(this).mouseenter(function(){jQuery(this).attr("arth_mouseover","true");void 0==jQuery(this).attr("arth_overed")&&jQuery(this).attr("arth_overed","false");void 0==jQuery(this).attr("arth_checked")&&jQuery(this).attr("arth_checked","true");"true"==jQuery(this).attr("arth_checked")&&d(this,".thumb_norm",b)});jQuery(this).mouseleave(function(){jQuery(this).attr("arth_mouseover","false");"true"==jQuery(this).attr("arth_checked")&&d(this,".thumb_norm",b)})});return this};



