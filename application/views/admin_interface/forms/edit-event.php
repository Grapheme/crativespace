<div class="row">
	<div class="span9">
		<h2>Редактирование мероприятия</h2>
		<?=form_open('administrator/event/update',array('id'=>'update-event-form')); ?>
			<div class="control-group">
				<input type="text" name="title" class="span6 valid-required" value="<?=htmlentities($event['title'],ENT_QUOTES,'utf-8');?>" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
			</div>
			<label for="photo" class="control-label">Дата и время проведения: </label>
			<div class="control-group">
				<input type="text" class="span2 datepicker" name="date" value="<?=swap_dot_date($event['date']);?>">
				<input type="text" class="span3" name="date_begin" placeholder="Введите время начала" value="<?=$event['date_begin'];?>">
			</div>
			<div class="controls">
				<img class="destination-photo img-polaroid" width="240" src="<?=site_url('loadimage/events/'.$event['id']);?>" />
			</div>
			<label for="photo" class="control-label">Фотография: </label>
			<div class="controls">
				<input type="file" class="input-select-photo" autocomplete="off" id="input-event-photo" name="photo" size="36">
				<button id="upload-event-photo" class="btn btn-small btn-info btn-upload hidden" <?=TOOLTIP_FIELD_IMAGE_UPLOAD;?>><i class="icon-upload icon-white"></i> Загрузить</button>
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
				<textarea rows="4" class="span9 ckeditor" name="content"><?=$event['content'];?></textarea>
			</div>
			<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Сохранить</button>
			<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
		<?= form_close(); ?>
	</div>
</div>