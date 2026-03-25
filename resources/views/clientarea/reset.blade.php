@extends('layouts.master')

@section('title','Reset Password')

@section('styles')
<style>
    .text-danger {
        color: red !important;
    }
    .text-success {
        color: green !important;
    }
    #password-strength-text,
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
            <h2 class="breadcrumb-title">Reset Password</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Reset Password</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- reset password area -->
    <div class="login-area py-120">
        <div class="container">
            <div class="col-md-5 mx-auto">
                <div class="login-form" id="authForm">
                    <div class="login-header">
                        <h3>Reset Password</h3>
                    </div>

                    @include('layouts.includes.partials.alerts')

                    <form action="{{ route('cla.password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <!-- Hidden email input for form submission -->
                        <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Your Email" value="{{ old('email', request()->email) }}" disabled>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="New Password" name="password" id="password" required>
                            <div class="progress mt-2" style="height: 5px;">
                                <div id="password-strength" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                            </div>
                            <small id="password-strength-text" class="text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" id="password_confirmation" required>
                            <small id="password-mismatch-feedback" class="text-muted"></small>
                        </div>

                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn">
                                <i class="fas fa-key"></i> Reset Password
                            </button>
                        </div>
                    </form>

                    <div class="login-footer">
                        <p><a href="javascript:window.close();">Close.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- reset password area end -->
</main>
@endsection

@section('scripts')
<script>
    window.onload = function() {
        const form = document.getElementById('authForm');
        if (form) {
            window.scrollTo({
                top: form.offsetTop - 45,
                behavior: 'smooth'
            });
        }
    };
</script>
@endsection