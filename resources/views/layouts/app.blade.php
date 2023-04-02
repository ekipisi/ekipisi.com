<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#FC3760" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ seo_helper()->renderHtml() }}
    <meta name="wot-verification" content="bd0554d87783a5b813e6" />
    <meta name="norton-safeweb-site-verification" content="8fdwffotstgr9iebw89a16suaop1gggaj2jz1giywlcvhmsnx3gz4uydsp3y23y4w4kuyqfdf59vvnqfyme8f69zupicjy3gsszp4vr55kf843c4nuntvllwtv0n8i-t" />
    <link rel="stylesheet" href="{{ secure_asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/ekipisi.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/icons.min.css') }}">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    @yield('header')
    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "LocalBusiness",
          "url": "www.{{ config('app.domain') }}",
          "name": "{{ config('app.name') }}",
          "telephone": "{{ config('company.central') }}",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ config('company.address') }}",
            "addressCountry": "Turkey"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": "{{ config('company.latitude') }}",
            "longitude": "{{ config('company.longitude')  }}"
          }
        }
    </script>
    @if (App::environment('production'))
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        @guest
        fbq('init', '129833461049242');
        @else
        fbq('init', '129833461049242', { 
            em: '{{ Auth::user()->email }}', 
            ph: '{{ Auth::user()->mobile }}',
            fn: '{{ Auth::user()->firstname }}',
            ln: '{{ Auth::user()->lastname }}',
        });
        @endif
        fbq('track', 'PageView');
        fbq('track', 'Lead');
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
</head>

<body {{ Request::is( 'user/*') || Request::is( 'user') ? 'class=user' : ''}}>
    <div class="hero is-bold @if (View::hasSection('hero')) @yield('hero') @else {{ Request::is('/') ? 'is-default' : 'is-relative is-theme-info'}} @endif">
        @if (Request::is('user/*') || Request::is('user')) @else @if (!View::hasSection('static'))
        <nav class="navbar navbar-wrapper is-cloned">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="{{ url('/') }}"><img src="{{ asset('images/logos/ekipisi-logo.svg') }}" alt="Ekipişi"></a>
                    <a id="navigation-mobile-trigger" title="Menu" aria-label="Menu" class="navigation-trigger navbar-item hamburger-btn custom-burger is-hidden-desktop" href="javascript:void(0);">
                        <span class="menu-toggle">	
                            <span class="icon-box-toggle"> 	
                                <span class="rotate">
                                    <i class="icon-line-top"></i>
                                    <i class="icon-line-center"></i>
                                    <i class="icon-line-bottom"></i> 
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
                <div id="is-cloned" class="navbar-menu">
                    <div class="navbar-start">
                        @include("partials/navbar/left")
                    </div>
                    <div class="navbar-end">
                        @include("partials/navbar/right", ['navbar' => 0])
                    </div>
                </div>
            </div>
        </nav>
        @endif @endif

        <nav class="navbar navbar-wrapper is-transparent is-static @yield('navbar')">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="{{ url('/') }}">
                        @if (trim($__env->yieldContent('navbar')) == "navbar-dark")
                            <img src="{{ asset('images/logos/ekipisi-logo.svg') }}" alt="Ekipişi">
                        @else
                            @if(View::hasSection('navbar'))
                                <img src="{{ asset('images/logos/ekipisi-white-logo.svg') }}" alt="Ekipişi">
                            @else
                                <img src="{{ asset('images/logos/ekipisi-logo.svg') }}" alt="Ekipişi">
                            @endif
                        @endif
                    </a>
                    <a id="navigation-trigger" title="Menu" aria-label="Menu" class="navigation-trigger navbar-item custom-burger is-hidden-desktop" href="javascript:void(0);">
                        <span class="menu-toggle">	
                            <span class="icon-box-toggle"> 	
                                <span class="rotate">
                                    <i class="icon-line-top"></i>
                                    <i class="icon-line-center"></i>
                                    <i class="icon-line-bottom"></i> 
                                </span>
                            </span>
                        </span>
                    </a>

                </div>
                <div id="is-static" class="navbar-menu">
                    <div class="navbar-start">
                        @include("partials/navbar/left")
                    </div>
                    <div class="navbar-end">
                        @include("partials/navbar/right", ['navbar' => View::hasSection('navbar')])
                    </div>
                </div>
            </div>
        </nav>
        @yield('hero-content')
    </div>

    @yield('content')
    @include("partials/footer") @yield('footer')
    @include("partials/sidebar/default")

    <script src="{{ asset('js/app-min.js') }}"></script>
    <script src="{{ asset('js/modernizr-min.js') }}"></script>
    <script src="{{ asset('js/main-min.js') }}"></script>
    <script src="{{ asset('js/ekipisi-min.js') }}"></script>
    @yield('scripts')
</body>
</html>