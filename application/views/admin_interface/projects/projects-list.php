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
					<a class="btn btn-small btn-block btn-primary" href="<?=site_url('administrator/projects/add')?>"><span class="fui-plus-16"></span> Добавить проект</a>
				</div>
				<div class="clear"></div>
			<?php for($i=0;$i<count($projects);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$projects[$i]['id'];?>">
						<h4 class="media-heading">
							<?=$projects[$i]['title'];?>
							<br/>
							<?=$projects[$i]['people'];?>
						</h4>
						<div class="media">
							<p><?=word_limiter($projects[$i]['content'],50);?></p>
						</div>
						<a class="btn btn-small btn-success btn-item-block hidden" href="<?=site_url('administrator/projects/edit/'.$projects[$i]['id']);?>" <?=TOOLTIP_BUTTON_EDIT;?>><i class="icon-edit"></i></a>
						<a class="btn btn-small btn-danger btn-item-block hidden link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$projects[$i]['id'];?>" data-url="<?=site_url('administrator/project/delete');?>" <?=TOOLTIP_BUTTON_DELETE;?>><i class="icon-remove"></i></a>
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
