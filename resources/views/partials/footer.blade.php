<footer id="dark-footer" class="footer footer-dark">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="footer-column">
                    <div class="footer-header">
                        <h3>{{ __('navigation.service') }}</h3>
                    </div>
                    <ul class="link-list">
                        <li>
                            <a href="{{ route('service.project') }}" onclick="handleGaClick('Footer','{{ __('navigation.service.project') }}')">{{ __('navigation.service.project') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('service.website') }}" onclick="handleGaClick('Footer','{{ __('navigation.service.website') }}')">{{ __('navigation.service.website') }}</a>
                        </li>
                        <li>
                        <a href="{{ route('service.google') }}" onclick="handleGaClick('Footer','{{ __('navigation.service.google') }}')">{{ __('navigation.service.google') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="column">
                <div class="footer-column">
                    <div class="footer-header">
                        <h3>{{ __('navigation.product') }}</h3>
                    </div>
                    <ul class="link-list">
                        <li>
                            <a href="{{ route('product.ecommerce.pack') }}" onclick="handleGaClick('Footer','{{ __('navigation.product.ecommerce.pack') }}')">{{ __('navigation.product.ecommerce.pack') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('product.ecommerce.module') }}" onclick="handleGaClick('Footer','{{ __('navigation.product.ecommerce.module') }}')">{{ __('navigation.product.ecommerce.module') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="column">
                <div class="footer-column">
                    <div class="footer-header">
                        <h3>{{ __('global.ekipisi') }}</h3>
                    </div>
                    <ul class="link-list">
                        <li>
                            <a href="{{ route('about') }}" onclick="handleGaClick('Footer','{{ __('navigation.whoweare') }}')">{{ __('navigation.whoweare') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('payment') }}" onclick="handleGaClick('Footer','{{ __('navigation.payment') }}')">{{ __('navigation.payment') }}</a>
                        </li>
                    </ul>
                    <div class="footer-header mt-10">
                        <h3>{{ __('navigation.customer.center') }}</h3>
                        <ul class="link-list">
                            <li>
                                <a href="{{ route('user.faq.home') }}" onclick="handleGaClick('Footer','{{ __('navigation.customer.center.faq') }}')">{{ __('navigation.customer.center.faq') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('user.support.home') }}" onclick="handleGaClick('Footer','{{ __('navigation.customer.center.ticket') }}')">{{ __('navigation.customer.center.ticket') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="footer-column">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logos/ekipisi-white-logo.svg') }}" alt="">
                    </div>
                    <div class="footer-header">
                        <nav class="level is-mobile">
                            <div class="level-left level-social">
                                <a href="{{ config('social.facebook') }}" onclick="handleGaClick('Social','Facebook')" title="Ekipişi Facebook" aria-label="Ekipişi Facebook" class="level-item external">
                                    <span class="icon">
                                        <i class="fa fa-facebook"></i>
                                    </span>
                                    <span class="is-hidden">Ekipişi Facebook</span>
                                </a>
                                <a href="{{ config('social.instagram') }}" onclick="handleGaClick('Social','Instagram')" title="Ekipişi Instagram" aria-label="Ekipişi Instagram" class="level-item external">
                                    <span class="icon">
                                        <i class="fa fa-instagram"></i>
                                    </span>
                                    <span class="is-hidden">Ekipişi Instagram</span>
                                </a>
                                <a href="{{ config('social.linkedin') }}" onclick="handleGaClick('Social','Linkedin')" title="Ekipişi Linkedin" aria-label="Ekipişi Linkedin" class="level-item external">
                                    <span class="icon">
                                        <i class="fa fa-linkedin"></i>
                                    </span>
                                    <span class="is-hidden">Ekipişi Linkedin</span>
                                </a>
                                <a href="{{ config('social.youtube') }}" onclick="handleGaClick('Social','Youtube')" title="Ekipişi Youtube" aria-label="Ekipişi Youtube" class="level-item external">
                                    <span class="icon">
                                        <i class="fa fa-youtube"></i>
                                    </span>
                                    <span class="is-hidden">Ekipişi Youtube</span>
                                </a>
                                <a href="{{ config('social.github') }}" onclick="handleGaClick('Social','Github')" title="Ekipişi Github" aria-label="Ekipişi Github" class="level-item external">
                                    <span class="icon">
                                        <i class="fa fa-github"></i>
                                    </span>
                                    <span class="is-hidden">Ekipişi Github</span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="level footer-level">
            <div class="level-left">
                <p class="level-item">
                    {{ __('global.copyright', ['year' => date("Y")]) }}
                </p>
                <p class="level-item">
                    <span class="has-text-left light-text is-text-6 ekipisi">
                    <a href="https://www.ekipisi.com.tr" title="{{ __('global.solutions') }}">{{ __('global.ekipisi') }}</a>&nbsp;<i class="fa fa-heart color-red"></i>&nbsp;{{ __('global.solutions') }}</span>
                </p>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <img src="{{ asset('images/logos/mc_vrt_rgb_rev.png') }}" width="24" height="19 " alt="Master Card" class="mr-10" />
                    <img src="{{ asset('images/logos/visa_inc_logo.png') }}" width="59" height="19" alt="Visa Card" />
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="backtotop"><a href="#"></a></div>