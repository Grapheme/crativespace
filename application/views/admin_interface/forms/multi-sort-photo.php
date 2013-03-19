<div class="thumbnails">
<?php for($i=0;$i<count($images);$i++):?>
	<div class="span2 portlet news-image-item" name="image" value="<?=$images[$i]['id'];?>" data-src="<?=$images[$i]['id'];?>">
		<div class="thumbnail">
			<div class="portlet-header"><?=$images[$i]['title'];?></div>
			<div class="portlet-content">
				<?=anchor('','<img src="'.site_url($images[$i]['src']).'" alt="'.$images[$i]['title'].'" title="'.$images[$i]['title'].'" />',array('class'=>'none'));?>
			</div>
		</div>
	</div>
<?php endfor;?>
</div>