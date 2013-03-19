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
			<div class="empty35 grid_12"></div>
			<div class="clear"></div>
			<?php for($i=0;$i<count($people);$i++):?>
				<div class="grid_2 people_div" data-item="<?=$people[$i]['id']?>">
					<div class="people_img_div">
						<div class="people_black_div"></div>
						<a class="def" href="#"><img class="people_plus" src="<?=site_url('img/people_plus.png');?>"></a>
					</div>
					<img class="people_img" src="<?=site_url('loadimage/people/'.$people[$i]['id']);?>">
					<p class="people_name"><?=$people[$i]['name'];?></p>
					
				</div>
			<?php endfor;?>
		</div>
		<div class="clear"></div>
		<div class="overlay hidden"></div>
		<div class="popup hidden people">
			<div id="div-popup"></div>
			<div class="esc"><div class="esc_hover"></div><img src="<?=site_url('img/people_esc.jpg');?>"></div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>
