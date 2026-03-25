@extends('layouts.master')

@section('title','Forogot Password?')

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
    </style>
@endsection

@section('wrapper')
    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Forgot Password</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Forgot Password</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- login area -->
        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form" id="authForm">
                        <div class="login-header">
                            <h3>Forgot Password</h3>
                        </div>

                        @include('layouts.includes.partials.alerts')


                        <form action="{{ route('cla.forgot.do') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Your Email" name="email">
                            </div>

                            <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn">
                                    <i class="far fa-paper-plane"></i> Reset Password
                                </button>
                            </div>
                        </form>

                        <div class="login-footer">
                            <p><a href="javascript:history.back();">Click to go back.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            const passwordField = $('#password');
            const confirmPasswordField = $('#password_confirmation');
            const passwordStrengthBar = $('#password-strength');
            const passwordStrengthText = $('#password-strength-text');
            const mismatchFeedback = $('#password-mismatch-feedback');

            confirmPasswordField.on('input', function () {
                const password = passwordField.val();
                const confirmPassword = confirmPasswordField.val();

                mismatchFeedback.text('');
                mismatchFeedback.removeClass('text-danger text-success');

                if (password !== confirmPassword) {
                    mismatchFeedback.text('Passwords do not match.').addClass('text-danger');
                } else {
                    mismatchFeedback.text('Passwords match.').addClass('text-success');
                }
            });

            passwordField.on('input', function () {
                const password = passwordField.val();
                let strength = 0;

                if (password.length >= 6) strength += 1;
                if (password.length >= 8) strength += 1;
                if (/[A-Z]/.test(password)) strength += 1;
                if (/[0-9]/.test(password)) strength += 1;
                if (/[^A-Za-z0-9]/.test(password)) strength += 1;

                const strengthPercent = (strength / 5) * 100;
                passwordStrengthBar.css('width', strengthPercent + '%');

                passwordStrengthBar.removeClass('bg-danger bg-warning bg-success');

                if (strengthPercent === 0) {
                    passwordStrengthText.text('').removeClass('text-danger text-warning text-success');
                } else if (strengthPercent <= 60) {
                    passwordStrengthText.text('Weak').removeClass('text-warning text-success').addClass('text-danger');
                    passwordStrengthBar.addClass('bg-danger');
                } else if (strengthPercent <= 80) {
                    passwordStrengthText.text('Moderate').removeClass('text-danger text-success').addClass('text-warning');
                    passwordStrengthBar.addClass('bg-warning');
                } else {
                    passwordStrengthText.text('Strong').removeClass('text-danger text-warning').addClass('text-success');
                    passwordStrengthBar.addClass('bg-success');
                }
            });
        });

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


@endsection

