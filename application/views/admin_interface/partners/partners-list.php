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
				<a class="btn btn-primary" href="<?=site_url('administrator/object/partners/add')?>"><span class="fui-plus-16"></span> Добавить партнера</a>
			<?php for($i=0;$i<count($partners);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$partners[$i]['id'];?>">
						<h3 class="media-heading">
							<?=$partners[$i]['title'];?>
						</h3>
						<div class="media">
							<?=$partners[$i]['office'];?> <br/>
							<?=$partners[$i]['site'];?> <br/>
							<?=$partners[$i]['email'];?>
						</div>
						<a href="<?=site_url('administrator/object/partners/edit/'.$partners[$i]['id']);?>">Редактировать</a>
						<a class="link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$partners[$i]['id'];?>" data-url="<?=site_url('administrator/object/partner/delete');?>">Удалить</a>
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
