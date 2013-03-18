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
					<span class="event_date"><?=month_date_with_time($news['date_publish']);?></span>
					<p class="event_title"><?=$news['title']?></p>
					<span class="event_text view-text">
						<?=$news['content']?>
						<div class="clear"></div>
					</span>
				<?php if(count($photos)):?>
					<p class="number_photo">
						<a href="#" class="prev"><img src="<?=site_url('img/left.jpg');?>" class="left"></a>1 / <?=count($photos);?><a href="#" class="next"><img src="<?=site_url('img/right.jpg');?>" class="right"></a>
					</p>
					<div class="news_img_div cycle-slideshow" data-cycle-prev=".prev" data-cycle-next=".next" data-cycle-fx="fade" data-cycle-timeout=0>
					<?php for($j=0;$j<count($photos);$j++):?>
						<img class="news_img" src="<?=site_url($photos[$j]['src']);?>">
					<?php endfor;?>
					</div>
				<?php endif;?>
					<div class="like_div"><a href="#" class="def"><div class="like"><img src="<?=site_url('img/like.jpg');?>"></div>0</a></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>