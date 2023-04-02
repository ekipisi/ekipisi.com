<div class="hero-foot pt-30 pb-30">
    <div class="container">
        <div class="tabs partner-tabs is-centered">
            <ul>
                @foreach($references as $reference)
                <li>
                    <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('Home References','{{ rawurlencode($reference->name) }}')">
                        <img class="partner-logo" src="{{ Storage::disk('warden')->url($reference->image) }}" alt="{{ $reference->name }}">
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>