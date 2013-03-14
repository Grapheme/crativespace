<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('css/images.css');?>" />
<link rel="stylesheet" href="<?=site_url('css/jquery-ui/jquery.ui.all.css');?>" />
</head>
<body>
	<div class="container">
		<?$this->load->view("admin_interface/includes/header")?>
		<div class="clear"></div>
		<div id="insert-news-step-1">
		<?=$this->load->view('admin_interface/forms/insert-news')?>
		</div>
		<div id="insert-news-step-2" class="hidden">
		<?=$this->load->view('admin_interface/forms/multi-insert-photo')?>
		</div>
		<div id="form-request"></div>
	</div>
<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript" src="<?=site_url('ckeditor/ckeditor.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/admin/multi-upload.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.core.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker-ru.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.widget.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker.js');?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){$(".datepicker").datepicker($.datepicker.regional['ru']);});
	</script>
</body>
</html>