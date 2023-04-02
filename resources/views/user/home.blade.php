@extends('layouts.user') 
@section('section')

@if ($has_order)
<section class="section">
    <div class="container">
        <div class="alert alert-success">
            Siparişiniz alındı danışmanlarımız en kısa sürede sizinle iletişime geçecek.
        </div>
    </div>
</section>
@endif

@if (!Auth::user()->status)
<section class="section">
    <div class="container">
        <div class="alert alert-warning">
            İşlemlerinize devam edebilmeniz için, email adresinize gönderdiğimiz etkinleştirme bağlantısına tıklamalısınız.
        </div>
    </div>
</section>
@endif

@if (count($announces) > 0)
<section class="section {{ $has_order || !Auth::user()->status ? "no-padding-top" : "" }}">
    <div class="container">
        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content is-marginless">
                    <h2 class="no-margin is-size-5 padding-20">Duyurular</h2>
                </div>
                <ul class="list-block bordered">
                    @foreach($announces as $announce)
                        @if ($announce->user_id == 0 || $announce->user_id == Auth::id())
                            <li><a href="{{ route('user.announce.detail', ['id' => $announce->id, 'domain' => $announce->domain]) }}"><i class="sl {{ $announce->icon ? $announce->icon : "sl-icon-volume-1" }} mr-20"></i> {{ $announce->title }}</a></li>
                        @endif
                    @endforeach
                </ul>        
            </div>
        </div>
    </div>
</section>
@endif
<section class="section {{ count($announces) > 0 ? "no-padding-top" : "" }}">
    <div class="container">
        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content">
                    <h2 class="no-margin is-size-5 padding-20">Son Destek Talepleriniz</h2>
                    <table class="responsive-table is-light-grey">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Tarih</th>
                                <th>Öncelik</th>
                                <th>Konu</th>
                                <th>Durum</th>
                                <th>Güncelleme</th>
                                <th></th>
                            </tr>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td data-th="ID" class="is-size-6 text-bold">
                                        #{{ $ticket->id }}
                                    </td>
                                    <td data-th="Tarih">
                                        {{ Carbon\Carbon::parse($ticket->updated_at)->format("d M Y") }}
                                    </td>
                                    <td data-th="Öncelik">
                                        <span class="tag squared is-{{ $ticket->priority->color }}">{{ $ticket->priority->name }}</span>
                                    </td>
                                    <td data-th="Konu">
                                        <a href="{{ route('user.support.detail', $ticket->id) }}">
                                            
                                            @desktop
                                            {{ str_limit($ticket->title,50) }}
                                            @elsedesktop
                                            {{ str_limit($ticket->title, 20) }}
                                            @enddesktop

                                        </a> @if ($ticket->type_id == 2 && !empty($ticket->notes))
                                        <i class="material-icons is-icon-md has-text-danger animated swing slower pull-right">notifications_active</i>                                    @endif
                                    </td>
                                    <td data-th="Durum">
                                        <span class="tag squared is-{{ $ticket->status->color }}">{{ $ticket->status->name }}</span>
                                    </td>
                                    <td data-th="Güncelleme">
                                        {{ Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}
                                    </td>
                                    <td data-th="İşlem">
                                        <a href="{{ route('user.support.detail', $ticket->id) }}" class="button is-small btn-align primary-btn">
                                            <i class="fa fa-eye"></i> Görüntüle
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @if (count($tickets) == 0) 
                        <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Daha önce destek talebinde bulunmadınız</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@if (count($services)>0)
<section class="section no-padding-top">
    <div class="container">
        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content">
                    <h2 class="no-margin is-size-5 padding-20">Yenilemesi Yaklaşan Ürünleriniz / Hizmetleriniz</h2>
                    <table class="responsive-table is-light-grey">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Ürün & Hizmet</th>
                                <th>Alan Adı</th>
                                <th>Fatura Döngüsü</th>
                                <th>Fatura Tarihi</th>
                                <th>Durum</th>
                            </tr>
                            @foreach($services as $service) 
                            <tr>
                                <td data-th="ID" class="is-size-6 text-bold">
                                    #{{ $service->id }}
                                </td>
                                <td data-th="Ürün & Hizmet">
                                    <a href="{{ route('user.service.detail', $service->id) }}">
                                        @desktop
                                        {{ $service->title }}
                                        @elsedesktop
                                        {{ str_limit($service->title, 20) }}
                                        @enddesktop
                                    </a>
                                </td>
                                <td data-th="Alan Adı">
                                    {{ $service->domain }}
                                </td>
                                <td data-th="Fatura Döngüsü">
                                    {{ $service->period['name'] }}
                                </td>
                                <td data-th="Fatura Tarihi">
                                    {{ Carbon\Carbon::parse($service->payment_date)->addDays($service->period['total_day'])->format("d M Y") }}
                                </td>
                                <td data-th="Durum">
                                    <span class="tag squared @if ($service->status) is-success @else is-danger @endif">{{ $service->status ? "Aktif" : "Pasif" }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if (count($billings)>0)
<section class="section no-padding-top">
    <div class="container">
        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content">
                    <h2 class="no-margin is-size-5 padding-20">Bekleyen Ödemeler</h2>
                    <table class="responsive-table is-light-grey">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Ürün & Hizmet</th>
                                <th>Tutar</th>
                                <th>Ödeme Tarihi</th>
                                <th>Durum</th>
                            </tr>
                            @foreach($billings as $billing) 
                            <tr>
                                <td data-th="ID" class="is-size-6 text-bold">
                                    <a href="{{ route('user.billing.invoice', $billing['id']) }}" target="_blank">#{{ $billing['invoice_no'] }}</a>
                                </td>
                                <td data-th="Ürün & Hizmet">
                                    @desktop
                                    {{ $billing['title'] }}
                                    <br />
                                    <small>{!! $billing['description'] !!}</small>
                                    @elsedesktop
                                    {{ str_limit($billing['title'], 20) }}
                                    @enddesktop
                                </td>
                                <td data-th="Tutar">
                                    {{ $billing['currency'] . "" . $billing['price'] }}
                                </td>
                                <td data-th="Fatura Tarihi">
                                    {{ $billing['payment_date'] }}
                                </td>
                                <td data-th="Durum">
                                    <span class="tag squared @if ($billing['status']) is-success @else is-danger @endif">{{ $billing['status'] ? "Ödendi" : "Ödenmedi" }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-bold has-text-right">Toplam</td>
                                <td colspan="3" class="text-bold">₺{{ $total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


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