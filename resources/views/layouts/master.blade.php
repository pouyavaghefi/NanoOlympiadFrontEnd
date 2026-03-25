<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.includes.init.head')
    @include('layouts.includes.init.meta')

    <title>
        {{ $seoSettings->meta_title ?? $bases['siteName'] }}
    </title>
    <style>
        #main_nav {
            flex: 1;
            justify-content: center;
        }

        @media (min-width: 992px) {
            .desktop-only-style {
                width: 120px;
                padding-left: 10px;
            }
        }

        @media (max-width: 768px) {
            #earthback, #moonback, .country-name {
                display: none !important;
            }
        }

        .whatsapp-icon-floting {
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            left: 18px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            -webkit-box-shadow: 2px 2px 3px #999;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .my-float{
            width: 30px;
            fill: white;
            background: transparent;
        }
        @media (max-width: 991.98px) {
            .dropdown-menu {
                position: static !important;
                display: block !important;
                float: none;
                width: 100%;
                background: #fff;
                box-shadow: none;
                margin-top: 0;
                z-index: 1050;
            }

            .dropdown-menu .dropdown-item {
                padding-left: 2rem;
            }

            .dropdown:hover .dropdown-menu {
                display: block !important;
            }

            .nav-item.dropdown > a {
                pointer-events: auto;
            }
        }

    </style>

    @if (app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('rtl.css') }}">
    @endif

    @yield('head-css')
    <style>
        .atom-loader{position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.85);display:flex;flex-direction:column;justify-content:center;align-items:center;z-index:9999;color:#fff;transition:opacity .5s,visibility .5s;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif}
        .atom-loader.hidden{opacity:0;visibility:hidden;pointer-events:none}
        .atom-container{position:relative;width:180px;height:180px;margin-bottom:30px}
        .nucleus{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:20px;height:20px;background:radial-gradient(circle,#ff4081,#e91e63);border-radius:50%;box-shadow:0 0 20px #ff4081,0 0 40px rgba(255,64,129,.5);z-index:10}
        .orbit{position:absolute;top:50%;left:50%;border:2px solid;border-radius:50%;transform:translate(-50%,-50%);animation-iteration-count:infinite;animation-timing-function:linear;animation-duration:3s}
        .orbit-1{width:120px;height:120px;border-color:rgba(79,195,247,.7);animation-name:orbit-rotate-1}
        .orbit-2{width:90px;height:90px;border-color:rgba(255,193,7,.7);animation-name:orbit-rotate-2;transform:translate(-50%,-50%) rotate(45deg)}
        .orbit-3{width:150px;height:150px;border-color:rgba(76,175,80,.7);animation-name:orbit-rotate-3;transform:translate(-50%,-50%) rotate(120deg)}
        .electron{position:absolute;width:12px;height:12px;border-radius:50%;top:0;left:50%;transform:translateX(-50%)}
        .electron-1{background:#4fc3f7;box-shadow:0 0 10px #4fc3f7,0 0 20px rgba(79,195,247,.7)}
        .electron-2{background:#ffc107;box-shadow:0 0 10px #ffc107,0 0 20px rgba(255,193,7,.7)}
        .electron-3{background:#4caf50;box-shadow:0 0 10px #4caf50,0 0 20px rgba(76,175,80,.7)}
        @keyframes orbit-rotate-1{0%{transform:translate(-50%,-50%) rotate(0)}100%{transform:translate(-50%,-50%) rotate(360deg)}}
        @keyframes orbit-rotate-2{0%{transform:translate(-50%,-50%) rotate(45deg)}100%{transform:translate(-50%,-50%) rotate(405deg)}}
        @keyframes orbit-rotate-3{0%{transform:translate(-50%,-50%) rotate(120deg)}100%{transform:translate(-50%,-50%) rotate(480deg)}}
        .loader-text{font-size:1.5rem;margin-top:20px;text-align:center;letter-spacing:2px;animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{opacity:.7}50%{opacity:1}}
        .loading-bar{width:200px;height:4px;background-color:rgba(255,255,255,.2);border-radius:2px;margin-top:20px;overflow:hidden}
        .loading-progress{height:100%;width:0;background:linear-gradient(90deg,#ff4081,#4fc3f7);border-radius:2px;transition:width .3s}
    </style>
    <style>
        @media (max-width: 991.98px) {
            .navbar-collapse {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: #fff;
                z-index: 1000;
                padding: 2rem;
                overflow-y: auto;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .navbar-collapse.show {
                transform: translateX(0);
            }

            .mobile-menu-right {
                display: block !important;
                z-index: 1100;
                position: relative;
            }

            .navbar-toggler {
                font-size: 1.5rem;
                padding: 0.5rem;
                background: transparent;
                border: none;
                cursor: pointer;
                z-index: 1101;
                position: relative;
            }

            /* Ensure the toggle button stays on top */
            .navbar-toggler-mobile-icon {
                position: relative;
                z-index: 1102;
            }

            /* Close button styling */
            .fa-times {
                color: #333 !important;
            }
        }
    </style>
</head>

<body class="@if(app()->getLocale() === 'ar') noto-sans-arabic @endif">

<!-- header area -->
@include('layouts.includes.header')
<!-- header area end -->

<!-- popup search -->
@include('layouts.includes.parsers.popup-search')
<!-- popup search end -->

<main class="main">
    @yield('wrapper')
</main>

<!-- footer area -->
@include('layouts.includes.footer')
<!-- footer area end -->

@include('layouts.includes.parsers.floating-wp')

<!-- scroll-top -->
@include('layouts.includes.parsers.scroll-to-top')
<!-- scroll-top end -->

<!-- js -->
@include('layouts.includes.init.scripts')
@include('sweetalert::alert')
@yield('scripts')
@include('layouts.includes.partials.atom-loader')

<script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.38/bundled/lenis.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => { // Wait for 1 second after page load
            const features = document.querySelectorAll(".feature-item");

            features.forEach((feature, index) => {
                setTimeout(() => {
                    feature.classList.add("reveal");
                }, index * 1000);
            });
        }, 2000);
    });
    document.querySelectorAll("#main_nav .nav-link").forEach(item => {
        item.addEventListener("click", function (e) {
            const isDropdown = item.classList.contains("dropdown-toggle");
            if (window.innerWidth < 992 && !isDropdown) {
                let bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
                bsCollapse.hide();
                togglerIcon.classList.remove("fa-times");
                togglerIcon.classList.add("fa-bars");
            }
        });
    });

</script>
<script>
    document.addEventListener('mousemove', function(event) {
        const moon = document.querySelector('.moon');
        const leftEye = document.querySelector('.eye.left');
        const rightEye = document.querySelector('.eye.right');

        const deltaX = event.clientX - moonCenterX;
        const deltaY = event.clientY - moonCenterY;

        const angle = Math.atan2(deltaY, deltaX);

        const eyeDistance = 12;
        const leftEyeX = Math.cos(angle) * eyeDistance;
        const leftEyeY = Math.sin(angle) * eyeDistance;
        const rightEyeX = Math.cos(angle) * eyeDistance;
        const rightEyeY = Math.sin(angle) * eyeDistance;

        leftEye.style.transform = `translate(-50%, -50%) translate(${leftEyeX}px, ${leftEyeY}px)`;
        rightEye.style.transform = `translate(-50%, -50%) translate(${rightEyeX}px, ${rightEyeY}px)`;
    });
    document.addEventListener("DOMContentLoaded", function () {
        const starsContainer = document.querySelector(".stars");
        const numberOfStars = 100;

        for (let i = 0; i < numberOfStars; i++) {
            const star = document.createElement("div");
            star.classList.add("star");
            star.style.top = `${Math.random() * 100}%`;
            star.style.left = `${Math.random() * 100}%`;
            star.style.animationDelay = `${Math.random() * 2}s`;
            starsContainer.appendChild(star);
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        const starsContainer = document.querySelector(".stars");
        const numberOfStars = 100;

        for (let i = 0; i < numberOfStars; i++) {
            const star = document.createElement("div");
            star.classList.add("star");
            star.style.top = `${Math.random() * 100}%`;
            star.style.left = `${Math.random() * 100}%`;
            star.style.animationDelay = `${Math.random() * 2}s`;
            starsContainer.appendChild(star);
        }
    });
    window.addEventListener('scroll', function() {
        var footer = document.querySelector('.footer-area');
        if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - footer.offsetHeight) {
            footer.classList.add('footer-dark');
        } else {
            footer.classList.remove('footer-dark');
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbarToggler = document.getElementById("navbar-toggler");
        const navbarCollapse = document.getElementById("main_nav");
        const togglerIcon = document.querySelector(".navbar-toggler-mobile-icon i");

        navbarToggler.addEventListener("click", function () {
            // Toggle the 'show' class on the navbar collapse
            navbarCollapse.classList.toggle("show");

            // Toggle the icon between bars and times
            if (navbarCollapse.classList.contains("show")) {
                togglerIcon.classList.remove("fa-bars");
                togglerIcon.classList.add("fa-times");
                document.body.style.overflow = "hidden"; // Prevent scrolling when menu is open
            } else {
                togglerIcon.classList.remove("fa-times");
                togglerIcon.classList.add("fa-bars");
                document.body.style.overflow = "auto"; // Re-enable scrolling
            }
        });

        // Close navbar when clicking a menu item (on mobile)
        document.querySelectorAll("#main_nav .nav-link").forEach(item => {
            item.addEventListener("click", function () {
                if (window.innerWidth < 992) {
                    navbarCollapse.classList.remove("show");
                    togglerIcon.classList.remove("fa-times");
                    togglerIcon.classList.add("fa-bars");
                    document.body.style.overflow = "auto";
                }
            });
        });

        // Close navbar when clicking outside (optional)
        document.addEventListener("click", function(event) {
            if (!navbarCollapse.contains(event.target) &&
                !navbarToggler.contains(event.target) &&
                navbarCollapse.classList.contains("show")) {
                navbarCollapse.classList.remove("show");
                togglerIcon.classList.remove("fa-times");
                togglerIcon.classList.add("fa-bars");
                document.body.style.overflow = "auto";
            }
        });
    });
</script>
    <script>
        document.addEventListener('DOMContentLoaded',()=>{const l=document.getElementById('atomLoader'),p=document.getElementById('loadingProgress');let progress=0;
        const simulate=()=>{progress=0;p.style.width='0%';
        const i=setInterval(()=>{progress+=Math.random()*20; // faster fill
        if(progress>=100){progress=100;clearInterval(i);
        setTimeout(()=>l.classList.add('hidden'),300);} // quicker fade
        p.style.width=progress+'%';},100);}; // shorter interval
        simulate();
        window.showAtomLoader=()=>{l.classList.remove('hidden');simulate()};
        window.changeAtomLoaderText=t=>{document.querySelector('.loader-text').textContent=t}});
        window.changeAtomLoaderText('INITIALIZING...');

    </script>
</body>
</html>
