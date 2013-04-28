/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

(function($){
	var mainOptions = {target: '#form-request',beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,type:'post'};
	$("#form-feedback").submit(function(){
		var options = mainOptions;
		options.target = null;
		options.dataType = 'json';
		options.success = function(response,status,xhr,jqForm){
			if(response.status){$(jqForm).resetForm();}
			mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
			$(jqForm).find("div.form-request").html(response.message);
		}
		$(this).ajaxSubmit(options);
		return false;
	});
})(window.jQuery);