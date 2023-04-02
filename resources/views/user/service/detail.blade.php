@extends('layouts.user') 
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
@endsection
@section('section')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-3">
                <div class="flex-card light-bordered light-raised">
                    <div class="card-body no-padding">
                        <ul class="list-block">
                            <li class="is-active">
                                <a id="btn-hizmet-bilgisi" class="btn-service">
                                        <i class="fa fa-fw fa-info-circle mr-20"></i>Hizmet Bilgileriniz</a>
                            </li>
                            <!-- <li>
                                    <a>
                                        <i class="fa fa-tasks mr-20"></i>Hesap Limitleriniz</a>
                                </li> -->
                            {{-- <li>
                                <a id="btn-iptal-islemi" class="btn-service">
                                        <i class="fa fa-times-circle mr-20"></i>İptal Talebi</a>
                            </li> --}}
                            @if ($service->product['category'] == "eticaret")
                            <li>
                                <a id="btn-paket-ozellikleri" class="btn-service">
                                    <i class="fa fa-fw fa-list-ul mr-20"></i>Hizmet Özellikleri</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="container-service" id="container-hizmet-bilgisi">
                    <div class="flex-card light-bordered light-raised">

                        <div class="card-body">
                            <div class="content">
                                <h4 class="no-margin is-size-5">Hizmet Bilgileri</h4>
                                <hr />
                                <div class="columns is-multiline">
                                    <div class="column is-4">
                                        <div class="flex-card light-bordered no-margin-bottom">
                                            <div class="card-body no-padding">
                                                <div class="content">
                                                    <h2 class="is-size-6 padding-10 no-margin">
                                                        <i class="fa fa-calendar mr-10"></i>Kayıt Tarihi</h2>
                                                    <hr class="no-padding no-margin" />
                                                    <p class="is-size-5 has-text-centered padding-20">
                                                        {{ Carbon\Carbon::parse($service->payment_date)->format("d M Y") }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <div class="flex-card light-bordered no-margin-bottom">
                                            <div class="card-body no-padding">
                                                <div class="content">
                                                    <h2 class="is-size-6 padding-10 no-margin">
                                                        <i class="fa fa-credit-card mr-10"></i>İlk Ödeme Miktarı</h2>
                                                    <hr class="no-padding no-margin" />
                                                    <p class="is-size-5 has-text-centered padding-20">
                                                        {{ ($service->currency['symbol_left'] ? $service->currency['symbol_left'] : $service->currency['symbol_right']) }} {{ $service->price
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <div class="flex-card light-bordered no-margin-bottom">
                                            <div class="card-body no-padding">
                                                <div class="content">
                                                    <h2 class="is-size-6 padding-10 no-margin">
                                                        <i class="fa fa-refresh mr-10"></i>Yinelenen Ödeme</h2>
                                                    <hr class="no-padding no-margin" />
                                                    <p class="is-size-5 has-text-centered padding-20">
                                                        {{ ($service->currency['symbol_left'] ? $service->currency['symbol_left'] : $service->currency['symbol_right']) }} {{ $service->price_renewal
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <div class="flex-card light-bordered">
                                            <div class="card-body no-padding">
                                                <div class="content">
                                                    <h2 class="is-size-6 padding-10 no-margin">
                                                        <i class="fa fa-cart-arrow-down mr-10"></i>Fatura Kesim Döngüsü</h2>
                                                    <hr class="no-padding no-margin" />
                                                    <p class="is-size-5 has-text-centered padding-20">
                                                        {{ $service->period['name'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <div class="flex-card light-bordered">
                                            <div class="card-body no-padding">
                                                <div class="content">
                                                    <h2 class="is-size-6 padding-10 no-margin">
                                                        <i class="fa fa-calendar-plus-o mr-10"></i>Sonraki Son Ödeme Tarihi</h2>
                                                    <hr class="no-padding no-margin" />
                                                    <p class="is-size-5 has-text-centered padding-20">
                                                        {{ Carbon\Carbon::parse($service->payment_date)->addDays($service->period['total_day'])->format("d M Y") }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <div class="flex-card light-bordered">
                                            <div class="card-body no-padding">
                                                <div class="content">
                                                    <h2 class="is-size-6 padding-10 no-margin">
                                                        <i class="fa fa-money mr-10"></i>Ödeme Tipi</h2>
                                                    <hr class="no-padding no-margin" />
                                                    <p class="is-size-5 has-text-centered padding-20">
                                                        {{ $service->paymenttype['name'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-service" id="container-iptal-islemi" style="display:none">
                    <div class="flex-card light-bordered light-raised">
                        <div class="card-body">
                            <div class="content">
                                <h4 class="no-margin is-size-5">İptal İşlemi</h4>
                                <hr />
                                <article class="message icon-msg warning-msg">
                                    <i class="material-icons">warning</i>
                                    <div class="message-body">
                                        <h4>Dikkat</h4>
                                        İptal talebiniz teknik birimimize iletilecektir. Hizmetinizin iptali ile ilgili herhangi bir engel yoksa teknik birimimiz
                                        tarafından hizmetiniz iptal edilecektir.
                                    </div>
                                </article>
                                <h5 class="text-bold is-size-6 mb-10">Lütfen hizmetinizi iptal sebebinizi belirtiniz.</h5>
                                <form class="validate-with-message" method="post" action="{{ route('user.service.cancel') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="service_id" value="{{ $service->id }}" />
                                    <ul class="unstyled-list">
                                        <li>
                                            <!-- Radio -->
                                            <label class="radio-wrap is-small">
                                        <input type="radio" class="b-radio" name="subject" value="Hizmet pahalı" checked>
                                        <span></span>
                                        Hizmet pahalı
                                    </label>
                                            <!-- /Radio -->
                                        </li>
                                        <li>
                                            <!-- Radio -->
                                            <label class="radio-wrap is-small">
                                        <input type="radio" class="b-radio" name="subject" value="Fatura tarihinde iptal et">
                                        <span></span>
                                        Fatura tarihinde iptal et
                                    </label>
                                            <!-- /Radio -->
                                        </li>
                                        <li>
                                            <!-- Radio -->
                                            <label class="radio-wrap is-small">
                                        <input type="radio" class="b-radio" name="subject" value="Teknik destek sorunu">
                                        <span></span>
                                        Teknik destek sorunu
                                    </label>
                                            <!-- /Radio -->
                                        </li>
                                        <li>
                                            <!-- Radio -->
                                            <label class="radio-wrap is-small">
                                        <input type="radio" class="b-radio" name="subject" value="Hizmetinizi beğenmedim">
                                        <span></span>
                                        Hizmetinizi beğenmedim
                                    </label>
                                            <!-- /Radio -->
                                        </li>
                                        <li>
                                            <!-- Radio -->
                                            <label class="radio-wrap is-small">
                                        <input type="radio" class="b-radio" name="subject" value="Diğer">
                                        <span></span>
                                        Diğer
                                    </label>
                                            <!-- /Radio -->
                                            <textarea class="textarea is-grow" rows="5" name="message" placeholder="Lütfen iptal etme sebebinizi belirtin."></textarea>
                                        </li>
                                    </ul>
                                    <div class="mt-20 has-text-left">
                                        <button type="submit" class="button is-medium is-danger">Hizmeti İptal Et</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-service" id="container-paket-ozellikleri" style="display:none">
                    <div class="flex-card light-bordered light-raised">
                        <div class="card-body">
                            <div class="content">
                                <h4 class="no-margin is-size-5">Hizmet Özellikleri</h4>
                                <hr />
                                @if (!empty($service->description))
                                <p class="mb-20">
                                    {!! $service->description !!}
                                </p>
                                @endif
                                <div class="columns">
                                    <div class="column">
                                <div class="solid-list">
                                    @php
                                    $i = 0 ;
                                    @endphp
                                    @foreach($service->product->features as $feature) 
                                    
                                    @php
                                    $i++;
                                    @endphp

                                    @if ($i == round(count($service->product->features) / 2) + 1)
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="solid-list">
                                    @endif
                                    <div class="solid-list-item">
                                        <div class="list-text">
                                            {{ $feature->feature->name }}
                                        </div>
                                        <div class="list-bullet ml-20">
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
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('user.service.home') }}" class="button raised is-white mb-20 is-hidden-tablet">
            <i class="fa fa-angle-left"></i> {{ __('global.back') }}
        </a>
    </div>
</section>
@endsection
 
@section('user-scripts')
    @if ($errors->any())
    <script>
        iziToast.show({
            icon: 'fa fa-bell-o',
            title: 'Merhaba',
            message: '@foreach ($errors->all() as $error) {{ $error }} @endforeach',
            theme: 'dark',
            class: 'custom1',
            position: 'topCenter',
            displayMode: 2,
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            progressBarColor: '#4FC1EA',
            balloon: true,
            iconColor: '#fff'
        });
    </script>
    @endif
@endsection