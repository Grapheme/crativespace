<header>
	<div class="grid_1"><a href="<?=site_url('');?>"><img class="index_img" src="<?=site_url('img/index.jpg');?>"></a></div>
	<div class="grid_11">
		<nav>
			<ul>
				<li><a href="<?=site_url('contacts');?>" data-active="contacts" class="menu_option">КОНТАКТЫ</a></li>
				<li><a href="<?=site_url('people');?>"  data-active="people" class="menu_option">ЛЮДИ</a></li>
				<li><a href="<?=site_url('object/partners');?>" data-active="object" class="menu_option">ОБЪЕКТ</a></li>
				<li><a href="<?=site_url('projects');?>"  data-active="projects" class="menu_option">ПРОЕКТЫ</a></li>
				<li><a href="<?=site_url('events');?>"  data-active="events" class="menu_option">МЕРОПРИЯТИЯ</a></li>
			</ul>
		</nav>
	</div>
	<div class="clear"></div>
<?php if(uri_string() == ''):?>
	<div class="main_img_div grid_12">
		<div class="main_img_text_container">
			<div class="main_img_text_div">
				<span class="main_img_text">МЫ СОЗДАЕМ КРЕАТИВНУЮ СРЕДУ</span><br>
				<span class="main_img_text">МЫ ПРЕДОСТАВЛЯЕМ ВОЗМОЖНОСТИ ДЛЯ САМОРЕАЛИЗАЦИИ</span>
			</div>
		</div>
	</div>
	<div class="clear"></div>
<?php endif;?>
</header>