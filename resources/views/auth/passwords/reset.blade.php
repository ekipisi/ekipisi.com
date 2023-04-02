@extends('layouts.auth') 
@section('content')
<div class="login-wrapper columns is-gapless">
    @include('partials/sliders/user')
    <div class="column is-4">
        <div class="hero is-fullheight">
            <div class="hero-heading">
                <div class="section has-text-centered">
                    <a href="{{ url('/') }}">
                        <img class="top-logo" src="{{ asset('images/logos/ekipisi-logo.svg') }}" alt="Ekipişi">
                    </a>
                </div>
            </div>
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-8 is-offset-2">
                            <form class="validate-with-message" action="{{ route('password.request') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="login-form animated preFadeInLeft fadeInLeft">

                                    <div class="field pb-10{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="control has-icons-right">
                                            <input type="email" class="input is-large email" name="email" value="{{ $email or old('email') }}" placeholder="{{ __('auth.email') }}"  required>
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
                                            <input id="password" type="password" class="input is-large" name="password" placeholder="Parola" required>
                                            <span class="icon is-medium is-right">
                                                <i class="sl sl-icon-lock"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password'))
                                            <small class="is-danger color-red is-size-7">
                                                {{ $errors->first('password') }}
                                            </small>
                                        @endif
                                    </div>
                                    
                                    <div class="field pb-10{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <div class="control has-icons-right">
                                            <input id="password-confirm" type="password" class="input is-large" name="password_confirmation" placeholder="Parola Doğrula" required>
                                            <span class="icon is-medium is-right">
                                                <i class="sl sl-icon-lock"></i>
                                            </span>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <small class="is-danger color-red is-size-7">
                                                {{ $errors->first('password_confirmation') }}
                                            </small>
                                        @endif
                                    </div>

                                    <p class="control login">
                                        <button class="button button-cta primary-btn btn-align-lg is-bold is-fullwidth raised no-lh">Parolayı Sıfırla</button>
                                    </p>
                                </div>
                            </form>
                            <div class="section forgot-password animated preFadeInLeft fadeInLeft">
                                <p class="has-text-centered">
                                    <a href="{{ route('home') }}">Ana Sayfa</a>
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