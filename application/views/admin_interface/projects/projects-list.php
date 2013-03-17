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
				<a class="btn btn-primary" href="<?=site_url('administrator/projects/add')?>"><span class="fui-plus-16"></span> Добавить проект</a>
			<?php for($i=0;$i<count($projects);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$projects[$i]['id'];?>">
						<h3 class="media-heading">
							<?=$projects[$i]['title'];?>
							<p class="palette-paragraph"><?=$projects[$i]['people'];?></p>
						</h3>
						<div class="media">
							<p><?=word_limiter($projects[$i]['content'],50);?></p>
						</div>
						<a href="<?=site_url('administrator/projects/edit/'.$projects[$i]['id']);?>">Редактировать</a>
						<a class="link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$projects[$i]['id'];?>" data-url="<?=site_url('administrator/project/delete');?>">Удалить</a>
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
