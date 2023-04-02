@extends('layouts.user') 
@section('hero-content')
    @include('user/partials/faq-search')
@endsection
 
@section('section')
<div class="section help-section">
    <div class="container">
        <div class="columns is-vcentered">
            <div class="column is-hidden-mobile"></div>
            <div class="column is-9 help-container">
                <div class="flex-card single-help-article">
                    <div class="article-inner">
                        <h2 class="title is-3 dark-text">
                            {{ $faq->name }}
                        </h2>
                        @if ($faq->video)
                            <div class="videoWrapper">
                                    <iframe src="https://www.youtube.com/embed/{{ $faq->video }}?loop=1&modestbranding=1" width="560" height="315" frameborder="0" allowfullscreen=""></iframe>
                                </div>
                        @endif
                        <div class="content">
                            {!! $faq->description !!}
                        </div>
                        <div class="rating-section">
                            <div class="question">Bu makale size yardımcı oldu mu?</div>

                            <div class="rating-buttons">
                                @if ($helpful)
                                    <span class="rating-button {{ $helpful->rate==1?'is-active':'' }}" data-value="1">
                                        <i class="material-icons">sentiment_very_dissatisfied</i>
                                    </span>
                                    <span class="rating-button {{ $helpful->rate==2?'is-active':'' }}" data-value="2">
                                        <i class="material-icons">sentiment_neutral</i>
                                    </span>
                                    <span class="rating-button {{ $helpful->rate==3?'is-active':'' }}" data-value="3">
                                        <i class="material-icons">sentiment_very_satisfied</i>
                                    </span>
                                @else
                                    <span class="rating-button" data-value="1">
                                        <i class="material-icons">sentiment_very_dissatisfied</i>
                                    </span>
                                    <span class="rating-button" data-value="2">
                                        <i class="material-icons">sentiment_neutral</i>
                                    </span>
                                    <span class="rating-button" data-value="3">
                                        <i class="material-icons">sentiment_very_satisfied</i>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-hidden-mobile"></div>
        </div>
    </div>
</div>
@endsection
@section('user-scripts')
<script>
    $(".rating-buttons .rating-button").click(function (e) {
        $(".rating-button").removeClass("is-active");
        $(this).addClass("is-active");
        var value = $(this).data("value");
        $.get("/user/faq/helpful/{{ $faq->id }}/" + value);
    });
</script>
@endsection