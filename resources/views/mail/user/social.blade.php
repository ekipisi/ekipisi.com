@extends('layouts.mail')

@section('content')
    <tr>
        <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">
            <h2>Hoşgeldiniz</h2>
            <strong>Sayın {{ $name }};</strong><br/>
            <strong>Kayıt olduğunuz için teşekkür ederiz.</strong><br/><br/>
            <strong>Müşteri Numaranız:&nbsp;</strong>{{ $user_id }}<br/>
            <strong>Parolanız:&nbsp;</strong>{{ $password }}<br/>
            <p>
                Üyeliğini etkinleştirmek için hemen aşağıdaki bağlantıya tıklayın:
            </p>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;
			padding-bottom: 5px;" class="button"><a
                    href="{{ route('confirm') }}/?code={{ $code }}" target="_blank"
                    style="text-decoration: underline;">
                <table border="0" cellpadding="0" cellspacing="0" align="left"
                       style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">
                    <tr>
                        <td align="left" valign="middle"
                            style="padding: 12px 24px; margin: 0; text-decoration: none; border-collapse: collapse; border-spacing: 0; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; -khtml-border-radius: 4px;"
                            bgcolor="#f53340">
                            <a target="_blank" style="text-decoration: none;
					color: #FFFFFF; font-family: sans-serif; font-size: 17px; font-weight: 400; line-height: 120%;"
                               href="{{ route('confirm') }}/?code={{ $code }}">
                                Üyeliğini Etkinleştir.
                            </a>
                            <img src="{{ route('track', $activity_id) }}" width="0" height="0" style="margin: 0; padding: 0;width:0; height:0; display:none; visible:hidden" />
                        </td>
                    </tr>
                </table>
            </a>
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