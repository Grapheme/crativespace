/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
var mt = mt || {};
mt.baseURL = 'http://'+window.location.hostname+'/';
mt.ShowCut = function(element,event){
	event.preventDefault();
	$(element).addClass('hidden').siblings('span.view-text').remove();
	$(element).siblings('span.hidden-text').hide().removeClass('hidden').fadeIn(100,function(){
		$(element).remove();
	});
}
$(function(){
	$(".none").click(function(event){event.preventDefault();});
	$("a.advanced").click(function(event){event.preventDefault(); mt.ShowCut($(this),event);});
	$("a.change-project").click(function(event){
		event.preventDefault();
		if(!$(this).hasClass('linked')){
			var _this = this;
			var parameter = $(_this).attr('data-item');
			$("#project-information").html('<img src="'+mt.baseURL+'img/loading.gif" alt="">');
			$("#project-information").load(mt.baseURL+"project-load",{'parameter':parameter},function(){
				$("a.change-project").removeClass('linked');
				$(_this).addClass('linked');
			});
		}
	});
	
	$("div.partner_div").click(function(){
		var _this = this;
		var parameter = $(_this).attr('data-item');
		$("#div-popup").load(mt.baseURL+"partner-load",{'parameter':parameter},function(){popup('in');});
	});
	$("div.people_div").click(function(){
		var _this = this;
		var parameter = $(_this).attr('data-item');
		$("#div-popup").load(mt.baseURL+"people-load",{'parameter':parameter},function(){popup('in');});
	});
});