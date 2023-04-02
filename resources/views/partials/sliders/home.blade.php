<div class="hero-slider" data-carousel>
    <div class="carousel-cell cell-ecommerce-mucadele is-vertical-center">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-6">
                        <figure class="">
                            <img src="{{ asset('images/illustrations/mucadele.svg') }}" alt="">
                        </figure>
                    </div>
                    <div class="column is-5 is-offset-1 has-text-centered is-hero-title">
                        <h1 class="title is-2">
                            Yıl Sonuna Kadar Tüm Paketlerde ₺500 İndirim Fırsatı
                        </h1>
                        <h2 class="subtitle is-4">
                            Sanal Mağazanı Kur, Kazanmaya Hemen Başla.
                        </h2>
                        <p class="">
                            <a href="#" class="button button-cta is-bold btn-align danger-btn raised modal-trigger" data-modal="ucretsiz-denemeye-basla-modal"  onclick="handleGaClick('Slider Modal','Demo Talebi')">
                                Ücretsiz Denemeye Başla
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="carousel-cell cell-website">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-5 has-text-centered is-hero-title">
                        <h1 class="title is-2 is-bigger">
                            Şık ve Modern
                        </h1>
                        <h2 class="subtitle is-4">
                            bir web sitesine sahip olmak artık çok kolay!
                        </h2>
                        <p class="">
                            <a href="{{ route('service.website') }}" onclick="handleGaClick('Slider','{{ __('navigation.service.website') }}')" class="button button-cta is-bold btn-align secondary-btn raised">
                                Detayları İncele
                            </a>
                        </p>
                    </div>
                    <div class="column is-6 is-offset-1">
                        <figure class="">
                            <img src="{{ asset('images/illustrations/web-sitesi.svg') }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>