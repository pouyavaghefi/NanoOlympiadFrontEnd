@extends('layouts.master')

@section('title','Login')

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
            <h2 class="breadcrumb-title">Login</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Login</li>
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
                        <h3>Login with your account</h3>
                    </div>

                    @include('layouts.includes.partials.alerts')


                    <form action="{{ route('cla.login.do') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Your Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Your Password" name="password">
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <a href="{{ route('cla.forgotpass') }}" class="forgot-pass">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                        </div>
                    </form>
                    <div class="login-footer">
                        <p>Don't have an account? <a href="{{ route('cla.register') }}">Register.</a></p>
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

