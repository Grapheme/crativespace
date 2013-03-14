<div class="row demo-row">
	<div class="span12">
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="span9 nav-collapse collapse">
						<ul class="nav">
							<li><a class="none" href="">Администирование<span class="navbar-unread">1</span></a></li>
							<li class="active"><a href="<?=site_url('administrator/news')?>">Новости</a></li>
							<li><a class="none" href="">Мероприятия</a></li>
							<li><a class="none" href="">Проекты</a></li>
							<li><a class="none" href="">Объект</a>
								<ul>
									<li><a href="<?=site_url('administrator/news/add');?>">Партнеры</a></li>
									<li><a href="<?=site_url('administrator/news/add');?>">Фотографии</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<select id="admin-operation" value="Администратор" class="span" tabindex="1" name="operation">
						<option value="<?=site_url(ADM_START_PAGE);?>" <?=(uri_string() == ADM_START_PAGE)?'selected="selected"':'';?> >Контрольная панель</option>
						<option value="<?=site_url('administrator/profile');?>" <?=($this->uri->segment(2) == 'profile')?'selected="selected"':'';?>>Мой профиль</option>
						<option value="<?=site_url('logoff');?>">Завершить сеанс</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>