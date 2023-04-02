<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>Fatura Detayları</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#FC3760" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ekipisi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons.min.css') }}">
</head>

<body>
    <section class="section pt-80">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-8 is-offset-2">
                    <div class="level">
                        <div class="level-left">
                            <p class="level-item"><a href="{{ route('user.billing.home') }}" class="button primary-btn btn-align raised"><i class="fa fa-angle-left" aria-hidden="true"></i> Geri Dön</a></p>
                        </div>
                        <div class="level-right">
                            <p class="level-item is-size-6 danger-text">Bu makbuzun resmi geçerliliği yoktur</p>
                        </div>
                    </div>
                </div>
                <div class="column is-8 is-offset-2">
                    <div class="flex-card light-bordered light-raised has-ribbon">
                        <div class="card-body">
                            @if ($invoice->is_paid)
                                <div class="ribbon is-success is-medium">Ödendi</div>
                            @else
                                <div class="ribbon is-danger is-medium">Ödenmedi</div>
                            @endif
                            <div class="content mt-20">
                                <div class="columns is-multiline">
                                    <div class="column is-3">
                                        <img src="{{ asset('images/logos/ekipisi-logo.svg') }}" alt="Ekipişi">
                                    </div>
                                    <div class="column is-9 has-text-right has-text-left-mobile">
                                        <p>
                                            <b>Makbuz</b>: #{{ $invoice->invoice_no }}<br />
                                            <b>Oluşturulma:</b> {{ Carbon\Carbon::parse($invoice->created_at)->format("d M Y") }}<br />
                                            <b>Son Ödeme:</b> {{ Carbon\Carbon::parse($invoice->payment_date)->format("d M Y") }}
                                        </p>
                                    </div>
                                    <div class="column">
                                        <p>
                                            Ekipişi Yazılım ve Danışmanlık Hizmetleri<br />
                                            Mustafa Genç<br /> 
                                            200/17 Sk. No:12 D:1<br />
                                            Buca / İzmir
                                        </p>
                                    </div>
                                    <div class="column has-text-right has-text-left-mobile">
                                        <p>
                                            @if ($invoice->user['company_type']==1)
                                                {{ $invoice->user['company_name'] }}<br />
                                                {{ $invoice->user['tax_no'] }} - {{ $invoice->user['tax_office'] }}<br />
                                            @else
                                                {{ $invoice->user['firstname'] }} {{ $invoice->user['lastname'] }}<br />
                                                {{ $invoice->user['identity_no'] }}<br />
                                            @endif
                                            {{ $invoice->user['invoice_address'] }}
                                        </p>
                                    </div>
                                </div>
                                <table class="responsive-table is-light-grey mt-40">
                                    <tbody>
                                        <tr>
                                            <th>Makbuz Öğesi</th>
                                            <th class="has-text-right">Tutar</th>
                                        </tr>
                                        <tr>
                                        <td data-th="Hizmet">
                                            <strong>{{ $invoice->service['title'] }}</strong><br />
                                            <small>{{ $invoice->description }}</small>
                                        </td>
                                            <td data-th="Tutar" class="has-text-right has-text-left-mobile">
                                                <strong>₺{{ $invoice->price }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td data-th="Toplam Tutar" colspan="2" class="has-text-right has-text-left-mobile">
                                                    <strong>₺{{ $invoice->price }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>