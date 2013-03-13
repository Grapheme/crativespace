/* Author: Grapheme Group
 * http://grapheme.ru/
 */

(function($){
	function updateSingleImage(_this,url,usrInput){
		if($(usrInput).emptyValue()){return false;}
		var bar = $("div.bar");
		var status = $("#upload-photo-status");
		bar.parents('div.progress').removeClass('progress-success progress-danger active').addClass('progress-info active');
		$(_this).parents("form").ajaxSubmit({
			url: mt.baseURL+url,
			dataType: 'json',
			type: 'post',
			beforeSubmit: function(){
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal);
				bar.html(percentVal);
				$(_this).addClass('disabled').tooltip('hide').attr('disabled','disabled');
				$("#div-upload-photo").removeClass('hidden');
			},
			uploadProgress: function(event,position,total,percentComplete){
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				bar.html(percentVal);
				status.html('<img src="'+mt.baseURL+'img/loading.gif" alt="" /> Загрузка...');
			},
			success: function(data){
				var percentVal = '100%';
				bar.width(percentVal);
				bar.html(percentVal);
				status.html(data.responseText);
				$(usrInput).clearFields();
				$(_this).removeClass('disabled').tooltip('hide').removeAttr('disabled').addClass('hidden');
				if(data.status){
					bar.parents('div.progress').removeClass('progress-info active').addClass('progress-success');
					$("img.destination-photo").attr('src',data.responsePhotoSrc);
				}else{
					bar.parents('div.progress').removeClass('progress-info active').addClass('progress-danger');
				}
			}
		});
	}
	$("#upload-profile-avatar").click(function(event){
		event.preventDefault();
		if($("#input-profile-avatar").emptyValue()){return false;}
		var _this = $(this);
		var bar = $("div.bar");
		bar.parents('div.progress').removeClass('progress-success progress-danger active').addClass('progress-info active');
		var status = $("#upload-avatar-status");
		$($(this).parents("form")).ajaxSubmit({
			url: mt.baseURL+"profile/save/avatar",
			dataType: 'json',
			type: 'post',
			beforeSubmit: function(){
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal);
				bar.html(percentVal);
				_this.addClass('disabled').tooltip('hide').attr('disabled','disabled');
				$("#div-upload-photo").removeClass('hidden');
			},
			uploadProgress: function(event,position,total,percentComplete){
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				bar.html(percentVal);
				status.html('<img src="'+mt.baseURL+'img/loading.gif" alt="" /> Загрузка...');
			},
			success: function(data){
				var percentVal = '100%';
				bar.width(percentVal);
				bar.html(percentVal);
				if(data.status){
					bar.parents('div.progress').removeClass('progress-info active').addClass('progress-success');
					$("img.profile-avatar").attr('src',data.responseAvatarSrc);
					$("img.profile-photo").attr('src',data.responsePhotoSrc);
				}else{
					bar.parents('div.progress').removeClass('progress-info active').addClass('progress-danger');
				}
				status.html(data.responseText);
				$("#input-profile-avatar").clearFields();
				_this.removeClass('disabled').tooltip('hide').removeAttr('disabled').addClass('hidden');
			}
		});
	});
	$("#upload-subject-photo").click(function(event){
		event.preventDefault();
		updateSingleImage(this,"university/subjects/save/photo",$("#input-subject-photo"));
	});
	$("#upload-faculty-photo").click(function(event){
		event.preventDefault();
		updateSingleImage(this,"university/faculties/save/photo",$("#input-faculty-photo"));
	});
	$("#upload-news-photo").click(function(event){
		event.preventDefault();
		updateSingleImage(this,"university/news/save/photo",$("#input-subject-photo"));
	});
	$("input.input-select-photo").change(function(){
		$("button.btn-upload").removeClass('hidden');
		$("button.btn-upload").tooltip('show');
		$("div.bar-file-upload").addClass('hidden');
	});
})(window.jQuery);