@extends('layouts.user') 
@section('section')

<section class="section">
    <div class="container">
        
        @if ($errors->all())
            <article class="message mt-30 custom-info-message icon-msg {{ $errors->has('updated') ? "success-msg" : "danger-msg" }}">
                <i class="material-icons">{{ $errors->has('updated') ? "check" : "assignment_late" }}</i>
                <div class="message-body">
                    <ul>
                        @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </article>
        @endif

        <div class="flex-card light-bordered light-raised">
            <div class="card-body no-padding">
                <div class="content">
                    <h2 class="no-margin is-size-5 padding-20">Tüm Makbuzlar</h2>
                    <table class="responsive-table is-light-grey">
                        <tbody>
                            <tr>
                                <th>Makbuz No</th>
                                <th>İlişkili Hizmet</th>
                                <th>Toplam</th>
                                <th>Son Ödeme Tarihi</th>
                                <th>Ödeme Tarihi</th>
                                <th>Durum</th>
                                <th></th>
                            </tr>
                            @foreach($billings as $billing)
                            <tr>
                                <td data-th="Makbuz No" class="is-size-6 text-bold">
                                    <a href="{{ route('user.billing.invoice', $billing->id) }}" target="_blank">#{{ $billing->invoice_no }}</a>
                                </td>
                                <td data-th="İlişkili Hizmet">
                                    @if ($billing->service)
                                    @desktop
                                    {{ $billing->service->title }}
                                    @elsedesktop
                                    {{ str_limit($billing->service->title, 20) }}
                                    @enddesktop
                                    @else
                                    -
                                    @endif
                                </td>
                                <td data-th="Toplam">
                                    {{ ($billing->currency['symbol_left'] ? $billing->currency['symbol_left'] : $billing->currency['symbol_right']) . " " . $billing->price }}
                                </td>
                                <td data-th="Son Ödeme Tarihi">
                                    {{ Carbon\Carbon::parse($billing->payment_date)->format("d M Y") }}
                                </td>
                                <td data-th="Ödeme Tarihi">
                                        @if ($billing->status)
                                        {{ Carbon\Carbon::parse($billing->is_paid_date)->format("d M Y") }}
                                        @else
                                        -
                                        @endif
                                </td>
                                <td data-th="Durum">
                                <span class="tag squared {{ $billing->status?"is-success":"is-danger" }}">
                                        @if ($billing->status)
                                        Ödendi
                                        @else
                                        Ödenmedi
                                        @endif
                                    </span>
                                </td>
                                <td data-th="İşlem">
                                    @if ($billing->status)
                                        -
                                    @else
                                        <a href="{{ route('user.billing.payment', $billing->id) }}" class="button is-small btn-align success-btn"><i class="fa fa-credit-card"></i> Ödeme Yap</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($billings) == 0) 
                        <p class="has-text-left-mobile has-text-centered-desktop pl-20 pb-20 no-padding-top">Kayıtlı makbuz bulunamadı.</p>
                    @endif
                </div>
            </div>
        </div>
        {{ $billings->links() }}
    </div>
</section>
@endsection