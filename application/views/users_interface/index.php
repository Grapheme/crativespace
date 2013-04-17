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
				<a href="#" class="prev-e"><img src="<?=site_url('img/left.jpg');?>" class="left"></a>МЕРОПРИЯТИЯ<a href="#" class="next-e"><img src="<?=site_url('img/right.jpg');?>" class="right"></a>
			</div>
			<div class="clear"></div>
			<div class="cycle-slideshow" data-cycle-prev=".prev-e" data-cycle-next=".next-e" data-cycle-fx="scrollHorz" data-cycle-speed="300" data-cycle-timeout=0 data-cycle-slides="> div">
				<div class="event_container first">
			<?php for($i=0;$i<3;$i++):?>
				<?php if(isset($events[$i]['id'])):?>
					<div class="grid_4">
						<div class="event event_link" data-translit="<?=$events[$i]['translit'];?>" data-item="<?=$events[$i]['id'];?>">
							<img src="<?=site_url('loadimage/events/'.$events[$i]['id']);?>" class="ievent">
							<div class="event_div_text">
								<span class="event_index_date"><?=month_date($events[$i]['date']).' '.$events[$i]['date_begin'];?><br>
								<span class="event_index_text"><?=$events[$i]['title']?></span>
								<!--<div class="like_div"><a href="#" class="def"><div class="like"><img src="<?=site_url('img/like.jpg');?>"></div>0</a></div>-->
							</div>
						</div>
					</div>
				<?php endif;?>
			<?php endfor;?>
				</div>
		<?php if(isset($events[3]['id'])):?>
			<?php for($i=3;$i<count($events);$i+=3):?>
				<div class="event_container">
				<?php for($j=0;$j<3;$j++):?>
					<?php if(isset($events[$i+$j]['id'])):?>
					<div class="grid_4">
						<div class="event event_link" data-item="<?=$events[$i+$j]['id'];?>">
							<img src="<?=site_url('loadimage/events/'.$events[$i+$j]['id']);?>" class="ievent">
							<div class="event_div_text">
								<span class="event_index_date"><?=$events[$i+$j]['date_begin'];?></span><br>
								<span class="event_index_text"><?=$events[$i+$j]['title'];?></span>
								<!--<div class="like_div"><a href="#" class="def"><div class="like"><img src="<?=site_url('img/like.jpg');?>"></div>0</a></div>-->
							</div>
						</div>
					</div>
					<?php endif;?>
				<?php endfor;?>
					</div>
			<?php endfor;?>
		<?php endif;?>
			</div>
	<?php endif;?>
		<?php if(count($news)):?>
			<div class="clear"></div>
			<div class="grid_8 prefix_1 infinite-scroll">
				<p class="center">НОВОСТИ</p>
				<div class="news_hr"></div>
			<?php for($i=0;$i<count($news);$i++):?>
				<div class="news_div">
					<p>
						<a href="<?=site_url('news/'.$news[$i]['translit']);?>" class="news_title"><?=$news[$i]['title']?></a><br>
						<span class="news_date"><?=month_date_with_time($news[$i]['date_publish']);?></span>
					</p>
				<?php
					$smalltext = trim(word_limiter($news[$i]['content'],50,' ...</p>'));
					$fulltext = trim($news[$i]['content']);
					$advanced = FALSE;
					if(mb_strlen($smalltext,'utf-8') != mb_strlen($fulltext,'utf-8')):
						$advanced = TRUE;
					endif;
				?>
					<span class="news_text view-text">
						<?=$smalltext;?>
					<?php if($advanced):?>
						<div class="clear"></div>
						<a class="expand def advanced" href="">показать полностью</a>
					<?php endif;?>
					</span>
				<?php if($advanced):?>
					<span class="news_text hidden-text hidden">
						<?=$fulltext;?>
						<div class="clear"></div>
						<a class="expand def сollapse" href="">свернуть текст</a>
					</span>
				<?php endif;?>
				<?php if(count($news[$i]['photos'])):?>
					<p class="number_photo">
						<a href="#" class="prev<?=$i;?>"><img src="<?=site_url('img/left.jpg');?>" class="left"></a>1 / <?=count($news[$i]['photos']);?><a href="#" class="next<?=$i;?>"><img src="<?=site_url('img/right.jpg');?>" class="right"></a>
					</p>
					<div class="news_img_div cycle-slideshow" data-cycle-prev=".prev<?=$i;?>" data-cycle-next=".next<?=$i;?>" data-cycle-fx="fade" data-cycle-timeout=0>
					<?php for($j=0;$j<count($news[$i]['photos']);$j++):?>
						<img class="news_img" src="<?=site_url($news[$i]['photos'][$j]['src']);?>">
					<?php endfor;?>
					</div>
				<?php endif;?>
				<!--<div class="like_div"><a href="#" class="def"><div class="like"><img src="<?=site_url('img/like.jpg');?>"></div>0</a></div>-->
				</div>
			<?php endfor;?>
			<?php if($next_items):?>
				<?php $offset = $this->per_page+$this->offset;?>
				<div class="next">
					<a href="<?=site_url("text-load/news/from/$offset");?>">&nbsp;</a>
				</div>
			<?php endif;?>
			</div>
		<?php endif;?>
			<div class="follow grid_3">
				<p class="center">FOLLOW US</p>
				<div class="follow_hr"></div>
				<div class="social_widget">
					<script type="text/javascript" src="//vk.com/js/api/openapi.js?82"></script>
					<!-- VK Widget -->
					<div id="vk_groups"></div>
					<script type="text/javascript">
					VK.Widgets.Group("vk_groups", {mode: 0, width: "200", height: "290"}, 832945);
					</script>
				</div>
				<div class="social_widget">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=118650518205495";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-like-box" data-href="https://www.facebook.com/creativespacepr" data-width="200" data-show-faces="true" data-stream="false" data-header="true"></div>
				</div>
				<p>
					<a target="_blank" href="https://www.facebook.com/creativespacepr"><img src="<?=site_url('img/facebook_button.jpg');?>"></a>
					<!--<a class="none" href="#"><img src="<?=site_url('img/twitter_button.jpg');?>"></a>-->
					<a target="_blank" href="http://vk.com/creativespacepro"><img src="<?=site_url('img/vk_button.jpg');?>"></a>
					<!--<a class="none" href="#"><img src="<?=site_url('img/gplus_button.jpg');?>"></a>-->
				</p>
				<p>
					<span class="follow_contact">наш hashtag в instagram:</span><br/>
					<span class="">#creativespace</span>
				</p>
				<div class="adress">
					<span class="follow_contact">г. Ростов-на-Дону<br>ул. Суворова 52а<br>+7(863)234-56-78<br>
					<?=safe_mailto('mail@CrSp.pro','mail@CrSp.pro','class="b"');?></span>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
<script type="text/javascript" src="<?=site_url('js/vendor/jquery.jscroll.min.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/infinite-loop.js');?>"></script>
</body>
</html>