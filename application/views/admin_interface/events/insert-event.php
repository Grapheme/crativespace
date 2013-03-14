<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
	<div class="container">
		<?$this->load->view("admin_interface/includes/header")?>
		<div class="clear"></div>
		<div id="div-insert-item">
		<?=$this->load->view('admin_interface/forms/insert-event')?>
		</div>
		<div id="form-request"></div>
	</div>
<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript" src="<?=site_url('ckeditor/ckeditor.js');?>"></script>
</body>
</html>