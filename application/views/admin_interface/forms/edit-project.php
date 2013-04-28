<div class="row">
	<div class="span9">
		<h2>Редактирование проекта</h2>
		<?=form_open('administrator/project/update',array('id'=>'update-project-form')); ?>
			<div class="control-group">
				<input type="text" name="title" class="span3 valid-required" value="<?=$project['title'];?>" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
				<input type="text" class="span5" name="site" placeholder="Введите URL сайта" value="<?=$project['site'];?>">
				<input type="text" class="span1" name="sort" placeholder="№ п.п" value="<?=$project['sort'];?>" title="Используется для сортировки">
				<div class="clear"></div>
				<div class="controls">
					<select id="select-people" class="span9" multiple=""  name="people[]" data-placeholder="Выберите людей">
				<?php for($i=0;$i<count($people);$i++):?>
					<?php $selected = FALSE;?>
					<?php for($j=0;$j<count($project['people']);$j++):?>
						<?php if($people[$i]['id'] == $project['people'][$j]):?>
							<?php $selected = TRUE;?>
						<?php endif;?>
					<?php endfor;?>
						<option value="<?=$people[$i]['id'];?>" <?=($selected)?' selected="selected"':''?>><?=$people[$i]['name'];?></option>
				<?php endfor;?>
					</select>
				</div>
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
