@extends('layouts.user') 

@section('section')

<section class="section no-padding-bottom">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body no-padding">
                    <form action="{{ route('user.service.home') }}" method="POST" class="validation padding-10">
                            {{ csrf_field() }}
                        <div class="columns is-gapless is-mobile search-form">
                            <div class="column is-four-fifths">
                                <input class="input is-medium" type="text" placeholder="Hizmetleriniz İçerisinde Arama">
                            </div>
                            <div class="column">
                                <button type="submit" class="button btn-align is-info is-medium is-fullwidth">
                                        <i class="sl sl-icon-magnifier"></i> <span class="is-hidden-touch">Arama</span>
                                    </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section no-padding-top">
        <div class="container">
            <div class="flex-card light-bordered light-raised">
                <div class="card-body no-padding">
                    <div class="content">
                        <h2 class="no-margin is-size-5 padding-20">Hizmetleriniz</h2>
                        <table class="responsive-table is-light-grey">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    @desktop
                                    <th>Ürün / Hizmet</th>
                                    @elsedesktop
                                    <th>Ürün / Hizmet</th>
                                    <th>Alan Adı</th>
                                    @enddesktop
                                    <th>Fatura Döngüsü</th>
                                    <th>Sonraki Ödeme Tarihi</th>
                                    <th>Kalan Gün</th>
                                    <th>Durum</th>
                                    <th>İşlem</th>
                                </tr>
                                @foreach($services as $service)
                                <tr>
                                    <td data-th="ID" class="is-size-6 text-bold">
                                        #{{ $service->id }}
                                    </td>
                                    @desktop
                                    <td data-th="Ürün / Hizmet">
                                        {{ $service->title }}
                                        <br /> {{ $service->domain }}
                                    </td>
                                    @elsedesktop
                                    <td data-th="Ürün / Hizmet">
                                        {{ $service->title }}
                                    </td>
                                    <td data-th="Alan Adı">
                                        {{ $service->domain }}
                                    </td>
                                    @enddesktop
                                    <td data-th="Fatura Döngüsü">
                                        {{ $service->period['name'] }}
                                    </td>
                                    <td data-th="Sonraki Ödeme Tarihi">
                                        {{ Carbon\Carbon::parse($service->payment_date)->addDays($service->period['total_day'])->format("d M Y") }}
                                    </td>
                                    <td data-th="Kalan Gün">
                                        <span class="tag squared @if (Carbon\Carbon::parse($service->payment_date)->addDays($service->period['total_day'])->diffInDays()<=7) is-danger @else is-warning @endif">
                                            {{ Carbon\Carbon::parse($service->payment_date)->addDays($service->period['total_day'])->diffInDays() }} gün
                                        </span>
                                    </td>
                                    <td data-th="Durum">
                                        <span class="tag squared @if ($service->status) is-success @else is-danger @endif">
                                            {{ $service->status ? "Aktif" : "Pasif" }}
                                        </span>
                                    </td>
                                    <td data-th="İşlem">
                                        <a href="{{ route('user.service.detail', $service->id) }}" class="button is-small btn-align primary-btn"><i class="fa fa-eye"></i> Görüntüle</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (count($services) == 0) 
                            <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Kayıtlı hizmet bulunamadı.</p>
                        @endif
                    </div>
                </div>
            </div>
            {{ $services->links() }}
        </div>
    </section>
@endsection