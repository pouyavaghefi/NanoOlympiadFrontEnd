<!-- meta tags -->
@include('layouts.includes.init.meta')

<!-- css -->
<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/css/all-fontawesome.min.css">
<link rel="stylesheet" href="/assets/css/animate.min.css">
<link rel="stylesheet" href="/assets/css/magnific-popup.min.css">
<link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/styles.css">
<link rel="stylesheet" href="/assets/css/own.css">
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{--@php
    $server = env('URL_ADMIN');
    $fav = $bases['siteFavicon'] ?? '';
    $fullFav = $server . "/" . $fav;
@endphp--}}
<link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icon/favicon.jpg">
<style>
    @media (max-width: 768px) {
        footer.footer-area {
            display: none !important;
        }
    }
    @media (max-width: 480px) {
        footer.footer-area {
            display: none !important;
        }
    }
</style>