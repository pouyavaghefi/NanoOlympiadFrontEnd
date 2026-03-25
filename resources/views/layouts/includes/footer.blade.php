@if (app()->getLocale() === 'ar')
<footer class="footer-area" dir="rtl">
    <div class="footer-shape">
{{--        <img src="/assets/img/shape/03.png" alt="">--}}
    </div>
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-100 pb-70">
                <div class="col-md-6 col-lg-3">
                    @include('layouts.includes.gadgets.subscription')
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">روابط مفيدة</h4>
                        <ul class="footer-list">
                            <li><a href="#">من نحن<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">الأسئلة الشائعة<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">المدونات<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">شروط الخدمة<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">سياسة الخصوصية<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">آخر الأخبار<i class="fas fa-caret-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">العناصر الرئيسية</h4>
                        <ul class="footer-list">
                            <li><a href="#">الدورات<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">الاستكشاف<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">الأعضاء<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">الفعاليات<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">اتصل بنا<i class="fas fa-caret-left"></i></a></li>
                            <li><a href="#">قاعة الشهرة<i class="fas fa-caret-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                            <img src="http://admin.nanolympiad.org/logos/1736100622_logo.png" alt="">
                        </a>
                        <p class="mb-3">
                            نحن ملتزمون برعاية الجيل القادم من العلماء والمبتكرين. منصتنا توفر للطلاب في جميع أنحاء العالم دورات عالية الجودة في علوم النانو، لإعدادهم للتحديات والفرص في البحث والتطوير المتقدم.
                        </p>
                        <ul class="footer-contact">
                            <li><a href="mailto:info@example.com"><i class="far fa-envelope"></i>info@nanolympiad.org</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="copyright-wrapper">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p class="copyright-text">
                            &copy; حقوق الطبع والنشر <span id="date"></span> <a href="{{ env('APP_URL') }}"> أولمبياد النانو </a> جميع الحقوق محفوظة.
                        </p>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <!-- Additional content if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@else
    <footer class="footer-area">
        <div class="footer-sunlight"></div>
        <div class="footer-background-logo"></div>
        <div class="stars">
            <!-- Generate multiple stars -->
            <div class="star" style="top: 10%; left: 20%;"></div>
            <div class="star" style="top: 30%; left: 40%;"></div>
            <div class="star" style="top: 50%; left: 60%;"></div>
            <!-- Add more stars as needed -->
            <!-- Blinking stars -->
            <div class="twinkling-star" style="top: 25%; left: 15%;"></div>
            <div class="twinkling-star" style="top: 40%; left: 80%;"></div>
            <div class="twinkling-star" style="top: 70%; left: 55%;"></div>
            <!-- Shooting Stars -->
            <div class="shooting-star" style="top: 5%; left: 50%;"></div>
            <div class="shooting-star" style="top: 60%; left: 10%;"></div>
            <div class="shooting-star" style="top: 80%; left: 85%;"></div>
        </div>
        <div class="rocket" id="rocket"></div>
        <div class="footer-shape">
            {{--        <img src="/assets/img/shape/03.png" alt="">--}}
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="row footer-widget-wrapper pt-100 pb-70">
                    <!-- About Us Section (Full width on mobile) -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="footer-widget-box about-us">
                            <a href="{{ env('APP_URL') }}" class="footer-logo">
                                @php
                                    $server = env('URL_ADMIN');
                                    $path = $footerData['footer_logo'] ?? '';
                                    $full = $server . "/" . $path;
                                @endphp
                                <img src="{{ $full }}" alt="logo">
                            </a>
                            <p class="mb-3">
                                {{ $footerData['footer_description'] ?? '' }}
                            </p>
                            <ul class="footer-contact">
                                <li><a href="mailto:{{ $footerData['footer_email'] ?? 'info@example.com' }}"><i class="far fa-envelope"></i>&nbsp; {{ $footerData['footer_email'] ?? 'info@nanolympiad.org' }} &nbsp;</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Useful Links and Main Items (Side by Side on Tablet, Stacked on Mobile) -->
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="footer-widget-box list">
                            <div class="wrapper">
                                <div class="footer-sunlight"></div>
                                <div id="earthback">
                                    <a href="https://earthobservatory.nasa.gov" title="Explore more" target="_blank" rel="noopener noreferrer">
                                        <div id="earth"></div>
                                    </a>
                                </div>
{{--                                <div class="country-name">--}}
{{--                                    <a title="Made in Iran" target="_blank" href="https://en.wikipedia.org/wiki/Iran">--}}
{{--                                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/Flag_of_Iran.svg" alt="Iran Flag" class="country-flag">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div id="moonback">--}}
{{--                                    <a rel="noopener noreferrer">--}}
{{--                                        <div class="moon">--}}
{{--                                            <div class="face">--}}
{{--                                                <div class="eye left"></div>--}}
{{--                                                <div class="eye right"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                            <style>
                                /* Apply custom tooltip only to specific links */
                                #earthback a[title],
                                .country-name a[title],
                                #moonback a[title] {
                                    position: relative;
                                }

                                /* Tooltip styling for specific links */
                                #earthback a[title]:hover::after,
                                .country-name a[title]:hover::after,
                                #moonback a[title]:hover::after {
                                    content: attr(title); /* Show the title text */
                                    position: absolute;
                                    bottom: 100%; /* Position above the element */
                                    left: 50%;
                                    transform: translateX(-50%); /* Center the tooltip */
                                    background-color: rgba(0, 0, 0, 0.7); /* Dark background */
                                    color: #fff; /* White text for contrast */
                                    padding: 5px 10px;
                                    border-radius: 5px;
                                    font-size: 0.9em;
                                    white-space: nowrap;
                                    opacity: 0;
                                    visibility: hidden;
                                    transition: opacity 0.3s ease, visibility 0.3s ease, bottom 0.3s ease;
                                    z-index: 10;
                                }

                                /* Make the tooltip visible on hover */
                                #earthback a[title]:hover::after,
                                .country-name a[title]:hover::after,
                                #moonback a[title]:hover::after {
                                    opacity: 1;
                                    visibility: visible;
                                    bottom: 110%; /* Slightly above the link */
                                }

                                /* Optional: Adding a little shadow to the tooltip */
                                #earthback a[title]:hover::after,
                                .country-name a[title]:hover::after,
                                #moonback a[title]:hover::after {
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                                }

                                /* For responsiveness and touch screens */
                                @media (max-width: 768px) {
                                    #earthback a[title]:hover::after,
                                    .country-name a[title]:hover::after,
                                    #moonback a[title]:hover::after {
                                        font-size: 0.8em; /* Slightly smaller tooltips on mobile */
                                    }
                                }


                                /* Background logo faintly visible */
                                .footer-background-logo {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-image: url('http://nanolympiad.org/assets/img/foo.png');
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    background-size: contain;
                                    opacity: 0.06;
                                    pointer-events: none;
                                    z-index: -1;
                                }

                                /* Stars in the sky */
                                .stars {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                }

                                /* Basic star design */
                                .star {
                                    position: absolute;
                                    width: 5px;
                                    height: 5px;
                                    background-color: #fff;
                                    border-radius: 50%;
                                    animation: twinkle 1.5s infinite alternate;
                                }

                                /* Twinkling effect for stars */
                                .twinkling-star {
                                    position: absolute;
                                    width: 4px;
                                    height: 4px;
                                    background-color: #fff;
                                    border-radius: 50%;
                                    animation: twinkle 2s infinite alternate;
                                }

                                /* Shooting star effect */
                                .shooting-star {
                                    position: absolute;
                                    width: 2px;
                                    height: 2px;
                                    background-color: #fff;
                                    border-radius: 50%;
                                    animation: shooting 3s ease-out infinite;
                                }

                                /* Keyframe for twinkling */
                                @keyframes twinkle {
                                    0% {
                                        opacity: 0.7;
                                    }
                                    100% {
                                        opacity: 1;
                                    }
                                }

                                /* Keyframe for shooting stars */
                                @keyframes shooting {
                                    0% {
                                        top: 0%;
                                        left: 0%;
                                        transform: scale(1) translateX(0);
                                    }
                                    100% {
                                        top: 100%;
                                        left: 100%;
                                        transform: scale(1.5) translateX(50px);
                                        opacity: 0;
                                    }
                                }

                                /* Dynamic sky color tint */
                                @keyframes skyTint {
                                    0% {
                                        background-color: #0d1b2a; /* Deep night blue */
                                    }
                                    25% {
                                        background-color: #1e2a38; /* A bit lighter */
                                    }
                                    50% {
                                        background-color: #2a3c55; /* Midnight blue */
                                    }
                                    75% {
                                        background-color: #1e2a38;
                                    }
                                    100% {
                                        background-color: #0d1b2a;
                                    }
                                }

                                .country-name {
                                    text-align: center;
                                    font-size: 1.2em;
                                    font-weight: bold;
                                    color: #fff;
                                    position: relative;
                                    z-index: 2;
                                    font-family: 'Arial', sans-serif;
                                    margin-left: 120px; /* Adjust to position the flag correctly */
                                    margin-top: 15px; /* Space below the Earth */
                                    display: inline-block; /* To keep the flag in line with the text */
                                }

                                .country-name p {
                                    margin: 0;
                                    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
                                    letter-spacing: 1px;
                                }

                                .country-flag {
                                    width: 40px; /* Flag size */
                                    height: auto;
                                    vertical-align: middle; /* Align flag with the text */
                                    margin-left: 8px; /* Space between flag and text */
                                    border-radius: 3px; /* Slight rounding for a polished look */
                                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); /* Subtle shadow */
                                }

                                @media (max-width: 768px) {
                                    .country-name {
                                        font-size: 1em; /* Slightly smaller text on mobile */
                                        margin-left: 0; /* Adjust for mobile responsiveness */
                                    }

                                    .country-flag {
                                        width: 30px; /* Smaller flag on mobile */
                                    }
                                }


                                .stars {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    pointer-events: none;
                                    z-index: 0;
                                }

                                .star {
                                    position: absolute;
                                    width: 2px;
                                    height: 2px;
                                    background: white;
                                    border-radius: 50%;
                                    opacity: 0;
                                    animation: twinkle 2s infinite;
                                }

                                @keyframes twinkle {
                                    0%, 100% { opacity: 0; }
                                    50% { opacity: 1; }
                                }
                                .footer-sunlight {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 400px;
                                    height: 400px;
                                    background: radial-gradient(
                                            circle at 0% 0%,
                                            rgba(255, 223, 100, 0.2) 0%, /* Soft yellow light */
                                            rgba(255, 223, 100, 0.1) 30%,
                                            rgba(255, 223, 100, 0) 70%
                                    );
                                    pointer-events: none;
                                    z-index: 0; /* Keep behind everything */
                                    opacity: 0.5; /* Faintness */
                                }
                                .footer-area {
                                    position: relative;
                                    overflow: hidden;
                                    animation: skyTint 30s infinite ease-in-out;
                                    position: relative;
                                    overflow: hidden;
                                }.eye {
                                     width: 12px;
                                     height: 12px;
                                     background-color: #fff;
                                     border-radius: 50%;
                                     position: absolute;
                                     top: 30%;
                                     transition: 0.1s ease-out;
                                     box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.3);
                                 }

                                .left {
                                    left: 25%;
                                }

                                .right {
                                    right: 25%;
                                }

                                .footer-background-logo {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-image: url('http://nanolympiad.org/assets/img/foo.png');
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    background-size: contain; /* or cover, depending on how you want it */
                                    opacity: 0.06; /* VERY LOW opacity */
                                    pointer-events: none; /* So it doesn't block clicks */
                                    z-index: 0;
                                }

                                /* Now make sure your footer content is above it */
                                .footer-widget,
                                .copyright {
                                    position: relative;
                                    z-index: 1;
                                }
                                .moon {
                                    width: 80px;
                                    height: 80px;
                                    background: radial-gradient(circle at 30% 30%, #f0f0f0, #cccccc 40%, #999999 70%);
                                    border-radius: 50%;
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    animation: 5s ease-in-out 0s normal none infinite moon-move;
                                    box-shadow: inset -10px -10px 20px rgba(0, 0, 0, 0.5), 0 0 30px rgba(255, 255, 255, 0.2);
                                    background-size: cover;
                                }
                                .moon .face {
                                    position: absolute;
                                    width: 100%;
                                    height: 100%;
                                    transform-origin: right;
                                    animation: 5s linear 0s normal none infinite moon-face-move;
                                }
                                .moon .face div {
                                    width: 25px;
                                    height: 8px;
                                    border-radius: 20px;
                                    position: absolute;
                                    top: 65%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    box-shadow: inset 0px -5px 0px 0px black;
                                    border-radius: 50%;
                                }
                                .moon .face div:before, .moon .face div:after {
                                    content: "";
                                    width: 10px;
                                    height: 10px;
                                    box-sizing: border-box;
                                    background-color: #ffffff;
                                    box-shadow: inset 0px 0px 0px 3px black;
                                    border-radius: 50%;
                                    position: absolute;
                                    top: -20px;
                                }
                                .moon .face div:before {
                                    left: -5px;
                                }
                                .moon .face div:after {
                                    right: -5px;
                                }

                                @keyframes face-move {
                                    0% {
                                        box-shadow: inset 0px -22px 0px 0px #252730, 2px 5px 5px -3px rgba(0, 0, 0, 0.5);
                                    }
                                    50% {
                                        top: 60%;
                                        left: 75%;
                                        height: 60px;
                                        border-radius: 50%;
                                        box-shadow: inset 0px -22px 0px 0px #252730, 2px 5px 5px -3px rgba(0, 0, 0, 0.5);
                                    }
                                    100% {
                                        box-shadow: inset 0px -22px 0px 0px #252730, 2px 5px 5px -3px rgba(0, 0, 0, 0.5);
                                    }
                                }
                                @keyframes land-move {
                                    0% {
                                        margin-left: 0px;
                                    }
                                    50% {
                                        margin-left: 50px;
                                    }
                                    100% {
                                        margin-left: 0px;
                                    }
                                }
                                @keyframes eye-ball {
                                    0% {
                                        box-shadow: inset -5px 5px 0px 15px #ffffff, 2px 2px 5px rgba(0, 0, 0, 0.5);
                                    }
                                    50% {
                                        box-shadow: inset 5px -2px 0px 12px #ffffff, 2px 2px 5px rgba(0, 0, 0, 0.5);
                                        top: -45px;
                                    }
                                    100% {
                                        box-shadow: inset -5px 5px 0px 15px #ffffff, 2px 2px 5px rgba(0, 0, 0, 0.5);
                                    }
                                }
                                @keyframes moon-move {
                                    0% {
                                        left: 12%;
                                        top: 55%;
                                        z-index: 5;
                                    }
                                    50% {
                                        left: 88%;
                                        top: 45%;
                                    }
                                    100% {
                                        left: 12%;
                                        top: 55%;
                                        z-index: -5;
                                    }
                                }
                                @keyframes moon-face-move {
                                    0% {
                                        transform: rotateY(0deg);
                                        opacity: 1;
                                        transform-origin: right;
                                    }
                                    25% {
                                        transform: rotateY(45deg);
                                        opacity: 0.5;
                                        transform-origin: right;
                                    }
                                    50% {
                                        transform: rotateY(90deg);
                                        opacity: 0;
                                        transform-origin: right;
                                    }
                                    75% {
                                        transform: rotateY(90deg);
                                        opacity: 0;
                                        transform-origin: left;
                                    }
                                    100% {
                                        transform: rotateY(0deg);
                                        opacity: 1;
                                        transform-origin: left;
                                    }
                                }
                                #earthback {
                                    perspective: 1000px;
                                    margin-bottom: 20px;
                                }

                                #earth {
                                    position: relative;
                                    width: 300px;
                                    height: 300px;
                                    margin: 3em auto;
                                    border-radius: 50%;
                                    background-image: url("https://lh5.googleusercontent.com/-kkxEx-SkRaY/VBLF4BV2lZI/AAAAAAAAKao/FnKsv7402_c/s500/earthmap.jpg");
                                    background-size: 600px 300px;
                                    background-repeat: repeat-x;
                                    background-position: -200px 0;
                                    box-shadow:
                                            inset 20px 0 80px 6px rgba(0, 0, 0, 1),
                                            0 20px 50px rgba(0, 0, 0, 0.6);
                                    animation: spinEarth 360s linear infinite; /* Slow default rotation */
                                    overflow: hidden;
                                    transition: all 0.5s ease; /* Smooth transition for all properties */
                                }

                                #earth:hover {
                                    animation-duration: 30s; /* Speed up when hovered */
                                }

                                @keyframes spinEarth {
                                    0% {
                                        background-position: -200px 0;
                                    }
                                    100% {
                                        background-position: -800px 0;
                                    }
                                }

                                #earth::after {
                                    content: "";
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    border-radius: 50%;
                                    box-shadow: inset -80px 0 80px 10px rgba(0, 0, 0, 0.5);
                                }

                                #earth::before {
                                    content: "";
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    border-radius: 50%;
                                    background: radial-gradient(circle at center, rgba(255,255,255,0.2), transparent 70%);
                                }

                                /* When hover, make the Earth spin faster */
                                #earth:hover {
                                    animation-duration: 30s; /* <-- Much faster! */
                                }
                            </style>


                            @if($footerData['footer_links'] == "on")
                                <h4 class="footer-widget-title">Useful Links</h4>
                                <ul class="footer-list">
                                    <li><a href="#"><i class="fas fa-caret-right"></i> About Us</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> FAQ's</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Blogs</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Terms Of Service</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Privacy policy</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Update News</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="col-6 col-md-3 col-lg-3">
                        <div class="footer-widget-box list">
                            @if($footerData['footer_links'] == "on")
                                <h4 class="footer-widget-title">Main Items</h4>
                                <ul class="footer-list">
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Courses</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Explore</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Members</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Events</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Contact Us</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Hall of Fame</a></li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Newsletter Section (Full width on mobile) -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="footer-widget-box list">
                            <h4 class="footer-widget-title">Newsletter</h4>
                            @if($footerData['newsletter_enabled'] == "on")
                                <div class="footer-newsletter">
                                    <p>{{ $footerData['newsletter_description'] ?? 'Subscribe Our Newsletter To Get Latest Update And News' }}</p>
                                    <div class="subscribe-form">
                                        <form action="{{ route('frt.new.sub') }}" method="POST">
                                            @csrf
                                            <input type="email" class="form-control" placeholder="Your Email" name="email">
                                            <button class="theme-btn" type="submit">
                                                {{ $footerData['newsletter_button_label'] ?? 'Subscribe Now' }} <i class="{{ $footerData['newsletter_button_icon'] ?? 'far fa-paper-plane' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="footer-newsletter">
                                    <p>Stay with us...</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif
