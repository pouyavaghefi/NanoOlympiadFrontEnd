@extends('layouts.master')

@section('title','Register')

@section('styles')
<style>
    .text-danger {
        color:red !important;
    }
    .text-success{
        color:green !important;
    }
    #password-strength-text {
        font-size: 0.875rem;
    }

    #password-mismatch-feedback {
        font-size: 0.875rem;
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
</style>
@endsection

@section('wrapper')
    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Register</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">
                        @if(Session::has('emailVerified'))
                            Complete Registration
                        @else
                            Register
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- register area -->
        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form" id="authForm">
                        <div class="login-header">
                            @if(\Illuminate\Support\Facades\Session::has('emailVerified'))
                                <h3>You're Almost In!</h3>
                                <sup>{{ \Illuminate\Support\Facades\Session::get('emailVerified') }}</sup>
                            @else
                                <h3>Create your account</h3>
                            @endif
                        </div>

                        @include('layouts.includes.partials.alerts')

                        @if(!\Illuminate\Support\Facades\Session::has('emailVerified'))
                            @include('layouts.includes.forms.first_step_registration')
                        @else
                            @php
                                $email = session('emailVerified');
                                $associatedUser = \App\Models\User::where('email', $email)->first();
                            @endphp
{{--                            @include('layouts.includes.forms.second_step_registration', ['associatedUser' => $associatedUser])--}}
                        @endif

                        @if(!\Illuminate\Support\Facades\Session::has('emailVerified'))
                            <div class="login-footer">
                                <p>Already have an account? <a href="{{ route('cla.login') }}">Login.</a></p>
                            </div>
                        @else
                            <div class="login-footer">
                                <p><a href="{{ env('EXTERNAL_LOGIN') }}">Login to your Profile.</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@php
    $countryList = DB::table('countries')
        ->select('code', 'name', 'phone_code')
        ->whereNotNull('continent')
        ->get()
        ->mapWithKeys(function ($c) {
            return [$c->code => ['name' => $c->name, 'phone' => $c->phone_code]];
        });
@endphp

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        window.onload = function() {
            const loginForm = document.getElementById('authForm');
            if (loginForm) {
                window.scrollTo({
                    top: loginForm.offsetTop - 45,
                    behavior: 'smooth'
                });
            }
        };
    </script>
    <script>
        function previewImage(inputId, previewImgId, previewContainerId) {
            document.getElementById(inputId).addEventListener('change', function (event) {
                let file = event.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById(previewImgId).src = e.target.result;
                        document.getElementById(previewContainerId).style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removeImage(inputId, previewContainerId) {
            document.getElementById(previewContainerId).addEventListener('click', function (event) {
                if (event.target.tagName === "BUTTON") {
                    document.getElementById(inputId).value = "";
                    document.getElementById(previewContainerId).style.display = 'none';
                }
            });
        }

        // Apply the functions for both photo inputs
        previewImage('photo-input', 'photo-preview', 'photo-preview-container');
        removeImage('photo-input', 'photo-preview-container');

        previewImage('passport-photo-input', 'passport-photo-preview', 'passport-photo-preview-container');
        removeImage('passport-photo-input', 'passport-photo-preview-container');
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let passportInput = document.querySelector('input[name="passport_number"]');

            passportInput.addEventListener("input", function () {
                let passportPattern = /^[A-Za-z0-9]{6,9}$/; // Only letters & numbers, 6-9 characters
                let errorMsg = document.getElementById("passport-error");

                if (!passportPattern.test(this.value)) {
                    if (!errorMsg) {
                        let errorDiv = document.createElement("div");
                        errorDiv.id = "passport-error";
                        errorDiv.style.color = "red";
                        errorDiv.innerText = "Invalid passport number. Use 6-9 letters/numbers.";
                        this.parentNode.appendChild(errorDiv);
                    }
                } else {
                    if (errorMsg) errorMsg.remove();
                }
            });
        });
    </script>
    <script>
        const countries = @json($countryList);

        document.addEventListener('DOMContentLoaded', function () {
            const countrySelect = document.getElementById('country');
            const telegramInput = document.querySelector('input[name="telegram_mobile"]');
            const mobileInput = document.querySelector('input[name="mobile"]');
            const flagImg = document.getElementById('country-flag');
            const codePreview = document.getElementById('country-code-preview');
            const welcomeText = document.getElementById('country-welcome');
            const previewContainer = document.getElementById('country-preview');

            countrySelect.addEventListener('change', function () {
                const selected = this.value;
                const country = countries[selected];

                if (country) {
                    // Set placeholders
                    const phoneCode = '+' + country.phone;
                    telegramInput.placeholder = `Telegram Mobile (e.g. ${phoneCode}912345678)`;
                    mobileInput.placeholder = `Mobile Number (e.g. ${phoneCode}912345678)`;

                    // Set preview info
                    if (flagImg && codePreview && welcomeText && previewContainer) {
                        flagImg.src = `https://flagsapi.com/${selected}/flat/32.png`;
                        codePreview.innerText = `Code: ${phoneCode}`;
                        welcomeText.innerText = `Welcome from ${country.name}`;
                        previewContainer.style.display = 'flex';
                    }
                }
            });
        });
    </script>
@endsection
