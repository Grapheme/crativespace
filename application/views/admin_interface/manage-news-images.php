<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('css/images.css');?>" />
</head>
<body>
	<div class="container">
		<?$this->load->view("admin_interface/includes/header")?>
		<div class="clear"></div>
		<a class="none btn btn-info disabled" id="add-news-images">Добавление изображений</a>
		<a class="none btn btn-info" id="delete-news-images">Удаление изображений</a>
		<hr/>
		<div class="clear"></div>
		<div id="div-insert-news-images">
		<?=$this->load->view('admin_interface/forms/multi-insert-photo')?>
		</div>
		<div id="div-delete-news-images" class="hidden">
		<?=$this->load->view('admin_interface/forms/multi-delete-photo')?>
		</div>
		<div id="form-request"></div>
	</div>
<?php $this->load->view("admin_interface/includes/scripts");?>
<script type="text/javascript" src="<?=site_url('js/admin/multi-upload.js');?>"></script>
</body>
</html>