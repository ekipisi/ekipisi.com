@extends('layouts.user') 

@section('section')
<section class="section solution-center">
        <div class="container">
            <div class="content pt-10 pb-10">
                @foreach($categories as $category)
                    <h2 class="title is-size-4 has-text-centered mt-30">{{ $category->name }}</h2>
                    <div class="columns is-multiline is-vcentered is-centered">
                        @foreach($category->solutions as $solution)                        
                            <div class="column is-3">
                                <div class="flex-card light-bordered">
                                    <div class="card-body">
                                        @if ($solution->url)
                                            <a href="{{ $solution->url }}" class="external">
                                                <img src="{{ Storage::disk('warden')->url($solution->image) }}" alt="{{ $solution->name }}" title="{{ $solution->name }}">
                                            </a>
                                        @else
                                            <img src="{{ Storage::disk('warden')->url($solution->image) }}" alt="{{ $solution->name }}" title="{{ $solution->name }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        </div>
    </section>
@endsection