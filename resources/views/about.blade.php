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
                    {{ __('about.title') }}
                </h1>
                <p class="subtitle is-4 components-subtitle is-size-6">
                    2013 yılında kurulan Ekipişi Yazılım ve Danışmanlık Hizmetleri, gelişme anlayışını benimsemiş, nitelikli çalışanları, bilişim
                    teknolojileri alanında artan bilgi ve deneyimleri ile sürekli gelişen kalite ve hizmet anlayışı ile,
                    çeşitli sektörlerde faaliyet gösteren orta ve büyük segmentteki kurumlara bilişim alanında hizmet vermektedir.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-12">
                <div class="content">
                    <h2 class="title is-3 mt-10">Biz Kimiz</h2>
                    <p class="is-size-5 mt-20">
                        Ürün ve hizmetlerini sunarken, müşterilerinin ihtiyaçlarına en uygun ve en yenilikçi çözümlere odaklanan Ekipişi Yazılım
                        ve Danışmanlık Hizmetleri, teknolojik gelişmeleri sadece takip eden değil; gelişime açık, yenilikçi
                        ve geniş vizyonuyla, müşterilerine katma değerli çözümler sunan bir kurumdur. Müşterilerinin kârlılığını
                        ve verimliliğini arttıracak teknoloji ve uygulamaları, ölçeklenebilir bir yapıda yine müşterilerinin
                        ihtiyaçları doğrultusunda sunan Ekipişi Yazılım ve Danışmanlık Hizmetleri, sağlam alt yapısı ve uzman
                        kadrosu ile yoluna devam etmektedir.
                    </p>
                    <h3 class="title is-4 mt-30">Vizyonumuz</h3>
                    <p class="is-size-5 mt-20">
                        Ulusal ve uluslararası kurumsal pazarda, müşterimizle beraber büyüyerek sektörün önde gelen proje bazlı lider iş ortağı olmak.
                    </p>
                    <h3 class="title is-4 mt-30">Misyonumuz</h3>
                    <div class="solid-list">
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Özel yazılım çözümleri üretmek,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Üretirken müşteri memnuniyetinin ötesini, müşteri heyecanını ve bağlılığını gözetmek,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Kazan-kazan denklemine ulaşmaksızın üretim sürecini noktalamamak,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Nitelikli, rekabetçi ve fark yaratan çözümler ortaya koymak.
                            </div>
                        </div>
                    </div>
                    <h2 class="title is-3 mt-50">Kalite Politikamız</h2>
                    <p class="is-size-5 mt-20">
                        Üretimimizin genel kapsamı; teknolojiden ve yüksek kaliteden ödün vermeden, maliyetlerin düşük seviyelerde tutulması, tüketicilerimizin
                        üretimle ilgili bilinçlendirilmeleri, teknik ihtiyaçları konusunda yönlendirilmeleri, eğitimleri
                        ve ödünsüz kalite politikamızdır. Bu hedefimize ulaşırken, çevre ve insan sağlığı ile ilgili sanayileşmiş
                        uygar toplumlarda alınması zorunlu her türlü önlemin alınması, ihmal etmeyeceğimiz çalışma prensibimizdir.
                    </p>
                    <h3 class="title is-4 mt-30">Kalite hedefleri aşağıda verildiği gibidir;</h3>
                    <div class="solid-list">
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Satışını yaptığımız tüm ürünlerimizin verilen teminlerinin % 98 oranında gerçekleşmesini sağlamak,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Müşteri şikayetlerini % 10 oranında azaltmak,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Üretim kapasitemizin bir önceki yıla göre % 15 oranında artmasını sağlamak,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Geri dönen ürünlerin oranını % 2’nin altında tutmak,
                            </div>
                        </div>
                        <div class="solid-list-item">
                            <div class="list-bullet">
                                <i class="sl sl-icon-check success-text"></i>
                            </div>
                            <div class="list-text">
                                Yapılması düşünülen tüm tasarım faaliyetlerini en geç 15 gün içinde sonuçlandırmak.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection