@extends('layouts.master')

@section('title','Course Details')

@section('head-css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css">
    <style>
        .plyr--full-ui input[type=range] {
            color: #ff9800;
        }
        iframe {
            max-width: 100%;
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
            border: none;
            margin-bottom: 1.5rem;
        }
        iframe[src*="youtube.com"] {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 9;
            border: none;
            margin: 1rem 0;
        }

    </style>
@endsection

@section('wrapper')
    @php
        if($course->image_url){
            $imageUrl = env('URL_ADMIN') . "/" . $course->image_url;
        }else{
            $imageUrl = null;
        }
    @endphp
    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url('{{ $imageUrl ?? asset('assets/img/breadcrumb/01.jpg') }}')">
        <div class="container">
            <h2 class="breadcrumb-title">{{ ucwords(str_replace('-', ' ', request()->segment(count(request()->segments())))) }}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ url('/') }}">Home</a></li>

                @foreach (request()->segments() as $key => $segment)
                    @if ($key + 1 < count(request()->segments()))
                        <li>
                            <a href="{{ url(implode('/', array_slice(request()->segments(), 0, $key + 1))) }}">
                                {{ ucwords(str_replace('-', ' ', $segment)) }}
                            </a>
                        </li>
                    @else
                        <li class="active">{{ ucwords(str_replace('-', ' ', $segment)) }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    @if (app()->getLocale() === 'ar')
    <!-- course-single -->
    <div class="course-single-area py-120">
        <div class="container">
            <div class="course-single-wrapper">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <div class="course-details">
                            <div class="course-details-img mb-30">
                                <img src="/assets/img/course/single.jpg" alt="thumb">
                            </div>
                            <div class="course-details" style="text-align:right">
                                <h3 class="mb-20">
                                    @if($courseTranslation->title)
                                    <span class="text-muted">({{ $courseTranslation->title }})</span>
                                    @endif
                                </h3>
                                <p class="mb-20">
                                    @if($courseTranslation->description)
                                    <span class="text-muted">({!! $courseTranslation->description !!})</span>
                                    @endif
                                </p>
                                <p class="mb-20">
                                    @if($courseTranslation->body)
                                    <span class="text-muted">({!! $courseTranslation->body !!})</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="course-single-sidebar">
                            <div class="widget">
                                <h4 class="widget-title">Course Info</h4>
                                <div class="course-single-info">
                                    <div class="single-info author">
                                        <div class="author-img">
                                            <img src="/assets/img/course/teacher.jpg" alt="#">
                                        </div>
                                        <div class="single-info-content">
                                            <h4>Teacher</h4>
                                            <span>Frank Mitchel</span>
                                        </div>
                                    </div>
                                    <div class="single-info category">
                                        <i class="far fa-bolt"></i>
                                        <div class="single-info-content">
                                            <h4>Category</h4>
                                            <span>Science & Engineering</span>
                                        </div>
                                    </div>
                                    <div class="single-info s-enroll">
                                        <i class="far fa-users"></i>
                                        <div class="single-info-content">
                                            <h4>Enrolled</h4>
                                            <span>50 Students</span>
                                        </div>
                                    </div>
                                    <div class="single-info rattings">
                                        <i class="far fa-clock"></i>
                                        <div class="single-info-content">
                                            <h4>Course Time</h4>
                                            <span>04 Years</span>
                                        </div>
                                    </div>
                                    <div class="single-info rattings">
                                        <i class="far fa-dollar"></i>
                                        <div class="single-info-content">
                                            <h4>Course Fees</h4>
                                            <span>$20,000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="course-buttons mt-3">
                                    @php
                                        $isFree = $course->price == 0;
                                        $isPrivate = $course->course_private == 1;
                                    @endphp

                                    @if ($isPrivate)
                                        <a href="javascript:void(0);" class="theme-btn disabled d-block mb-2" title="Private Course">
                                            Private Course Only
                                            <i class="fas fa-lock ms-2"></i>
                                        </a>

                                        <button type="button" class="theme-btn-outline d-block" onclick="showPrivateCourseGuide()">
                                            Why is this course private?
                                            <i class="fas fa-question-circle ms-2"></i>
                                        </button>
                                    @elseif ($isFree)
                                        <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="theme-btn d-block">
                                            Start Learning For Free
                                            <i class="fas fa-arrow-right-long ms-2"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="theme-btn d-block">
                                            Enroll Now
                                            <i class="fas fa-arrow-right-long ms-2"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="widget-title">Course Features</h4>
                                <div class="course-feature-list">
                                    <a href="#"><i class="far fa-book-open"></i> Lectures <span>20</span></a>
                                    <a href="#"><i class="far fa-pencil"></i> Quizes <span>12</span></a>
                                    <a href="#"><i class="far fa-clock"></i> Duration <span>4 Years</span></a>
                                    <a href="#"><i class="far fa-globe"></i> Language <span>English</span></a>
                                    <a href="#"><i class="far fa-fill-drip"></i> Skill Level <span>Basic</span></a>
                                    <a href="#"><i class="far fa-location-dot"></i> Location <span>On Campus</span></a>
                                    <a href="#"><i class="far fa-users"></i> Students <span>90</span></a>
                                    <a href="#"><i class="far fa-graduation-cap"></i> Certificate <span>Yes</span></a>
                                    <a href="#"><i class="far fa-check-circle"></i> Assessments <span>Yes</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course-single end-->

    @else
        @php
            $totalHours = 0;
            $totalMinutes = 0;
            $totalSeconds = 0;

            $episodes = DB::table('episodes')->where('course_id', $course->id)->get();

            foreach ($episodes as $episode) {
               list($hours, $minutes, $seconds) = explode(":", $episode->time);

               $totalHours += (int) $hours;
               $totalMinutes += (int) $minutes;
               $totalSeconds += (int) $seconds;
            }

            $totalMinutes += floor($totalSeconds / 60);
            $totalSeconds = $totalSeconds % 60;

            $totalHours += floor($totalMinutes / 60);
            $totalMinutes = $totalMinutes % 60;

            $course_teacher_course = DB::table('course_teachers_course')->where('course_id', $course->id)->first();
            $course_category_course = DB::table('course_category_course')->where('course_id', $course->id)->get();
            if($course_teacher_course){
                $course_teacher = DB::table('course_teachers')->where('id', $course_teacher_course->teacher_id)->first();
                $course_teacher = DB::table('course_teachers')->where('id', $course_teacher_course->teacher_id)->first();
                $user = DB::table('users')->where('id', $course_teacher->user_id)->first();
                $fullName = $user->first_name . ' ' . $user->last_name;
            }else{
                $fullName = 'No teacher has been added!';
            }
            $registered_num = DB::table('course_registrations')->where('course_id', $course->id)->count();
            if($course->intro_video){
                $introVid = env('URL_ADMIN') . "/" . $course->intro_video;
            }else{
                $introVid = null;
            }
        @endphp
        <!-- course-single -->
        <div class="course-single-area py-120">
            <div class="container">
                <div class="course-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="course-single-sidebar">
                                <div class="widget">
                                    <h4 class="widget-title">Course Info</h4>
                                    <div class="course-single-info">
                                        <div class="single-info author">
                                            <div class="author-img">
                                                <img src="{{ $user->avatar ?? '/assets/img/course/teacher.jpg' }}" alt="Teacher Image">
                                            </div>
                                            <div class="single-info-content">
                                                <h4>Teacher</h4>
                                                <span>{{ $fullName ?? $user->uname }}</span>
                                            </div>
                                        </div>
                                        <div class="single-info category">
                                            <i class="far fa-bolt"></i>
                                            <div class="single-info-content">
                                                <h4>Category</h4>
                                                <span>
                                                    @if(count($course_category_course) > 0)
                                                    @foreach($course_category_course as $category)
                                                        {{ $category->name }}
                                                        @if(count($course_category_course) > 1)
                                                            @if(!$loop->last)
                                                                ,
                                                            @else
                                                                @continue
                                                            @endif
                                                        @else
                                                            @continue
                                                        @endif
                                                    @endforeach
                                                    @else
                                                        No category has been defined!
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="single-info s-enroll">
                                            <i class="far fa-users"></i>
                                            <div class="single-info-content">
                                                <h4>Enrolled</h4>
                                                <span>{{ $registered_num }} Students</span>
                                            </div>
                                        </div>
                                        <div class="single-info rattings">
                                            <i class="far fa-clock"></i>
                                            <div class="single-info-content">
                                                <h4>Course Time</h4>
                                                <span>{{ sprintf('%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSeconds) }}</span>
                                            </div>
                                        </div>
                                        <div class="single-info rattings">
                                            <i class="far fa-dollar"></i>
                                            <div class="single-info-content">
                                                <h4>Course Fees</h4>
                                                <span>${{ number_format($course->price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-buttons mt-3">
                                        <div class="course-buttons mt-3">
                                            @php
                                                $isFree = $course->price == 0;
                                                $isPrivate = $course->course_private == 1;
                                            @endphp

                                            @if ($isPrivate)
                                                <a href="javascript:void(0);" class="theme-btn disabled d-block mb-2" title="Private Course">
                                                    Private Course Only
                                                    <i class="fas fa-lock ms-2"></i>
                                                </a>

                                                <button type="button" class="theme-btn-outline d-block" onclick="showPrivateCourseGuide()">
                                                    Why is this course private?
                                                    <i class="fas fa-question-circle ms-2"></i>
                                                </button>
                                            @elseif ($isFree)
                                                <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="theme-btn d-block">
                                                    Start Learning For Free
                                                    <i class="fas fa-arrow-right-long ms-2"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="theme-btn d-block">
                                                    Enroll Now
                                                    <i class="fas fa-arrow-right-long ms-2"></i>
                                                </a>
                                            @endif
                                        </div>{{--                                        <a href="{{ route('frt.crs.addToWishList', $course->id) }}" class="btn-wishlist">--}}
{{--                                            <i class="far fa-heart"></i> Add to Wishlist--}}
{{--                                        </a>--}}
                                    </div>
                                </div>
                                <div class="widget">
                                    <h4 class="widget-title">Course Features</h4>
                                    <div class="course-feature-list">
                                        <a href="#"><i class="far fa-book-open"></i> Lectures <span>{{ $course->lectures }}</span></a>
                                        <a href="#"><i class="far fa-pencil"></i> Quizes <span>{{ $course->quizzes }}</span></a>
                                        <a href="#"><i class="far fa-globe"></i> Language <span>{{ $course->language ?? 'English' }}</span></a>
                                        <a href="#"><i class="far fa-fill-drip"></i> Skill Level <span>{{ $course->skill_level }}</span></a>
                                        <a href="#"><i class="far fa-users"></i> Students <span>{{ $registered_num }}</span></a>
                                        <a href="#"><i class="far fa-check-circle"></i> Assessments <span>
                                                @if($course->assessments == 1)
                                                    YES
                                                @else
                                                    NO
                                                @endif
                                        </span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="course-details">
                                <div class="course-details-img mb-30">
{{--                                    <img src="{{ $imageUrl ?? '/assets/img/course/single.jpg' }}" alt="thumb">--}}
                                    @if($course->intro_video_url)
                                    <a class="play-btn popup-youtube" href="{{ $course->intro_video_url ?? 'https://www.youtube.com/watch?v=ckHzmP1evNU' }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    @endif
                                    @if($introVid)
                                        <video id="player" playsinline controls width="100%">
                                            <source src="{{ $introVid }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif

                                </div>
                                <div class="course-details">
                                    <h3 class="mb-20">{{ $course->title }}</h3>
                                    <p class="mb-20">
                                       {!! $course->body !!}
                                    </p>

                                    <br>
                                    <hr>

                                    @if(!is_null($course->course_iframe))
                                        <div class="ratio ratio-16x9 mb-4">
                                            <iframe src="{{ $course->course_iframe }}" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    @endif

                                    <!-- Buttons below the iframe -->
                                    <div class="d-flex justify-content-center gap-3">
                                        <!-- Button to view course on YouTube -->
                                        @if($course->course_playlist)
                                        <a href="{{ $course->course_playlist }}" target="_blank" class="btn btn-danger btn-lg">
                                            <i class="bi bi-youtube"></i> View on YouTube
                                        </a>
                                        @endif

                                        <!-- Button to browse course in website playlist -->
                                        @php
                                            $isFree = $course->price == 0;
                                            $isPrivate = $course->course_private == 1;
                                        @endphp

                                        @if ($isPrivate)
                                            <a href="javascript:void(0);" class="theme-btn disabled d-block mb-2" title="Private Course">
                                                Private Course Only
                                                <i class="fas fa-lock ms-2"></i>
                                            </a>

                                            <button type="button" class="theme-btn-outline d-block" onclick="showPrivateCourseGuide()">
                                                Why is this course private?
                                                <i class="fas fa-question-circle ms-2"></i>
                                            </button>
                                        @elseif ($isFree)
                                            <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="theme-btn d-block">
                                                Start Learning For Free
                                                <i class="fas fa-arrow-right-long ms-2"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="theme-btn d-block">
                                                Enroll Now
                                                <i class="fas fa-arrow-right-long ms-2"></i>
                                            </a>
                                        @endif                                    </div>

                                @if($course->requirements)
                                    <div class="my-4">
                                        <div class="mb-3">
                                            <h3 class="mb-3">Course Requirement</h3>
                                            <p>
                                                {!! $course->requirements !!}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course-single end-->
    @endif
@endsection

@section('scripts')
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('#player', {
                controls: ['play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
            });
        });
    </script>
    <script>
        function showPrivateCourseGuide() {
            Swal.fire({
                icon: 'info',
                title: 'Private Course',
                text: 'This course is only available to users who are signed up.',
                showCancelButton: true,
                confirmButtonText: 'Got it!',
                cancelButtonText: 'Register Now',
                reverseButtons: true
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '{{ route("cla.register") }}'; // Change to your actual registration route
                }
            });
        }

    </script>
@endsection
