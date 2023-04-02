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
                            <i class="im im-icon-Magnifi-Glass2"></i>
                            </div>
                            <div class="inner-content">
                                <h2 class="title is-3 dark-text">Arama Sonuçları</h2>
                                <div class="inner-text">
                                    Eğer sorunuza cevap bulamadıysanız <a href="{{ route('user.support.add') }}">Destek Sistemimizi</a> kullanmaktan çekinmeyin.
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