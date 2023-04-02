@extends('layouts.auth') 
@section('content')
<div class="login-wrapper columns is-gapless">
    @include('partials/sliders/user')
    <div class="column is-4 is-one-third-tablet">
        <div class="hero is-fullheight">
            <div class="hero-heading">
                <div class="section has-text-centered">
                    <a href="{{ route('home') }}">
                        <img class="top-logo" src="{{ asset('images/logos/ekipisi-logo.svg') }}" alt="Ekipişi">
                    </a>
                </div>
                <div class="no-account-link has-text-centered">
                    <a href="{{ route('register') }}">{{ __('auth.noaccount') }}</a>
                </div>
            </div>
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-8 is-offset-2">

                            @if ($errors->has('warning_register'))
                                <article class="message icon-msg success-msg">
                                    <i class="material-icons">assignment_turned_in</i>
                                    <div class="message-body">
                                        {{ $errors->first('warning_register') }}
                                    </div>
                                </article>
                            @endif
        
                            @if ($errors->has('success_activation'))
                                <article class="message icon-msg success-msg">
                                    <i class="material-icons">assignment_turned_in</i>
                                    <div class="message-body">
                                        {{ $errors->first('success_activation') }}
                                    </div>
                                </article>
                            @endif
        
                            @if ($errors->has('danger_activation'))
                                <article class="message icon-msg danger-msg">
                                    <i class="material-icons">assignment_late</i>
                                    <div class="message-body">
                                        {{ $errors->first('danger_activation') }}
                                    </div>
                                </article>
                            @endif

                            <form class="validate-with-message" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="login-form animated preFadeInLeft fadeInLeft">
                                    <div class="field pb-10{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="control has-icons-right">
                                        <input type="email" class="input is-large required email" name="email" id="email" value="{{ $email or old('email') }}" placeholder="{{ __('auth.email') }}"
                                                autofocus/>
                                            <span class="icon is-medium is-right">
                                                <i class="sl sl-icon-globe"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('email'))
                                            <small class="is-danger color-red is-size-7">
                                                {{ $errors->first('email') }}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="field pb-10{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="control has-icons-right">
                                            <input type="password" class="input is-large required" name="password" id="password" placeholder="{{ __('auth.password') }}">
                                            <span class="icon is-medium is-right">
                                                <i class="sl sl-icon-lock"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                        <small class="is-danger color-red is-size-7">
                                            {{ $errors->first('password') }}
                                        </small> @endif
                                    </div>
                                    <div class="field pb-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('auth.remember') }}
                                            </label>
                                        </div>
                                    </div>
                                    <p class="control login">
                                        <button type="submit" class="button button-cta primary-btn btn-align-lg is-bold is-fullwidth raised no-lh">{{ __('auth.login') }}</button>
                                    </p>
                                </div>
                            </form>
                            <div class="is-divider" data-content="{{ __('auth.or') }}"></div>
                            <div class="section no-margin padding-60">
                                <nav class="level is-mobile animated preFadeInLeft fadeInLeft">
                                    <p class="level-item has-text-centered">
                                        <a href="{{ url('login/facebook') }}" class="link is-info"><i class="fa fa-facebook-square fa-2x"></i></a>
                                    </p>
                                    <p class="level-item has-text-centered">
                                        <a href="{{ url('login/google') }}" class="link is-info"><i class="fa fa-google fa-2x"></i></a>
                                    </p>
                                    <p class="level-item has-text-centered">
                                        <a href="{{ url('login/linkedin') }}" class="link is-info"><i class="fa fa-linkedin-square fa-2x"></i></a>
                                    </p>
                                </nav>
                            </div>
                            <div class="section forgot-password animated preFadeInLeft fadeInLeft">
                                <p class="has-text-centered">
                                    <a href="{{ route('password.request') }}">{{ __('auth.password.request') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection