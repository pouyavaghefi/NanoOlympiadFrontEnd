@extends('layouts.master')

@section('title','Admin Login')

@section('wrapper')
    <main class="main">
        <!-- login area -->
        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form" id="authForm">
                        <div class="login-header">
                            <h3>Super User Login Area</h3>
                        </div>

                        @include('layouts.includes.partials.alerts')


                        <form action="{{ route('adm.login.do') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Your Username" name="username">
                            </div>
                            <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->
    </main>
@endsection