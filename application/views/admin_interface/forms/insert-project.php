<div class="row">
	<div class="span9">
		<h2>Добавление проекта</h2>
		<?=form_open_multipart('administrator/project/insert',array('id'=>'insert-project-form')); ?>
			<div class="control-group">
				<input type="text" name="title" class="span3 valid-required" value="" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
				<input type="text" class="span5" name="site" placeholder="Введите URL сайта" value="">
				<input type="text" class="span1" name="sort" placeholder="№ п.п" value="0" title="Используется для сортировки">
				<div class="clear"></div>
				<div class="controls">
					<select id="select-people" class="span9" multiple="" name="people[]" data-placeholder="Выбирите людей">
					<?php for($i=0;$i<count($people);$i++):?>
						<option value="<?=$people[$i]['id'];?>"><?=$people[$i]['name'];?></option>
					<?php endfor;?>
					</select>
				</div>
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
			<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Создать проект</button>
			<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
		<?= form_close(); ?>
	</div>
</div>