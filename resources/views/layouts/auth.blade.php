<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#FC3760"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ seo_helper()->renderHtml() }}
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ekipisi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons.min.css') }}">
    @if (App::environment('production'))
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '129833461049242');
        fbq('track', 'PageView');
    </script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "6bfd563e-f78a-49bf-8a63-ba0366750822",
                safari_web_id: 'web.onesignal.auto.4463433a-b41c-4a34-809b-879a9d93883b',
            });
        });

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

        @if (App::environment('production'))
            @guest
            @else
            Tawk_API.visitor = {
                name  : "{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}",
                email : "{{ Auth::user()->email }}",
            };
            @endif
        @endif

        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5c13b64d7a79fc1bddf0f2ec/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter50265118 = new Ya.Metrika2({
                        id:50265118,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch(e) { }
            });
            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks2");
    </script>
    @endif
    @include("components/google-analytics")
    @yield('header')
</head>
<body>
    @yield('content')

    @yield('footer')

    <script src="{{ asset('js/app-min.js') }}"></script>
    <script src="{{ asset('js/modernizr-min.js') }}"></script>
    <script src="{{ asset('js/main-min.js') }}"></script>
    <script src="{{ asset('js/ekipisi-min.js') }}"></script>
    @yield('scripts')
</body>
</html>