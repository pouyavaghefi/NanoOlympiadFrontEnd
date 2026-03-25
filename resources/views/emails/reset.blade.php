@php
    $info = \DB::table('contact_page')->first();
@endphp
        <!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ env('MAIN_DOMAIN') }} - Activate Your Account</title>
    <style media="all" type="text/css">
        body {
            font-family: Helvetica, sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 16px;
            line-height: 1.3;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            background-color: #f4f5f6;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 0 auto !important;
            max-width: 600px;
            padding-top: 24px;
            width: 600px;
        }
        .main {
            background: #ffffff;
            border: 1px solid #eaebed;
            border-radius: 16px;
            width: 100%;
        }
        .wrapper {
            padding: 24px;
        }
        .btn-primary a {
            background-color: #0867ec;
            border-color: #0867ec;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<table role="presentation" class="body">
    <tr>
        <td></td>
        <td class="container">
            <div class="content">
                <table role="presentation" class="main">
                    <tr>
                        <td class="wrapper">
                            <p>Hi, {{ $name }}</p>
                            <p>You’re now part of our community. To get started, please activate your account and explore more...</p>
                            <table role="presentation" class="btn btn-primary">
                                <tr>
                                    <td align="left">
                                        <a href="{{ route('cla.verify', ['email' => $email]) }}">Complete Registration</a>
                                    </td>
                                </tr>
                            </table>
                            <p>If any problem occurred, feel free to contact us.</p>
                            <p>Good luck!</p>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table role="presentation">
                        <tr>
                            <td class="content-block">
                                <span>{{ $info->office_address ?? '' }}</span><br>
                                <span>{{ $info->phone ?? '' }}</span><br>
                                <span>{{ $info->email ?? '' }}</span><br>
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by">
                                <a href="{{ env('APP_URL') }}">{{ strtoupper(env('MAIN_DOMAIN')) }}</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>