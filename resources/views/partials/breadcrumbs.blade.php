@if (count($breadcrumbs))
    {{-- is-centered --}}
    <nav class="breadcrumb has-arrow-separator is-small" aria-label="breadcrumbs">
        <ul>
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($loop->first)
                <li>
                    <a href="{{ $breadcrumb->url }}" onclick="handleGaClick('Breadcrumbs','{{ $breadcrumb->title }}')">
                        <span class="icon is-small">
                            <i class="sl sl-icon-home" aria-hidden="true"></i>
                        </span>
                        <span>{{ $breadcrumb->title }}</span>
                    </a>
                </li>
                @else
                @if ($breadcrumb->url && !$loop->last)
                    <li><a href="{{ $breadcrumb->url }}" onclick="handleGaClick('Breadcrumbs','{{ $breadcrumb->title }}')">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="is-active"><a href="#" aria-current="page">{{ $breadcrumb->title }}</a></li>
                @endif
                @endif
            @endforeach
        </ul>
      </nav>
@endif