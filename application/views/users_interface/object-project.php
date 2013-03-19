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
<body onload="height('.objects','1'); resize_height('.objects','1');">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="page objects">
		<div class="navigation_border"></div>
		<div class="nav"></div>
		<div class="container_12 objects_c">
			<?php $this->load->view("users_interface/includes/header");?>
			<div class="projects_container">
				<div class="empty35"></div>
				<div class="grid_2">
					<nav>
						<ul>
							<li><a href="<?=site_url('object/project');?>" class="projects_nav linked">ПЛАН ЗДАНИЯ</a></li>
							<li><a href="<?=site_url('object/partners');?>" class="projects_nav ">ПАРТНЕРЫ</a></li>
							<li><a href="<?=site_url('object/photos');?>" class="projects_nav">ФОТОГРАФИИ</a></li>
						</ul>
					</nav>
					<div class="floors">
						<p><a href="#plan3" class="linked">1</a></p>
						<p><a href="#plan2">2</a></p>
						<p><a href="#plan1">3</a></p>
					</div>
				</div>
				<div class="grid_8">
					<div><a name="plan3"></a><img src="<?=site_url('img/plan_3.png');?>"></div>
					<div><a name="plan2"></a><img src="<?=site_url('img/plan_2.png');?>"></div>
					<div><a name="plan1"></a><img src="<?=site_url('img/plan_1.png');?>"></div>
				</div>
				<div class="grid_2">
					<div class="company"><a href="#"><span class="plan_number">100</span><span class="plan_company">Велопрокат</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">101</span><span class="plan_company">TRUE STUFF</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">102</span><span class="plan_company">ALASKA</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">201</span><span class="plan_company">DOBRO</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">202</span><span class="plan_company">SHKOLADESIGN</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">203</span><span class="plan_company">DJSHOP</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">204</span><span class="plan_company">СИЛА ЙОГИ</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">205</span><span class="plan_company">ПАТИПА</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">300</span><span class="plan_company">BAZA.AG</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">301</span><span class="plan_company">People Around</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">302</span><span class="plan_company">M-Point</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">303</span><span class="plan_company">Флорариум</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">304</span><span class="plan_company">Grapheme</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">305</span><span class="plan_company">НЕФТЬ</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">306</span><span class="plan_company">[ekswai'zi]</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">307</span><span class="plan_company">ALASKA</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">308</span><span class="plan_company">ОНИ</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">309</span><span class="plan_company">ТЮРЬМА</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">310</span><span class="plan_company">let me speak from my heart</span></a></div>
					<div class="company"><a href="#"><span class="plan_number">311</span><span class="plan_company">VodooBooks</span></a></div>
					<div class="means">
						<div class="means_mar">
							<div class="means_div"><img src="<?=site_url('img/means_1.png');?>" class="means_img">НОМЕР ОФИСА</div>
							<div class="means_div"><img src="<?=site_url('img/means_2.png');?>" class="means_img">ВАКАНТНО</div>
							<div class="means_div"><img src="<?=site_url('img/means_3.png');?>" class="means_img">САН.УЗЕЛ</div>
							<div class="means_div"><img src="<?=site_url('img/means_4.png');?>" class="means_img">ОГНЕТУШИТЕЛЬ</div>
							<div class="means_div"><img src="<?=site_url('img/means_5.png');?>" class="means_img">РЕМОНТ</div>
							<div class="means_div"><img src="<?=site_url('img/means_6.png');?>" class="means_img">ВЫХОД</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php $this->load->view("users_interface/includes/footer");?>
<?php $this->load->view("users_interface/includes/scripts");?>
</body>
</html>
