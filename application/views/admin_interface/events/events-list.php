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
					<a class="btn btn-small btn-block btn-primary" href="<?=site_url('administrator/events/add')?>"><span class="fui-plus-16"></span> Добавить мероприятие</a>
				</div>
				<div class="clear"></div>
			<?php for($i=0;$i<count($events);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$events[$i]['id'];?>">
						<h4 class="media-heading">
							<?=$events[$i]['date_begin'];?>
							<br/>
							<?=$events[$i]['title'];?>
						</h4>
						<div class="media">
							<p><?=word_limiter($events[$i]['content'],50);?></p>
						</div>
						<a class="btn btn-small btn-success btn-item-block hidden" href="<?=site_url('administrator/events/edit/'.$events[$i]['id']);?>" <?=TOOLTIP_BUTTON_EDIT;?>><i class="icon-edit"></i></a>
						<a class="btn btn-small btn-danger btn-item-block hidden link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$events[$i]['id'];?>" data-url="<?=site_url('administrator/event/delete');?>" <?=TOOLTIP_BUTTON_DELETE;?>><i class="icon-remove"></i></a>
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
