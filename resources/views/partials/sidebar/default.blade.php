<div class="side-navigation-menu">
    <div class="category-menu-wrapper">
        <ul class="categories">
            <li class="square-logo"><img src="{{ asset('images/logos/square-white.svg') }}" alt=""></li>
            <li class="category-link @if (Request::is('user/*') || Request::is('user')) @else is-active @endif" data-navigation-menu="pages"><i class="sl sl-icon-layers"></i></li>
            <li class="category-link @if (Request::is('user/*') || Request::is('user')) is-active @endif" data-navigation-menu="user"><i class="sl sl-icon-people"></i></li>
        </ul>
    </div>
    <div id="pages" class="navigation-menu-wrapper animated preFadeInRight fadeInRight @if (Request::is('user/*') || Request::is('user')) is-hidden @endif">
        <div class="navigation-menu-header">
            <span>Ekipişi</span>
            <a class="ml-auto hamburger-btn navigation-close" title="Menu" aria-label="Menu" href="javascript:void(0);">
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
        <ul class="navigation-menu">
            <li class="has-children">
                <a class="parent-link has-new" href="#">
                    <span class="material-icons">shopping_cart</span>
                    {{ __('navigation.product.ecommerce') }}
                </a>
                <ul>
                    <li><a class="is-submenu" href="{{ route('product.ecommerce.pack') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.product.ecommerce.pack') }}')">{{ __('navigation.product.ecommerce.pack') }}</a></li>
                    <li><a class="is-submenu" href="{{ route('product.ecommerce.module') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.product.ecommerce.module') }}')">{{ __('navigation.product.ecommerce.module') }}</a></li>
                </ul>
            </li>
            <li class="has-children">
                <a class="parent-link" href="#">
                    <span class="material-icons">code</span>
                    {{ __('navigation.service') }}
                </a>
                <ul>
                    <li><a class="is-submenu" href="{{ route('service.project') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.service.project') }}')">{{ __('navigation.service.project') }}</a></li>
                    <li><a class="is-submenu" href="{{ route('service.website') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.service.website') }}')">{{ __('navigation.service.website') }}</a></li>
                </ul>
            </li>
            <li>
                <a class="parent-link has-new" href="{{ route('reference') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.references') }}')">
                    <span class="material-icons">weekend</span>
                    {{ __('navigation.references') }}
                </a>
            </li>
            <li>
                <a class="parent-link" href="{{ route('about') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.about') }}')">
                    <span class="material-icons">business</span>
                    {{ __('navigation.about') }}
                </a>
            </li>
            <li>
                <a class="parent-link" href="{{ route('contact') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.contact') }}')">
                    <span class="material-icons">email</span>
                    {{ __('navigation.contact') }}
                </a>
            </li>
        </ul>
    </div>
    <div id="user" class="navigation-menu-wrapper animated preFadeInRight fadeInRight @if (Request::is('user/*') || Request::is('user')) @else is-hidden @endif">
        <div class="navigation-menu-header @guest @else navigation-welcome @endif">
            @guest
                <span>Müşteri Paneli</span>
            @else
                <span>{!! __('navigation.sidebar.user.hello', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname]) !!}</span>
            @endif
            <a class="ml-auto hamburger-btn navigation-close" title="Menu" aria-label="Menu" href="javascript:void(0);">
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
        <ul class="navigation-menu">
            @guest
            <li>
                <a class="parent-link" href="{{ route('login') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.login') }}')">
                    <span class="material-icons">lock</span>
                    {{ __('navigation.user.login') }}
                </a>
            </li>
            <li>
                <a class="parent-link" href="{{ route('register') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.register') }}')">
                    <span class="material-icons">person_add</span>
                    {{ __('navigation.user.register') }}
                </a>
            </li>
            @else
                <li>
                    <a class="parent-link" href="{{ route('user.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.home') }}')">
                        <span class="material-icons">home</span>
                        {{ __('navigation.user.home') }}
                    </a>
                </li>
                <li class="has-children">
                    <a class="parent-link" href="#">
                        <span class="material-icons">perm_identity</span>
                        {{ __('navigation.user.profile') }}
                    </a>
                    <ul>
                        <li><a class="is-submenu" href="{{ route('user.profile') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.account') }}')">{{ __('navigation.user.account') }}</a></li>
                        <li><a class="is-submenu" href="{{ route('user.password') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.password') }}')">{{ __('navigation.user.password') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a class="parent-link has-new" href="{{ route('user.announce.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.announce') }}')">
                        <span class="material-icons">notifications_active</span>
                        {{ __('navigation.user.announce') }}
                    </a>
                </li>
                <li class="has-children">
                    <a class="parent-link has-new" href="#">
                        <span class="material-icons">perm_identity</span>
                        {{ __('navigation.user.support') }}
                    </a>
                    <ul>
                        <li><a class="is-submenu" href="{{ route('user.support.add') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.support.add') }}')">{{ __('navigation.user.support.add') }}</a></li>
                        <li><a class="is-submenu" href="{{ route('user.support.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.support.home') }}')">{{ __('navigation.user.support.home') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a class="parent-link" href="{{ route('user.service.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.service') }}')">
                        <span class="material-icons">important_devices</span>
                        {{ __('navigation.user.service') }}
                    </a>
                </li>
                <li>
                    <a class="parent-link has-new" href="{{ route('user.billing.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.billing') }}')">
                        <span class="material-icons">credit_card</span>
                        {{ __('navigation.user.billing') }}
                    </a>
                </li>
                <li>
                    <a class="parent-link has-new" href="{{ route('user.partnership.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.partnership') }}')">
                        <span class="material-icons">redeem</span>
                        {{ __('navigation.user.partnership') }}
                    </a>
                </li>
                <li>
                    <a class="parent-link" href="{{ route('user.faq.home') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.faq') }}')">
                        <span class="material-icons">info</span>
                        {{ __('navigation.user.faq') }}
                    </a>
                </li>
                <li>
                    <a class="parent-link" href="{{ route('user.solutions') }}" onclick="handleGaClick('Sidebar','{{ __('navigation.user.solutions') }}')">
                        <span class="material-icons">explore</span>
                        {{ __('navigation.user.solutions') }}
                    </a>
                </li>
                <li>
                    <a class="parent-link" href="{{ route('logout') }}" onclick="event.preventDefault(); handleGaClick('Sidebar','{{ __('navigation.user.logout') }}'); document.getElementById('logout-form').submit();">
                        <span class="material-icons">exit_to_app</span>
                        {{ __('navigation.user.logout') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>