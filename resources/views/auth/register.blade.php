@extends('layouts.auth')
@section('scripts')
<script src="{{ asset('js/signup.js') }}"></script>
@endsection
@section('content')
<section class="section parallax is-relative" data-background="{{ asset('images/bg/tech-pattern.png') }}" data-color="#000" data-color-opacity="0">
    <div class="container">
        <div class="columns">
            <div class="column is-2 is-offset-5">
                <div>
                    <figure class="image is-4-by-3">
                        <a href="{{ route('home') }}" class="signup-logo">
                            <img class="first" src="{{ asset('images/logos/ekipisi-blue-logo.svg') }}" alt="">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
        <div class="columns is-vcentered">
            <div class="column is-8 is-offset-2">
                <div class="flex-card light-bordered light-raised">
                    <div class="card-body">
                        @if ($errors->any())
                        <article class="message danger-msg">
                            <div class="message-body">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br />
                                @endforeach
                            </div>
                        </article>
                        @endif
                        <form id="signup-form" action="{{ route('register') }}" method="post">
                            {{ csrf_field() }}
                        <h3><span><i class="fa fa-question-circle"></i></span>{{ __('auth.register.step.basic') }}</h3>
                            <section>
                                <p class="has-text-centered text-bold mt-30">{{ __('auth.register.step.basic.info') }}</p>
                                <div class="columns mt-10">
                                    <div class="column is-6">
                                        <label for="firstname">{{ __('auth.register.step.basic.firstname') }}</label>
                                        <input type="text" class="required input is-medium mt-5" name="firstname" id="firstname" value="{{ $firstname or old('firstname') }}" />
                                        @if ($errors->has('firstname'))
                                            <p class="is-danger">{{ $errors->first('firstname') }}</p>
                                        @endif
                                    </div>
                                    <div class="column is-6">
                                        <label for="lastname">{{ __('auth.register.step.basic.lastname') }}</label>
                                        <input type="text" class="required input is-medium mt-5" name="lastname" id="lastname" value="{{ $lastname or old('lastname') }}" />
                                        @if ($errors->has('lastname'))
                                            <p class="is-danger">{{ $errors->first('lastname') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column is-12">
                                        <label for="email">{{ __('auth.register.step.basic.email') }}</label>
                                        <input type="email" class="required email input is-medium mt-5" name="email" id="email" value="{{ $email or old('email') }}" />
                                        @if ($errors->has('email'))
                                            <p class="is-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </section>
                         
                            <h3><span><i class="fa fa-university"></i></span>{{ __('auth.register.step.contact') }}</h3>
                            <section>
                                <div class="columns">
                                    <div class="column is-12">
                                    <label for="address">{{ __('auth.register.step.contact.address') }}</label>
                                        <textarea class="textarea is-grow mt-5 required" rows="5" name="address" id="address">{{ $address or old('address') }}</textarea>
                                    </div>
                                </div>
                                <div class="columns mt-10">
                                    <div class="column is-4">
                                        <label for="country">{{ __('auth.register.step.contact.country') }}</label>
                                        <div class="select mt-5">
                                            <select class="required" name="country" id="country">
                                                <option selected="selected" value="">{{ __('auth.register.step.contact.country.select') }}</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ ($country->id==215)?"selected":"" }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <label for="city">{{ __('auth.register.step.contact.city') }}</label>
                                        <div class="select mt-5">
                                            <select class="required" name="city" id="city">
                                                <option selected="selected" value="">{{ __('auth.register.step.contact.city.select') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <label for="state">{{ __('auth.register.step.contact.state') }}</label>
                                        <input type="text" class="input is-medium mt-5 required" name="state" id="state" value="{{ $state or old('state') }}" />
                                    </div>
                                </div>
                                <div class="columns mt-10">
                                    <div class="column is-6">
                                        <label for="phone">{{ __('auth.register.step.contact.phone') }}</label>
                                        <input type="text" class="input is-medium mt-5" name="phone" id="phone" value="{{ $phone or old('phone') }}" />
                                    </div>
                                    <div class="column is-6">
                                        <label for="mobile">{{ __('auth.register.step.contact.mobile') }}</label>
                                        <input type="text" class="input is-medium mt-5 required" name="mobile" id="mobile" value="{{ $mobile or old('mobile') }}" />
                                    </div>
                                </div>
                            </section>

                        <h3><span><i class="fa fa-user"></i></span>{{ __('auth.register.step.type') }}</h3>
                            <section>
                                <p class="has-text-centered text-bold mt-30">
                                    {{ __('auth.register.step.type.info') }}
                                    <input type="text" class="required user_type" data-msg="Lütfen kullanıcı tipini seçin." id="user_type" name="user_type" value="{{ $user_type or old('user_type') }}" /> 
                                </p>
                                <div class="buttons has-addons is-centered">
                                    <a class="button is-medium" id="btnKurumsal">
                                        <span class="icon is-medium">
                                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                                        </span>
                                        <span>{{ __('auth.register.step.type.corporate') }}</span>
                                    </a>
                                    <a class="button is-medium" id="btnBireysel">
                                        <span class="icon is-medium">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        <span>{{ __('auth.register.step.type.person') }}</span>
                                    </a>
                                </div>
                                <div id="kurumsal" style="display:none">
                                    <div class="columns mt-10">
                                        <div class="column is-6">
                                            <label for="tax_no">{{ __('auth.register.step.type.corporate.tax.no') }}</label>
                                            <input type="text" data-inputmask="'mask': '9{1,11}'" class="input is-medium mt-5 required" name="tax_no" id="tax_no" value="{{ $tax_no or old('tax_no') }}" />
                                        </div>
                                        <div class="column is-6">
                                            <label for="tax_office" style="display:block">{{ __('auth.register.step.type.corporate.tax.office') }}</label>
                                            <div id="tax_office_container">
                                                <div class="select mt-5">
                                                    <select class="required" name="tax_office" id="tax_office">
                                                        <option selected="selected" value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="columns">
                                        <div class="column is-12">
                                            <label for="company_name">{{ __('auth.register.step.type.corporate.company') }}</label>
                                            <input type="text" class="input is-medium mt-5 required" name="company_name" id="company_name" value="{{ $company_name or old('company_name') }}" />
                                        </div>
                                    </div>
                                </div>
                                <div id="bireysel" style="display:none">
                                    <div class="columns">
                                        <div class="column is-8">
                                        <label for="identity_no">{{ __('auth.register.step.type.person.identity.no') }}</label>
                                            <input type="text" data-inputmask="'mask': '9{1,11}'" class="input is-medium mt-5 required" tckimlikno="true" name="identity_no" id="identity_no" value="{{ $identity_no or old('identity_no') }}" />
                                        </div>
                                        <div class="column is-4">
                                            <label for="birthday">{{ __('auth.register.step.type.person.birthyear') }}</label>
                                            <input type="text" data-inputmask="'mask': '9{1,4}'" class="input is-medium mt-5 required" name="birthday" id="birthday" value="{{ $birthday or old('birthday') }}" />
                                        </div>
                                    </div>
                                    <p class="has-text-centered">{{ __('auth.register.step.type.person.info') }}</p>
                                </div>
                            </section>
                         
                        <h3><span><i class="fa fa-check-circle"></i></span>{{ __('auth.register.step.confirm') }}</h3>
                            <section>
                                <p class="has-text-centered text-bold mt-30">
                                {{ __('auth.register.step.confirm.info') }}
                                </p>
                                <div class="columns mt-10">
                                    <div class="column is-6">
                                    <label for="password">{{ __('auth.register.step.confirm.password') }}</label>
                                        <input type="password" class="input is-medium mt-5 required" name="password" id="password" />
                                    </div>
                                    <div class="column is-6">
                                        <label for="confirm">{{ __('auth.register.step.confirm.password.confirm') }}</label>
                                        <input type="password" class="input is-medium mt-5 required" name="password_confirmation" id="password_confirmation" />
                                    </div>
                                </div>
                            </section>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="copyright has-text-centered no-padding no-margin">
            <span class="moto dark-text">{{ __('global.ekipisi') }}
                <i class="fa fa-heart color-red"></i> {{ __('global.solutions') }}</span>
        </div>
    </div>
</section>
@endsection
