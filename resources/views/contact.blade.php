@extends('layouts.app') 
@section('navbar', 'navbar-light') 
@section('hero-content')
<div id="main-hero" class="hero-body">
    <div class="container has-text-left">
        <div class="columns is-vcentered has-text-left">
            <div class="column is-12">
                <div class="breadcrumbs-container is-hidden-touch mb-10">
                    {{ Breadcrumbs::render() }}
                </div>
                <h1 class="title components-title is-3">
                    {{ __('contact.title') }}
                </h1>
                <p class="subtitle is-4 components-subtitle is-size-6">
                    {{ __('contact.description') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<section class="section no-padding-top">
    <div class="container">
        <div class="content-wrapper">
            <div class="columns">
                <div class="column is-5">
                    <div class="content mt-20">
                    </div>
                    <div class="content">
                        <div class="flex-card contact-card light-bordered padding-15">
                            <div class="icon">
                                <i class="im im-icon-Email"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">{{ __('contact.email') }}</div>
                                <div class="contact-details">
                                    <span class="details-text">
                                    <b>{{ config("company.email") }}</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-card contact-card light-bordered padding-15">
                            <div class="icon">
                                <i class="im im-icon-Phone-Wifi"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">{{ __('contact.central') }}</div>
                                <div class="contact-details">
                                    <span class="details-text">
                                        <b>{{ config("company.central") }}</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-card contact-card light-bordered padding-15">
                            <div class="icon">
                                <i class="im im-icon-Map-Marker"></i>
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">{{ __('contact.address') }}</div>
                                <div class="contact-details">
                                    <span class="details-text">
                                        <b>{{ config("company.address") }}</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-6 is-offset-1">
                    @if ($errors->has('updated'))
                    <article class="message icon-msg success-msg">
                        <i class="material-icons">assignment_turned_in</i>
                        <div class="message-body">
                            {{ $errors->first('updated') }}
                        </div>
                    </article>
                    @endif
                    <form id="form" class="validate-with-message" method="POST" action="{{ route('contact') }}">
                        {{ csrf_field() }}
                        <div class="columns">
                            <div class="column">
                                <div class="control{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                    <label>{{ __('contact.firstname') }} *</label>
                                    <input class="input is-large mt-5 required" minlength="3" maxlength="50" name="firstname" id="firstname" type="text" />                                    @if ($errors->has('firstname'))
                                    <small class="is-danger color-red is-size-7">
                                        {{ $errors->first('firstname') }}
                                    </small> @endif
                                </div>
                            </div>
                            <div class="column">
                                <div class="control{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <label>{{ __('contact.lastname') }} *</label>
                                    <input class="input is-large mt-5 required" minlength="3" maxlength="50" name="lastname" id="lastname" type="text" />                                    @if ($errors->has('lastname'))
                                    <small class="is-danger color-red is-size-7">
                                            {{ $errors->first('lastname') }}
                                        </small> @endif
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>{{ __('contact.email') }} *</label>
                                    <input class="input is-large mt-5 required email" minlength="10" maxlength="200" name="email" id="email" type="email" />                                    @if ($errors->has('email'))
                                    <small class="is-danger color-red is-size-7">
                                                {{ $errors->first('email') }}
                                            </small> @endif
                                </div>
                            </div>
                            <div class="column">
                                <div class="control{{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <label>{{ __('contact.subject') }} *</label>
                                    <div class="mt-5"></div>
                                    <div class="select is-large is-fullwidth">
                                        <select class="required" name="subject" id="subject" data-placeholder="{{ __('contact.subject.select') }}" required>
                                            <option value="{{ __('contact.subject.ecommerce') }}">{{ __('contact.subject.ecommerce') }}</option>
                                            <option value="{{ __('contact.subject.website') }}">{{ __('contact.subject.website') }}</option>
                                            <option value="{{ __('contact.subject.project') }}">{{ __('contact.subject.project') }}</option>
                                            <option value="{{ __('contact.subject.info') }}">{{ __('contact.subject.info') }}</option>
                                            <option value="{{ __('contact.subject.support') }}">{{ __('contact.subject.support') }}</option>
                                            <option value="{{ __('contact.subject.other') }}">{{ __('contact.subject.other') }}</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('subject'))
                                        <small class="is-danger color-red is-size-7">
                                            {{ $errors->first('subject') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <label>{{ __('contact.message') }} *</label>
                                    <div class="mt-5"></div>
                                    <textarea class="textarea is-grow required" name="message" id="message" rows="5" minlength="20" placeholder="{{ __('contact.message') }}"></textarea>
                                    @if ($errors->has('message'))
                                    <small class="is-danger color-red is-size-7">
                                            {{ $errors->first('message') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="control {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    {!! Recaptcha::render([ 'lang' => App::getLocale() ]) !!} @if ($errors->has('g-recaptcha-response'))
                                    <small class="is-danger color-red is-size-7">
                                            {{ $errors->first('g-recaptcha-response') }}
                                        </small> @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-20">
                            <button class="button btn-align no-lh raised info-btn is-medium">{{ __('contact.send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@desktop
<div id="google-map" class="section is-large"></div>
@elsedesktop
<div id="google-map" class="section is-large" style="height:350px;"></div>
@enddesktop
@endsection
 
@section('scripts')
<script src="https://maps.google.com/maps/api/js?key={{ config('google.maps.apikey') }}"></script>
<script>
$(document).ready(function($){
        $('#google-map').gMap({
            latitude: {{ config('company.latitude') }},
            longitude: {{ config('company.longitude') }},
            maptype: 'ROADMAP',
            zoom: 13,
            markers: [
                {
                    latitude: {{ config('company.latitude') }},
                    longitude:  {{ config('company.longitude') }},
                    html: '<div style="width: 300px;"><h4 style="margin-bottom: 8px;">Ekipişi</h4><div style="align-items:center!important;" class="content content-flex">{{ config("company.address") }}</div></div>',
                    icon: {
                        image: "{{ secure_asset('images/marker.png') }}",
                        iconsize: [56, 82],
                        iconanchor: [32,39]
                    }
                }
            ],
            doubleclickzoom: true,
            controls: {
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false
            }
        });
});
</script>
@endsection