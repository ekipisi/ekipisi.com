@extends('layouts.app') 
@section('hero', 'is-relative is-theme-info is-bold') 
@section('static','false') 
@section('navbar',
'navbar-light') 
@section('hero-content')
<div id="main-hero" class="hero-body">
    <div class="container has-text-centered">
        <div class="columns is-vcentered">
            <div class="column is-12 has-text-left">
                <div class="breadcrumbs-container is-hidden-touch mb-10">
                    {{ Breadcrumbs::render() }}
                </div>
                <h1 class="title components-title is-3">
                    E-Ticaret İlave Modüller
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div id="scrollnavigation" class="scroll-nav-wrapper">
    <div class="container">
        <div class="tabs scrollnav-tabs is-centered">
            <ul>
                <li class="scrollnav-item is-active">
                    <a href="#section1">Ek Modüller</a>
                </li>
                {{-- <li class="scrollnav-item">
                    <a href="#section2">Tasarımsal Çalışmalar</a>
                </li> --}}
                <li>
                    <a href="#section3">Ek Hizmetler</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<section class="section is-medium parallax is-relative" data-background="{{ asset('images/bg/tech-pattern.png')}}" data-color="#000"
    data-color-opacity="0" id="section1">
    <div class="container">
        <div class="section-title-wrapper">
            <div class="bg-number">1</div>
            <h2 class="title section-title has-text-centered dark-text">Ek Modüller</h2>
            <div class="subtitle has-text-centered is-tablet-padded">
                Özel olarak ihtiyaç duyabileceğiniz ek modüllerimiz.
            </div>
        </div>
        <div class="content-wrapper">
            <div class="columns values-cards is-minimal is-vcentered is-gapless is-multiline">
                <!-- Card -->
                <div class="column">
                    <div class="feature-card  card-lg light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-File-Excel color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">XML ENTEGRASYONU</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Tedarikçiler ile entegrasyon yaparak, ürünlerinin otomatik olarak sitenize eklenmesini ve güncellenmesini sağlayabilirsiniz.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : ₺750 + KDV
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                            Satın Al <i class="sl sl-icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card  card-lg light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Car-Coins color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">SEPETTE İNDİRİM MODÜLÜ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Kampanya sepete atılan ürün adetleri arttıkça fiyatları azaltarak, tüketiciyi daha çok ürünü almaya teşvik etmektedir.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : ₺250 + KDV
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                            Satın Al <i class="sl sl-icon-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card  card-lg light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Printer color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">FATURA YAZDIRMA MODÜLÜ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Siparişlerin fatura olarak site üzerinden yazdırılabilmesi ve faturaya uygun dizaynın yapılabilmesine imkan sağlamaktadır.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : ₺350 + KDV
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                            Satın Al <i class="sl sl-icon-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card -->
                <div class="column">
                    <div class="feature-card  card-lg light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Support color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">MESAJLAŞMA MODÜLÜ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                    Müşteri ile tek bir platform üzerinden iletişimi sürdürebilir, hem müşterinin hem e-ticaret yöneticisinin geçmişe doğru tüm karşılıklı mesajlarına ulaşabilirsiniz.
                                </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : ₺650 + KDV
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                                Satın Al <i class="sl sl-icon-arrow-right"></i>
                            </a>
                    </div>
                </div>

                <!-- Card -->
                <div class="column">
                    <div class="feature-card  card-lg light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Upload-toCloud color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">ÇOKLU FOTOĞRAF YÜKLEME MODÜLÜ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                    Ürün fotoğraflarını sürükle bırak kolaylığında yükleyebileceğiniz, bir ürünün birden fazla fotoğrafını tek seferde yükleyebileceğiniz modüldür.
                                </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : ₺250 + KDV
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                                Satın Al <i class="sl sl-icon-arrow-right"></i>
                            </a>
                    </div>
                </div>

                <!-- Card -->
                <div class="column">
                    <div class="feature-card  card-lg light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Address-Book color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">ZİYARETÇİ DEFTERİ MODÜLÜ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                        Ziyaretçi defteri ile müşterilerinizin görüşlerini başka müşterileriniz ile paylaşın.
                                </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : ₺300 + KDV
                        </div>
                        <a href="#" class="button btn-align btn-more is-link color-primary">
                                Satın Al <i class="sl sl-icon-arrow-right"></i>
                            </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
{{-- <section class="section is-medium is-relative  section-feature-grey" id="section2">
    <div class="container">
        <div class="section-title-wrapper">
            <div class="bg-number">2</div>
            <h2 class="title section-title has-text-centered dark-text">Tasarımsal Çalışmalar</h2>
        </div>
        <div class="content-wrapper">
            <div class="columns values-cards is-minimal is-vcentered is-gapless is-multiline">
                <!-- Card -->
                <div class="column">
                    <div class="feature-card light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Big-Data color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">10GB TRAFİK</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Paket kapsamında yer alan trafik limiti dışında yeni trafik paketleri alarak limitinizi artırabilirsiniz.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : $3 + KDV
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Internet color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">ALAN ADI TESCİLİ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                E-Ticaret siteniz için yeni isimler tescil edip, sitenize yönlendirilmesini sağlayabilirsiniz.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : $15 + KDV
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-SSL color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">SSL SERTİFİKASI</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                SSL sertifikası bankaların sanal pos kurulumları için alınmak zorundadır.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : $30 + KDV
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section class="section is-medium parallax is-relative" data-background="{{ asset('images/bg/tools.svg') }}" data-color="#000" data-color-opacity="0"
    id="section3">
    <div class="container">
        <div class="section-title-wrapper">
            <div class="bg-number">2</div>
            <h2 class="title section-title has-text-centered dark-text">Ek Hizmetler</h2>
        </div>
        <div class="content-wrapper">
            <div class="columns values-cards is-minimal is-vcentered is-gapless is-multiline">
                <!-- Card -->
                <div class="column">
                    <div class="feature-card light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Big-Data color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">10GB TRAFİK</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                Paket kapsamında yer alan trafik limiti dışında yeni trafik paketleri alarak limitinizi artırabilirsiniz.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : $3 + KDV
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-Internet color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">ALAN ADI TESCİLİ</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                E-Ticaret siteniz için yeni isimler tescil edip, sitenize yönlendirilmesini sağlayabilirsiniz.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : $15 + KDV
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="column">
                    <div class="feature-card light-bordered hover-inset has-text-centered mb-20">
                        <div class="card-icon">
                            <i class="im im-icon-SSL color-primary"></i>
                        </div>
                        <div class="card-title">
                            <h4 class="color-primary">SSL SERTİFİKASI</h4>
                        </div>
                        <div class="card-feature-description">
                            <span class="">
                                SSL sertifikası bankaların sanal pos kurulumları için alınmak zorundadır.
                            </span>
                        </div>
                        <div class="is-link color-red pb-10 pt-10 has-text-weight-bold">
                            Fiyat : $30 + KDV
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection