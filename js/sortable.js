/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 $(function(){
	$("div.thumbnails").sortable({
		connectWith:".thumbnails",
		update:function(event,ui){
			var list = mt.formSerialize($("div.thumbnails").find("div.portlet"));
			$.post(mt.baseURL+"object/photos/change-position",{'list':list});
		}
	});
	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header" )
			.addClass("ui-widget-header ui-corner-all")
			.prepend("<span class='ui-icon ui-icon-minusthick'></span>")
			.end()
		.find(".portlet-content");

	$(".portlet-header .ui-icon").click(function(){
		$(this).toggleClass("ui-icon-minusthick").toggleClass("ui-icon-plusthick");
		$(this).parents(".portlet:first").find(".portlet-content").toggle();
	});

	$(".thumbnails").disableSelection();
});