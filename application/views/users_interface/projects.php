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
				<?php if($projects):?>
					<nav>
						<ul>
						<?php for($i=0;$i<count($projects);$i++):?>
							<li><a href="<?=site_url('projects');?>" class="projects_nav linked"><?=$projects[$i]['title'];?></a></li>
						<?php endfor;?>
						</ul>
					</nav>
				<?php endif;?>
				</div>
				<div class="grid_8 prefix_1">
					<div class="projects_main_div">
					<?php if(isset($projects[0])):?>
						<img src="<?=site_url('loadimage/project/'.$projects[0]['id']);?>">
						<p class="dobrocoworkru_explain"><?=$projects[0]['content'];?></p>
						<div class="projects_people">
							<p class="dobrocoworkru_people">ЛЮДИ: <?=$projects[0]['people'];?></p>
							<a class="dobrocoworkru" href="#"><?=$projects[0]['site'];?></a>
						</div>
					<?php endif;?>
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