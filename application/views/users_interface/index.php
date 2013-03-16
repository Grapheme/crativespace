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
		<div class="main_img_container"></div>
		<div class="navigation_border"></div>
		<div class="container_12">
			<?php $this->load->view("users_interface/includes/header");?>
		<?php if(count($events)):?>
			<div class="event_title_div grid_20">
				<a href="#"><img src="<?=site_url('img/left.jpg');?>" class="left"></a>МЕРОПРИЯТИЯ<a href="#"><img src="<?=site_url('img/right.jpg');?>" class="right"></a>
			</div>
			<div class="clear"></div>
			<div class="event_container">
			<?php for($i=0;$i<count($events);$i++):?>
				<div class="grid_4">
					<div class="event">
						<div>
							<img src="<?=site_url('loadimage/events/'.$events[$i]['id']);?>" class="ievent">
							<div class="event_div_text">
								<span class="event_index_date"><?=$events[$i]['date_begin']?></span><br><span class="event_index_text"><?=$events[$i]['title']?></span>
								<div class="like">
									<a href="#">
										<img src="<?=site_url('img/liked.jpg');?>" class="liked">
										<img src="<?=site_url('img/like.jpg');?>">25
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endfor;?>
			</div>
		<?php endif;?>
		<?php if(count($news)):?>
			<div class="clear"></div>
			<div class="grid_8 prefix_1"><p class="center">НОВОСТИ</p>
				<div class="news_hr"></div>
			<?php for($i=0;$i<count($news);$i++):?>
				<div class="news_div">
					<p><span class="news_title"><?=$events[$i]['title']?></span><br><span class="news_date"><?=month_date_with_time($news[$i]['date_publish']);?></span></p>
					<span class="news_text"><?=word_limiter($news[$i]['content'],50);?></span>
					<span class="hidden_text hidden"><?=$news[$i]['content'];?></span>
					<a class="expand" href="#">показать полностью</a>
			<?php if(count($news[$i]['photos'])):?>
					<p class="number_photo"><a href="#"><img src="<?=site_url('img/left.jpg');?>" class="left"></a>1 / 25<a href="#"><img src="<?=site_url('img/right.jpg');?>" class="right"></a></p>
				<?php for($j=0;$j<count($news[$i]['photos']);$j++):?>
					<div class="news_img_div"><img class="news_img" src="<?=site_url($news[$i]['photos'][$j]['src']);?>"></div>
				<?php endfor;?>
			<?php endif;?>
					<div class="like"><a href="#"><img src="<?=site_url('img/like.jpg');?>">25</a></div>
				</div>
			<?php endfor;?>
			</div>
			<div class="follow grid_3">
				<p class="center">FOLLOW US</p>
				<div class="follow_hr"></div>
				<p>
					<a href="#"><img src="<?=site_url('img/facebook_button.jpg');?>"></a>
					<a href="#"><img src="<?=site_url('img/twitter_button.jpg');?>"></a>
					<a href="#"><img src="<?=site_url('img/vk_button.jpg');?>"></a>
					<a href="#"><img src="<?=site_url('img/gplus_button.jpg');?>"></a>
				</p>
				<div class="adress">
					<span class="follow_contact">г. Ростов-на-Дону<br>ул. Суворова 52а<br>+7(863)234-56-78<br>
					<?=safe_mailto('mail@CrSp.pro','mail@CrSp.pro','class="b"');?></span>
				</div>
			</div>
			<div class="clear"></div>
		<?php endif;?>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>