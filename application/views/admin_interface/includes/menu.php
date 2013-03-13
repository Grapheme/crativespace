<div class="row demo-row">
	<div class="span9">
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a class="none" href="">Администирование<span class="navbar-unread">1</span></a></li>
							<li class="active"><a class="none" href="">Новости</a>
								<ul>
									<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-plus-16"></span> Добавить</a></li>
									<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-new-16"></span> Редактировать</a></li>
								</ul>
							</li>
							<li><a class="none" href="">Мероприятия</a>
								<ul>
									<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-plus-16"></span> Добавить</a></li>
									<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-new-16"></span> Редактировать</a></li>
								</ul>
							</li>
							<li><a class="none" href="">Проекты</a>
								<ul>
									<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-plus-16"></span> Добавить</a></li>
									<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-new-16"></span> Редактировать</a></li>
								</ul>
							</li>
							<li><a class="none" href="">Объект</a>
								<ul>
									<li><a href="<?=site_url('administrator/news/add');?>">Партнеры <span class="pull-right fui-menu-24"></span></a>
										<ul>
											<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-plus-16"></span> Добавить</a></li>
											<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-new-16"></span> Редактировать</a></li>
										</ul>
									</li>
									<li><a href="<?=site_url('administrator/news/add');?>">Фотографии <span class="pull-right fui-menu-24"></span></a>
										<ul>
											<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-plus-16"></span> Добавить</a></li>
											<li><a href="<?=site_url('administrator/news/add');?>"><span class="fui-new-16"></span> Редактировать</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span3">
		<select id="admin-operation" value="Администратор" class="span3" tabindex="1" name="operation">
			<option value="<?=site_url(ADM_START_PAGE);?>" <?=(uri_string() == ADM_START_PAGE)?'selected="selected"':'';?> >Контрольная панель</option>
			<option value="<?=site_url('administrator/profile');?>" <?=($this->uri->segment(2) == 'profile')?'selected="selected"':'';?>>Мой профиль</option>
			<option value="<?=site_url('logoff');?>">Завершить сеанс</option>
		</select>
	</div>
</div>