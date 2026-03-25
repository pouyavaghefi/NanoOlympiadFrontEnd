@php
    $server = env('URL_ADMIN');
    $path = $bases['siteLogo'];
    $full = $server."/".$path;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Coming Soon...</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="/soon/css/mdb.min.css" />
</head>
<body>
<!--Main Navigation-->
<header>
    <!-- Intro settings -->
    <style>
        /* Default height for small devices */
        #intro {
            height: 600px;
            /* Margin to fix overlapping fixed navbar */
            margin-top: 58px;
        }
        @media (max-width: 991px) {
            #intro {
                /* Margin to fix overlapping fixed navbar */
                margin-top: 45px;
            }
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand" target="_blank" href="https://mdbootstrap.com/docs/standard/">
                <img src="{{ $full }}" height="16" alt="" loading="lazy"
                     style="margin-top: -3px;" />
            </a>
            <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#navbarExample01"
                    aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
{{--            <div class="collapse navbar-collapse" id="navbarExample01">--}}
{{--                <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
{{--                    <li class="nav-item active">--}}
{{--                        <a class="nav-link" aria-current="page" href="#intro">Home</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow"--}}
{{--                           target="_blank">Learn Bootstrap 5</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="https://mdbootstrap.com/docs/standard/" target="_blank">Download MDB UI KIT</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}

{{--                <ul class="navbar-nav d-flex flex-row">--}}
{{--                    <!-- Icons -->--}}
{{--                    <li class="nav-item me-3 me-lg-0">--}}
{{--                        <a class="nav-link" href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow"--}}
{{--                           target="_blank">--}}
{{--                            <i class="fab fa-youtube"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item me-3 me-lg-0">--}}
{{--                        <a class="nav-link" href="https://www.facebook.com/mdbootstrap" rel="nofollow" target="_blank">--}}
{{--                            <i class="fab fa-facebook-f"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item me-3 me-lg-0">--}}
{{--                        <a class="nav-link" href="https://twitter.com/MDBootstrap" rel="nofollow" target="_blank">--}}
{{--                            <i class="fab fa-twitter"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item me-3 me-lg-0">--}}
{{--                        <a class="nav-link" href="https://github.com/mdbootstrap/mdb-ui-kit" rel="nofollow" target="_blank">--}}
{{--                            <i class="fab fa-github"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="p-5 text-center bg-image shadow-1-strong"
         style="background-image: url('{{ env('URL_ADMIN') }}/{{ $static->where('name', 'coming_soon_background_image')->first()->value }}')">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white px-4" data-mdb-theme="dark">
                    <h1 class="mb-3">{{ $static->where('name', 'coming_soon_title')->first()->value ?? 'Coming Soon!' }}</h1>

                    <!-- Time Counter -->
                    <h3 id="time-counter" class="border border-light my-4 p-4"></h3>

{{--                    <p>{{ $static->where('name', 'coming_soon_description')->first()->value ?? "We're working hard to finish the development of this site." }}</p>--}}

{{--                    <p>Until then have a look at our Free Bootstrap 5 tutorials</p>--}}

{{--                    <a class="btn btn-outline-light btn-lg m-2" href="{{ $static->where('name', 'coming_soon_button_one_link')->first()->value ?? '#' }}" role="button" data-mdb-ripple-init rel="nofollow" target="_blank">--}}
{{--                        {{ $static->where('name', 'coming_soon_button_one_name')->first()->value ?? 'Start tutorial' }}--}}
{{--                    </a>--}}
{{--                    <a class="btn btn-outline-light btn-lg m-2" href="{{ $static->where('name', 'coming_soon_button_two_link')->first()->value ?? '#' }}" target="_blank" data-mdb-ripple-init role="button">--}}
{{--                        {{ $static->where('name', 'coming_soon_button_two_name')->first()->value ?? 'Download MDB UI KIT' }}--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
</header>
<!--Main Navigation-->

{{--<!--Main layout-->--}}
{{--<main class="mt-5">--}}
{{--    <div class="container">--}}
{{--        <!--Section: Content-->--}}
{{--        <section>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 gx-5 mb-4 d-lg-flex align-items-center">--}}
{{--                    <div>--}}
{{--                        <h4><strong> {{ $static->where('name', 'coming_soon_subscription_form_title')->first()->value ?? 'Subscribe to stay up to date' }}</strong></h4>--}}
{{--                        <p class="text-muted">--}}
{{--                            {{ $static->where('name', 'coming_soon_subscription_form_description')->first()->value ?? '' }}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 gx-5 mb-4">--}}
{{--                    <form method="POST" action="{{ route('frt.sub') }}">--}}
{{--                        @csrf--}}

{{--                        <!-- Name input -->--}}
{{--                        <div class="form-outline mb-4" data-mdb-input-init>--}}
{{--                            <input type="text" id="form5Example1" class="form-control" name="name" />--}}
{{--                            <label class="form-label" for="form5Example1">Name</label>--}}
{{--                        </div>--}}

{{--                        <!-- Email input -->--}}
{{--                        <div class="form-outline mb-4" data-mdb-input-init>--}}
{{--                            <input type="email" id="form5Example2" class="form-control" name="email" />--}}
{{--                            <label class="form-label" for="form5Example2">Email address</label>--}}
{{--                        </div>--}}

{{--                        <!-- Submit button -->--}}
{{--                        <button type="submit" class="btn btn-primary btn-block mb-4" data-mdb-ripple-init>--}}
{{--                            Subscribe--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--        <!--Section: Content-->--}}
{{--    </div>--}}
{{--</main>--}}
{{--<!--Main layout-->--}}

<!--Footer-->
<footer class="bg-light text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © {{ date("Y") }} Copyright:
        <a class="text-dark" href="{{ $bases['siteUrl'] ?? '' }}">{{ $bases['siteName'] ?? '' }}</a>
    </div>
    <!-- Copyright -->
</footer>
<!--Footer-->

<!-- Time Counter -->
<script type="text/javascript">
    // Set the date we're counting down to
    var countDownDate = new Date();
    countDownDate.setDate(countDownDate.getDate() + 25);

    // Update the count down every 1 second
    var x = setInterval(function () {
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById('time-counter').innerHTML =
            days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById('time-counter').innerHTML = 'EXPIRED';
        }
    }, 1000);
</script>
<!-- MDB -->
<script type="text/javascript" src="/soon/js/mdb.umd.min.js"></script>
</body>
</html>
