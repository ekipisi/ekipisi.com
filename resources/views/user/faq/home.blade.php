@extends('layouts.user') 

@section('hero-content')
    @include('user/partials/faq-search')
@endsection

@section('section')
<section class="section help-section">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-hidden-mobile"></div>
                <div class="column is-9">
                    @foreach($categories as $category)
                    <div class="flex-card category-card light-bordered">
                        <div class="card-body">
                            
                                <div class="icon">
                                    <i class="im {{ $category->icon	 }}"></i>
                                </div>
                                <div class="inner-content">
                                    <h2 class="title is-4"><a href="{{ route('user.faq.category', $category->id) }}">{{ $category->name }}</a></h2>
                                    <div class="inner-text">
                                        {{ $category->description }}
                                    </div>
                                    <div class="card-meta">
                                        <div class="meta-info">
                                            <div class="articles-number">
                                                @if ($category->parent_id == 0)
                                                    <div class="inline-list">
                                                        @foreach($category->parents as $subcategory)
                                                            <div class="mr-20">
                                                                <a href="{{ route('user.faq.category', $subcategory->id) }}">
                                                                    {{ $subcategory->name }} ({{ count($subcategory->faqs) }})
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    Bu bölümde {{ (count($category->faqs)>0)? count($category->faqs) . " yazı var" :"hiç yazı yok" }}.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="column is-hidden-mobile"></div>
            </div>
        </div>
    </section>
@endsection