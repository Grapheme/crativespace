<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="page">
		<div class="navigation_border"></div>
		<div class="container_12">
			<?php $this->load->view("users_interface/includes/header");?>
			<div class="empty grid_12"></div>
			<div class="clear"></div>
			<div class="infinite-scroll">
			<?php for($i=0;$i<count($events);$i++):?>
				<div class="event_page_div">
					<div class="grid_6 prefix_1">
						<span class="event_date"><?=$events[$i]['date_begin']?></span>
						<p class="event_title"><?=$events[$i]['title']?></p>
						<div class="event_text view-text"><?=word_limiter($events[$i]['content'],50);?></div>
						<div class="clear"></div>
						<div class="hidden_text hidden-text hidden"><?=$events[$i]['content'];?></div>
						<a class="expand advanced" href="#">показать полностью</a>
						<div class="like set-like" data-type="events" data-item="<?=$events[$i]['id'];?>">
							<a href="#">
								<img src="<?=site_url('img/liked.jpg');?>" class="liked">
								<img src="<?=site_url('img/like.jpg');?>"><span class="liked-value"><?=$events[$i]['liked'];?></span>
							</a>
						</div>
					</div>
					<div class="grid_5">
						<div class="event_page_image"><img src="<?=site_url('loadimage/events/'.$events[$i]['id']);?>" class="ievent"></div>
					</div>
				</div>
			<?php endfor;?>
			<?php if($next_items):?>
				<?php $offset = $this->per_page+$this->offset;?>
				<div class="next">
					<a href="<?=site_url("text-load/events/from/$offset");?>">&nbsp;</a>
				</div>
			<?php endif;?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>