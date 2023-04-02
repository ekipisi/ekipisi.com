@extends('layouts.app') 
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
                    Google Haritalara Kayıt
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<section class="section is-medium is-relative">
    <div class="container">
        <div class="content-wrapper">
            <div class="columns is-vcentered">
                <div class="column is-7 has-text-centered">
                    <img class="featured-svg" src="{{ asset('images/illustrations/mobile-map.svg') }}" alt="">
                </div>
                <div class="column is-5">
                    <h3 class="detailed-feature-subtitle">Google, Yandex</h3>
                    <h2 class="title is-3 no-margin">Haritalar</h2>
                    <div class="title-divider"></div>
                    <span class="section-feature-description">Akıllı telefonların kullanımı artmasıyla Google haritalarının önemi artmıştır. Artık neredeyse her Google
                            aramasında karşımıza harita çıkmaktadır. Bu haritalar sayesinde müşterileriniz firmanıza lokasyon
                            olarak daha çabuk ulaşmasını sağlayabiliriz. Google haritaları sadece konumuzu göstermez. Burada
                            telefon numaralarınızı, site adresinizi, e-mail adresinizi, çalışma saatleriniz gibi birçok bilgiyi
                            paylaşabilirsiniz. Google Haritanızı istediğiniz zaman düzenleme yapabilirsiniz. Bölgesel bir değişilik
                            yapmadığınız süre zarfında tekrardan doğrulama istemez.</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-feature-grey is-medium">
    <div class="container">
        <div class="content-wrapper">
            <div class="columns is-vcentered">
                <div class="column is-7 has-text-centered is-hidden-tablet is-hidden-desktop">
                    <img class="featured-svg" src="{{ asset('images/illustrations/mobile-map.svg') }}" alt="">
                </div>
                <div class="column is-5 has-text-left">
                    <h2 class="title is-3 no-margin">Google Harita Kaydını Neden Yaptırmalıyım?</h2>
                    <div class="title-divider is-left"></div>
                    <div class="section-feature-description">
                        <div class="solid-list">
                            <div class="solid-list-item">
                                <div class="list-bullet">
                                    <i class="material-icons">done</i>
                                </div>
                                <div class="list-text">
                                    Hedef müşterinin araştırılması,
                                </div>
                            </div>
                            <div class="solid-list-item">
                                <div class="list-bullet">
                                    <i class="material-icons">done</i>
                                </div>
                                <div class="list-text">
                                    İhtiyaç analizi, verilerin analizi ve çözüm önerileri geliştirilmesi,
                                </div>
                            </div>
                            <div class="solid-list-item">
                                <div class="list-bullet">
                                    <i class="material-icons">done</i>
                                </div>
                                <div class="list-text">
                                    Google'un hizmeti olan harita kaydı ile Google aramalrında ilk sayfaya çıkabilmek için yaptırmalısınız.
                                </div>
                            </div>
                            <div class="solid-list-item">
                                <div class="list-bullet">
                                    <i class="material-icons">done</i>
                                </div>
                                <div class="list-text">
                                    Müşterileriniz firmanızı daha kolay bulabilmesi için yaptırmalısınız. Akıllı telefonlarda Google haritalarında konumunuzu
                                    aratarak bulabilirler.
                                </div>
                            </div>
                            <div class="solid-list-item">
                                <div class="list-bullet">
                                    <i class="material-icons">done</i>
                                </div>
                                <div class="list-text">
                                    Google haritaları, Google'un gözünde değeriniz arttırır. Bu nedenle de Seo'ya katkısıda vardır.
                                </div>
                            </div>
                            <div class="solid-list-item">
                                <div class="list-bullet">
                                    <i class="material-icons">done</i>
                                </div>
                                <div class="list-text">
                                    Sitenizi Google haritalarına eklediyseniz, Adwords reklamlarınızda konum işaretleme yapabilme şansı vermektedir.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-7 has-text-centered is-hidden-mobile">
                    <img class="featured-svg" src="{{ asset('images/illustrations/haritalar.svg') }}" alt="">
                </div>
            </div>
        </div>
</section>
<!-- Learn more on features -->
<section class="section is-medium is-relative">
    <div class="container has-text-centered">
        <div class="columns is-vcentered">
            <div class="column is-8 is-offset-2 has-text-centered">
                <div class="section-title-wrapper">
                    <h2 class="title dark-text text-bold main-title is-3">
                        Google Harita Kaydı İle Nerelerde Çıkarım?
                    </h2>
                </div>
            </div>
        </div>
        <div class="columns is-vcentered">
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Engineering is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Google'da yapılan sektörel aramalarda</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Edit-Map is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Google harita (Adres) aramalarında</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
            <div class="column is-4">
                <!-- Side icon box -->
                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-VPN is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Navigasyon cihazlarında</h5>
                    </div>
                </div>
                <!-- /Side icon box -->
            </div>
        </div>
        <div class="pt-20 pb-20"></div>
        <div class="columns is-vcentered">
            <div class="column is-8 is-offset-2">
                <article class="message icon-msg accent-msg">
                    <i class="material-icons">info</i>
                    <div class="message-body">
                        <strong>Bilgi:</strong>Yukarıdaki kriterlerin gerçekleşmesi google tarafından onaylanması sonucunda
                        olmaktadır. Bize düşen görev açılan haritayı aktif bir şekilde yönetmektir.
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<!-- /Learn more on features -->
<section class="section is-medium is-relative section-feature-grey">
    <div class="container">
        <div class="content-wrapper">
            <div class="section-title-wrapper">
                <div class="bg-number">?</div>
                <h2 class="title section-title has-text-centered dark-text">Google Harita Kaydı Ne Kadar Sürede Tamamlanır?</h2>
                <div class="subtitle has-text-centered is-tablet-padded">
                    Ekipişi olarak Google harita kayıt işlemini bünyeminde hemen yapılmaktadır. Google harita başburusu yapanken, gmail hesabı
                    ve firmanızın iletişim bilgileri gerekmektedir. Kayıt başvurusunu doğrulamanın 5 yöntemi bulunmaktadır.
                    Bunlar;
                </div>
            </div>
            <span class="section-feature-description has-text-left">
                    <div class="solid-list">
                        <div class="solid-list-item">
                            <div class="list-bullet pt-10">
                                <i class="material-icons">done</i>
                            </div>
                            <div class="list-text">
                                <strong>Posta Kartıyla Doğrulama</strong>
                                <br />
                                <p>
                                    Başvuru yapıldıktan sonra 14 gün içerisinde Google'dan gelen kod ile harita aktif edilmektedir. Bazen kod tarafınıza ulaşmadığında
                                    Google ile iletişime geçip haritayı aktif ettiriyoruz.
                                </p>
                            </div>
                        </div>
                        <div class="solid-list-item pt-10">
                            <div class="list-bullet">
                                <i class="material-icons">done</i>
                            </div>
                            <div class="list-text">
                                <strong>Telefonla Doğrulama (Yalnızca belirli işletmelerde kullanılabilir)</strong>
                                <p>
                                    Google tarafından aranıp kod verilmektedir. Kod ile haritayı aktif ettiten sonra haritanız hemen aktif olacaktır. Telefonla
                                    doğrulama tüm işletmeler için kullanılabilir bir seçenek değildir. Doğrulama işlemi sırasında
                                    bu seçeneği görmezseniz başka bir doğrulama yöntemini deneyin.
                                </p>
                            </div>
                        </div>
                        <div class="solid-list-item pt-10">
                            <div class="list-bullet">
                                <i class="material-icons">done</i>
                            </div>
                            <div class="list-text">
                                <strong>E-postayla Doğrulama (Yalnızca belirli işletmelerde kullanılabilir)</strong>
                                <p>Google tarafından mail adresinize kod gelmektedir. Kod ile haritayı aktif ettiten sonra haritanız
                                    hemen aktif olacaktır. E-postayla doğrulama tüm işletmeler için kullanılabilir bir seçenek
                                    değildir. Doğrulama işlemi sırasında bu seçeneği görmezseniz başka bir doğrulama yöntemini
                                    deneyin.
                                </p>
                            </div>
                        </div>
                        <div class="solid-list-item pt-10">
                            <div class="list-bullet">
                                <i class="material-icons">done</i>
                            </div>
                            <div class="list-text">
                                <strong>Anında Doğrulama (Yalnızca belirli işletmelerde kullanılabilir)</strong>
                                <p>Firmanızın web sitesini Google Search Console ile önceden doğruladıysanız, firmanızın haritasını
                                    yönetmeniz için gerekli doğrulama işleminin anında yapılma olasılığı da vardır. Bazı işletme
                                    kategorilerinin anında doğrulama için uygun olmayabileceğini unutmayın.</p>
                            </div>
                        </div>
                        <div class="solid-list-item pt-10">
                            <div class="list-bullet">
                                <i class="material-icons">done</i>
                            </div>
                            <div class="list-text">
                                <strong>Toplu Doğrulama (10'dan fazla farklı konuma sahip işletmeler tarafından kullanılabilir)</strong>
                                <p>Aynı firmaya ait 10'dan fazla şube varsa, haritalarını tek seferde ekleme fırsatı vermektedir.
                                    Google My Business Konumları ile doğrulama için uygun bir firma olabilirsiniz.</p>
                            </div>
                        </div>
                    </div>
                </span>
        </div>
    </div>
</section>
@endsection