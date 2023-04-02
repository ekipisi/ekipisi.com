@extends('layouts.app') 
@section('hero', 'is-relative is-theme-info is-bold') 
@section('static','false') 
@section('navbar',
'navbar-light') 
@section('hero-content')
<div id="main-hero" class="hero-body">
    <div class="container has-text-centered">
        <div class="columns is-vcentered">
            <div class="column is-12 has-text-left">
                <div class="breadcrumbs-container is-hidden-touch mb-10">
                    {{ Breadcrumbs::render() }}
                </div>
                <h1 class="title components-title is-3">
                    {{ __('reference.title') }}
                </h1>
                <p class="subtitle is-4 components-subtitle is-size-6">
                    {{ __('reference.description') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div id="scrollnavigation" class="scroll-nav-wrapper">
    <div class="container">
        <div class="tabs scrollnav-tabs is-centered">
            <ul>
                <li class="scrollnav-item is-active"><a href="#ecommerce">{{ __('reference.category.ecommerce') }}</a></li>
                <li class="scrollnav-item"><a href="#cms">{{ __('reference.category.cms') }}</a></li>
                <li class="scrollnav-item"><a href="#project">{{ __('reference.category.project') }}</a></li>
            </ul>
        </div>
    </div>
</div>
<section class="section">
    <div class="container">
        <div class="columns is-multiline" id="ecommerce">
            <div class="column is-12">
                <h3 class="title is-4 mt-30">{{ __('reference.category.ecommerce') }}</h3>
            </div>
            @foreach($ecommerce as $reference)
            <div class="column is-4">
                <div class="card ressource-card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                                <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('References','{{ rawurlencode($reference->name) }}')">
                                    <img src="{{ Storage::disk('warden')->url($reference->image) }}" alt="{{ $reference->name }}">
                                </a>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                            <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('References','{{ rawurlencode($reference->name) }}')">{{ $reference->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if (count($website)>0)
        <hr />
        <div class="columns is-multiline" id="cms">
            <div class="column is-12">
                <h3 class="title is-4 mt-30">{{ __('reference.category.cms') }}</h3>
            </div>
            @foreach($website as $reference)
            <div class="column is-4">
                <div class="card ressource-card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                                <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('References','{{ rawurlencode($reference->name) }}')">
                                    <img src="{{ Storage::disk('warden')->url($reference->image) }}" alt="{{ $reference->name }}">
                                </a>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                            <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('References','{{ rawurlencode($reference->name) }}')">{{ $reference->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        @if (count($project)>0)
        <hr />
        <div class="columns is-multiline" id="project">
            <div class="column is-12">
                <h3 class="title is-4 mt-30">{{ __('reference.category.project') }}</h3>
            </div>
            @foreach($project as $reference)
            <div class="column is-4">
                <div class="card ressource-card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                                <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('References','{{ rawurlencode($reference->name) }}')">
                                    <img src="{{ Storage::disk('warden')->url($reference->image) }}" alt="{{ $reference->name }}">
                                </a>
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                            <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('References','{{ rawurlencode($reference->name) }}')">{{ $reference->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection