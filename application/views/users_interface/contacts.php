<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('css/bootstrap-tooltip.css');?>" />
<link rel="stylesheet" href="<?=site_url('css/css-patch.css');?>" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
</head>
<body onload="initialize()">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="page contacts_p">
		<div class="navigation_border"></div>
		<div class="container_12 contacts">
		<?php $this->load->view("users_interface/includes/header");?>
			<div class="grid_12 empty35"></div>
			<div class="grid_2">
				<div class="c_div"><div class="c_title">АДРЕС</div><div class="c_text">г.Ростов-на-Дону<br>ул. Суворова 52а</div></div>
				<div class="c_div"><div class="c_title">E-MAIL</div><div class="c_text"><?=safe_mailto('mail@CrSp.pro','mail@CrSp.pro','class="c_email"');?></div></div>
				<div class="c_div"><div class="c_title">ТЕЛЕФОН</div><div class="c_text">+7 (863) 234-56-78</div></div>
			</div>
			<div class="grid_6 prefix_2">
				<?php $this->load->view("users_interface/forms/feedback");?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="map"></div>
<?php $this->load->view("users_interface/includes/footer");?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url();?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script type="text/javascript" src="<?=site_url('js/vendor/jquery.cycle2.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/plugins.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/main.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/vendor/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/vendor/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/vendor/base.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/feedback.js');?>"></script>
<script type="text/javascript">$("header a[data-active='<?=$this->uri->segment(1);?>']").addClass('linked');</script>
</body>
</html>
