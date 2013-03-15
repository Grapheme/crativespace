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
					<a class="btn btn-small btn-block btn-primary" href="<?=site_url('administrator/people/add')?>"><span class="fui-plus-16"></span> Добавить человека</a>
				</div>
				<div class="clear"></div>
			<?php for($i=0;$i<count($people);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$people[$i]['id'];?>">
						<h4 class="media-heading">
							<?=$people[$i]['name'];?>
						</h4>
						<div class="media">
							<?=$people[$i]['company'];?><br/>
							<?=$people[$i]['position'];?><br/>
							<?=$people[$i]['email'];?><br/>
							<?=$people[$i]['phone'];?>
						</div>
						<a class="btn btn-small btn-success btn-item-block hidden" href="<?=site_url('administrator/people/edit/'.$people[$i]['id']);?>" <?=TOOLTIP_BUTTON_EDIT;?>><i class="icon-edit"></i></a>
						<a class="btn btn-small btn-danger btn-item-block hidden link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$people[$i]['id'];?>" data-url="<?=site_url('administrator/people/delete');?>" <?=TOOLTIP_BUTTON_DELETE;?>><i class="icon-remove"></i></a>
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
