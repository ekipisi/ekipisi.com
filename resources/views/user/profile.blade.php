@extends('layouts.user') 
@section('section')
<section class="section">
    <div class="container">

        @if (!Auth::user()->address)
        <div class="alert alert-warning">
            İşlemlerinize devam edebilmeniz için, eksik bilgilerinizi doldurmanız gerekiyor.
        </div>
        <div class="mb-30"></div>
        @endif

        <div class="columns">
            @include('user/partials/menu/profile')
            <div class="column is-9">
                <div class="flex-card light-bordered light-raised">
                    <div class="card-body">
                        <div class="content">
                            <h2 class="no-margin is-size-5">{{ __('user.profile.title') }}</h2>
                            <form class="validate-with-message" method="post" action="{{ route('user.profile') }}">
                                {{ csrf_field() }}
                                <div class="columns mt-10">
                                    <div class="column is-6">
                                        <label for="firstname">Ad</label>
                                        <input type="text" disabled="disabled" class="input is-large is-size-6 mt-5" name="firstname" id="firstname" value="{{ $firstname or old('firstname') }}"
                                            required/>
                                    </div>
                                    <div class="column is-6">
                                        <label for="lastname">Soyad</label>
                                        <input type="text" disabled="disabled" class="input is-large is-size-6 mt-5" name="lastname" id="lastname" value="{{ $lastname or old('lastname') }}"
                                            required/>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column is-12">
                                        <label for="email">E-posta</label>
                                        <input type="email" disabled="disabled" class="required email input is-large is-size-6 mt-5" name="email" id="email" value="{{ $email or old('email') }}"
                                        />
                                    </div>
                                </div>
                                @if (Auth::user()->address)
                                <h4 class="mt-50">Sosyal Medya Hesaplarınla İlişkilendir</h4>
                                <div class="level-left mb-40">
                                    <div class="level-item">
                                        @if ($social && $social->facebook_id)
                                            <a href="{{ route('user.social.cancel', 'facebook') }}" class="button social-btn facebook raised"><i class="fa fa-facebook-f"></i> Facebook ile Bağlantıyı Kes</a>
                                        @else
                                            <a href="{{ url('login/facebook') }}" class="button social-btn facebook raised"><i class="fa fa-facebook-f"></i> Facebook ile Bağlan</a>
                                        @endif
                                    </div>
                                    <div class="level-item">
                                        @if ($social && $social->linkedin_id)
                                            <a href="{{ route('user.social.cancel', 'linkedin') }}" class="button social-btn linkedin raised"><i class="fa fa-linkedin"></i> Linkedin ile Bağlantıyı Kes</a>
                                        @else
                                            <a href="{{ url('login/linkedin') }}" class="button social-btn linkedin raised"><i class="fa fa-linkedin"></i> Linkedin ile Bağlan</a>
                                        @endif
                                    </div>
                                    <div class="level-item">
                                        @if ($social && $social->google_id)
                                            <a href="{{ route('user.social.cancel', 'google') }}" class="button social-btn google raised"><i class="fa fa-google"></i> Google ile Bağlantıyı Kes</a>
                                        @else
                                            <a href="{{ url('login/google') }}" class="button social-btn google raised"><i class="fa fa-google"></i> Google ile Bağlan</a>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <h4 class="mt-50">Adres Bilgileri</h4>
                                <div class="columns">
                                    <div class="column is-12">
                                        <label for="address">Adres</label>
                                        <textarea class="textarea is-grow mt-5 is-secondary-focus required" rows="5" name="address" id="address">{{ $address or old('address') }}</textarea>
                                    </div>
                                </div>
                                <div class="columns mt-10">
                                    <div class="column is-4">
                                        <label for="country" class="is-block">Ülke</label>
                                        <div class="select is-large is-fullwidth mt-5">
                                            <select class="required" name="country" id="country">
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ ($country->id==215)?"selected":"" }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <label for="city" class="is-block">Şehir</label>
                                        <div class="select is-large is-fullwidth mt-5">
                                            <select class="required" name="city" id="city"></select>
                                        </div>
                                    </div>
                                    <div class="column is-4">
                                        <label for="state">İlçe</label>
                                        <input type="text" class="input is-large is-size-6 mt-5 required" name="state" id="state" value="{{ $state or old('state') }}"
                                        />
                                    </div>
                                </div>
                                <div class="columns mt-10">
                                    <div class="column is-6">
                                        <label for="phone">Telefon</label>
                                        <input type="text" class="input is-large is-size-6 mt-5" name="phone" id="phone" value="{{ $phone or old('phone') }}" />
                                    </div>
                                    <div class="column is-6">
                                        <label for="lastname">Cep Telefonu</label>
                                        <input type="text" class="input is-large is-size-6 mt-5 required" name="mobile" id="mobile" value="{{ $mobile or old('mobile') }}"
                                        />
                                    </div>
                                </div>

                                <h4 class="mt-50">Fatura Bilgileri <small>({{ $company_type ? "Kurumsal" : "Bireysel" }} Kullanıcı)</small></h4>
                                @if ($company_type)
                                <div class="columns mt-10">
                                    <div class="column is-6">
                                        <label for="tax_no">Vergi Numaranız</label>
                                        <input type="text" data-inputmask="'mask': '9{1,11}'" class="input is-large is-size-6 mt-5 required" name="tax_no" id="tax_no"
                                            value="{{ $tax_no or old('tax_no') }}" />
                                    </div>
                                    <div class="column is-6">
                                        <label for="tax_office">Vergi Dairesi</label>
                                        <div id="tax_office_container">
                                            <div class="select is-large is-fullwidth mt-5">
                                                <select class="required" name="tax_office" id="tax_office">
                                                    <option selected="selected" value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="columns">
                                    <div class="column is-12">
                                        <label for="company_name">Firma Adı</label>
                                        <input type="text" class="input is-large is-size-6 mt-5 required" name="company_name" id="company_name" value="{{ $company_name or old('company_name') }}"
                                        />
                                    </div>
                                </div>
                                @else
                                <div class="columns">
                                    <div class="column is-6">
                                        <label for="identity_no">TC Kimlik Numaranız</label>
                                        <input type="text" class="input is-large is-size-6 mt-5 required" tckimlikno="true" name="identity_no" id="identity_no" value="{{ $identity_no or old('identity_no') }}"
                                        />
                                    </div>
                                    <div class="column is-6">
                                        <label>Doğum Yılı</label>
                                        <input type="text" class="input is-medium mt-5 required" name="birthday" id="birthday" value="{{ $birthday or old('birthday') }}"
                                        />
                                    </div>
                                </div>
                                @endif
                                <div class="columns">
                                    <div class="column is-12">
                                        <label for="invoice_address">Fatura Adresi</label>
                                        <textarea class="textarea is-grow mt-5 is-secondary-focus required" rows="5" name="invoice_address" id="invoice_address">{{ $invoice_address or old('invoice_address') }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-20 has-text-left">
                                    <button type="submit" class="button is-medium is-info">Bilgileri Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
 
@section('user-scripts')
<script>
    $("#country").change(function () {
    var country_id = $(this).val();
    $.getJSON('/api/zone/city/' + country_id, function (data) {
        var options = '';
        $.each(data.data, function (index, val) {
            options += '<option value="' + val['id'] + '">' + val['name'] + '</option>';
        });
        $('#city').html(options).val('{{ $city_id }}');
        $("#city").change();
    });
});
$("#country").change();
$("#city").change(function () {
    var city_id = $(this).val();
    $.getJSON('/api/taxoffices/' + city_id, function (data) {
        var options = '';
        if (data.data.length == 0) {
            $("#tax_office_container").html("<input type=\"text\" class=\"input is-large is-size-6 mt-5 required\" name=\"tax_office\" id=\"tax_office\" value=\"{{ $tax_office or old('tax_office') }}\" />");
        } else {
            $.each(data.data, function (index, val) {
                options += '<option value="' + val['name'] + '">' + val['name'] + '</option>';
            });
            $('#tax_office').html(options);
            $('#tax_office').html(options).val('{{ $tax_office }}');
        }
    });
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