/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$("div.infinite-scroll").jscroll({
		loadingHtml: '<img src="<?=site_url("img/loading.gif")?>" alt="Загрузка" />',
		padding: 40,
		nextSelector: '.next a:last',
		contentSelector: '',
	});
});