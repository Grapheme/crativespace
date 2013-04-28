<?php require_once(PATH_PAGE_VARIABLE);
if($this->uri->uri_string() == ''):
	$uri = 'home';
else:
	$uri = to_underscore($this->uri->uri_string());
endif;
if($this->uri->segment(1) == 'news'):
	$uri = 0;
	$head_variable[$uri]['title'] = $news['title'];
	$head_variable[$uri]['description'] = $news['title'];
endif;
if($this->uri->segment(1) == 'event'):
	$uri = 0;
	$head_variable[$uri]['title'] = $event['title'];
	$head_variable[$uri]['description'] = $event['title'];
endif;?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?=$head_variable[$uri]['title'];?></title>
<meta name="description" content="<?=$head_variable[$uri]['description'];?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="<?=site_url('css/normalize.css');?>" />
<link rel="stylesheet" href="<?=site_url('css/main.css');?>" />
<link href="http://fonts.googleapis.com/css?family=PT+Sans&subset=cyrillic,latin" rel="stylesheet" type="text/css" />
<script src="<?=site_url('js/vendor/modernizr-2.6.2.min.js');?>"></script>