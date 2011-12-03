(function(){
    var _gaq = _gaq || [], ga, s,
        $text, $spot, $box,
        boxProperty = '';

     function onMouseMove(e) {
        var xm = e.clientX - 400,
            ym = e.clientY - 175,
            d  = Math.round(Math.sqrt(xm * xm + ym * ym) / 5);

        $text.css("text-shadow", -xm + 'px ' + -ym + 'px ' + (d + 10) + 'px black');

        if (boxProperty) {
            $box.css(boxProperty, '0 ' + -ym + 'px ' + (d + 30) + 'px black');
        }

        xm = e.clientX - 800;
        ym = e.clientY - 450;
        $spot.css("background-position", xm + 'px ' + ym + 'px');
    }

    $.facebox.settings.loadingImage = 'img/facebox/loading.gif';
    $.facebox.settings.closeImage   = 'img/facebox/closelabel.png';
    $(function() {
        $('.contact').amail('(at)','(dot)');
        $('a[rel*=facebox]').facebox();
        $text = $('#tsb-text');
        $spot = $('#tsb-spot');
        $box  = $('#tsb-box');

        if ($text.size() && $spot.size() && $box.size()) {
            if ($box.css('webkit-box-shadow') !== '') {
                boxProperty = 'webkit-box-shadow';
            } else if ($box.css('moz-box-shadow') !== '') {
                boxProperty = 'moz-box-shadow';
            } else if ($box.css('box-shadow') !== '') {
                boxProperty = 'box-shadow';
            }

            $('#text-shadow-box').bind('mousemove', onMouseMove)
                                 .bind('touchmove', function (e) {
                e.preventDefault();
                e.stopPropagation();
                onMouseMove({
                    clientX: e.touches[0].clientX,
                    clientY: e.touches[0].clientY
                });
            });
        }

        onMouseMove({clientX: 400, clientY: 200});
    });

    try {
        _gaq.push(['_setAccount', 'UA-9617079-3']);
        _gaq.push(['_gat._anonymizeIp']);
        _gaq.push(['_trackPageview']);
        ga = document.createElement('script');
        ga.type  = 'text/javascript';
        ga.async = true;

        if ('https:' == document.location.protocol) {
            ga.src = 'https://ssl.google-analytics.com/ga.js';
        }
        else {
            ga.src = 'http://www.google-analytics.com/ga.js';
        }

        s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    } catch(err) {
        if (window.console && window.console.log) {
            console.log('exception throwed while GA-Tracking of type: ' + err.type +
                        ' and message: ' + err.message);
        }
    }
}());