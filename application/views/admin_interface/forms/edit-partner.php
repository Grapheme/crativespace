<div class="row">
	<div class="span9">
	<h2>Редактирование информации о партнере</h2>
	<?=form_open('administrator/object/partner/update',array('id'=>'update-partner-form')); ?>
		<div class="control-group">
			<input type="text" name="title" class="span5 valid-required" value="<?=$partner['title'];?>" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
			<br/><input type="text" class="span5 valid-required valid-email" name="email" placeholder="Email" value="<?=$partner['email'];?>">
			<br/><input type="text" class="span5" name="site" placeholder="Введите URL сайта" value="<?=$partner['site'];?>">
			<br/><input type="text" class="span5 valid-required" name="office" placeholder="Номер офиса" value="<?=$partner['office'];?>">
		</div>
		<div class="control-group">
			<input type="text" class="span5" name="facebook" placeholder="Facebook" value="<?=$partner['facebook'];?>">
			<input type="text" class="span5" name="twitter" placeholder="Twitter" value="<?=$partner['twitter'];?>">
			<input type="text" class="span5" name="vk" placeholder="Вконтакте" value="<?=$partner['vk'];?>">
			<input type="text" class="span5" name="google" placeholder="Google+" value="<?=$partner['google'];?>">
		</div>
		<div class="controls">
			<img class="destination-photo img-polaroid" src="<?=site_url('loadimage/partner/'.$partner['id']);?>" />
		</div>
		<div class="clear"></div>
		<label for="photo" class="control-label">Фотография: </label>
		<div class="controls">
			<input type="file" class="input-select-photo" autocomplete="off" id="input-partner-photo" name="photo" size="36">
			<button id="upload-partner-photo" class="btn btn-small btn-info btn-upload hidden" <?=TOOLTIP_FIELD_IMAGE_UPLOAD;?>><i class="icon-upload icon-white"></i> Загрузить</button>
			<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
			<div class="clear"></div>
			<div id="div-upload-photo" class="bar-file-upload hidden">
				<div class="span6 progress progress-info progress-striped active">
					<div class="bar" style="width: 54%"></div>
				</div>
				<span id="upload-photo-status">Загрузка</span>
			</div>
		</div>
		<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Сохранить</button>
		<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
	<?= form_close(); ?>
	</div>
</div>
