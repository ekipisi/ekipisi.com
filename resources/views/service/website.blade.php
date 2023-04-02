@extends('layouts.app') 
@section('static','false') 
@section('navbar', 'navbar-light') 
@section('hero-content')
<div id="main-hero" class="hero-body">
    <div class="container has-text-centered">
        <div class="columns is-vcentered">
            <div class="column is-12 has-text-left">
                <div class="breadcrumbs-container is-hidden-touch mb-10">
                    {{ Breadcrumbs::render() }}
                </div>
                <h1 class="title components-title is-3">
                    Kurumsal Web Sitesi Çözümleri
                </h1>
                <p class="subtitle is-4 components-subtitle is-size-6">
                    İnternet üzerinde yer alan firmanız her gün her saat sektörünüz ile ilgili bilgi almak isteyen ziyaretçilerinize açık olacaktır.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<!-- Scrollnav -->
<div id="scrollnavigation" class="scroll-nav-wrapper">
    <div class="container">
        <div class="tabs scrollnav-tabs is-centered">
            <ul>
                <li class="scrollnav-item is-active">
                    <a href="#section1">Kurumsal Web Sitesi</a>
                </li>
                <li class="scrollnav-item">
                    <a href="#section2">Aşamalar</a>
                </li>
                <li class="scrollnav-item">
                    <a href="#section3">Site Özellikleri</a>
                </li>
                <li class="scrollnav-item">
                    <a href="#section4">Ek Hizmetler</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Scrollnav -->
<!-- Feature highlight -->
<section class="section is-medium parallax" data-background="{{ asset('images/bg/icon-bg-grey.png') }}" data-color="#000"
    data-color-opacity="0" id="section1">
    <div class="container">
        <!-- Title -->
        <div class="section-title-wrapper">
            <h2 class="title section-title has-text-centered dark-text">Kurumsal Web Sitesi</h2>
            <div class="subtitle has-text-centered is-tablet-padded">
                Web siteleri hedef kitlenizin firmanız hakkında bilgi sahibi olmalarını, ürün veya hizmetlerinizi ayrıntılı bir şekilde incelemelerini
                ve bu bağlamda size en kısa ve kolay şekilde ulaşmalarını, ürün ve hizmetleriniz ile ilgili gelişme ve yenilikleri
                hızlı ve kolay bir şekilde duyurmanızı sağlamaktadır.
            </div>
        </div>
        <div class="content-wrapper">
            <!-- Row -->
            <div class="columns">
                <!-- Featured image -->
                <div class="column is-6">
                    <div>
                        <figure class="image is-4-by-3">
                            <img class="first" src="{{ asset('images/illustrations/web-design.svg') }}" alt="">
                        </figure>
                    </div>
                </div>
                <!-- Content -->
                <div class="column is-5 is-offset-1 pt-80">
                    <p class="section-feature-description">
                        Profesyonelce tasarlanarak dizayn edilen, görsel, metinsel ve grafiksel anlamda tamamen sade ve estetik, akıcı, kurumunuzun
                        renkleri ve vizyonu ile uyumlu, sizi zenginleştici bir şekilde yansıtan ve temsil eden bir kurumsal
                        site tasarımı çalışması, ziyaretçilerinizin gözünde sizi kurumsal ve profesyonel bir firma olarak
                        göstererek, ürün veya hizmetinizin ne kadar kaliteli ve kullanışlı olduğu hakkında bilgi sahibi olmalarını
                        sağlayacaktır.
                    </p>
                    <p class="section-feature-description pt-30">
                        Profesyonelce tasarlanmamış, üzerinde emek harcanmadan, web tasarım ve estetik anlamında hiç bir zenginliği bulunmayan, sizi
                        veya kurumunuzu yansıtmayan bir kurumsal web sitesi kurmak, aksine sizi internet ortamında ziyaretçileriniz
                        ve hedef kitlenizin gözünde amatör ve kötü bir izlem yaratarak prestij ve müşteri kaybına yol açacaktır.
                    </p>
                    <p class="section-feature-description pt-30">
                        Web sitesi tasarımı firmanızın kurumsal kimliğinizle örtüşmelidir. İnternet sitenizi oluştururken kurumsal kimliğinizle tamamen
                        örtüşen, sizi en iyi şekilde temsil eden tasarımlar oluşturmak sizin ne kadar profesyonel bir firma
                        olduğunuzu gösterir.
                    </p>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </div>
</section>
<!-- /Feature highlight -->
<!-- Feature highlight -->
<section class="section is-medium is-relative section-feature-grey" id="section2">
    <div class="container">
        <!-- Title -->
        <div class="section-title-wrapper">
            <h2 class="title section-title has-text-centered dark-text">Web Tasarım Aşamaları;</h2>
        </div>
        <div class="content-wrapper">
            <!-- Row -->
            <!-- /Title -->
            <div class="columns">
                <div class="column is-12">
                    <div class="columns">
                        <div class="column">
                            <div class="solid-list">
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        Hedef müşterinin araştırılması,
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        İhtiyaç analizi, verilerin analizi ve çözüm önerileri geliştirilmesi,
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        Proje iş planı sunumu,
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        Teklif ve teklif onayı,
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        Genel konsept tasarımı,
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        Kod yapısı ile tasarımın uyumlulaştırılması,
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        Veri girişi ve Testler
                                    </div>
                                </div>
                                <div class="solid-list-item">
                                    <div class="list-bullet">
                                        <i class="sl sl-icon-check success-text"></i>
                                    </div>
                                    <div class="list-text">
                                        <strong>Yayına Geçiş.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="is-divider-vertical" data-content=""></div>
                        <div class="column">
                            <p>
                                Bu çalışmanın bitmesi, web tasarım projesinin önemli olan birinci adımıdır. Bu aşamalar bittiken sonra web sitenizin sürekli
                                güncellenmesi, sektörünüz ve firmanız ile ilgili yeniliklerin siteniz üzerinden yayınlanması
                                sitenizin izlenme sayılarını artıracak buda size yeni müşteriler kazanmak için fırsat oluşturacaktır.
                            </p>
                            <p class="pt-30">
                                Diğer aşama ise günümüzde etkisi çok büyük olan Arama Motoru Optimizasyonu çalışmalarının yapılmasıdır.
                            </p>
                            <p class="pt-30">
                                Arama Motoru Optimizasyonu çalışmaları ve Google Adwords, Facebook Ads vs. ile ilgili detaylı bilgi alabilmek için bizi arayabilirsiniz.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </div>
</section>
<!-- /Feature highlight -->
<!-- Learn more on features -->
<section class="section is-medium is-relative" id="section3">
    <div class="container has-text-centered">
        <div class="columns is-vcentered">
            <div class="column is-6 is-offset-3 has-text-centered">
                <div class="section-title-wrapper">
                    <h2 class="title dark-text text-bold main-title is-2">
                        Kurumsal Web Site Özellikleri
                    </h2>
                </div>
            </div>
        </div>
        <div class="columns is-vcentered is-multiline">
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Monitor-3 is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Full Dinamik Site</h5>
                        Hazırlanan Web Sayfasında Tüm içerikler dinamik olup, site yönetim panelinden tarafınızca sorunsuz şekilde istenildiğinde
                        değiştirilebilir, silinebilir, güncellenebilir,
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Photos is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Gelişmiş Galeri Yönetimi</h5>
                        Sitenizde Sınırsız şekilde Galeriler oluşturabilir sunum sayfaları hazırlayabilirsiniz.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Venn-Diagram is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Site Renk Akış Şeması</h5>
                        Kurumsal kimliğinizi yansıtacak renk kodlamaları yapılarak, sitenin tüm bölümlerinde içerik bağlantı geçişlerinde ve başlıklarında
                        renk uyumu sağlanır.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Bell is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Duyuru Yönetimi</h5>
                        Sitenizde yer almasını istediğiniz duyuruların eklendiği modüldür. Var olan duyuruları güncelleyebilir, silebilir veya yeni
                        duyuru ekleyebilirsiniz.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Optimization is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Dinamik Seo Yönetimi</h5>
                        Sitenizin temel SEO ayarlarının yapıldığı Site Yönetiminden girişi sağlanan Modülümüzdür. Ayrıca sitede her dil bölümü için
                        ayrıca seo çalışması yapılabilmektedir.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Film-Strip is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Slider Yönetimi</h5>
                        Katmanlı Slider Yönetimi ile sitenize canlılık, hareketllik katabilirsiniz bu sayede ziyaretçilerinizin dikkatini çekerek,web
                        sitenizin imajına katkıda bulunabilirsiniz.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Pen-6 is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Gelişmiş İçerik Sayfası Yönetimi</h5>
                        Sınırsız Alt Sayfa ve Grupları oluşturabilir. Her Alt Sayfaya Özel foto galeri,Video galeri ve Değişik tiplerde dökuman ekleme,
                        Dil modülllerine özel tanımlamalar yapabilirsiniz
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Film-Board is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Gelişmiş Video Galeri Yönetimi</h5>
                        Sitenizde sınırsız şekilde Video Galeriler oluşturup, kendi videolarınızı yükleyebilir yada Youtube gibi video sitelerinden
                        videolarınızı kolayca sitenize entegre edebilirsiniz.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Box-Close is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Ürün Yönetimi</h5>
                        Ürünlerinizin tanımıtımı için gelişmiş ürün yönetim sistemi. Sınırsız sayıda ürün ekleyebilirsiniz.
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
        </div>
    </div>
</section>
<!-- /Learn more on features -->
<!-- Learn more on features -->
<section class="section is-medium is-relative parallax" data-background="{{ asset('images/bg/tech-pattern.png') }}" data-color="#000"
    data-color-opacity="0" id="section4">
    <div class="container has-text-centered">
        <div class="columns is-vcentered">
            <div class="column is-8 is-offset-2 has-text-centered">
                <div class="section-title-wrapper">
                    <h2 class="title dark-text text-bold main-title is-3">
                        Kurumsal Web Siteleri İçin Sağladığımız Ek Hizmetler
                    </h2>
                </div>
            </div>
        </div>
        <div class="columns is-vcentered is-multiline">
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Kurumsal Kimlik Tasarımı</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Logo Tasarımı</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Çoklu Dil Desteği</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Profesyonel Fotoğraf Çekimi</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">İçerik Desteği</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Site Güncelleme Hizmeti</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Toplu Mail Gönderme Hizmeti</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Toplu Sms Gönderme Hizmeti</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Dijital Katalog</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Reklam Hizmetleri</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Hosting ve Alan Adı Tescili</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Yes is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Haritalara Kayıt</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
        </div>
    </div>
</section>
<!-- /Learn more on features -->
@endsection