<form action="<?=site_url('send-feedback');?>" method="post" id="form-feedback">
	<div class="feedback clearfix">
		<div class="grid_4">
			<div class="c_title">ОБРАТНАЯ СВЯЗЬ</div>
			<textarea class="valid-required" name="user-content" placeholder="Сообщение" rows="8" <?=TOOLTIP_FIELD_BLANK;?>></textarea>
		</div>
		<div class="grid_2">
			<label for="">Тема сообщения:</label>
			<select name="user-thema">
				<option value="Вакансии">Вакансии</option>
				<option value="Сотрудничество">Сотрудничество</option>
				<option value="Аренда">Аренда</option>
				<option value="Инвестиции">Инвестиции</option>
			</select>
			<label for="">Номер телефона:</label>
			<input name="user-phone" type="text" placeholder="Номер телефона" <?=TOOLTIP_FIELD_BLANK;?>>
			<label for="">Контактный e-mail:</label>
			<input class="valid-required valid-email" name="user-email" type="text" placeholder="Электронная почта" <?=TOOLTIP_FIELD_BLANK;?>>
			<div class="div-form-operation">
				<div class="text-error form-request"></div>
				<button class="sbutton" type="submit" value="send" name="submit-feedback">Отправить</button>
			</div>
			<div class="wait-request hidden"></div>
		</div>
		</div>
	</div>
	<div class="clear"></div>
</form>