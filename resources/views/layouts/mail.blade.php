<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no"/>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-width: 100%;
            width: 100% !important;
            height: 100% !important;
        }

        body, table, td, div, p, a {
            -webkit-font-smoothing: antialiased;
            text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            line-height: 100%;
        }

        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse !important;
            border-spacing: 0;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }

        @media all and (min-width: 560px) {
            .container {
                border-radius: 8px;
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                -khtml-border-radius: 8px;
            }
        }

        a, a:hover {
            color: #127DB3;
        }

        .footer a, .footer a:hover {
            color: #999999;
        }
    </style>
    <title>{{ config('app.name') }}</title>
</head>
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%"
      style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
	background-color: #F0F0F0;
	color: #000000;"
      bgcolor="#F0F0F0"
      text="#000000">
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
       style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;"
            bgcolor="#F0F0F0">
            <table border="0" cellpadding="0" cellspacing="0" align="center"
                   width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
	max-width: 560px;" class="wrapper">

                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 20px;
			padding-bottom: 20px;">
                        <div style="display: none; visibility: hidden; overflow: hidden; opacity: 0; font-size: 1px; line-height: 1px; height: 0; max-height: 0; max-width: 0;
			color: #F0F0F0;" class="preheader">
                            {{ config('app.name') }}
                        </div>
                        <a target="_blank" style="text-decoration: none;"
                           href="{{ config('app.link') }}"><img border="0" vspace="0" hspace="0"
                                                                src="{{ asset('images/ekipisi-blue-logo.png') }}"
                                                                width="140" height="51"
                                                                alt="{{ config('app.name') }}"
                                                                title="{{ config('app.name') }}"
                                                                style="
				color: #000000;
				font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block;"/></a>

                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" align="center"
                   bgcolor="#FFFFFF"
                   width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
	max-width: 560px;" class="container">
                @yield('content')
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;" class="line">
                        <hr
                                color="#E0E0E0" align="center" width="100%" size="1" noshade
                                style="margin: 0; padding: 0;"/>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 12px; font-weight: 400; line-height: 160%;
			padding-top: 20px;
			padding-bottom: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">
                        İpucu: E-posta adres defterinize <a href="mailto:{{ config('support.mail') }}" target="_blank"
                                                            style="color: #127DB3; font-family: sans-serif; font-size: 12px; font-weight: 400; line-height: 160%;">{{ config('support.mail') }}</a>
                        adresini eklerseniz,
                        e-posta sisteminiz her zaman bizden gelen mesajları tanır ve e-postalarımız her zaman sizi
                        ulaşır ve siz yeni teklifleri kaçırmazsınız.<br/>
                        Teşekkür ederiz,<br/>
                        <a href="{{ config('app.link') }}" target="_blank"
                           style="color: #f53340;text-decoration: none; font-family: sans-serif; font-size: 14px; font-weight: 600; line-height: 160%;">{{ config('app.name') }}</a>
                    </td>
                </tr>
            </table>
            @include('partials/mail/footer')
        </td>
    </tr>
</table>
</body>
</html>