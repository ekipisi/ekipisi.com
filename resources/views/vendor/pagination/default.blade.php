@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" disabled> {{ __('pagination.previous') }}</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-previous">{{ __('pagination.previous') }}</a>
        @endif
        
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next">{{ __('pagination.next') }}</a>
        @else
            <a class="pagination-next" disabled>{{ __('pagination.next') }}</a>
        @endif
        
        <ul class="pagination-list">
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}

            @desktop

            @if (is_string($element))
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            @endif

            @elsedesktop

            @enddesktop

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a class="pagination-link is-current" aria-label="{{ __('pagination.page') }} {{ $page }}" aria-current="page">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}" class="pagination-link" aria-label="{{ __('pagination.goto') }} {{ $page }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        </ul>
    </nav>
@endif
