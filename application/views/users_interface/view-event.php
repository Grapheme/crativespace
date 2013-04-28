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
			<div class="event_page_div">
				<div class="grid_6 prefix_1">
					<span class="event_date"><?=month_date($event['date']).' '.$event['date_begin'];?></span>
					<p class="event_title"><?=$event['title']?></p>
					<span class="event_text view-text">
						<?=trim($event['content']);?>
					</span>
					<!--<div class="like_div"><a href="#" class="def"><div class="like"><img src="<?=site_url('img/like.jpg');?>"></div>0</a></div>-->
				</div>
				<div class="grid_5">
					<div class="event_page_image"><img src="<?=site_url('loadimage/events/'.$event['id']);?>"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>