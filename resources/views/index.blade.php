@extends('layouts.master')

@section('title','Homepage')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<style>
    .whats-float {
        position: fixed;
        transform:translate(108px,0px);
        top:25%;
        right:0;
        width:150px;
        overflow: hidden;
        background-color: #25d366;
        color: #FFF;
        border-radius: 2px 0 0 2px;
        z-index: 10;
        transition: all 0.5s ease-in-out;
        vertical-align: middle
    }
    .whats-float a span {
        color: white;
        font-size: 15px;
        padding-top: 8px;
        padding-bottom: 10px;
        position: absolute;
        line-height: 16px;
        font-weight: bolder;
    }

    .whats-float i {
        font-size: 30px;
        color: white;
        line-height: 30px;
        padding: 10px;
        transform:rotate(0deg);
        transition: all 0.5s ease-in-out;
        text-align:center;

    }

    .whats-float:hover {
        color: #FFFFFF;
        transform:translate(0px,0px);
    }

    .whats-float:hover i  {
        transform:rotate(360deg);
    }




</style>
@endsection

@section('wrapper')
    <!-- hero slider -->
    @if(in_array('hero', $enabledSections))
        @include('layouts.includes.gadgets.hero')
    @endif
    <!-- hero slider end -->

    <!-- feature area -->
    @if(in_array('feature-area', $enabledSections))
        @include('layouts.includes.gadgets.feature-area')
    @endif
    <!-- feature area end -->

    <!-- about area -->
    @if(in_array('about-area', $enabledSections))
        @include('layouts.includes.gadgets.about-area')
    @endif
    <!-- about area end -->

    <!-- counter area -->
    @if(in_array('counter-area', $enabledSections))
        @include('layouts.includes.gadgets.counter-area')
    @endif
    <!-- counter area end -->

    <!-- course-area -->
    @if(in_array('course-area', $enabledSections))
        @include('layouts.includes.gadgets.course-area')
    @endif
    <!-- course-area -->

    <!-- video-area -->
    {{--    @include('layouts.includes.gadgets.video-area')--}}
    <!-- video-area end -->

    <!-- team-area -->
    {{--    @include('layouts.includes.gadgets.team-area')--}}
    <!-- team-area end -->

    <!-- choose-area -->
    {{--    @include('layouts.includes.gadgets.choose-area')--}}
    <!-- choose-area end -->

    <!-- gallery-area -->
    {{--    @include('layouts.includes.gadgets.gallery-area')--}}
    <!-- gallery-area end -->

    <!-- cta-area -->
    {{--    @include('layouts.includes.gadgets.cta')--}}
    <!-- cta-area end -->

    <!-- event area -->
    {{--    @include('layouts.includes.gadgets.event-area')--}}
    <!-- event area end -->

    <!-- enroll area-->
    {{--    @include('layouts.includes.gadgets.enroll-area')--}}
    <!-- enroll area end -->

    <!-- department area -->
    @if(in_array('department-area', $enabledSections))
        @include('layouts.includes.gadgets.department-area')
    @endif
    <!-- department area end -->

    <!-- testimonial area -->
    {{--    @include('layouts.includes.gadgets.testimonials-area')--}}
    <!-- testimonial area end -->

    <!-- blog area -->
    {{--    @include('layouts.includes.gadgets.blog-area')--}}
    <!-- blog area end -->


    </div>

    @include('layouts.includes.gadgets.winners')

    <!-- partner area -->
    @if(in_array('partner-area', $enabledSections))
        @include('layouts.includes.gadgets.partner-area')
    @endif
    <!-- partner area end -->

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = new URL(window.location.href);

        // Check if "auth_token" exists in query parameters
        if (currentUrl.searchParams.has("auth_token")) {
            currentUrl.searchParams.delete("auth_token"); // remove token
            window.location.replace(currentUrl.toString()); // redirect to clean URL
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    // Initialize particles.js background
    document.addEventListener('DOMContentLoaded', function() {
        particlesJS("ino-particles-js", {
            particles: {
                number: { value: 120, density: { enable: true, value_area: 1000 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.7, random: true },
                size: { value: 4, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.3,
                    width: 1.5
                },
                move: {
                    enable: true,
                    speed: 3,
                    direction: "none",
                    random: true,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" },
                    resize: true
                }
            },
            retina_detect: true
        });

        // Medal filter functionality
        const inoFilterButtons = document.querySelectorAll('.ino-filter-btn');
        const inoCountryButtons = document.querySelectorAll('.ino-country-btn');
        const inoWinnerCards = document.querySelectorAll('.ino-winner-card');

        inoFilterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                inoFilterButtons.forEach(btn => btn.classList.remove('ino-active'));
                // Add active class to clicked button
                button.classList.add('ino-active');

                const filter = button.getAttribute('data-filter');
                applyFilters();

                // Trigger celebration for gold filter
                if (filter === 'gold') {
                    inoCreateConfetti();
                }
            });
        });

        inoCountryButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all country buttons
                inoCountryButtons.forEach(btn => btn.classList.remove('ino-active'));
                // Add active class to clicked button
                button.classList.add('ino-active');

                applyFilters();
            });
        });

        function applyFilters() {
            const activeFilter = document.querySelector('.ino-filter-btn.ino-active').getAttribute('data-filter');
            const activeCountry = document.querySelector('.ino-country-btn.ino-active').getAttribute('data-country');

            inoWinnerCards.forEach(card => {
                const medalType = card.classList.contains('ino-gold') ? 'gold' :
                    card.classList.contains('ino-silver') ? 'silver' :
                        card.classList.contains('ino-bronze') ? 'bronze' : 'none';
                const country = card.getAttribute('data-country');

                const medalMatch = activeFilter === 'all' ||
                    (activeFilter === 'gold' && medalType === 'gold') ||
                    (activeFilter === 'silver' && medalType === 'silver') ||
                    (activeFilter === 'bronze' && medalType === 'bronze');
                const countryMatch = activeCountry === 'all' || country === activeCountry;

                if (medalMatch && countryMatch) {
                    card.style.display = 'block';
                    // Add animation
                    card.style.animation = 'none';
                    setTimeout(() => {
                        card.style.animation = 'ino-fadeInUp 0.8s forwards';
                    }, 10);
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Create confetti celebration
        function inoCreateConfetti() {
            const celebration = document.getElementById('ino-celebration');
            celebration.style.display = 'block';

            // Clear any existing confetti
            celebration.innerHTML = '';

            // Create confetti particles
            for (let i = 0; i < 200; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'ino-confetti';

                // Random colors
                const colors = ['#FFD700', '#FFEC8B', '#FFA500', '#FF8C00', '#FF4500', '#C0C0C0', '#E8E8E8', '#CD7F32', '#E6B17E'];
                const randomColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.setProperty('--ino-confetti-color', randomColor);

                // Random position and animation
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confetti.style.animationDelay = (Math.random() * 2) + 's';
                confetti.style.opacity = Math.random() * 0.7 + 0.3;
                confetti.style.width = (Math.random() * 10 + 5) + 'px';
                confetti.style.height = (Math.random() * 15 + 10) + 'px';
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;

                celebration.appendChild(confetti);

                // Remove confetti after animation completes
                setTimeout(() => {
                    if (confetti.parentNode) {
                        confetti.remove();
                    }
                }, 5000);
            }

            // Hide celebration container after animation
            setTimeout(() => {
                celebration.style.display = 'none';
            }, 5000);
        }

        // Add hover effects to winner cards
        inoWinnerCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-15px) rotateX(5deg) scale(1.03)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) rotateX(0) scale(1)';
            });
        });

        // Add staggered animation to cards on load
        inoWinnerCards.forEach((card, index) => {
            card.style.animationDelay = (index * 0.1) + 's';
        });
    });
</script>
@endsection
