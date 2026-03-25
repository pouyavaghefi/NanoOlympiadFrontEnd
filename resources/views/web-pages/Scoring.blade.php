@extends('layouts.master')

@section('title', $page->title)

@section('head-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@php
    $content = preg_replace_callback(
        '#<img[^>]+src=["\'](/storage/uploads/[^"\']+)["\']#i',
        fn($m) => str_replace($m[1], 'https://admin.nanolympiad.org' . $m[1], $m[0]),
        $page->content
    );

    $content = preg_replace('/<img([^>]+)style=["\'][^"\']*["\']([^>]*)>/i', '<img$1$2>', $content);
@endphp

@section('styles')
    <style>
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

        .fade-in {
            animation: fadeIn 0.6s ease-out both;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection

@section('wrapper')
    <div class="static-page container py-4 fade-in">
        @include('layouts.includes.parsers.bread-crumb')

        <div class="section content">
            {!! $content !!}
        </div>
    </div>
@endsection