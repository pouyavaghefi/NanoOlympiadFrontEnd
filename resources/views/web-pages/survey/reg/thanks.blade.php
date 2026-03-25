<?xml version="1.0" encoding="UTF-8"?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Thank You!</title>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/form/assets/css/bootstrap/bootstrap.min.css"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Recoleta Alt Font -->
    <link rel="stylesheet" href="/form/assets/css/fonts.css"/>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="/form/assets/css/style.css"/>

    <!-- animation -->
    <link rel="stylesheet" href="/form/assets/css/animation.css"/>

    <!-- responsive -->
    <link rel="stylesheet" href="/form/assets/css/responsive.css"/>
</head>
<body>
<form id="Stepform" action="{{ route('frt.survey.reg.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <main class="overflow-hidden">
        <section class="thankyou">
            <div class="container">
                <div class="step-inner">
                    <div class="thankyoumsg">
                        <div class="thumbsUp">
                            <img src="/form/assets/images/thumbs-up.png" alt="ThumbsUp">
                        </div>
                        <h2>Many Thanks For Completing  Much Appreciated.</h2>
                    </div>
                </div>
            </div>
        </section>
    </main>
</form>
</body>
</html>
