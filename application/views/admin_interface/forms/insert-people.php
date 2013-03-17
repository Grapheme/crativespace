<div class="row">
	<div class="span9">
	<h2>Добавление информации о человеке</h2>
	<?=form_open_multipart('administrator/people/insert',array('id'=>'insert-people-form')); ?>
		<div class="control-group">
			<input type="text" name="name" class="span5 valid-required" value="" placeholder="Имя" <?=TOOLTIP_FIELD_BLANK;?> />
			<br/><input type="text" class="span5" name="company" placeholder="Место работы" value="">
			<br/><input type="text" class="span5" name="position" placeholder="Должность" value="">
			<br/><input type="text" class="span5 valid-required valid-email" name="email" placeholder="Email" value="">
			<br/><input type="text" class="span5 valid-required" name="phone" placeholder="Телефон" value="">
		</div>
		<div class="control-group">
			<input type="text" class="span5" name="facebook" placeholder="Facebook" value="">
			<input type="text" class="span5" name="twitter" placeholder="Twitter" value="">
			<input type="text" class="span5" name="vk" placeholder="Вконтакте" value="">
			<input type="text" class="span5" name="google" placeholder="Google+" value="">
		</div>
		<div class="clear"></div>
		<label for="photo" class="control-label">Фотография: </label>
		<div class="controls">
			<input type="file" class="valid-required" autocomplete="off" name="photo" <?=TOOLTIP_FIELD_BLANK;?> size="52">
			<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
			<div class="clear"></div>
			<div id="div-upload-photo" class="bar-file-upload hidden">
				<div class="span6 progress progress-info progress-striped active">
					<div class="bar" style="width: 54%"></div>
				</div>
				<span id="upload-photo-status">Загрузка</span>
			</div>
		</div>
		<div class="clear"></div>
		<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Добавить человека</button>
		<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
	<?= form_close(); ?>
	</div>
</div>
