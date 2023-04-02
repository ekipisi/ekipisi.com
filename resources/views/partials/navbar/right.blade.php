@guest
<a href="tel://{{ Helpers::FormatPhone(config('company.central')) }}" class="navbar-item is-link {{ $navbar ? "light-text" : "dark-text" }} text-bold is-hidden-mobile is-hidden-tablet-only">
    <i class="material-icons">phone_in_talk</i> {{ config('company.central') }}
</a>
<a class="navbar-item is-slide is-centered-tablet" href="{{ route('login') }}" onclick="handleGaClick('Navigation','{{ __('navigation.user.login') }}')">
    <i class="material-icons">lock</i> {{ __('navigation.user.login') }}
</a>
<div class="navbar-item is-button is-centered-tablet">
    <a class="button is-bold btn-align secondary-btn" href="{{ route('register') }}" onclick="handleGaClick('Navigation','{{ __('navigation.user.register') }}')">
        {{ __('navigation.user.register') }}
    </a>
</div>
@else
    @if (Request::is('user/*') || Request::is('user'))
    <div class="navbar-item">
        {!! __('navigation.user.hello', ['firstname' => Auth::user()->firstname, 'lastname' => Auth::user()->lastname]) !!}
    </div>
    @else
    <a class="navbar-item" href="{{ route('user.home') }}" onclick="handleGaClick('Navigation','{{ __('navigation.user.panel') }}')">
        <i class="material-icons">lock</i>  {{ __('navigation.user.panel') }}
    </a>
    @endif
    <div class="navbar-item no-margin no-padding">|</div>
    <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); handleGaClick('Navigation','{{ __('navigation.user.logout') }}'); document.getElementById('logout-form').submit();">
        {{ __('navigation.user.logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
@endguest