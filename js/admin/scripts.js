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
				$("#div-insert-item").delay(1000).slideUp(500,function(){
					$("#div-insert-item").remove();
					$("#form-request").html(responseText);
				})
			}else{
				$("div.bar").parents('div.progress').removeClass('progress-info active').addClass('progress-danger');
			}
		}
	}
	$("#login-form").submit(function(){
		$("#form-request").html('');
		var loginOptions = options;
		loginOptions.target = null;
		loginOptions.dataType = 'json';
		loginOptions.success = function(response,status,xhr,jqForm){
			if(response.status){
				mt.redirect(response.cabinet_path);
			}else{
				mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
				$("#form-request").html(response.message);
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
	$("#insert-news-form").submit(function(){
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
		var newsOptions = options;
		newsOptions.target = null;
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
		newsOptions.target = null;
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
				if(data.status){$("div.list-item-block[data-src="+mt.currentElement+"]").parents(".media").html(data.message);}
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
		var url = $("#form-delete-images").attr('action');
		var postdata = mt.formSerialize($("#form-delete-images input:checkbox:checked"));
		if(postdata == ''){
			$("#form-request").html("Не выбраны изображения");
			return false;
		}
		$("#form-delete-images").find(".wait-request").removeClass('hidden');
		$.post(url,{'postdata':postdata},
			function(data){
				if(data.status){
					$("#form-delete-images").find(".wait-request").addClass('hidden');
					if($("#form-title-images").exists()){
						$("#form-delete-images input:checkbox:checked").each(function(i,element){
							var imgID = $(element).parents('div.news-image-item').attr("data-src");
							$("#form-title-images div.news-image-item[data-src='"+imgID+"']").remove();
							$("#div-sort-object-images div.news-image-item[data-src='"+imgID+"']").remove();
						})
					}
					$("#form-delete-images input:checkbox:checked").parents('div.news-image-item').remove();
					
				}
				$("#form-request").html(data.message);
			},"json");
	});
	$("#insert-event-form").submit(function(){
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
		$(this).ajaxSubmit(singlePhotoOption);
		return false;
	});
	$("#update-event-form").submit(function(){
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
		var eventOptions = options;
		eventOptions.target = null;
		eventOptions.success = function(responseText,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(responseText,statusText,xhr,jqForm);
			$("#div-update-event").slideUp(500,function(){
				$(this).remove();
				$("#form-request").html(responseText);
			})
		}
		$(this).ajaxSubmit(eventOptions);
		return false;
	});
	$("#insert-project-form").submit(function(){
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
		$(this).ajaxSubmit(singlePhotoOption);
		return false;
	});
	$("#update-project-form").submit(function(){
		var ckdata = CKEDITOR.instances.content.getData();
		$(this).find("textarea.ckeditor").html(ckdata);
		var projectOptions = options;
		projectOptions.target = null;
		projectOptions.success = function(responseText,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(responseText,statusText,xhr,jqForm);
			$("#div-update-project").slideUp(500,function(){
				$(this).remove();
				$("#form-request").html(responseText);
			})
		}
		$(this).ajaxSubmit(projectOptions);
		return false;
	});
	$("#insert-partner-form").submit(function(){
		$(this).ajaxSubmit(singlePhotoOption);
		return false;
	});
	$("#update-partner-form").submit(function(){
		var partnerOptions = options;
		partnerOptions.target = null;
		partnerOptions.success = function(responseText,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(responseText,statusText,xhr,jqForm);
			$("#div-update-partner").slideUp(500,function(){
				$(this).remove();
				$("#form-request").html(responseText);
			})
		}
		$(this).ajaxSubmit(partnerOptions);
		return false;
	});
	$("#add-object-images").click(function(){
		$("a.a-object-images").removeClass('disabled');
		$("div.div-object-images").addClass('hidden');
		$("#div-insert-object-images").removeClass('hidden');
		$(this).addClass('disabled');
	});
	$("#title-object-images").click(function(){
		$("a.a-object-images").removeClass('disabled');
		$("div.div-object-images").addClass('hidden');
		$("#div-title-object-images").removeClass('hidden');
		$(this).addClass('disabled');
	});
	$("#sort-object-images").click(function(){
		$("a.a-object-images").removeClass('disabled');
		$("div.div-object-images").addClass('hidden');
		$("#div-sort-object-images").removeClass('hidden');
		$(this).addClass('disabled');
	});
	$("#delete-object-images").click(function(){
		$("a.a-object-images").removeClass('disabled');
		$("div.div-object-images").addClass('hidden');
		$("#div-delete-object-images").removeClass('hidden');
		$(this).addClass('disabled');
	});
	$("#form-title-images :button.btn-save-title-images").click(function(event){
		event.preventDefault();
		var _this = $(this);
		var url = $("#form-title-images").attr('action');
		var postdata = 'id='+$(this).attr('data-src')+'&title='+$(this).siblings(":text").val();
		_this.addClass('hidden').after('<div class="span1 loading pull-right"></div>')
		$.post(url,{'postdata':postdata},
			function(data){
				if(data.status){
					_this.removeClass('hidden').addClass('btn-success').siblings("div.loading").remove();
				}else{
					_this.removeClass('hidden').addClass('btn-danger').siblings("div.loading").remove();
				}
			},"json");
	});
	$("#insert-people-form").submit(function(){
		$(this).ajaxSubmit(singlePhotoOption);
		return false;
	});
	$("#update-people-form").submit(function(){
		var peopleOptions = options;
		peopleOptions.target = null;
		peopleOptions.success = function(responseText,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(responseText,statusText,xhr,jqForm);
			$("#div-update-people").slideUp(500,function(){
				$(this).remove();
				$("#form-request").html(responseText);
			})
		}
		$(this).ajaxSubmit(peopleOptions);
		return false;
	});
});