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
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
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
	$("#update-news-form").submit(function(){
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
		var newsOptions = options;
		newsOptions.success = function(responseText,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(responseText,statusText,xhr,jqForm);
			$("#div-update-news").slideUp(500,function(){
				$(this).remove();
				$("#form-request").html(responseText);
			})
		}
		$(this).ajaxSubmit(newsOptions);
		return false;
	});
	$("#btn-modal-confirm-user").click(function(){
		if(mt.currentElement){
			var url = $("a.link-operation-account[data-src='"+mt.currentElement+"']").attr('data-url');
			$.post(url,{'parameter':mt.currentElement},function(data){
				if(data.status){$("div.list-item-block[data-src="+mt.currentElement+"]").parents(".media").height(100).css('border','1px dashed black').html(data.message);}
				$("#confirm-user").modal('hide');
			},"json");
		}
	});
	$("#add-news-images").click(function(){
		$(this).addClass('disabled');
		$("#delete-news-images").removeClass('disabled');
		$("#div-delete-news-images").addClass('hidden');
		$("#div-insert-news-images").removeClass('hidden');
	});
	$("#delete-news-images").click(function(){
		$(this).addClass('disabled');
		$("#add-news-images").removeClass('disabled');
		$("#div-delete-news-images").removeClass('hidden');
		$("#div-insert-news-images").addClass('hidden');
	});
	$("#btn-delete-images").click(function(event){
		event.preventDefault();
		var postdata = mt.formSerialize($("#form-delete-images input:checkbox:checked"));
		if(postdata == ''){
			$("#form-request").html("Не выбраны изображения");
			return false;
		}
		$("#form-delete-images").find(".wait-request").removeClass('hidden');
		$.post(mt.baseURL+"administrator/news/images/delete",{'postdata':postdata},
			function(data){
				if(data.status){
					$("#form-delete-images").find(".wait-request").addClass('hidden');
					$("#form-delete-images input:checkbox:checked").parents('div.news-image-item').remove();
				}
				$("#form-request").html(data.message);
			},"json");
	});
});