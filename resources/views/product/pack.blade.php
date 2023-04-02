@extends('layouts.app') 
@section('hero', 'is-relative is-default is-bold is-medium is-feature-wave is-pricing') 
@section('navbar',
'navbar-dark') 
@section('hero-content')
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <symbol id="icon-check" viewBox="0 0 24 24">
            <title>check</title>
            <path d="M9 16.172l10.594-10.594 1.406 1.406-12 12-5.578-5.578 1.406-1.406z"></path>
        </symbol>
        <symbol id="icon-close" viewBox="0 0 24 24">
            <title>close</title>
            <path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
        </symbol>
        <symbol id="icon-info_outline" viewBox="0 0 24 24">
            <title>info_outline</title>
            <path d="M11.016 9v-2.016h1.969v2.016h-1.969zM12 20.016c4.406 0 8.016-3.609 8.016-8.016s-3.609-8.016-8.016-8.016-8.016 3.609-8.016 8.016 3.609 8.016 8.016 8.016zM12 2.016c5.531 0 9.984 4.453 9.984 9.984s-4.453 9.984-9.984 9.984-9.984-4.453-9.984-9.984 4.453-9.984 9.984-9.984zM11.016 17.016v-6h1.969v6h-1.969z"></path>
        </symbol>
        <symbol id="icon-local_offer" viewBox="0 0 24 24">
            <title>local_offer</title>
            <path d="M5.484 6.984c0.844 0 1.5-0.656 1.5-1.5s-0.656-1.5-1.5-1.5-1.5 0.656-1.5 1.5 0.656 1.5 1.5 1.5zM21.422 11.578c0.375 0.375 0.563 0.844 0.563 1.406s-0.188 1.031-0.563 1.406l-7.031 7.031c-0.375 0.375-0.844 0.563-1.406 0.563s-1.031-0.188-1.406-0.563l-9-9c-0.375-0.375-0.563-0.844-0.563-1.406v-7.031c0-1.078 0.891-1.969 1.969-1.969h7.031c0.563 0 1.031 0.188 1.406 0.563z"></path>
        </symbol>
        <symbol id="icon-phone_in_talk" viewBox="0 0 24 24">
            <title>phone_in_talk</title>
            <path d="M15 12c0-1.641-1.359-3-3-3v-2.016c2.766 0 5.016 2.25 5.016 5.016h-2.016zM18.984 12c0-3.891-3.094-6.984-6.984-6.984v-2.016c4.969 0 9 4.031 9 9h-2.016zM20.016 15.516c0.563 0 0.984 0.422 0.984 0.984v3.516c0 0.563-0.422 0.984-0.984 0.984-9.375 0-17.016-7.641-17.016-17.016 0-0.563 0.422-0.984 0.984-0.984h3.516c0.563 0 0.984 0.422 0.984 0.984 0 1.266 0.188 2.438 0.563 3.563 0.094 0.328 0.047 0.75-0.234 1.031l-2.203 2.203c1.453 2.859 3.797 5.156 6.609 6.609l2.203-2.203c0.281-0.281 0.703-0.328 1.031-0.234 1.125 0.375 2.297 0.563 3.563 0.563z"></path>
        </symbol>
    </defs>
</svg>
<div class="hero-body">
    <div class="container">

            @if ($errors->any())
            <div class="has-text-centered pt-20 pb-20">
                @foreach ($errors->all() as $error)
                    {{ $error }} 
                @endforeach
            </div>
        @endif

        <div class="is-hidden">{{ Breadcrumbs::render() }}</div>
        <div class="columns is-vcentered">
            <div class="column is-10 is-offset-1 is-hero-title has-text-centered">
                <h1 class="title is-size-2 is-medium">
                    E-Ticaret Paketleri
                </h1>
                <h2 class="subtitle is-5">
                    Benzersiz ve esnek e-ticaret altyapımız ile siz de başarıyı hızlıca yakalayabilirsiniz.
                </h2>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="section section-secondary">
    <div class="container">
        <div class="switch-pricing-wrapper">
            <div class="pricing-container">
                <div class="classic-pricing">
                    <div class="pricing-table is-comparative">
                        <div class="pricing-plan is-features">
                            <div class="plan-header">Özellikler</div>
                            <div class="plan-old-price"><span class="plan-price-amount">&nbsp;</span></div>
                            <div class="plan-price"><span class="plan-price-amount">&nbsp;</span></div>
                            <div class="plan-items">
                                @foreach($features as $feature)
                                    <div class="plan-item{{ $feature == reset($features) ? " item-1":"" }}">{{ $feature->name }}</div>
                                @endforeach
                            </div>
                            <div class="plan-footer">
                            </div>
                        </div>
                        <div class="pricing-plan is-mobile">
                            <div class="plan-header">Lite</div>
                            <div class="plan-old-price">
                                <span class="plan-price-amount price-line-through">
                                    {{-- <span class="plan-price-currency">₺</span>{{ (float)$lite_pack->price + 1000 }} --}}<span class="plan-price-currency">₺</span>1.500
                                </span>
                            </div>
                            <div class="plan-price">
                                <span class="plan-price-amount">
                                    <span class="plan-price-currency">₺</span>{{ number_format($lite_pack->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="plan-items">
                                @include('components/product/item', ['data' => $lite_features])
                            </div>
                            <div class="plan-footer">
                                <button class="button btn-align raised is-fullwidth modal-trigger order-pack" data-id="1" data-modal="siparis-modal">Satın Al</button>
                            </div>
                        </div>
                        <div class="pricing-plan is-mobile is-secondary">
                            <div class="plan-header">Pro</div>
                            <div class="plan-old-price">
                                <span class="plan-price-amount price-line-through">
                                    {{-- <span class="plan-price-currency">₺</span>{{ (float)$pro_pack->price + 1000 }} --}}
                                    <span class="plan-price-currency">₺</span>2.500
                                </span>
                            </div>
                            <div class="plan-price">
                                <span class="plan-price-amount">
                                    <span class="plan-price-currency">₺</span>{{ number_format($pro_pack->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="plan-items">
                                @include('components/product/item', ['data' => $pro_features])
                            </div>
                            <div class="plan-footer">
                                <button class="button btn-align raised is-fullwidth modal-trigger order-pack" data-id="2" data-modal="siparis-modal">Satın Al</button>
                            </div>
                        </div>
                        <div class="pricing-plan is-mobile is-danger is-active">
                            <div class="plan-header">Extended</div>
                            <div class="plan-old-price">
                                <span class="plan-price-amount price-line-through">
                                    {{-- <span class="plan-price-currency">₺</span>{{ (float)$extended_pack->price + 1000 }} --}}<span class="plan-price-currency">₺</span>3.500
                                </span>
                            </div>
                            <div class="plan-price">
                                <span class="plan-price-amount">
                                    <span class="plan-price-currency">₺</span>{{ number_format($extended_pack->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="plan-items">
                                @include('components/product/item', ['data' => $extended_features])
                            </div>
                            <div class="plan-footer">
                                <button class="button btn-align raised is-fullwidth modal-trigger order-pack" data-id="3" data-modal="siparis-modal">Satın Al</button>
                            </div>
                        </div>
                        <div class="pricing-plan is-mobile is-accent">
                            <div class="plan-header">Platinum</div>
                            <div class="plan-old-price">
                                <span class="plan-price-amount price-line-through">
                                    {{-- <span class="plan-price-currency">₺</span>{{ (float)$platinum_pack->price + 1000 }} --}}
                                    <span class="plan-price-currency">₺</span>4.500
                                </span>
                            </div>
                            <div class="plan-price">
                                <span class="plan-price-amount">
                                    <span class="plan-price-currency">₺</span>{{ number_format($platinum_pack->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="plan-items">
                                @include('components/product/item', ['data' => $platinum_features])
                            </div>
                            <div class="plan-footer">
                                <button class="button btn-align raised is-fullwidth modal-trigger order-pack" data-id="4" data-modal="siparis-modal">Satın Al</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="hero-foot">
                    <div class="container mt-120">
                        <div class="tabs partner-tabs is-centered">
                            <ul>
                                @foreach($references as $reference)
                                <li>
                                    <a href="{{ $reference->url }}" title="{{ $reference->name }}" aria-label="{{ $reference->name }}" class="external" onclick="handleGaClick('Pack References','{{ rawurlencode($reference->name) }}')">
                                        <img class="partner-logo" src="{{ Storage::disk('warden')->url($reference->image) }}" alt="{{ $reference->name }}">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="section-title-wrapper has-text-centered">
            <div class="special-divider pb-30">
                <span></span>
                <span></span>
            </div>
            <h2 class="title is-2">Size Uygun Pakete Karar Veremediniz mi?</h2>
            <h3 class="subtitle is-4">Hemen Arayın Danışmanlarımız Size Yardımcı Olsun...</h3>
            <h4 class="title is-2 color-red pt-30">+90 850 885 1 357</h4>
        </div>
        <div class="columns is-multiline">
            <div class="column is-4 is-offset-4">
                <div>
                    <figure class="image">
                        <img class="first" src="{{ asset('images/illustrations/support-team.svg') }}" alt="">
                    </figure>
                </div>
            </div>
            <div class="column is-12">
                <p class="has-text-centered pt-30 pb-30">
                    İlk defa sanal mağazanızı kuruyorsanız, sektörel terimlere, e-ticarete yönelik kavramlara yabancı olabilirsiniz. Bu konuda
                    yeterli bilgi sahibi olmanız ancak zamanla olabilecektir. Sizin için öncelikli olmayan bir özelliği çok
                    önemseyip, olmazsa olmaz bir özelliği göz ardı ediyor olabilirsiniz. Danışmanlarımız sizlerden aldıkları
                    bilgileri değerlendirip, size en uygun çözümü önerecekler ve sizi doğru yönlendireceklerdir.
                </p>
            </div>
        </div>
        <div class="is-divider" data-content="ya da"></div>
        <h3 class="title is-3 has-text-centered pt-40">Biz Sizi Arayalım</h3>
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <div class="contact-form">
                    <form class="validate-with-message" method="POST" action="{{ route('call') }}">
                        {{ csrf_field() }}
                        <div class="columns is-multiline">
                            <div class="column is-6">
                                <div class="control">
                                    <label>Ad *</label>
                                    <input class="input is-medium required" name="firstname" type="text">
                                </div>
                            </div>
                            <div class="column is-6">
                                <div class="control">
                                    <label>Soyad *</label>
                                    <input class="input is-medium required" name="lastname" type="text">
                                </div>
                            </div>
                            <div class="column is-6">
                                <div class="control">
                                    <label>E-posta *</label>
                                    <input class="input is-medium required email" name="email" type="email">
                                </div>
                            </div>
                            <div class="column is-6">
                                <div class="control">
                                    <label>Telefon *</label>
                                    <input class="input is-medium required" name="phone" type="phone">
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="control">
                                    <label>Konu *</label>
                                    <textarea class="textarea is-grow required" name="subject" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="column is-12 has-text-centered">
                                <button type="submit" class="button is-fullwidth secondary-btn raised is-medium">
                                            Bilgilerinizi Bırakın Sizi Arayalım
                                        </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('partials/modals/order')
@endsection
@section('scripts') 
<script>
$( ".order-pack" ).click(function() {
  var id = $(this).data('id');
  $("#pack").val(id);
});
</script>
@endsection