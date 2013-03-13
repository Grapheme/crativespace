<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
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
				<div class="c_div">
					<div class="c_title">АДРЕС</div>
					<div class="c_text">г.Ростов-на-Дону<br>ул. Суворова 52а</div>
				</div>
				<div class="c_div">
					<div class="c_title">E-MAIL</div>
					<div class="c_text">
						<?=safe_mailto('mail@CrSp.pro','mail@CrSp.pro','class="c_email"');?>
					</div>
				</div>
				<div class="c_div">
					<div class="c_title">ТЕЛЕФОН</div>
					<div class="c_text">+7 (863) 234-56-78</div>
				</div>
			</div>
			<div class="grid_3 prefix_3">
				<div class="c_div">
					<div class="c_title">УПРАВЛЯЮЩИЙ ЦЕНТРА</div>
					<div class="c_text_right">
						<span class="c_name">Александр Кулешов</span><br>+7 (919) 884-65-22<br>
						<?=safe_mailto('alkuleshov@gmail.com','alkuleshov@gmail.com','class="c_email"');?>
					</div>
					<div class="c_sub">Вопросы и предложения, аренда помещений или рабочего места в коворкинге</div>
				</div>
			</div>
			<div class="grid_4">
				<div class="c_div">
					<div class="c_title">КУРАТОР ВЫСТАВОК И МЕРОПРИЯТИЙ</div>
					<div class="c_text_right">
						<span class="c_name">Роман Чекмарев</span><br>+7 (950) 865-08-90<br>
						<?=safe_mailto('chekyroma@yandex.ru','chekyroma@yandex.ru','class="c_email"');?>
					</div>
					<div class="c_sub">Проведение мероприятий на территории пространства</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="map"></div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>
