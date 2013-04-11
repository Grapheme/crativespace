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
				<a class="btn btn-primary" href="<?=site_url('administrator/people/add')?>"><span class="fui-plus-16"></span> Добавить человека</a>
			<?php for($i=0;$i<count($people);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$people[$i]['id'];?>">
						<h3 class="media-heading">
							<?=$people[$i]['name'];?>
						</h3>
						<div class="media">
							<?=$people[$i]['company'];?><br/>
							<?=$people[$i]['position'];?><br/>
							<?=$people[$i]['email'];?><br/>
							<?=$people[$i]['phone'];?>
						</div>
						<a href="<?=site_url('administrator/people/edit/'.$people[$i]['id']);?>">Редактировать</a>
						<a class="link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$people[$i]['id'];?>" data-url="<?=site_url('administrator/people/delete');?>">Удалить</a>
					</div>
					<div class="clear"></div>
				</div>
			<?php endfor;?>
			<?=$pagination;?>
			</div>
		</div>
		<?php $this->load->view("modal/confirm-user");?>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>
