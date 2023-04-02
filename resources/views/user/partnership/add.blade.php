@extends('layouts.user') 

@section('section')

<section class="section">
    <div class="container">
       <div class="columns">
           <div class="column is-3 is-hidden-mobile"></div>
           <div class="column">

            <div class="flex-card light-bordered light-raised">
                <div class="card-body">
                    <div class="content">
                        <h2 class="no-margin is-size-5">Yeni Referans</h2>
                        <form class="validate-with-message" method="post" action="{{ route('user.partnership.add') }}">
                            {{ csrf_field() }}
                            <div class="columns mt-10 is-multiline">
                                <div class="column is-6">
                                    <input type="text" placeholder="Adı" class="required input is-large" name="firstname" id="firstname"  value="{{ $firstname or old('firstname') }}" />
                                    @if ($errors->has('firstname'))
                                    <small class="is-danger color-red is-size-7">
                                        {{ $errors->first('firstname') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="column is-6">
                                    <input type="text" placeholder="Soyadı" class="required input is-large" name="lastname" id="lastname"  value="{{ $lastname or old('lastname') }}" />
                                    @if ($errors->has('lastname'))
                                    <small class="is-danger color-red is-size-7">
                                        {{ $errors->first('lastname') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="column is-6">
                                    <input type="text" placeholder="E-Posta Adresi" class="required input is-large" name="email" id="email"  value="{{ $email or old('email') }}" />
                                    @if ($errors->has('email'))
                                    <small class="is-danger color-red is-size-7">
                                        {{ $errors->first('email') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="column is-6">
                                    <input type="text" placeholder="Telefon Numarası" class="required input is-large" name="phone" id="phone"  value="{{ $phone or old('phone') }}" />
                                    @if ($errors->has('phone'))
                                    <small class="is-danger color-red is-size-7">
                                        {{ $errors->first('phone') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="column is-12">
                                    <input type="text" placeholder="Firma / Kurum Adı" class="required input is-large" name="company" id="company"  value="{{ $company or old('company') }}" />
                                    @if ($errors->has('company'))
                                    <small class="is-danger color-red is-size-7">
                                        {{ $errors->first('company') }}
                                    </small>
                                    @endif
                                </div>
                                <div class="column is-12">
                                    <textarea class="textarea is-grow" name="message" id="message" rows="5" minlength="10" placeholder="Varsa iletmek istediğiniz notunuz">{{ $message or old('message') }}</textarea>
                                </div>
                            </div>
                            <div class="mt-20 has-text-left">
                                <button type="submit" class="button is-medium is-info">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

           </div>
           <div class="column is-3 is-hidden-mobile"></div>
       </div>
    </div>
</section>

@endsection
@section('user-scripts')
<script>
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