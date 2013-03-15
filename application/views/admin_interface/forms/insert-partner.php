<div class="span2">
	<img src="<?=site_url('img/people_3.jpg');?>" alt="Creative Space" />
	<h4>Добавление партнера</h4>
</div>
<div class="span9">
	<div class="login-form span9">
	<?=form_open_multipart('administrator/object/partner/insert',array('id'=>'insert-partner-form')); ?>
		<div class="control-group">
			<input type="text" name="title" class="span5 valid-required" value="" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
			<br/><input type="text" class="span5 valid-required valid-email" name="email" placeholder="Email" value="">
			<br/><input type="text" class="span5" name="site" placeholder="Введите URL сайта" value="">
			<br/><input type="text" class="span5 valid-required" name="office" placeholder="Номер офиса" value="">
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
		<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Создать партнера</button>
		<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
	<?= form_close(); ?>
	</div>
</div>
