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
					<div class="grid_1">
						<script type="text/javascript">
							(function() {
								if (window.pluso)
									if ( typeof window.pluso.start == "function")
										return;
								var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
								s.type = 'text/javascript';
								s.charset = 'UTF-8';
								s.async = true;
								s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
								var h = d[g]('head')[0] || d[g]('body')[0];
								h.appendChild(s);
							})();
							</script>
							<div class="pluso" data-options="medium,square,line,vertical,nocounter,theme=06" data-services="vkontakte,facebook,twitter" data-background="transparent" data-url="http://creativespace.pro" data-title="Title" data-description="Description"></div>
					</div>
					<div class="grid_6">
						<span class="event_date"><?=month_date($events[$i]['date']).' '.$events[$i]['date_begin'];?></span>
						<p class="event_title">
							<a href="<?=site_url('event/'.$events[$i]['translit']);?>"><?=$events[$i]['title']?></a>
						</p>
						<span class="event_text view-text">
							<?=trim(word_limiter($events[$i]['content'],100,' ...</p>'));;?>
						</span>
						<!--<div class="like_div"><a href="#" class="def"><div class="like"><img src="<?=site_url('img/like.jpg');?>"></div>0</a></div>-->
					</div>
					<div class="grid_5">
						<div class="event_page_image"><img src="<?=site_url('loadimage/events/'.$events[$i]['id']);?>"></div>
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
<script type="text/javascript" src="<?=site_url('js/vendor/jquery.jscroll.min.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/infinite-loop.js');?>"></script>
</body>
</html>