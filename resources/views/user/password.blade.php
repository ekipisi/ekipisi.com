@extends('layouts.user') 

@section('section')

<section class="section">
        <div class="container">
            <div class="columns">
                @include('user/partials/menu/profile')
                <div class="column is-9">
                    <div class="flex-card light-bordered light-raised">
                        <div class="card-body">
                            <div class="content">
                                <h2 class="no-margin is-size-5">{{ __('user.password.title') }}</h2>
                                <form class="validate-with-message" method="post" action="{{ route('user.password') }}">
                                        {{ csrf_field() }}
                                        <div class="columns mt-10">
                                            <div class="column is-12">
                                                <label for="current">Güncel Parola</label>
                                                <input type="password" class="required input is-large mt-5" name="current" id="current" />
                                            </div>
                                        </div>
                                        <div class="columns">
                                                <div class="column is-6">
                                                    <label for="password">Yeni Parola</label>
                                                    <input type="password" class="input is-large mt-5" name="password" id="password" required/>
                                                </div>
                                                <div class="column is-6">
                                                    <label for="password_confirmation">Yeni Parola Tekrar</label>
                                                    <input type="password" class="input is-large mt-5" name="password_confirmation" id="password_confirmation" equalto="#password" required/>
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
@if ($errors->any())
<script>
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
</script>
@endif
@endsection