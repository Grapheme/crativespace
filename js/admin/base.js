/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
var mt = mt || {};
mt.baseURL = 'http://'+window.location.hostname+'/';
mt.currentURL = window.location.href;
mt.currentElement = 0;
mt.isValidEmailAddress = function(emailAddress){
	if(emailAddress != ''){
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	}
	return true;
};
mt.isValidPhone = function(phoneNumber){
	var pattern = new RegExp(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i);
	return pattern.test(phoneNumber);
};
mt.formSerialize = function(objects){
	var data = '';
	$(objects).each(function(i,element){
		if(data === ''){data = $(element).attr('name')+"="+$(element).val();
		}else{data = data+"&"+$(element).attr('name')+"="+$(element).val();}
	});
	return data;
};
mt.matches_parameters = function(parameter1,parameter2){
	var param1 = new String(parameter1);
	var param2 = new String(parameter2);
	if(param1.toString() == param2.toString()){return true;}
	return false;
};
mt.exist_email = function(emailInput){
	var user_email = $(emailInput).val();
	$(emailInput).tooltip('destroy');
	if(user_email != ''){
		if(!mt.isValidEmailAddress(user_email)){$(emailInput).attr('data-original-title','Неверный Email').tooltip('show');}
		else{
			$.post(mt.baseURL+"valid/exist-email",{'parametr':user_email},
				function(data){if(!data.status){$(emailInput).attr('data-original-title','Email уже существует').tooltip('show');}},"json");
		}
	}
};
mt.redirect = function(path){window.location=path;}
mt.ShowCut = function(element,event){
	event.preventDefault();
	var element = this;
	$(element).addClass('hidden').siblings('div.view-text').remove();
	$(element).siblings('div.hidden-text').hide().removeClass('hidden').fadeIn(500,function(){
		$(element).remove();
	});
}
mt.minLength = function(string,Len){if(string != ''){if(string.length < Len){return false;}else{return true;}}}
mt.FieldsIsNotNumeric = function(formObject){
	var result = {};var num = 0;
	$(formObject).nextAll("input.digital").each(function(i,element){if(!$.isNumeric($(element).val())){result[num] = $(element).attr('id');num++;}});
	$(formObject).nextAll("input.numeric-float").each(function(i,element){if(!$.isNumeric($(element).val())){result[num] = $(element).attr('id');num++;}});
	if($.isEmptyObject(result)){return false;}else{return result;}
}
mt.noValidEmails = function(elements){
	var user_email = ''; var errors = false;
	$(elements).each(function(i,element){
		user_email = $(element).val();
		if(!mt.isValidEmailAddress(user_email)){$(element).attr('data-original-title','Неверный Email').tooltip('show');errors = true;}
	});
	return errors;
}
mt.validation = function(formData,jqForm,options){
	var errors = false;
	$(":input[role='tooltip']").tooltip('destroy');
	$(jqForm).find("input.valid-required").each(function(i,element){if($(this).val() == ''){$(this).tooltip('show');errors = true;}});
	if(!errors){
		if($(jqForm).find("input.valid-email").length > 0){
			if(mt.noValidEmails($(jqForm).find("input.valid-email"))){errors = true;}
		}
	}
	if(!errors){
		if($(jqForm).find("input[type='password']").length > 1){
			var user_password = $("#input-password").val();
			var user_confirm_password = $("#input-confirm-password").val();
			if(user_password != ''){
				if(!mt.matches_parameters(user_password,user_confirm_password)){$("#input-confirm-password").attr('data-original-title','Пароли не совпадают').tooltip('show');errors = true;}
				if(!mt.minLength(user_password,6)){$("#input-password").attr('data-original-title','Не меньше 6 символов').tooltip('show');errors = true;}
			}
		}
	}
	if(errors){return false;}else{return true;}
}
mt.ajaxBeforeSubmit = function(formData,jqForm,options){
	$("#form-request").html('');
	if(mt.validation(formData,jqForm,options)){
		$(jqForm).find("span.wait-request").removeClass('hidden');
		$(jqForm).find(":input[type='submit']").addClass('disabled').attr('disabled','disabled');
		return true;
	}else{
		return false;
	}
}
mt.ajaxSuccessSubmit = function(responseText,statusText,xhr,jqForm){
	$(jqForm).find("span.wait-request").addClass('hidden');
	$(jqForm).find(":input[type='submit']").removeClass('disabled').removeAttr('disabled');
}
$(function(){
	$.fn.exists = function(){return $(this).length;}
	$.fn.emptyValue = function(){if($(this).val() == ''){return true;}else{return false;}}
	$("a[role='tooltip']").tooltip();
	$(".none").click(function(event){event.preventDefault();});
	$(":input.unique-email").blur(function(){mt.exist_email(this);});
	$(":input.valid-email").blur(function(){
		var email = $(this).val();
		if(!mt.isValidEmailAddress(email)){
			$(this).attr('data-original-title','Неверный Email').tooltip('show');
		};
	});
	$(":input[role='tooltip']").change(function(){$(this).tooltip("destroy");});
	$("a.link-operation-account").click(function(){mt.currentElement = $(this).parents("div.list-item-block").attr("data-src")});
	$("a[data-toggle='popover']").popover();
});