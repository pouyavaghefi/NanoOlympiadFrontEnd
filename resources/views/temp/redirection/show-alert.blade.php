@extends('layouts.master')

@section('title','Redirecting...')

@section('wrapper')
    @php
        $findToken = \DB::table('user_access_tokens')->where('user_id', auth()->user()->id)->first();
        $urlPanel = "https://profile.nanolympiad.org/courses/registered_courses";

        if ($findToken) {
            $urlPanel .= "?auth_token=" . $findToken->token;
        }

        if (!session()->has('redirection_url')) {
            header("Location: $urlPanel");
            exit();
        }
    @endphp

    <div class="about-area mt-4">
        <h1>You're being redirected to the profile dashboard page</h1>
        <h3>Or check out the profile page manually: <a style="color:blue" href="{{ $urlPanel }}">{{ $urlPanel }}</a></h3>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "{{ session('redirection_url') }}";
        }, 2000);
    </script>
@endsection
