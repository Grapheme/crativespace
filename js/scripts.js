/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
var mt = mt || {};
mt.baseURL = 'http://'+window.location.hostname+'/';
mt.redirect = function(path){window.location=path;}
$(function(){
	$(".none").click(function(event){event.preventDefault();});
	$("a.change-project").click(function(event){
		event.preventDefault();
		if(!$(this).hasClass('linked')){
			var _this = this;
			var parameter = $(_this).attr('data-item');
			$("#project-information").html('<img src="'+mt.baseURL+'img/loading.gif" alt="">');
			$("#project-information").load(mt.baseURL+"project-load",{'parameter':parameter},function(){
				$("a.change-project").removeClass('linked');
				$(_this).addClass('linked');
				$("a.people_div").click(function(){peopleDiv(this);});
			});
		}
	});
	$("div.event_link").click(function(){mt.redirect(mt.baseURL+'event/'+$(this).attr('data-translit'));});
	$("div .event .like_div").click(function(even){even.stopPropagation();});
	$("div.partner_div").click(function(){
		var _this = this;
		var parameter = $(_this).attr('data-item');
		$("#div-popup").load(mt.baseURL+"partner-load",{'parameter':parameter},function(){popup('in');});
	});
	$(".people_div").click(function(){peopleDiv(this);});
	function peopleDiv(_this){
		var parameter = $(_this).attr('data-item');
		$("#div-popup").load(mt.baseURL+"people-load",{'parameter':parameter},function(){popup('in');});
	}
});