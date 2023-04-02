@extends('layouts.user') 

@section('section')
<section class="section parallax is-relative" id="section-info" style="display:none;" data-background="{{ asset('images/bg/geometry2.png') }}" data-color="#000" data-color-opacity="0">
    <div class="container">
        <div class="section-title-wrapper">
            <h2 class="title section-title has-text-centered dark-text text-bold">
                Gelir Ortaklığı
            </h2>
            <div class="subtitle has-text-centered is-tablet-padded">
                Gelin sizi de firmamıza ortak yapalım, 
                öneriniz ile başlayan her satış için %10 kazanın.
            </div>
        </div>
        <div class="content-wrapper">
            <div class="columns values-cards is-minimal is-vcentered is-gapless is-multiline">
                <div class="column">
                    <div class="feature-card hover-inset light-bordered has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Target-Market"></i>
                        </div>
                        <div class="card-title">
                            <h4>Referansları İletin</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Formu doldurarak referans olmak istediğiniz kişi bilgilerini bize iletin.
                            </span>
                        </div>
                        <a href="{{ route('user.partnership.add') }}" class="button btn-align btn-more is-link color-primary">
                            Yeni Kayıt Gir <i class="sl sl-icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-card hover-inset light-bordered has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Sharethis"></i>
                        </div>
                        <div class="card-title">
                            <h4>Bağlantımızı Paylaşın</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Dilerseniz size özel paylaşım linkini sosyal medya veya e-mail aracılığı ile çevrenizle paylaşın.
                            </span>
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                            Yakında <i class="sl sl-icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="column">
                    <div class="feature-card hover-inset light-bordered has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Medal-3"></i>
                        </div>
                        <div class="card-title">
                            <h4>Sonuç</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Sizin aracılığınız ile gerçekleşecek her satış için %10 kazanın!
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="has-text-centered">
                <button id="btn-change-display" class="button">Gizle</button>
            </div> --}}
        </div>
    </div>
</section>
<section class="section" id="section-list" data-background="{{ asset('images/bg/geometry2.png') }}" data-color="#000" data-color-opacity="0">
    <div class="container">
        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content">
                    <div class="columns is-vcentered is-gapless is-mobile no-margin padding-20">
                        <div class="column">
                            <h2 class="no-margin no-padding is-size-5">Gelir Ortaklığı</h2>
                        </div>
                        <div class="column has-text-right">
                            <a href="{{ route('user.partnership.add') }}" class="button is-info"><i class="im im-icon-Add-User"></i><span class="is-hidden-mobile">Yeni Referans Ekle</span></a>
                        </div>
                    </div>
                    <table class="responsive-table is-light-grey">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Durum</th>
                                <th>Ad Soyad</th>
                                <th>E-posta</th>
                                <th>Kanal</th>
                                <th>Kazanç</th>
                                <th>Ödeme</th>
                                <th>Eklenme Tarihi</th>
                                <th></th>
                            </tr>
                                @foreach($partnerships as $partnership)
                                <tr>
                                    <td data-th="ID" class="is-size-6 text-bold">
                                        #{{ $partnership->id }}
                                    </td>
                                    <td data-th="Durum">
                                        @if ($partnership->called)
                                            @if ($partnership->status)
                                                <span class="tag squared is-success">Onaylandı</span>
                                            @else
                                                <span class="tag squared is-danger">İptal Edildi</span>
                                            @endif
                                        @else
                                            <span class="tag squared is-info">Bekliyor</span>
                                        @endif
                                    </td>
                                    <td data-th="Ad Soyad">
                                        {{ $partnership->firstname }} {{ $partnership->lastname }}
                                    </td>
                                    <td data-th="E-posta">
                                        {{ $partnership->email }}
                                    </td>
                                    <td data-th="Kanal">
                                        @if ($partnership->channel=="form")
                                            Gelir Ortağı Form
                                        @else 
                                            Özel Paylaşım Linki
                                        @endif
                                    </td>
                                    <td data-th="Kazanç">
                                        @if ($partnership->price)
                                            {{ $partnership->price }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-th="Ödeme">
                                        @if ($partnership->price)
                                            @if ($partnership->paid)
                                                <span class="tag squared is-success">Ödendi</span>
                                            @else
                                            <span class="tag squared is-danger">Ödenmedi</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-th="Son Güncelleme">
                                        {{ Carbon\Carbon::parse($partnership->created_at)->format("d M Y, h:i") }}
                                    </td>
                                    <td data-th="İşlem">
                                        
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @if (count($partnerships) == 0) 
                    <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Referans kaydınız yok.</p>
                    @endif
                </div>
            </div>
        </div>
        {{ $partnerships->links() }}
    </div>
</section>
@endsection
@section('user-scripts')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
    if (Cookies.get('partnership-info') == undefined) {
        $('#section-info').css("display","block");
        $('#section-list').addClass('parallax is-relative');
    }
    $("#btn-change-display").click(function() {
        Cookies.set('partnership-info', '1', { expires: 30 });
        location.reload();
    });
    @if ($errors->any())
    iziToast.show({
        icon: 'fa fa-bell-o',
        title: 'Merhaba',
        message: '@foreach ($errors->all() as $error) {{ $error }} @endforeach',
        theme: 'dark',
        class: 'custom1',
        position: 'bottomCenter',
        displayMode: 2,
        transitionIn: 'flipInX',
        transitionOut: 'flipOutX',
        progressBarColor: '#4FC1EA',
        balloon: true,
        iconColor: '#fff'
    });
    @endif
</script>
@endsection