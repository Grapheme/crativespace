<form action="<?=site_url('send-feedback');?>" method="post" id="form-feedback">
	<div class="feedback">
		<div class="">
			ОБРАТНАЯ СВЯЗЬ
		</div>
		<div class="grid_3">
			<textarea class="valid-required" name="user-content" placeholder="Сообщение" rows="8" <?=TOOLTIP_FIELD_BLANK;?>></textarea>
		</div>
		<div class="grid_2">
			<label for="">Тема сообщения:</label><br/>
			<select name="user-thema">
				<option value="Вакансии">Вакансии</option>
				<option value="Сотрудничество">Сотрудничество</option>
				<option value="Аренда">Аренда</option>
				<option value="Инвестиции">Инвестиции</option>
			</select>
			<br/>
			<label for="">Номер телефона:</label><br/>
			<input name="user-phone" type="text" placeholder="Номер телефона" <?=TOOLTIP_FIELD_BLANK;?>>
			<br/>
			<label for="">Контактный e-mail:</label>
			<input class="valid-required valid-email" name="user-email" type="text" placeholder="Электронная почта" <?=TOOLTIP_FIELD_BLANK;?>>
		</div>
	</div>
	<div class="">
		<div class="div-form-operation">
			<div class="text-error form-request"></div>
			<button class="sbutton" type="submit" value="send" name="submit-feedback">Отправить</button>
		</div>
		<div class="clear"></div>
		<div class="wait-request hidden"></div>
	</div>
</form>