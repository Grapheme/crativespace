<div class="span2">
	<img src="<?=site_url('img/people_3.jpg');?>" alt="Creative Space" />
	<h4>Администратор</h4>
</div>
<div class="span5">
	<div class="login-form span4">
	<?=form_open('administrator/profile/save',array('id'=>'profile-form')); ?>
		<div class="control-group">
			<input type="password" name="password" class="login-field valid-required" value="" placeholder="Новый пароль" <?=TOOLTIP_FIELD_BLANK;?> id="input-password" />
			<label class="login-field-icon fui-lock-16" for="login-pass"></label>
		</div>
		<div class="control-group">
			<input type="password" name="confirm" class="login-field valid-required" value="" placeholder="Подтвердите пароль" <?=TOOLTIP_FIELD_BLANK;?> id="input-confirm-password" />
			<label class="login-field-icon fui-lock-16" for="login-pass"></label>
		</div>
		<button type="submit" value="" name="submit" class="btn btn-primary btn-large btn-block">Сменить пароль</button>
		<span class="wait-request hidden"><img src="<?=site_url('img/loading.gif');?>" alt="" /></span><div id="form-request"></div>
	<?= form_close(); ?>
	</div>
</div>
