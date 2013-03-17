<div class="row">
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
							<!--<li class="active"><a href="<?=site_url(ADM_START_PAGE);?>">Контр.панель</a></li>-->
							<li data-active="news"><a href="<?=site_url('administrator/news')?>">Новости</a></li>
							<li data-active="events"><a href="<?=site_url('administrator/events')?>">Мероприятия</a></li>
							<li data-active="projects"><a href="<?=site_url('administrator/projects')?>">Проекты</a></li>
							<li data-active="people"><a href="<?=site_url('administrator/people')?>">Люди</a></li>
							<li data-active="object"><a class="none" href="">Объект</a>
								<ul>
									<li><a href="<?=site_url('administrator/object/partners');?>">Партнеры</a></li>
									<li><a href="<?=site_url('administrator/object/photos');?>">Фотографии</a></li>
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