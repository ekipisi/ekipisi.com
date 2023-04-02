@extends('layouts.user') 
@section('section')
<section class="section no-padding-bottom">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <p class="has-text-centered text-bold is-size-4">ÖDEME SİSTEMİ HENÜZ AKTİF DEĞİL</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section no-padding-top">
    <div class="container">
        
        @if ($errors->all())
            <article class="message mt-30 custom-info-message icon-msg {{ $errors->has('updated') ? "success-msg" : "danger-msg" }}">
                <i class="material-icons">{{ $errors->has('updated') ? "check" : "assignment_late" }}</i>
                <div class="message-body">
                    <ul>
                        @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </article>
        @endif

        <div class="flex-card light-bordered light-raised">
            <div class="navigation-tabs simple-tabs animated-tabs">
                <div class="tabs no-margin">
                    <ul>
                        <li class="tab-link is-active" data-tab="tab-credit-card"><a><span class=" is-size-5">Kredi Kartı <span class="is-hidden-mobile">İle Ödeme</span></span></a></li>
                        <li class="tab-link" data-tab="tab-eft"><a><span class=" is-size-5">Banka Havelesi/Eft <span class="is-hidden-mobile">ile ödeme</span></span></a></li>
                    </ul>
                </div>
                <div id="tab-credit-card" class="navtab-content is-active">
                    <form class="validate-with-message mb-40" method="post" action="{{ route('user.billing.payment', $id) }}">
                        {{ csrf_field() }}
                        <div class="columns is-multiline mt-10">
                            <div class="column is-6 is-offset-3">
                                <p class="has-text-centered">Kredi Kartı ile yapılan ödemeler de <span class="text-bold">%{{ $commission }}</span> komisyon uygulanmaktadır.</p>
                                <p class="has-text-centered text-bold is-size-5">Kartınızdan Çekilecek Tutar : ₺{{ $price_commission }}</p>
                            </div>
                            <div class="column is-6 is-offset-3">
                                <div class="card-js" data-capture-name="true" data-icon-colour="#0B9BE5">
                                    <input class="card-number" name="cardnumber" id="cardnumber" placeholder="Kredi Kartı Numarası" autocomplete="off" required>
                                    <input class="name" name="name" id="name" placeholder="Kart Üzerindeki İsim" autocomplete="off" required>
                                    <input class="expiry-month" name="expiry-month" id="expiry-month" autocomplete="off" required>
                                    <input class="expiry-year" name="expiry-year" id="expiry-year" autocomplete="off" required>
                                    <input class="cvc" name="cvc" id="cvc" placeholder="CVC/CV2 Kodu" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="column is-6 is-offset-3">
                                <div class="control">
                                    <label class="checkbox-wrap is-small">
                                    <input id="check1" type="checkbox" class="d-checkbox" required>
                                    <span></span>
                                    <a href="" >Genel Hizmet Sözleşmesini</a> İptal, İade şartlarını onaylıyorum.
                                </label>
                                </div>
                            </div>
                            <div class="column is-4 is-offset-4">
                                <div class="mt-20">
                                    <button disabled class="button is-fullwidth btn-align no-lh raised is-medium info-btn">
                                    <i class="fa fa-shield"></i> Ödemeyi Tamamla</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
                <div id="tab-eft" class="navtab-content">
                    <p>
                        Banka havalesi/eft ile yapacağınız işlemler için lütfen ödeme işlemi sonrasında "ödeme bildirimi yap" butonuna tıklayarak
                        ödeme işlemi ile ilgili bildirmde bulununuz.
                    </p>
                    <p class="text-bold is-size-5">
                        Ödemeniz Gereken Tutar : ₺{{ number_format($price_tl, 2, ',', '.') }}
                    </p>
                    <div class="content">
                        <table class="responsive-table is-light-grey">
                            <tbody>
                                <tr>
                                    <th>Banka</th>
                                    <th>Türk Lirası IBAN</th>
                                    <th>Euro IBAN</th>
                                    <th>Şube</th>
                                    <th>Şube No</th>
                                </tr>
                                <tr>
                                    <td data-th="Banka">
                                        Türkiye İş Bankası
                                    </td>
                                    <td data-th="Türk Lirası IBAN">
                                        -
                                    </td>
                                    <td data-th="Euro IBAN">
                                        -
                                    </td>
                                    <td data-th="Şube">
                                        -
                                    </td>
                                    <td data-th="Şube No">
                                        -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form class="mb-10" method="post" action="{{ route('user.billing.ispaid') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $id }}" />
                        <button type="submit" class="button is-fullwidth btn-align no-lh raised is-medium info-btn"><i class="fa fa-shield"></i> Ödeme Bildirimi Yap</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="columns">
            <div class="column">
                <div class="flex-card light-bordered light-raised">
                    <div class="content">
                        <h2 class="no-margin is-size-5 padding-20">Ödenecek Makbuzlar</h2>
                        <table class="responsive-table is-light-grey is-mobile">
                            <tbody>
                                <tr>
                                    <th>Makbuz No</th>
                                    <th>Ödenecek Tutar</th>
                                    <th class="has-text-right">Ödenecek Tutar (₺)</th>
                                </tr>
                                <tr>
                                    <td data-th="Makbuz No">
                                        #{{ $invoice_no }}
                                    </td>
                                    <td data-th="Ödenecek Tutar">
                                        {{ $price }}
                                    </td>
                                    <td data-th="Ödenecek Tutar (₺)" class="has-text-left-mobile has-text-right">
                                        ₺{{ number_format($price_tl, 2, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td data-th="Toplam" colspan="3" class="is-size-5 text-bold has-text-right">
                                        <span class="is-hidden-mobile is-hidden-tablet-only">Toplam :</span> ₺{{ number_format($price_tl,
                                        2, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column">
                @if ($has_service)
                <div class="flex-card light-bordered light-raised">
                    <div class="content">
                        <h2 class="no-margin is-size-5 padding-20">Hizmetler</h2>
                        <table class="responsive-table is-light-grey">
                            <tbody>
                                <tr>
                                    <td data-th="Hizmet">
                                        <a href="{{ route('user.service.detail', $service->id) }}" target="_blank">{{ $service->title }}</a>
                                    </td>
                                    <td data-th="Tutar">
                                        {{ ($service->currency['symbol_left'] ? $service->currency['symbol_left'] : $service->currency['symbol_right']) . "" . number_format($service->price,
                                        2, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <a href="{{ route('user.billing.home') }}" class="button raised is-white mb-20 is-hidden-tablet">
            <i class="fa fa-angle-left"></i> {{ __('global.back') }}
        </a>

        <hr />
        <p class="has-text-centered text-bold is-size-6">
            Güncel Kur Bilgisi
        </p>
        <p class="has-text-centered is-size-6">
            @foreach($currencies as $currency)
            {{ $currency['code'] }} : <span class="text-bold">₺{{ $currency['price'] }}</span>
            @if ($currency == reset($currencies )) - @endif
            @endforeach
        </p>

    </div>
</section>
@endsection
@section('user-scripts')
@endsection