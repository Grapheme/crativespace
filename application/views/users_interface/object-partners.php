<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
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
							<li><a href="<?=site_url('object/partners');?>" class="projects_nav linked">ПАРТНЕРЫ</a></li>
							<li><a href="<?=site_url('object/photos');?>" class="projects_nav">ФОТОГРАФИИ</a></li>
						</ul>
					</nav>
				</div>
				<div class="grid_10 partner_photo_container">
				<?php for($i=0;$i<count($partners);$i++):?>
					<div class="partner_div" data-item="<?=$partners[$i]['id']?>">
						<a class="none" href="">
							<div class="partner_black_div"></div>
							<img class="partner_photo" src="<?=site_url('loadimage/partner/'.$partners[$i]['id']);?>">
						</a>
					</div>
				<?php endfor;?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="overlay hidden"></div>
	<div class="popup hidden partner">
		<div id="div-popup"></div>
		<div class="esc"><div class="esc_hover"></div><img src="<?=site_url('img/people_esc.jpg');?>"></a></div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>
