<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url();?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script src="<?=site_url('js/plugins.js');?>"></script>
<script src="<?=site_url('js/main.js');?>"></script>
<script src="<?=site_url('js/scripts.js');?>"></script>
<script type="text/javascript">$("header a[data-active='<?=$this->uri->segment(1);?>']").addClass('linked');</script>
<?php if(isset($next_items) && $next_items):?>
<script type="text/javascript" src="<?=site_url('js/vendor/jquery.jscroll.min.js');?>"></script>
<script type="text/javascript">
	$(function(){
		$("div.infinite-scroll").jscroll({
			loadingHtml: '<img src="<?=site_url("img/loading.gif")?>" alt="Загрузка" />',
			padding: 40,
			nextSelector: '.next a:last',
			contentSelector: '',
		});
	})
</script>
<?php endif;?>