@extends('layouts.mail')

@section('content')
    <tr>
        <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">
            <h3>Merhaba {{ $name }};</h3>
            {!! parsedown($description) !!}
        </td>
    </tr>
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;" class="line">
            <hr
                    color="#E0E0E0" align="center" width="100%" size="1" noshade
                    style="margin: 0; padding: 0;"/>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">
            <strong>{{ config('company.name') }} - {{ $department }}</strong><br />
            <strong>Id : </strong>#{{ $id }}<br />
            <strong>Konu : </strong>{{ $title }}<br />
            <strong>Durum : </strong>{{ $status }}<br />
            <img src="{{ route('track', $activity_id) }}" width="0" height="0" style="margin: 0; padding: 0;width:0; height:0; display:none; visible:hidden" />
        </td>
    </tr>
    <tr>
            <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
                padding-top: 25px;
                color: #000000;
                font-family: sans-serif;" class="paragraph">
                {{ route('user.support.detail', $id) }} bağlantıya tıklayarak talep detaylarına ulaşabilirsiniz.
            </td>
        </tr>
    <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                padding-top: 25px;" class="line">
                <hr
                        color="#E0E0E0" align="center" width="100%" size="1" noshade
                        style="margin: 0; padding: 0;"/>
            </td>
        </tr>
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 12px; font-weight: 400; line-height: 160%;
        padding-top: 25px;
        padding-bottom: 5px;
        color: #000000;
        font-family: sans-serif;" class="paragraph">
                <p>Bu e-posta otomasyon tarafından gönderilmiştir.</p> 
                <p>Lütfen e-posta üzerinden cevap yazmayınız.</p>
        </td>
    </tr>
@endsection