@extends('layouts.app') 
@section('navbar', 'navbar-light')

@section('header')
    @yield('header')
@endsection

@section('hero-content')
    @yield('hero-content')
@endsection

@section('content')
    <div id="usernavigation" class="scroll-nav-wrapper is-hidden-mobile">
            <div class="container">
                <div class="tabs scrollnav-tabs user-menu is-centered">
                    <ul>
                        <li class="scrollnav-item {{ (Request::is("user") ? 'is-active' : '') }}">
                        <a href="{{ route('user.home') }}">{{ __('navigation.user.home') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/profile") || Request::is("user/password") ? 'is-active' : '') }}">
                            <nav class="is-scroll-drop">
                                <span>{{ __('navigation.user.profile') }} <i class="sl sl-icon-arrow-down"></i></span>
                                <div class="dropContain">
                                    <div class="dropOut triangle">
                                        <ul>
                                            <li>
                                                <a href="{{ route('user.profile') }}">{{ __('navigation.user.account') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.password') }}">{{ __('navigation.user.password') }}</a>
                                            </li>
                                            <li class="navbar-divider"></li>
                                            <li>
                                                <a href="{{ route('user.announce.home') }}">{{ __('navigation.user.announce') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.email.home') }}">{{ __('navigation.user.email') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/support*") ? 'is-active' : '') }}">
                            <nav class="is-scroll-drop">
                                <span>{{ __('navigation.user.support') }} <i class="sl sl-icon-arrow-down"></i></span>
                                <div class="dropContain">
                                    <div class="dropOut triangle">
                                        <ul>
                                            <li>
                                                <a href="{{ route('user.support.add') }}">{{ __('navigation.user.support.add') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('user.support.home') }}">{{ __('navigation.user.support.home') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/service*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.service.home') }}">{{ __('navigation.user.service') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/billing*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.billing.home') }}">{{ __('navigation.user.billing') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/partnership*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.partnership.home') }}">{{ __('navigation.user.partnership') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/faq*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.faq.home') }}">{{ __('navigation.user.faq') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/solutions*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.solutions') }}">{{ __('navigation.user.solutions') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="scrollnav" class="scroll-nav-wrapper is-hidden-desktop is-hidden-tablet">
            <div class="container">
                <div class="tabs scrollnav-tabs user-menu is-centered">
                    {{-- <i id="drag-left" class="im im-icon-Drag-Left is-icon-2x animated infinite bounceInRight slower"></i> --}}
                    <ul>
                        <li class="scrollnav-item {{ (Request::is("user") ? 'is-active' : '') }}">
                            <a href="{{ route('user.home') }}">{{ __('navigation.user.home') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/profile") ? 'is-active' : '') }}">
                            <a href="{{ route('user.profile') }}">{{ __('navigation.user.account') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/password") ? 'is-active' : '') }}">
                            <a href="{{ route('user.password') }}">{{ __('navigation.user.password') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/support") ? 'is-active' : '') }}">
                            <a href="{{ route('user.support.home') }}">{{ __('navigation.user.support.home') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/support/add") ? 'is-active' : '') }}">
                            <a href="{{ route('user.support.add') }}">{{ __('navigation.user.support.add') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/service*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.service.home') }}">{{ __('navigation.user.service') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/billing*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.billing.home') }}">{{ __('navigation.user.billing') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/partnership*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.partnership.home') }}">{{ __('navigation.user.partnership') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/faq*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.faq.home') }}">{{ __('navigation.user.faq') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/solutions*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.solutions') }}">{{ __('navigation.user.solutions') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/announce*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.announce.home') }}">{{ __('navigation.user.announce') }}</a>
                        </li>
                        <li class="scrollnav-item {{ (Request::is("user/email*") ? 'is-active' : '') }}">
                            <a href="{{ route('user.email.home') }}">{{ __('navigation.user.email') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container is-hidden-touch pt-20">
        {{ Breadcrumbs::render() }}
    </div>
    
    @yield('section')
@endsection                             

@section('footer')
    @yield('user-footer')
@endsection

@section('scripts')
    <script src="{{ asset('js/user-min.js') }}"></script>
    @yield('user-scripts')
@endsection