<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    <link rel="stylesheet" href="/assets/ebook/bookshelf.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f1e8;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            overflow-x: hidden;
        }

        /* Updated Larger Book Styling */
        .book {
            position: relative;
            width: 80px;  /* Increased from 60px */
            height: 240px; /* Increased from 200px */
            transform-style: preserve-3d;
            transition: transform 0.5s ease;
            cursor: pointer;
            transform: translateZ(0);
        }

        .book:hover {
            transform: translateY(-25px) rotateY(30deg) scale(1.15); /* Slightly stronger hover effect */
            z-index: 10;
        }

        .side {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #f5f1e8;
            border: 1px solid #d4af37;
            box-sizing: border-box;
            backface-visibility: hidden;
            transition: all 0.3s ease;
        }

        .spine {
            background: linear-gradient(90deg, #3e2723, #5d4037);
            color: #fff;
            padding: 20px 8px; /* Increased padding */
            transform: rotateY(0deg) translateZ(40px); /* Increased depth */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
            box-shadow: inset 5px 0 15px rgba(0,0,0,0.3);
        }

        .cover {
            background-size: cover;
            background-position: center;
            transform: rotateY(90deg) translateZ(40px); /* Increased depth */
            background-color: #f9f3e9;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.2);
            border-left: none;
        }

        .top {
            background: #8d6e63;
            transform: rotateX(90deg) translateZ(40px); /* Increased depth */
            height: 80px; /* Increased to match new width */
            top: -40px; /* Adjusted to match new height */
            box-shadow: inset 0 -3px 10px rgba(0,0,0,0.2);
        }

        /* Updated Spine Text Styling */
        .spine-title {
            font-size: 14px; /* Increased from 12px */
            font-weight: bold;
            margin-bottom: 8px; /* Increased spacing */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 72px; /* Increased space for text */
            line-height: 1.3; /* Better line spacing */
            text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
        }

        .spine-author {
            font-size: 12px; /* Increased from 10px */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 36px; /* Increased space for text */
            color: #d4af37;
            line-height: 1.3;
            font-style: italic;
        }

        /* Enhanced Shadow Effect */
        .book::after {
            content: '';
            position: absolute;
            bottom: -12px; /* Slightly larger shadow */
            left: 0;
            width: 100%;
            height: 12px;
            background: rgba(0,0,0,0.2);
            transform: rotateX(-90deg);
            transform-origin: 50% 0;
            transition: all 0.3s ease;
        }

        /* Adjust bookshelf container height */
        .bookshelf-container, .second-row {
            height: 280px; /* Increased from 250px to accommodate larger books */
        }

        /* Adjust gap between books */
        .bookshelf {
            gap: 20px; /* Increased from 15px for better spacing */
        }

        .top {
            background: #8d6e63;
            transform: rotateX(90deg) translateZ(100px);
            height: 60px !important; /* Match the width of the book */
        }

        .bookshelf-container {
            height: 250px; /* Increased from 200px */
        }

        .second-row {
            height: 250px; /* Increased from 200px */
        }
        .bookshelf-wrapper {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .bookshelf-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://ino-official.org/assets/img/bookshelf.jpg') no-repeat center center;
            background-size: cover;
            z-index: 1;
        }

        /* Bookshelf containers */
        .bookshelf-container {
            position: absolute;
            top: 60%; /* was 30% — adjusted to match the last shelf row */
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 200px;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .second-row {
            top: 18%; /* <-- Position near top shelf */
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 200px;
            position: absolute;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: flex-end; /* Align to right */
        }

        .bookshelf {
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }

        /* Photo Frame */
        .photo-frame {
            position: relative;
            width: 120px;
            height: 120px;
            left:1100px;
            bottom:600px;
            background: #fff;
            border: 15px solid #d4af37;
            box-shadow:
                    0 0 0 5px #333,
                    0 10px 25px rgba(0,0,0,0.5),
                    inset 0 0 20px rgba(0,0,0,0.2);
            transform: rotate(5deg);
            transition: all 0.3s ease;
            z-index: 3;
            margin-right: 30px;
            margin-bottom: 10px;
        }

        .photo-frame:hover {
            transform: rotate(0deg) scale(1.05);
            box-shadow:
                    0 0 0 5px #333,
                    0 15px 35px rgba(0,0,0,0.6),
                    inset 0 0 25px rgba(0,0,0,0.3);
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(0.3) contrast(1.1);
        }

        .photo-frame::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid rgba(255,255,255,0.3);
            pointer-events: none;
        }

        .photo-frame::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            height: 80%;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,0.05);
            pointer-events: none;
        }

        .page-title {
            position: absolute;
            top: 4%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2.5vw;
            background: rgba(255,255,255,0.8);
            color: #3e2723;
            padding: 0.5vw 2vw;
            border-radius: 20px;
            z-index: 3;
        }

        .page-title span{
            color:#472E29;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-shadow: 0px 0px 10px cyan,
            0px 0px 20px cyan,
            0px 0px 40px cyan,
            0px 0px 80px cyan;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 5vw;
                top: 3%;
            }

            .bookshelf-container {
                width: 90%;
                bottom: 20%;
            }

            .second-row {
                bottom: 38%;
            }

            .bookshelf {
                gap: 10px;
            }

            .photo-frame {
                width: 80px;
                height: 80px;
                border-width: 10px;
                margin-right: 15px;
            }
        }


        form {
            display: flex;
            margin-bottom:20px;
            height: 100vh;
        }

        .surface, .cube__front, .cube__left, .cube__top {
            background-color: var(--offColor);
        }

        .surface, .surface span {
            display: block;
        }

        .surface, .cube {
            transform-style: preserve-3d;
        }

        .surface {
            box-shadow: 0 0 1em transparent;
            transition: all var(--dur) ease-out;
            cursor: pointer;
            margin: auto;
            position: relative;
            transform: rotateX(45deg) rotateZ(-45deg) translateY(-0.5em);
            width: 4em;
            height: 2em;
            -webkit-tap-highlight-color: transparent;
        }

        .cube, .cube span, .label-text {
            position: absolute;
            left: 0;
        }

        .cube, .cube span {
            top: 0;
        }
        .cube__front, .cube__left, .cube__top, .cube__reflection {
            height: 2em;
            width: 2em;
        }
        .cube__front, .cube__left, .cube__top {
            transition: background-color var(--dur) ease-out, transform var(--dur) var(--timing);
        }
        .cube__front {
            background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
            transform: rotateX(-90deg);
            transform-origin: 50% 100%;
        }
        .cube__left {
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2));
            transform: rotateY(-90deg);
            transform-origin: 0 50%;
        }
        .cube__top {
            transform: translateZ(2em);
        }
        .cube__reflection {
            background-color: #000;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%, 0 100%);
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%, 0 100%);
            opacity: 0.04;
            transform: rotate(45deg) scale(0.707);
            transform-origin: 0 0;
            transition: clip-path var(--dur) var(--timing), -webkit-clip-path var(--dur) var(--timing);
        }
        .cube:nth-child(2) {
            transform: translate(2em, 0);
        }
        .cube:nth-child(2) .cube__front {
            transform: rotateX(-90deg) scaleY(0.25);
        }
        .cube:nth-child(2) .cube__left {
            transform: rotateY(-90deg) scaleX(0.25);
        }
        .cube:nth-child(2) .cube__top {
            transform: translateZ(0.5em);
        }

        input[type=checkbox] {
            position: fixed;
            top: -1.5em;
            left: -1.5em;
        }
        input[type=checkbox]:checked + .surface {
            box-shadow: 0 0 1em var(--onColor);
        }
        input[type=checkbox]:checked + .surface, input[type=checkbox]:checked + .surface .cube__front, input[type=checkbox]:checked + .surface .cube__left, input[type=checkbox]:checked + .surface .cube__top {
            background-color: var(--onColor);
        }
        input[type=checkbox]:checked + .surface .cube__front {
            transform: rotateX(-90deg) scaleY(0.25);
        }
        input[type=checkbox]:checked + .surface .cube__left {
            transform: rotateY(-90deg) scaleX(0.25);
        }
        input[type=checkbox]:checked + .surface .cube__top {
            transform: translateZ(0.5em);
        }
        input[type=checkbox]:checked + .surface .cube__reflection {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 67% 100%, 0 33%);
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 67% 100%, 0 33%);
        }
        input[type=checkbox]:checked + .surface .cube:nth-child(2) .cube__front {
            transform: rotateX(-90deg);
        }
        input[type=checkbox]:checked + .surface .cube:nth-child(2) .cube__left {
            transform: rotateY(-90deg);
        }
        input[type=checkbox]:checked + .surface .cube:nth-child(2) .cube__top {
            transform: translateZ(2em);
        }

        .label-text {
            top: calc(100% + 0.5em);
            width: 100%;
            text-align: center;
            text-transform: uppercase;
        }

        input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Sticky Note Styles */
        .sticky-notes {
            position: absolute;
            top: 5%;
            left: 15%;
            z-index: 5;
        }

        .note {
            color: #000;
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto;
            padding: 10px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-size: 0.8em;
            box-shadow: 0 5px 5px 1px rgba(0,0,0,0.3);
            background: #fdfd86;
            transform: rotate(-5deg);
            transition: all 0.3s ease;
            overflow: hidden;
            cursor: pointer;
        }

        .note:hover {
            width: 200px;  /* Expanded size on hover */
            height: 200px;
            transform: rotate(0deg);
            z-index: 10;
            font-size: 1em;
        }

        .note:after {
            content: "";
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 40%;
            height: 20%;
            background: rgba(0,0,0,0.1);
            transform: rotate(5deg);
            filter: blur(3px);
        }

        .note-content {
            height: 100%;
            overflow: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .note:hover .note-content {
            opacity: 1;
        }

        .note h3 {
            font-size: 1.2em;
            margin-bottom: 8px;
            display: none; /* Hidden by default */
        }

        .note:hover h3 {
            display: block; /* Show on hover */
        }

        .note p {
            display: none; /* Hidden by default */
            margin: 5px 0;
            font-size: 0.9em;
        }

        .note:hover p {
            display: block; /* Show on hover */
        }

        .mug-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            padding-top: 10%;
        }

        .mug-coffee {
            max-width: 100px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .smoke-container {
            display: flex;
            position: relative;
            width: 100px;
            margin: 0 auto;
            position: relative;
        }

        .smoke-1 {
            animation: shift 5s linear 0.5s infinite;
            opacity: 0;
        }

        .smoke-2 {
            animation: shift-2 4s linear 0.6s infinite;
            opacity: 0;
        }

        .smoke-3 {
            animation: shift-3 5s linear 1.2s infinite;
            opacity: 0;
        }

        .mug {
            width: 90px;
            height: 105px;
            border-radius: 5px;
            background-color: #86aab3;
            position: absolute;
            margin: 0 auto;
            box-shadow: 1px 3px 4px rgba(0, 0, 0, 0.2);

            &:after {
                content: "";
                position: absolute;
                z-index: -1;
                right: -20px;
                top: 15%;
                width: 80px;
                height: 45px;
                border: 8px solid #86aab3;
                border-radius: 15px;
                box-shadow: 1px 3px 4px rgba(0, 0, 0, 0.2);
            }
        }

        @keyframes shift {
            0% {
                transform: translate(10px, 155%);
                opacity: 1;
            }
            80% {
                opacity: 0;
            }

            100% {
                transform: translate(10px, 0%);
                opacity: 0;
            }
        }

        @keyframes shift-2 {
            0% {
                transform: translate(0, 155%);
                opacity: 1;
            }

            80% {
                opacity: 0;
            }

            100% {
                transform: translate(0, 0);
                opacity: 0;
            }
        }

        @keyframes shift-3 {
            0% {
                opacity: 1;
                transform: translate(-10px, 80px);
            }

            80% {
                opacity: 0;
            }

            100% {
                transform: translate(-10px, 0);
                opacity: 0;
            }
        }

        .smokes {
            transform: translateX(20px);
        }

    </style>

    <style>
        /* Lamp Styles */
        .lamp-container {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 4;
        }

        .lamp {
            position: relative;
            width: 60px;
            height: 150px;
        }

        .lamp-item {
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
        }

        .lamp-top {
            width: 6px;
            height: 60px;
            background: #3e2723;
            top: 0;
            pointer-events: none;
        }

        .lamp-middle {
            width: 30px;
            height: 18px;
            background-color: #3e2723;
            top: 60px;
            border-radius: 30px 30px 0 0;
            pointer-events: none; /* Disable clicks on middle part */
        }

        .lamp-bottom {
            cursor: pointer;
            width: 80px;
            height: 40px;
            background-color: #3e2723;
            top: 78px;
            border-radius: 10px;
            left: -15%;
            z-index: 2;
        }

        .lamp-light.on {
            position: absolute;
            width: 400px;
            height: 300px;
            background: rgba(255, 248, 198, 0.5);
            clip-path: polygon(40% 0, 60% 0, 80% 100%, 20% 100%);
            top: 120px;
            left: 50%;
            transform: translateX(-50%);
            pointer-events: none;
            transition: opacity 0.3s ease;
            filter: blur(10px);
            z-index: 1;
        }

        .lamp-light.off {
            opacity: 0;
            pointer-events: none;
        }

        /* Coffee Mug */
        .coffee-mug {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 80px;
            height: 80px;
            z-index: 500;
        }

        .mug {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .mug-body {
            position: absolute;
            width: 70px;
            height: 60px;
            background: #f5f1e8;
            border: 5px solid #d4af37;
            border-radius: 0 0 35px 35px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }

        .mug-handle {
            position: absolute;
            right: -15px;
            top: 10px;
            width: 20px;
            height: 30px;
            border: 5px solid #d4af37;
            border-left: none;
            border-radius: 0 20px 20px 0;
        }

        .coffee {
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            background: #6f4e37;
            border-radius: 0 0 30px 30px;
        }

        .steam {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 20px;
            background: rgba(255,255,255,0.6);
            border-radius: 10px;
            animation: steam 3s infinite;
        }

        .steam:nth-child(2) {
            left: 40%;
            animation-delay: 0.5s;
        }

        .steam:nth-child(3) {
            left: 60%;
            animation-delay: 1s;
        }

        @keyframes steam {
            0% { transform: translateY(0) scale(1); opacity: 0.6; }
            100% { transform: translateY(-30px) scale(0.5); opacity: 0; }
        }

        .book2 {
            width: 200px;
            height: 300px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 1s ease;
            cursor: pointer;
            margin: 0px;
            perspective: 1000px;
        }

        .book2:hover {
            transform: rotateY(-180deg);
        }

        .book2-img {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url("../assets/covers/broshor-ino1.jpg") no-repeat center;
            background-size: cover;
            backface-visibility: hidden;
            transform: rotateY(0deg);
            z-index: 2;
            border: 1px solid #ccc;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .text2 {
            position: absolute;
            width: 100%;
            height: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            background: white;
            backface-visibility: hidden;
            transform: rotateY(180deg);
            z-index: 1;
            border: 1px solid #ccc;
            box-sizing: border-box;
            box-shadow: inset 20px 0 50px rgba(0,0,0,0.2);
        }

        .book2:before {
            content: '';
            position: absolute;
            width: 10px;
            height: 100%;
            background: linear-gradient(90deg, #ddd, #fff);
            right: -10px;
            top: 0;
            transform: rotateY(90deg);
            transform-origin: 100% 0;
            z-index: 3;
        }

        .text2 h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #3e2723;
        }

        .text2 p {
            line-height: 1.5;
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .text2 a {
            text-decoration: none;
            color: #5d4037;
            font-weight: bold;
            letter-spacing: 0.7px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .text2 a:hover {
            color: #d4af37;
        }

        .text2 a i {
            transition: 0.3s ease;
            margin-left: 5px;
        }

        .text2 a:hover i {
            transform: translateX(5px);
        }
    </style>
</head>
<body>
@php
    $books = DB::table('bookshelves')->get();
@endphp

<div class="bookshelf-wrapper">
    <div class="lamp-container">
        <div class="lamp">
            <div class="lamp-item lamp-top"></div>
            <div class="lamp-item lamp-middle"></div>
            <div class="lamp-item lamp-bottom"></div>
            <div class="lamp-item lamp-light off"></div>
        </div>
    </div>

    <h1 class="page-title">📚 <span>Our Digital Library</span></h1>

    <div class="sticky-notes">
        <div class="note yellow">
            <div class="note-content">
                <h3>Library Note</h3>
                <p>Welcome to our digital library! Click on books to download them.</p>
                <p>Toggle the lamp to adjust lighting.</p>
            </div>
        </div>
    </div>

    <a href="{{ env('APP_URL') }}"><div class="coffee-mug">
        <div class="mug">
            <div class="mug-body">
                <div class="coffee"></div>
            </div>
            <div class="mug-handle"></div>
            <div class="steam"></div>
            <div class="steam"></div>
            <div class="steam"></div>
        </div>
    </div></a>

    <div class="bookshelf-background"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const lampBottom = document.querySelector('.lamp-bottom');
            const lampLight = document.querySelector('.lamp-light');

            function toggleLamp() {
                lampLight.classList.toggle('on');
                lampLight.classList.toggle('off');
            }

            lampBottom.addEventListener('click', toggleLamp);
        });
    </script>

    <div class="bookshelf-container">
        <div class="bookshelf">
            <form class="fullScreen">
                <input id="toggle" type="checkbox" name="toggle" role="switch" value="on">
                <label for="toggle" class="surface">
                        <span class="cube">
                            <span class="cube__front"></span>
                            <span class="cube__left"></span>
                            <span class="cube__top"></span>
                            <span class="cube__reflection"></span>
                        </span>
                    <span class="cube">
                            <span class="cube__front"></span>
                            <span class="cube__left"></span>
                            <span class="cube__top"></span>
                        </span>
                </label>
            </form>

            <a target="_blank" href="https://english.khamenei.ir/" title="Visit Supreme Leader's Official Website"><div class="photo-frame">
                    <img src="https://www.hoover.org/sites/default/files/styles/850x640/public/2023-11/Khamenei_2023.jpeg?itok=FFLI-n4g" alt="Memories">
                </div></a>

            @foreach($books as $book)
                @php
                    $titleAttr = "Download: {$book->name} by {$book->author} - PDF Ebook";
                // Remove .pdf extension and add .jpg
                $coverName = str_replace('.pdf', '.jpg', $book->source);
                // Generate secure asset URL
                $coverUrl = secure_asset('assets/covers/' . $coverName);
                // Fallback image with full HTTPS URL
                $fallbackImage = 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?fit=crop&w=400&q=80';
                // Check if file exists using full server path
                $absolutePath = public_path('assets/covers/' . $coverName);
                $coverImage = (file_exists($absolutePath) && is_readable($absolutePath)) ? $coverUrl : $fallbackImage;
                // Generate secure download link
                $downloadLink = secure_asset('dl/' . $book->source);
                @endphp

                <a href="{{ $downloadLink }}" download class="book-link" title="{{ $titleAttr }}">
                    <div class="book" data-title="{{ $book->name }}" data-author="{{ $book->author }}" data-cover="{{ $coverImage }}">
                        <div class="side spine">
                            <span class="spine-title">{{ $book->name }}</span>
                            <span class="spine-author">{{ $book->author }}</span>
                        </div>
                        <div class="side top"></div>
                        <div class="side cover"></div>
                    </div>
                </a>
            @endforeach

            <div class="book2">
                <div class="book2-img"></div>
                <div class="text2">
                    <h2>Broshor</h2>
                    <p>Find out what we do...</p>
                    <a href="https://ino-official.org/dl/broshor-ino1.pdf">Read More <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/ebook/cssUtils.js"></script>
<script src="/assets/ebook/bookshelf.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add parallax effect to background
        const background = document.querySelector('.bookshelf-background');
        window.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            background.style.transform = `translate(-${x * 20}px, -${y * 20}px)`;
        });

        // Initialize bookshelf
        const bookshelf = new Bookshelf({
            el: '.bookshelf',
            perspective: 1000
        });

        // Load cover images
        document.querySelectorAll('.book').forEach(book => {
            const cover = book.dataset.cover;
            if (cover) {
                const img = new Image();
                img.src = cover;
                img.onload = function() {
                    book.querySelector('.cover').style.backgroundImage = `url('${cover}')`;
                };
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get both toggle elements
        const cubeToggle = document.getElementById('toggle');
        const lampBottom = document.querySelector('.lamp-bottom');
        const lampLight = document.querySelector('.lamp-light');

        // Function to toggle lamp state
        function toggleLamp() {
            lampLight.classList.toggle('on');
            lampLight.classList.toggle('off');
        }

        // Connect cube toggle to lamp functionality
        cubeToggle.addEventListener('change', function() {
            toggleLamp();
        });

        // Keep the original lamp click functionality
        lampBottom.addEventListener('click', toggleLamp);

        // [Rest of your existing JavaScript remains the same]

        // Add parallax effect to background
        const background = document.querySelector('.bookshelf-background');
        window.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            background.style.transform = `translate(-${x * 20}px, -${y * 20}px)`;
        });

        // Initialize bookshelf
        const bookshelf = new Bookshelf({
            el: '.bookshelf',
            perspective: 1000
        });

        // Load cover images
        document.querySelectorAll('.book').forEach(book => {
            const cover = book.dataset.cover;
            if (cover) {
                const img = new Image();
                img.src = cover;
                img.onload = function() {
                    book.querySelector('.cover').style.backgroundImage = `url('${cover}')`;
                };
            }
        });
    });
</script>
</body>
</html>