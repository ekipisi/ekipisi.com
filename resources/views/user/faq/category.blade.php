@extends('layouts.user') 

@section('hero-content')
    @include('user/partials/faq-search')
@endsection

@section('section')
<div class="section help-section is-relative">
    <div class="container">
        <div class="columns">
            <div class="column is-hidden-mobile"></div>
            <div class="column is-9 help-container">
                <div class="shadow-bg">
                    <div class="category-header">
                        <div class="icon">
                        <i class="im {{ $category->icon }}"></i>
                        </div>
                        <div class="inner-content">
                            <h2 class="title is-3 dark-text">{{ $category->name }}</h2>
                            <div class="inner-text">
                                {{ $category->description }}
                                @if ($category->parent_id == 0)
                                    <div class="inline-list mt-10">
                                        @foreach($category->parents as $subcategory)
                                            <div class="mr-20">
                                                <a href="{{ route('user.faq.category', $subcategory->id) }}">
                                                    {{ $subcategory->name }} ({{ count($subcategory->faqs) }})
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="articles-list">

                        @if (count($faqs)>0)
                        @foreach($faqs as $faq)
                        <div class="help-article">
                            <a href="{{ route('user.faq.detail', $faq->id) }}">
                                <div class="inner-content">
                                <h3 class="title is-5">{{ $faq->name }}</h3>
                                    <div class="inner-text">
                                        {{ str_limit(strip_tags($faq->description), 200) }}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <div class="help-article">
                                
                                    <div class="inner-content has-text-centered">
                                    <h3 class="title is-5">Kayıt içerik bulunamadı.</h3>
                                        
                                    </div>
                            </div>
                        @endif

                        

                    </div>
                    <div class="padding-30 no-padding-top pb-20">
                            {{ $faqs->links() }}
                    </div>
                </div>
            </div>
            <div class="column is-hidden-mobile"></div>
        </div>

    </div>
</div>
@endsection