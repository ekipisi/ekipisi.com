@extends('layouts.app')
@section('hero', 'is-default is-bold is-fullheight')
@section('hero-content')
<div class="hero-body">
        <div class="container has-text-centered">
            <div class="columns is-vcentered is-multiline">
                <div class="column is-3"></div>
                <div class="column is-6">
                @php
                 $image_list = ['1' => asset('images/illustrations/404-2.svg'), '2'=>asset('images/illustrations/404-1.svg')];
                @endphp
                <img src="{{ $image_list[array_rand($image_list)] }}" alt="">
                </div>
                <div class="column is-3"></div>
                <div class="column is-12 has-text-centered">
                    <h1 class="is-size-2">
                        {{ __('global.404.title') }}
                    </h1>
                    <h2 class="subtitle is-5">
                    {!! __('global.404.description', ['url' => route('home')]) !!}
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection