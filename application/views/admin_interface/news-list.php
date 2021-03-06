<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
	<div class="container">
		<?php $this->load->view("admin_interface/includes/header");?>
		<div class="row">
			<div class="span12">
				<div class="span3">
					<a class="btn btn-small btn-block btn-primary" href="<?=site_url('administrator/news/add')?>"><span class="fui-plus-16"></span> Добавить новость</a>
				</div>
				<div class="clear"></div>
			<?php for($i=0;$i<count($news);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$news[$i]['id'];?>">
						<h4 class="media-heading">
							<?=month_date_with_time($news[$i]['date_publish']);?>
							<br/>
							<?=$news[$i]['title'];?>
						</h4>
						<div class="media">
							<p><?=word_limiter($news[$i]['content'],50);?></p>
						</div>
						<a class="btn btn-small btn-success btn-item-block hidden" href="<?=site_url('administrator/news/edit/'.$news[$i]['id']);?>" <?=TOOLTIP_BUTTON_EDIT;?>><i class="icon-edit"></i></a>
						<a class="btn btn-small btn-primary btn-item-block hidden" href="<?=site_url('administrator/news/edit/images/'.$news[$i]['id']);?>" <?=TOOLTIP_FIELD_IMAGE_UPLOAD;?>><i class="icon-edit"></i></a>
						<a class="btn btn-small btn-danger btn-item-block hidden link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$news[$i]['id'];?>" data-url="<?=site_url('university/news/delete');?>" <?=TOOLTIP_BUTTON_DELETE;?>><i class="icon-remove"></i></a>
					</div>
					<div class="clear"></div>
				</div>
			<?php endfor;?>
			<?=$pagination;?>
			</div>
		</div>
		<?php $this->load->view("admin_interface/modal/confirm-user");?>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>
