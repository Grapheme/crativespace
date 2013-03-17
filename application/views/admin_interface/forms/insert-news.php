<div class="row">
	<div class="span9">
		<h2>Добавление новости</h2>
		<?=form_open('administrator/news/insert',array('id'=>'insert-news-form')); ?>
			<div class="control-group">
				<input type="text" name="title" class="span7 valid-required" value="" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
				<input type="text" class="input-small datepicker" name="date" autocomplete="off" placeholder="Введите дату" readonly="readonly" value="<?=date("d.m.Y");?>">
			</div>
			<div class="control-group">
				<textarea rows="10" class="span9 ckeditor" name="content"></textarea>
			</div>
			<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Создать новость</button>
			<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
	</div>
</div>