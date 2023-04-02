<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">{{ __('navigation.product.ecommerce') }}</a>
    <div class="navbar-dropdown is-boxed is-large">
        <a class="navbar-item is-menu" href="{{ route('product.ecommerce.pack') }}" onclick="handleGaClick('Navigation','{{ __('navigation.product.ecommerce.pack') }}')">
            <i class="material-icons">shopping_cart</i> 
            <span>{{ __('navigation.product.ecommerce.pack') }}</span>
        </a>
        <a class="navbar-item is-menu" href="{{ route('product.ecommerce.module') }}" onclick="handleGaClick('Navigation','{{ __('navigation.product.ecommerce.module') }}')">
            <i class="material-icons">wb_incandescent</i> 
            <span>{{ __('navigation.product.ecommerce.module') }}</span>
        </a>
    </div>
</div>

<div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link" href="#">{{ __('navigation.service') }}</a>
    <div class="navbar-dropdown is-boxed is-large">
        <a class="navbar-item is-menu" href="{{ route('service.project') }}" onclick="handleGaClick('Navigation','{{ __('navigation.service.project') }}')">
            <i class="material-icons">code</i> 
            <span>{{ __('navigation.service.project') }}</span>
        </a>
        <a class="navbar-item is-menu" href="{{ route('service.website') }}" onclick="handleGaClick('Navigation','{{ __('navigation.service.website') }}')">
            <i class="material-icons">important_devices</i> 
            <span>{{ __('navigation.service.website') }}</span>
        </a>
    </div>
</div>

<a class="navbar-item is-slide" href="{{ route('reference') }}" onclick="handleGaClick('Navigation','{{ __('navigation.references') }}')">{{ __('navigation.references') }}</a>
<a class="navbar-item is-slide" href="{{ route('about') }}" onclick="handleGaClick('Navigation','{{ __('navigation.about') }}')">{{ __('navigation.about') }}</a>
<a class="navbar-item is-slide" href="{{ route('contact') }}" onclick="handleGaClick('Navigation','{{ __('navigation.contact') }}')">{{ __('navigation.contact') }}</a>