/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$("div.infinite-scroll").jscroll({
		loadingHtml: '',
		padding: 40,
		nextSelector: '.next a:last',
		contentSelector: '',
	});
});