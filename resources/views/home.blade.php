@extends('layouts.app') 
@section('hero-content')
    @include("partials/sliders/home")
    @include("partials/clients/home", ['references', $references])
@endsection


@section('content')
<div class="is-hidden">{{ Breadcrumbs::render() }}</div>
<section class="section is-medium is-relative">
    <div class="container has-text-centered">
        <div class="special-divider pb-10">
            <span></span>
            <span></span>
        </div>
        <div class="columns is-vcentered">
            <div class="column is-8 is-offset-2 has-text-centered">
                <div class="section-title-wrapper">
                    <h2 class="title dark-text text-bold main-title is-2">
                        Fark Yaratacak Özellikler
                    </h2>
                    <h3 class="subtitle">İşletmenizin düşük maliyetle internette var olması için ihtiyaç duyacağınız her şey:</h3>
                </div>
            </div>
        </div>
        <div class="columns is-vcentered is-multiline">
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Mens is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Gelişmiş Kullanıcı Yönetimi</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Shop-2 is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Çoklu Mağaza</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Venn-Diagram is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Seçenek ve Özellikler</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Tag is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Sınırsız Kategori Ekleme</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Clothing-Store is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Sınırsız Ürün Ekleme</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Target is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Özel Filtreler</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Euro is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Çoklu Parabirimi</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Flag-4 is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">Çoklu Dil Desteği</h5>
                    </div>
                </div>

            </div>
            <div class="column is-4">

                <div class="content content-flex">
                    <div class="dark-text">
                        <i class="im im-icon-Calculator is-size-2 color-primary"></i>
                    </div>
                    <div class="dark-text has-text-left ml-30">
                        <h5 class="text-bold">İndirim ve Kampanyalar</h5>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="is-divider" data-content="ve dahası..."></div> --}}
    </div>
</section>
@endsection
 
@section('footer')
    @include("partials/modals/trial")
@endsection