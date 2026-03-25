@extends('layouts.master')

@section('title', $page->title)

@section('head-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

@endsection

@php
    $content = preg_replace_callback(
        '#<img[^>]+src=["\'](/storage/uploads/[^"\']+)["\']#i',
        fn($m) => str_replace($m[1], 'https://admin.nanolympiad.org' . $m[1], $m[0]),
        $page->content
    );

    // Strip inline styles from <img> tags
    $content = preg_replace('/<img([^>]+)style=["\'][^"\']*["\']([^>]*)>/i', '<img$1$2>', $content);
@endphp


@section('styles')
    <style>
        .enlarged-image {
            max-width: 90vw;
            max-height: 90vh;
            border-radius: 12px;
        }

        .static-page .content img {
            display: block;
            width: 100%;
            max-width: 100%;
            height: auto;
            margin: 30px auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            transition: all 0.7s ease-out;
            opacity: 0;
            transform: translateY(40px);
        }

        .static-page .content img:hover {
            transform: scale(1.02);
        }

        .static-page .content img.in-view {
            opacity: 1;
            transform: translateY(0);
        }


        .static-page .content p {
            margin-top: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .static-page .content h2,
        .static-page .content h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #16a085;
            font-weight: bold;
        }

        /* Optional smoother scroll appearance */
        .fade-in {
            animation: fadeIn 0.6s ease-out both;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .static-page .section {
            margin-bottom: 50px;
        }

        .static-page .content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2d2d2d;
        }

        .static-page .content h2,
        .static-page .content h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #16a085;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .static-page .content ul {
            margin-left: 1.5rem;
            padding-left: 0.5rem;
            list-style-type: disc;
        }

        .static-page .content img {
            display: block;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            margin: 25px auto;
            transition: transform 0.3s ease;
        }

        .static-page .content img:hover {
            transform: scale(1.02);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out both;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modern-carousel-container {
            max-width: 1080px;
            margin: 60px auto 40px;
            padding: 0 20px;
        }

        .carousel-slide {
            padding: 0 10px;
        }

        .carousel-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .carousel-description {
            text-align: center;
            font-size: 1.05rem;
            color: #444;
            margin-top: 12px;
            font-weight: 500;
        }

        .slick-prev,
        .slick-next {
            background: rgba(255,255,255,0.85) !important;
            border-radius: 50%;
            width: 40px !important;
            height: 40px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            z-index: 1;
        }

        .slick-prev:hover,
        .slick-next:hover {
            background: #fff !important;
        }

        .slick-prev:before,
        .slick-next:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 20px;
            color: #333;
        }

        .slick-prev:before { content: '\f104'; }
        .slick-next:before { content: '\f105'; }

        .carousel-controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }

        .carousel-btn {
            padding: 10px 26px;
            border-radius: 25px;
            background: #007bff;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .carousel-btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }
    </style>
@endsection

@section('wrapper')
    <div class="static-page container py-4 fade-in">
        @include('layouts.includes.parsers.bread-crumb')

        <div class="section content">
            {!! $content !!}
        </div>

        <div class="text-center my-5">
            <a href="https://visitiran.ir" target="_blank" class="visit-iran-btn">
                <span class="btn-text">Explore Iran's Wonders</span>
                <span class="btn-icon">✈️</span>
                <span class="btn-sparkles"></span>
            </a>
        </div>

        <style>
            .visit-iran-btn {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                font-size: 1.8rem;
                font-weight: 700;
                padding: 1rem 2.5rem;
                background: linear-gradient(135deg, #f12711, #f5af19, #e1f549, #f5af19, #f12711);
                background-size: 300% 300%;
                color: white;
                border-radius: 60px;
                box-shadow: 0 10px 25px rgba(241, 39, 17, 0.4),
                0 5px 10px rgba(245, 175, 25, 0.4),
                inset 0 0 15px rgba(255,255,255,0.3);
                transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                position: relative;
                overflow: hidden;
                text-shadow: 0 2px 4px rgba(0,0,0,0.2);
                border: 2px solid rgba(255,255,255,0.2);
                animation: gradientShift 8s ease infinite;
            }

            .btn-text {
                position: relative;
                z-index: 2;
            }

            .btn-icon {
                display: inline-block;
                transform: translateX(0) rotate(0);
                transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                position: relative;
                z-index: 2;
            }

            .btn-sparkles {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                overflow: hidden;
                z-index: 1;
            }

            .btn-sparkles::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%);
                opacity: 0;
                transition: opacity 0.4s ease;
            }

            .visit-iran-btn:hover {
                transform: translateY(-5px) scale(1.05);
                box-shadow: 0 15px 35px rgba(241, 39, 17, 0.6),
                0 10px 15px rgba(245, 175, 25, 0.5),
                inset 0 0 20px rgba(255,255,255,0.4);
                animation: gradientShift 4s ease infinite;
            }

            .visit-iran-btn:hover .btn-icon {
                transform: translateX(5px) rotate(15deg);
            }

            .visit-iran-btn:hover .btn-sparkles::before {
                opacity: 0.6;
                animation: sparkleRotate 4s linear infinite;
            }

            .visit-iran-btn::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg,
                transparent,
                rgba(255,255,255,0.2),
                transparent);
                transform: translateX(-100%);
                transition: transform 0.6s ease;
            }

            .visit-iran-btn:hover::after {
                transform: translateX(100%);
            }

            @keyframes gradientShift {
                0% { background-position: 0% 50% }
                50% { background-position: 100% 50% }
                100% { background-position: 0% 50% }
            }

            @keyframes sparkleRotate {
                from { transform: rotate(0deg) }
                to { transform: rotate(360deg) }
            }

            /* Pulse animation when page loads */
            @keyframes pulse {
                0% { transform: scale(1) }
                50% { transform: scale(1.05) }
                100% { transform: scale(1) }
            }

            .visit-iran-btn {
                animation: pulse 2s ease 1, gradientShift 8s ease infinite;
            }

            .carousel-btn {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 22px;
            }

            .carousel-btn i {
                pointer-events: none;
            }

        </style>

        @php
            $allowedIp = '178.131.169.67';
        @endphp

        @if (request()->ip() === $allowedIp)

        <div class="modern-carousel-container">
            <div class="slick-carousel">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="carousel-slide">
                        <img src="{{ asset('carousel/images/slider/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg') }}"
                             alt="Slide {{ $i }}"
                             class="carousel-image" />
                        <div class="carousel-description">
                            Photo description for slide {{ $i }}
                        </div>
                    </div>
                @endfor
            </div>

            <div class="carousel-controls">
                <div class="carousel-btn" id="carousel-prev">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="carousel-btn" id="carousel-next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

        </div>

            <style>
                .carousel-controls {
                    display: flex;           /* make children in a row */
                    justify-content: center; /* center the buttons horizontally */
                    gap: 20px;               /* space between buttons */
                    margin: 20px 0;          /* top & bottom spacing */
                }

                .carousel-btn {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background: #007bff;
                    color: white;
                    font-size: 22px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: background 0.3s ease, transform 0.2s ease;
                }

                .carousel-btn:hover {
                    background: #0056b3;
                    transform: scale(1.05);
                }

                .carousel-btn i {
                    pointer-events: none;
                }

                /* MOBILE SCROLL FIX FOR MODAL */
                @media (max-width: 768px) {
                    .qr-modal {
                        display: flex !important;
                        align-items: flex-start;
                        padding: 20px;
                        overflow-y: auto;
                        -webkit-overflow-scrolling: touch;
                    }

                    .qr-modal.active {
                        display: flex !important;
                    }

                    .qr-modal-content {
                        max-height: 90vh;
                        overflow-y: auto;
                        -webkit-overflow-scrolling: touch;
                        margin: auto;
                        width: 95%;
                        transform-origin: center;
                        border-radius: 15px;
                    }

                    .modal-body {
                        display: flex;
                        flex-direction: column;
                        max-height: none;
                        overflow: visible;
                    }

                    .modal-qr-container {
                        min-width: 100%;
                        order: 1;
                    }

                    .modal-info {
                        min-width: 100%;
                        order: 2;
                        padding-bottom: 20px;
                    }

                    .modal-qr-wrapper {
                        max-width: 280px;
                        height: 280px;
                        margin: 0 auto 20px;
                    }

                    .modal-actions {
                        flex-direction: column;
                        gap: 10px;
                        position: sticky;
                        bottom: 0;
                        background: white;
                        padding: 15px 0;
                        border-top: 1px solid #eee;
                        margin-top: 10px;
                    }

                    .modal-btn {
                        width: 100%;
                        min-width: unset;
                        padding: 14px;
                    }

                    /* Prevent body scroll when modal is open */
                    body.modal-open {
                        overflow: hidden;
                        position: fixed;
                        width: 100%;
                        height: 100%;
                    }
                }

                @media (max-width: 480px) {
                    .qr-modal-content {
                        max-height: 85vh;
                        width: 100%;
                        margin: 10px;
                        border-radius: 10px;
                    }

                    .modal-header {
                        padding: 25px 20px 15px;
                    }

                    .modal-body {
                        padding: 25px 20px;
                    }

                    .modal-title {
                        font-size: 24px;
                    }

                    .modal-subtitle {
                        font-size: 14px;
                    }

                    .modal-qr-wrapper {
                        max-width: 220px;
                        height: 220px;
                        padding: 15px;
                    }

                    .scan-instructions {
                        padding: 15px;
                        font-size: 13px;
                    }

                    .modal-info h4 {
                        font-size: 18px;
                    }

                    .modal-features li {
                        font-size: 14px;
                    }
                }

                /* Custom scrollbar for modal on mobile */
                .qr-modal-content::-webkit-scrollbar {
                    width: 6px;
                }

                .qr-modal-content::-webkit-scrollbar-track {
                    background: #f1f1f1;
                    border-radius: 10px;
                }

                .qr-modal-content::-webkit-scrollbar-thumb {
                    background: #888;
                    border-radius: 10px;
                }

                .qr-modal-content::-webkit-scrollbar-thumb:hover {
                    background: #555;
                }

                /* Ensure all QR items are visible on all screens */
                @media (max-height: 600px) {
                    .qrboard-container {
                        min-height: 100vh;
                    }

                    .qrboard-grid {
                        grid-template-columns: repeat(2, 1fr);
                        gap: 15px;
                    }

                    .qrboard-item {
                        padding: 15px;
                    }
                }

                /* Fix for very long names */
                .qrboard-name {
                    word-wrap: break-word;
                    overflow-wrap: break-word;
                    hyphens: auto;
                    max-height: 3.6em; /* Show about 2 lines */
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }

                /* Ensure modal fits on all screens */
                @media (max-height: 500px) {
                    .qr-modal-content {
                        max-height: 95vh;
                        margin: 10px auto;
                    }

                    .modal-qr-wrapper {
                        max-width: 180px;
                        height: 180px;
                    }
                }
            </style>
        @endif

        @include('layouts.includes.gadgets.qr-codes')

        <img
                src="{{ asset('img/qr/main.png') }}"
                width="500"
                height="400"
                style="
        display: block;
        margin: 40px auto;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    "
                onmouseover="this.style.transform='scale(1.1)';"
                onmouseout="this.style.transform='scale(1)';"
        />

        <style>
            .btn-gradient {
                background: linear-gradient(135deg, #4c6ef5, #15aabf);
                color: #fff;
                border: none;
                cursor: pointer;
                transition: 0.25s ease;
                font-size: 1rem;
                box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            }
            .btn-gradient:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 16px rgba(0,0,0,0.25);
            }
            .btn-gradient:active {
                transform: scale(0.97);
            }
        </style>

    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        window.onload = function () {
            const images = document.querySelectorAll(".static-page .content img");

            const isInViewport = el => {
                const rect = el.getBoundingClientRect();
                return rect.top < window.innerHeight && rect.bottom > 0;
            };

            const onScroll = () => {
                images.forEach(img => {
                    if (isInViewport(img)) {
                        img.classList.add("in-view");
                    }
                });
            };

            window.addEventListener("scroll", onScroll);
            onScroll(); // check once on load
        };

        images.forEach((img, i) => {
            if (isInViewport(img)) {
                setTimeout(() => {
                    img.classList.add("in-view");
                }, i * 100); // 100ms stagger
            }
        });
    </script>
    <script>
        $('.carousel-image').on('click', function () {
            const imgSrc = $(this).attr('src');

            Swal.fire({
                imageUrl: imgSrc,
                imageAlt: 'Preview',
                background: '#000',
                showConfirmButton: false,
                backdrop: 'rgba(0,0,0,0.9)',
                customClass: {
                    image: 'enlarged-image'
                }
            });
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            const $carousel = $('.slick-carousel');

            $carousel.slick({
                centerMode: true,
                centerPadding: '0',
                slidesToShow: 3,
                focusOnSelect: true,
                speed: 300,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                responsive: [
                    { breakpoint: 992, settings: { slidesToShow: 2, centerMode: true }},
                    { breakpoint: 768, settings: { slidesToShow: 1, centerMode: false }}
                ]
            });

            $('#carousel-prev').on('click', () => $carousel.slick('slickPrev'));
            $('#carousel-next').on('click', () => $carousel.slick('slickNext'));

            // Click-to-enlarge images
            $('.carousel-image').on('click', function () {
                Swal.fire({
                    imageUrl: $(this).attr('src'),
                    background: '#000',
                    showConfirmButton: false,
                    backdrop: 'rgba(0,0,0,0.9)'
                });
            });
        });
    </script>


@endsection
