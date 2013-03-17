<div class="row">
	<div class="span9">
		<h2>Редактирование новости</h2>
		<?=form_open('administrator/news/update',array('id'=>'update-news-form')); ?>
			<div class="control-group">
				<input type="text" name="title" class="span7 valid-required" value="<?=$news['title'];?>" placeholder="Название" <?=TOOLTIP_FIELD_BLANK;?> />
				<input type="text" class="input-small datepicker" name="date" autocomplete="off" placeholder="Введите дату" readonly="readonly" value="<?=$news['date_publish'];?>">
			</div>
			<div class="control-group">
				<textarea rows="10" class="span9 ckeditor" name="content"><?=$news['content'];?></textarea>
			</div>
			<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Сохранить</button>
			<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
		<?= form_close(); ?>
	</div>
</div>