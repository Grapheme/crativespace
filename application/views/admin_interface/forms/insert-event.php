<div class="row">
	<div class="span9">
		<h2>Добавление мероприятия</h2>
		<?=form_open_multipart('administrator/event/insert',array('id'=>'insert-event-form')); ?>
			<div class="control-group">
				<input type="text" name="title" class="span6 valid-required" value="" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
			</div>
			<label for="photo" class="control-label">Дата и время проведения: </label>
			<div class="control-group">
				<input type="text" class="span2 datepicker" name="date" value="<?=date("d.m.Y")?>">
				<input type="text" class="span3" name="date_begin" placeholder="Введите время начала" value="">
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
			<div class="control-group">
				<textarea rows="10" class="span9 ckeditor" name="content"></textarea>
			</div>
			<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Создать мероприятие</button>
			<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
		<?= form_close(); ?>
	</div>
</div>