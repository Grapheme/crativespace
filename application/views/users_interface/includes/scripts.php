<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url();?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
<script type="text/javascript" src="<?=site_url('js/vendor/jquery.cycle2.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/plugins.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/main.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/scripts.js');?>"></script>
<script type="text/javascript">$("header a[data-active='<?=$this->uri->segment(1);?>']").addClass('linked');</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter21041596 = new Ya.Metrika({id:21041596,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/21041596" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->