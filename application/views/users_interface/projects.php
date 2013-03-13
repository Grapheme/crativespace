<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
</head>
<noscript>
	<style>.projects,.projects_c{visibility:visible;}</style>
</noscript>
<body onload="height('.projects'); resize_height();">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="page projects">
		<div class="navigation_border"></div>
		<div class="nav"></div>
		<div class="container_12 projects_c">
			<?php $this->load->view("users_interface/includes/header");?>
			<div class="projects_container">
				<div class="grid_12 empty35"></div>
				<div class="grid_2">
					<nav>
						<ul>
							<li><a href="#" class="projects_nav linked">DOBROCOWORK</a></li>
							<li><a href="#" class="projects_nav">CREATIVE RADIO</a></li>
							<li><a href="#" class="projects_nav">ГАЛЕРЕЯ</a></li>
							<li><a href="#" class="projects_nav">ВЕЛОПРОКАТ</a></li>
							<li><a href="#" class="projects_nav">ТИПОГРАФИЯ</a></li>
							<li><a href="#" class="projects_nav">BAZA</a></li>
							<li><a href="#" class="projects_nav">ФЛОРАРИУМ</a></li>
						</ul>
					</nav>
				</div>
				<div class="grid_8 prefix_1">
					<div class="projects_main_div">
						<img src="<?=site_url('img/dobroco.jpg');?>">
						<p class="dobrocoworkru_explain">Dobrocowork - это лучшие условия для аренды комфортных мест в специально подготовленном лофт-пространстве в центре города, площадью 170 квадратных метров с возможностью организации рабочих групп до 6-ти человек.<br>
						Ковокеры получают возможность работать в удобном офисе, принимать участие в интересных и перспективных проектах, влиться в профессиональную команду и познакомится с единомышленниками, проще говоря стать частью команды проекта dobrocowork, не имеющего аналогов на юге России</p>
						<div class="projects_people">
							<p class="dobrocoworkru_people">ЛЮДИ: <a class="dobrocoworkru_person" href="#">Александр Кулешов</a>, <a class="dobrocoworkru_person" href="#">Павел Юдин</a>, <a class="dobrocoworkru_person" href="#">Андрей Герцен</a></p>
							<a class="dobrocoworkru" href="#">dobrocowork.ru</a>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>