@extends('layouts.master')

@section('title','Members')

@section('head-css')
    <style>
        #addRepBtn:hover i {
            transform: scale(1.2); /* Enlarges the icon on hover */
        }
        #addRepBtn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        .country-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            border-radius: 8px;
            background: #f8f9fa;
            border-left: 5px solid #007bff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            font-weight: 500;
        }

        .country-info img {
            width: 50px;
            height: 30px;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        #repForm {
            display: none;
            background-color: #f9f9f9; /* Light background for the form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            animation: slideIn 0.5s ease-out;
        }

        #repForm.show {
            display: block;
        }

        form .form-control {
            border-radius: 5px;
        }

        form .btn {
            width: 100%;
            border-radius: 5px;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        form {
            overflow: visible !important;
        }
            .member-card {
                height: 100px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .flag-img {
                object-fit: contain;
            }

        @media (max-width: 767.98px) {
            .heading {
                margin-top: 100px;
            }
        }

    </style>

@endsection

@section('scripts')
    <script>
        document.getElementById('addRepBtn').addEventListener('click', function () {
            const form = document.getElementById('repForm');

            // Toggle form visibility
            if (form.style.maxHeight) {
                form.style.maxHeight = null;
                form.style.display = "none";
            } else {
                form.style.display = "block";
                form.style.maxHeight = form.scrollHeight + "px";  // Set to form's scrollHeight for smooth slide-in

                // Scroll the page to the form
                window.scrollTo({
                    top: form.offsetTop - 100,  // Adjust the offset to fit above the form
                    behavior: 'smooth'
                });
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            let messages = {
                "DZ": "Hello, dear friend from Algeria! 🇩🇿 We're happy to have you here! 😊",
                "FR": "Salut, ami français! 🇫🇷 Join our amazing community and enjoy your stay! 🎉",
                "DE": "Hallo, Freund aus Deutschland! 🇩🇪 We’re excited to see you here! 🚀",
                "US": "Hey there, friend from the USA! 🇺🇸 You’re now part of something great! 🔥",
                "JP": "こんにちは、日本の友達! 🇯🇵 Welcome aboard! Let’s have a great time together! 🎌",
                "IN": "नमस्ते भारत के साथी! 🇮🇳 We’re glad you joined us! Let’s make something awesome! ✨"
            };

            $('#country').on('change', function () {
                let countryCode = $(this).val();
                if (countryCode !== "0") {
                    let flagUrl = `https://flagcdn.com/w40/${countryCode.toLowerCase()}.png`;
                    let message = messages[countryCode] || `Welcome, dear friend from ${$('#country option:selected').text()}! 🌍 We're happy to have you!`;

                    // Update flag and message
                    $('#country-flag').attr('src', flagUrl);
                    $('#welcome-message').text(message);

                    // Show the container with animation
                    $('#country-info-container').fadeIn();
                } else {
                    $('#country-info-container').fadeOut();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('openRepForm'))
            document.getElementById('repForm')?.classList.add('show');
            @endif
        });
    </script>
    <script>
        $('#memberModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var flagLarge = button.data('flag2');
            var flagSmall = button.data('flag');

            if (!flagLarge && flagSmall) {
                flagLarge = String(flagSmall).replace(/(\.[^/.]+)$/, '2$1');
            }

            var modal = $(this);
            modal.find('#memberModalLabel').text(name);
            modal.find('#modalFlag')
                .attr('src', flagLarge)
                .on('error', function() {
                    $(this).attr('src', flagSmall);
                });
        });

    </script>
@endsection

@section('wrapper')
    <div class="about-area mt-4">
        @include('layouts.includes.partials.alerts')
        @include('layouts.includes.gadgets.members')
    </div>
@endsection
