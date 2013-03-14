<div class="span2">
	<img src="<?=site_url('img/people_3.jpg');?>" alt="Creative Space" />
	<h4>Добавление изображений</h4>
</div>
<div class="span9">
	<div class="login-form span9">
		<form id="upload" action="<?=site_url('administrator/news/insert/images');?>" method="POST" enctype="multipart/form-data">
			<p id="photos-block-message"></p>
			<div class="clear"></div>
			<fieldset>
				<legend>Используйте форму для добавления изображений</legend>
				<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="5000000" />
				<div class="control-group">
					<p>&nbsp;</p>
					<label for="fileselect">Укажите файлы:</label>
					<input type="file" id="fileselect" size="45" autocomplete="off" name="fileselect[]" multiple="multiple" />
					<div id="filedrag">или перетяните файлы сюда</div>
				</div>
				<div id="submitbutton">
					<button type="submit">Загрузить изображения</button>
				</div>
			</fieldset>
		</form>
		<div id="progress"></div>
		<?php if($this->uri->segment(3) != 'edit'):?>
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Внимание!</strong> Не обновляйте страницу до полной загрузки всех изображений.
		</div>
		<?php endif;?>
		<div id="messages"><ul id="list-images" class="thumbnails"></ul></div>
	</div>
</div>