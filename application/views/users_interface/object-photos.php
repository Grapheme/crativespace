<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('js/fancybox/jquery.fancybox.css?v=2.1.4');?>" type="text/css" media="screen" />
</head>
<noscript>
<style>.objects{visibility:visible;}</style>
</noscript>
<body onload="height('.objects','0'); resize_height('.objects','0');">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="page objects">
		<div class="navigation_border"></div>
		<div class="nav"></div>
		<div class="container_12 objects_c wp">
			<?php $this->load->view("users_interface/includes/header");?>
			<div class="projects_container">
				<div class="grid_2">
				<div class="empty35"></div>
					<nav>
						<ul>
							<li><a href="<?=site_url('object/project');?>" class="projects_nav">ПЛАН ЗДАНИЯ</a></li>
							<li><a href="<?=site_url('object/partners');?>" class="projects_nav">ПАРТНЕРЫ</a></li>
							<li><a href="<?=site_url('object/photos');?>" class="projects_nav linked">ФОТОГРАФИИ</a></li>
						</ul>
					</nav>
				</div>
				<div class="grid_10 object_photo_container">
				<?php for($i=0;$i<count($images);$i++):?>
					<a class="fancy" rel="gallery1" href="<?=site_url($images[$i]['src']);?>">
						<div class="esc_hover"></div>
						<div class="photo_text"><?=$images[$i]['title']?></div>
						<img class="photo_fulls" src="<?=site_url('img/photo_fulls.png');?>">
						<img class="object_photo" src="<?=site_url($images[$i]['src']);?>">
					</a>
				<?php endfor;?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
<script type="text/javascript" src="<?=site_url('js/fancybox/jquery.fancybox.pack.js?v=2.1.4');?>"></script>
</body>
</html>
