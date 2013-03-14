<div class="span2">
	<img src="<?=site_url('img/people_3.jpg');?>" alt="Creative Space" />
	<h4>Редактирование проекта</h4>
</div>
<div class="span9">
	<div class="login-form span9">
	<?=form_open('administrator/project/update',array('id'=>'update-project-form')); ?>
		<div class="control-group">
			<input type="text" name="title" class="span4 valid-required" value="<?=$project['title'];?>" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
			<input type="text" class="span5" name="site" placeholder="Введите URL сайта" value="<?=$project['site'];?>">
			<div class="clear"></div>
			<input type="text" class="span7" name="people" placeholder="Введите людей" value="<?=$project['people'];?>">
		</div>
		<div class="controls">
			<img class="destination-photo img-polaroid" src="<?=site_url('loadimage/project/'.$project['id']);?>" />
		</div>
		<div class="clear"></div>
		<label for="photo" class="control-label">Фотография: </label>
		<div class="controls">
			<input type="file" class="input-select-photo" autocomplete="off" id="input-project-photo" name="photo" size="36">
			<button id="upload-project-photo" class="btn btn-small btn-info btn-upload hidden" <?=TOOLTIP_FIELD_IMAGE_UPLOAD;?>><i class="icon-upload icon-white"></i> Загрузить</button>
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
		<div class="control-group">
			<textarea rows="10" class="span9 ckeditor" name="content"><?=$project['content'];?></textarea>
		</div>
		<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Сохранить</button>
		<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
	<?= form_close(); ?>
	</div>
</div>
