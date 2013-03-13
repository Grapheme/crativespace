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
		<?$this->load->view("admin_interface/includes/menu")?>
		<div class="clear"></div>
		<?=$this->load->view('admin_interface/forms/profile')?>
	</div>
<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>