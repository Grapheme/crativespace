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
				<a class="btn btn-primary" href="<?=site_url('administrator/news/add')?>"><span class="fui-plus-16"></span> Добавить новость</a>

			<?php for($i=0;$i<count($news);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$news[$i]['id'];?>">
						<h3 class="media-heading">
							<?=$news[$i]['title'];?>
							<p class="palette-paragraph"><?=month_date_with_time($news[$i]['date_publish']);?></p>
						</h3>
						<div class="media">
							<p><?=word_limiter($news[$i]['content'],50);?></p>
						</div>
						<a href="<?=site_url('administrator/news/edit/'.$news[$i]['id']);?>">Редактировать</a>
						<a href="<?=site_url('administrator/news/edit/images/'.$news[$i]['id']);?>">Добавить изображения</a>
						<a class="link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$news[$i]['id'];?>" data-url="<?=site_url('administrator/news/delete');?>">Удалить</a>
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
