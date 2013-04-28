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
				<a class="btn btn-primary" href="<?=site_url('administrator/events/add')?>"><span class="fui-plus-16"></span> Добавить мероприятие</a>
			<?php for($i=0;$i<count($events);$i++):?>
				<div class="media hover-item-block">
					<div class="media-body list-item-block" data-src="<?=$events[$i]['id'];?>">
						<h3 class="media-heading">
							<?=$events[$i]['title'];?>
							<p class="palette-paragraph"><?=month_date($events[$i]['date']).' '.$events[$i]['date_begin'];?></p>
						</h3>
						<div class="media">
							<p><?=word_limiter($events[$i]['content'],50);?></p>
						</div>
						<a href="<?=site_url('administrator/events/edit/'.$events[$i]['id']);?>">Редактировать</a>
						<a class="link-operation-account" href="#confirm-user" data-toggle="modal" data-src="<?=$events[$i]['id'];?>" data-url="<?=site_url('administrator/event/delete');?>">Удалить</a>
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
