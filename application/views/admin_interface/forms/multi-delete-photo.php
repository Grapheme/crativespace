<?=form_open($multi_delete_photo_url,array('class'=>'form-horizontal','id'=>'form-delete-images')); ?>
	<div class="media">
	<?php for($i=0;$i<count($images);$i++):?>
		<div class="span3 news-image-item" data-src="<?=$images[$i]['id'];?>">
			<img class="span2 img-polaroid media-object" src="<?=site_url($images[$i]['src']);?>" alt="" >
			<div class="media-body">
				<input type="checkbox" name="image[]" class="image-checked" value="<?=$images[$i]['id'];?>" autocomplete="off" />
			</div>
		</div>
	<?php endfor;?>
	</div>
	<div class="form-actions">
		<button class="btn btn-danger pull-right" id="btn-delete-images" type="submit" name="submit" value="send">Удалить</button>
		<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span><div id="form-request"></div>
	</div>
<?= form_close(); ?>