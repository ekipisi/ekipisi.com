@extends('layouts.auth') 
@section('content')
<div class="login-wrapper columns is-gapless">
    @include('partials/sliders/user')
    <div class="column is-4">
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
                    <div class="columns is-multiline">
                        @if (session('status'))
                        <div class="column is-8 is-offset-2">
                            <article class="message icon-msg success-msg">
                                <i class="material-icons">assignment_turned_in</i>
                                <div class="message-body">
                                    {{ session('status') }}
                                </div>
                            </article>
                        </div>
                        @endif
                        <div class="column is-8 is-offset-2">
                            <form class="validate-with-message" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div class="login-form animated preFadeInLeft fadeInLeft">
                                    <div class="field pb-10{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="control has-icons-right">
                                            <input type="email" class="input is-large required email" name="email" id="email" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}">
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
                                    <p class="control login">
                                        <button class="button button-cta primary-btn btn-align-lg is-bold is-fullwidth raised no-lh">{{ __('auth.password.reset.link') }}</button>
                                    </p>
                                </div>
                            </form>
                            <div class="section forgot-password animated preFadeInLeft fadeInLeft">
                                <p class="has-text-centered">
                                <a href="{{ route('login') }}">{{ __('global.back') }}</a>
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