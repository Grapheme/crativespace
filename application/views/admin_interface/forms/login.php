<div class="login">
	<div class="login-screen">
		<div class="login-icon">
			<img src="<?=site_url('images/login/icon.png');?>" alt="Creative Space" />
			<h4>Авторизация<small>CreativeSpace</small></h4>
		</div>
		<div class="login-form">
		<?=form_open('admin/login',array('id'=>'login-form')); ?>
			<div class="control-group">
				<input type="text" id="login-email" name="login" class="login-field valid-required valid-email sendField" value="" <?=TOOLTIP_FIELD_BLANK;?> placeholder="Логин" />
				<label class="login-field-icon fui-man-16" for="login-name"></label>
			</div>
			<div class="control-group">
				<input type="password" name="password" class="login-field valid-required sendField" value="" placeholder="Пароль" <?=TOOLTIP_FIELD_BLANK;?> id="login-pass" />
				<label class="login-field-icon fui-lock-16" for="login-pass"></label>
			</div>
			<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Вход на сайт</button>
			<div class="login-link" id="form-request"></div>
			<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span>
		<?= form_close(); ?>
		</div>
	</div>
</div>