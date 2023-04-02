@foreach($data as $feature)
<div class="plan-item" data-feature="{{ $feature->feature->name }}">
    @if (str_contains($feature->content, '₺'))
        <span class="text-bold">{{ $feature->content }}</span>
    @elseif (str_contains($feature->content, 'close'))
        <svg class="svg-icon icon-close danger-text"><use xlink:href="#icon-close"></use></svg>
    @elseif (str_contains($feature->content, 'check'))
        <svg class="svg-icon icon-check success-text"><use xlink:href="#icon-check"></use></svg>
    @elseif (str_contains($feature->content, 'info'))
        <span data-toggle="tooltip" data-placement="top" data-title="Opsiyonel" data-original-title=""><svg class="svg-icon icon-info_outline warning-text"><use xlink:href="#icon-info_outline"></use></svg></span>
    @elseif (str_contains($feature->content, 'phone-ticket'))
    <span data-toggle="tooltip" data-placement="top" data-title="Telefon ile Destek" data-original-title=""><svg class="svg-icon icon-phone_in_talk primary-text"><use xlink:href="#icon-phone_in_talk"></use></svg></span>
        <span data-toggle="tooltip" data-placement="top" data-title="Ticket ile Destek" data-original-title=""><svg class="svg-icon icon-local_offer primary-text"><use xlink:href="#icon-local_offer"></use></svg></span>
    @elseif (str_contains($feature->content, 'phone'))
        <span data-toggle="tooltip" data-placement="top" data-title="Telefon ile Destek" data-original-title=""><svg class="svg-icon icon-phone_in_talk primary-text"><use xlink:href="#icon-phone_in_talk"></use></svg></span>
    @elseif (str_contains($feature->content, 'ticket'))
        <span data-toggle="tooltip" data-placement="top" data-title="Ticket ile Destek" data-original-title=""><svg class="svg-icon icon-local_offer primary-text"><use xlink:href="#icon-local_offer"></use></svg></span>
    @else
        <span class="text-bold">{{ $feature->content }}</span>
    @endif
</div>
@endforeach