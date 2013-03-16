/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
var mt = mt || {};
mt.baseURL = 'http://'+window.location.hostname+'/';
mt.ShowCut = function(element,event){
	event.preventDefault();
	$(element).addClass('hidden').siblings('div.view-text').remove();
	$(element).siblings('div.hidden-text').hide().removeClass('hidden').fadeIn(100,function(){
		$(element).remove();
	});
}
mt.clickLike = function(element,event){
	event.preventDefault();
	var postdata = 'id='+$(element).attr('data-item')+'&type='+$(element).attr('data-type');
	$.post(mt.baseURL+"set-item-like",{'postdata':postdata},
		function(data){
			if(data.status){
				$(element).find('span.liked-value').html(data.liked);
				$(element).removeClass('set-like').off('click').on('click',function(event){event.preventDefault();});
			}
		},"json");
}
$(function(){
	$(".none").click(function(event){event.preventDefault();});
	$("a.advanced").click(function(event){event.preventDefault(); mt.ShowCut($(this),event);});
	$("div.set-like").click(function(event){
		mt.clickLike($(this),event);
	});
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
});