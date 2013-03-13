/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	var options = {target: '#form-request',beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,type:'post',dataType: null};
	var singlePhotoOption = {
		type: 'post',
		beforeSubmit: function(responseText,statusText,xhr,jqForm){
			if(mt.ajaxBeforeSubmit(responseText,statusText,xhr,jqForm)){
				$("#upload-photo-status").empty();
				var percentVal = '0%';
				$("div.bar").width(percentVal);
				$("div.bar").html(percentVal);
				$(jqForm).find("span.wait-request").addClass('hidden');
				$("#div-upload-photo").removeClass('hidden');
			}else{return false;}
		},
		uploadProgress: function(event,position,total,percentComplete){
			var percentVal = percentComplete + '%';
			$("div.bar").width(percentVal);
			$("div.bar").html(percentVal);
			$("#upload-photo-status").html('<img src="'+mt.baseURL+'img/loading.gif" alt="" /> Загрузка...');
		},
		success: function(responseText,statusText,xhr,jqForm){
			var percentVal = '100%';
			$("div.bar").width(percentVal);
			$("div.bar").html(percentVal);
			$("#upload-photo-status").html("Фото загружено");
			$(jqForm).find("span.wait-request").addClass('hidden');
			$(jqForm).find(":input[type='submit']").removeClass('disabled').removeAttr('disabled');
			if(statusText){
				$("div.bar").parents('div.progress').removeClass('progress-info active').addClass('progress-success');
				$(jqForm).delay(1000).slideUp(500,function(){
					if($(jqForm).has("div.types-select-forms").length == 1){
						$(jqForm).show().parents("div.types-select-forms").addClass('hidden');
					}
					$(jqForm).resetForm();
					$("#div-upload-photo").addClass('hidden');
					$(jqForm).find(":input[type='submit']").removeClass('disabled').removeAttr('disabled');
					$("#form-request").html(responseText);
					$("#repeat-again").on('click',function(event){
						event.preventDefault();
						$("#form-request").html('');
						$(jqForm).slideDown(500);
					});
				})
			}else{
				$("div.bar").parents('div.progress').removeClass('progress-info active').addClass('progress-danger');
			}
		}
	}
	$("#login-form").submit(function(){
		var loginOptions = options;
		loginOptions.target = null;
		loginOptions.dataType = 'json';
		loginOptions.success = function(response,status,xhr,jqForm){
			if(response.status){
				mt.redirect(response.cabinet_path);
			}else{
				mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
				$("#form-request").html();
			}
		}
		$(this).ajaxSubmit(loginOptions);
		return false;
	});
	$("#profile-form").submit(function(){
		$(this).ajaxSubmit(options);
		$(this).clearForm();
		return false;
	});
	$("#admin-operation").dropkick({change: function(value,label){mt.redirect(value);}});
	$("#forgot-password").click(function(){

	});
	
	$("#insert-news-form").submit(function(){
		var newsOptions = options;
		newsOptions.success = function(responseText,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(responseText,statusText,xhr,jqForm);
			$("#insert-news-step-1").slideUp(500,function(){
				$(this).remove();
				$("#form-request").html(responseText);
				$("#load-images").on('click',function(event){event.preventDefault();$("#form-request").html('');$("#insert-news-step-2").hide().removeClass('hidden').slideDown(500);});
			})
		}
		$(this).ajaxSubmit(newsOptions);
		return false;
	});
});