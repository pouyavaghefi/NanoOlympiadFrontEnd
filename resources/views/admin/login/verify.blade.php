@extends('layouts.master')

@section('title','Admin Login')

@section('wrapper')
    <main class="main">
        <!-- login area -->
        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form" id="authForm">
                        @php
                            $parts = explode('@', $email);
                            $name = $parts[0];
                            $domain = $parts[1];
                            $visible = substr($name, 0, 2);
                            $maskedEmail = $visible . str_repeat('*', max(1, strlen($name) - 2)) . '@' . $domain;
                        @endphp

                        <div class="login-header">
                            <h3>Verify Yourself!</h3>
                            <p>Check {{ $maskedEmail }}</p>
                        </div>

                        @include('layouts.includes.partials.alerts')

                        <form action="{{ route('adm.login.verify') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>2fa Code</label>
                                <input type="text" class="form-control" placeholder="Your 2fa Code" name="token">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->
    </main>
@endsection