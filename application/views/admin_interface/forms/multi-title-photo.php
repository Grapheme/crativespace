<?=form_open($multi_title_photos_url,array('class'=>'form-horizontal','id'=>'form-title-images')); ?>
	<div class="media">
	<?php for($i=0;$i<count($images);$i++):?>
		<div class="span5 news-image-item" data-src="<?=$images[$i]['id'];?>">
			<img class="span1 img-polaroid media-object" src="<?=site_url($images[$i]['src']);?>" alt="" >
			<div class="media-body">
				<input type="text" name="title<?=$images[$i]['id'];?>" value="<?=$images[$i]['title'];?>" />
				<button data-src="<?=$images[$i]['id'];?>" class="btn btn-save-title-images"><span class="fui-checkmark-16"></span></button>
			</div>
		</div>
	<?php endfor;?>
	</div>
<?= form_close(); ?>