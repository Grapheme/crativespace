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
		<a class="none a-object-images btn btn-info disabled" id="add-object-images">Добавление изображений</a>
		<a class="none a-object-images btn btn-info" id="title-object-images">Подписи к изображениям</a>
		<a class="none a-object-images btn btn-info" id="sort-object-images">Сортировка изображений</a>
		<a class="none a-object-images btn btn-info" id="delete-object-images">Удаление изображений</a>
		<hr/>
		<div class="clear"></div>
		<div class="div-object-images" id="div-insert-object-images">
		<?=$this->load->view('admin_interface/forms/multi-insert-photo');?>
		</div>
		<div class="div-object-images hidden" id="div-title-object-images">
		<?=$this->load->view('admin_interface/forms/multi-title-photo');?>
		</div>
		<div class="div-object-images hidden" id="div-sort-object-images">
		<?=$this->load->view('admin_interface/forms/multi-sort-photo');?>
		</div>
		<div class="div-object-images hidden" id="div-delete-object-images">
		<?=$this->load->view('admin_interface/forms/multi-delete-photo');?>
		</div>
		<div id="form-request"></div>
	</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url();?>js/libs/jquery-1.9.1.min.js"><\/script>')</script>
<script type="text/javascript" src="<?=site_url('js/admin/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/admin/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/admin/jquery-ui-1.10.2.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/admin/jquery.dropkick-1.0.0.js');?>"></script>
<!--[if lt IE 8]>
<script src="<?=site_url('js/admin/icon-font-ie7.js');?>"></script>
<script src="<?=site_url('js/admin/icon-font-ie7-24.js');?>"></script>
<![endif]-->
<script type="text/javascript" src="<?=site_url('js/admin/base.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/admin/scripts.js');?>"></script>
<script type="text/javascript">$("ul.nav li[data-active='<?=$this->uri->segment(2);?>']").addClass('active');</script>
<script type="text/javascript" src="<?=site_url('js/admin/multi-upload.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/sortable.js');?>"></script>
</body>
</html>