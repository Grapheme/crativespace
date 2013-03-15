<div class="span2">
	<img src="<?=site_url('img/people_3.jpg');?>" alt="Creative Space" />
	<h4>Редактирование информации о человеке</h4>
</div>
<div class="span9">
	<div class="login-form span9">
	<?=form_open('administrator/people/update',array('id'=>'update-people-form')); ?>
		<div class="control-group">
			<input type="text" name="name" class="span5 valid-required" value="<?=$people['name'];?>" placeholder="Имя" <?=TOOLTIP_FIELD_BLANK;?> />
			<br/><input type="text" class="span5" name="company" placeholder="Место работы" value="<?=$people['company'];?>">
			<br/><input type="text" class="span5" name="position" placeholder="Должность" value="<?=$people['position'];?>">
			<br/><input type="text" class="span5 valid-required valid-email" name="email" placeholder="Email" value="<?=$people['email'];?>">
			<br/><input type="text" class="span5 valid-required" name="phone" placeholder="Телефон" value="<?=$people['phone'];?>">
		</div>
		<div class="control-group">
			<input type="text" class="span5" name="facebook" placeholder="Facebook" value="<?=$people['facebook'];?>">
			<input type="text" class="span5" name="twitter" placeholder="Twitter" value="<?=$people['twitter'];?>">
			<input type="text" class="span5" name="vk" placeholder="Вконтакте" value="<?=$people['vk'];?>">
			<input type="text" class="span5" name="google" placeholder="Google+" value="<?=$people['google'];?>">
		</div>
		<div class="controls">
			<img class="destination-photo img-polaroid" src="<?=site_url('loadimage/people/'.$people['id']);?>" />
		</div>
		<div class="clear"></div>
		<label for="photo" class="control-label">Фотография: </label>
		<div class="controls">
			<input type="file" class="input-select-photo" autocomplete="off" id="input-people-photo" name="photo" size="36">
			<button id="upload-people-photo" class="btn btn-small btn-info btn-upload hidden" <?=TOOLTIP_FIELD_IMAGE_UPLOAD;?>><i class="icon-upload icon-white"></i> Загрузить</button>
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
