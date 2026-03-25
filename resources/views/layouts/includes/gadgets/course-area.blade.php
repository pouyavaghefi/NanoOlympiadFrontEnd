<div class="course-area py-120" dir="ltr">
    <div class="container">
        @if (app()->getLocale() === 'ar')
                @php
                    $courseHeading = DB::table('localizations')->where('key', 'course-courses-heading')->where('language_id', 5)->value('value');
                    $courseSubheading = DB::table('localizations')->where('key', 'course-courses-subheading')->where('language_id', 5)->value('value');
                    $courseDesc = DB::table('localizations')->where('key', 'course-courses-desc')->where('language_id', 5)->value('value');
                    $courseBtn1 = DB::table('localizations')->where('key', 'course-btn-one')->where('language_id', 5)->value('value');
                    $courseBtn2 = DB::table('localizations')->where('key', 'course-btn-two')->where('language_id', 5)->value('value');
                @endphp
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center" style="text-align: right;">
                            <span class="site-title-tagline">{{ $courseHeading }}<i class="far fa-book-open-reader"></i></span>
                            <h2 class="site-title">{{ $courseSubheading }}</h2>
                            <p>{{ $courseDesc }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Our Courses<i class="far fa-book-open-reader"></i></span>
                            <h2 class="site-title">Let's Check Our <span>Courses</span></h2>
                            <p></p>
                        </div>
                    </div>
                </div>
        @endif

        @if (app()->getLocale() === 'ar')
        <div class="row">
            @foreach($courses as $course)
                @php
                $newSlug = $courseTranslations[$course->id]->slug;
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="course-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="course-img">
{{--                            <span class="course-tag"><i class="far fa-bookmark"></i>--}}
{{--                                {{ $courseTranslations[$course->id]->title }}--}}
{{--                            </span>--}}

                            <img src="{{ env('URL_ADMIN') }}/{{ $course->image_url ?? '/assets/img/course/default.jpg' }}" alt="{{ $course->title }}">
                            @if ($course->course_private == 1)
                                <i class="fas fa-lock ms-2 text-danger" title="Private Course"></i>
                            @endif
                            <a href="{{ route('frt.crs.show', ['slug' => $newSlug]) }}" class="btn"><i class="far fa-link"></i></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="course-meta-left"><i class="far fa-book"></i> {{ $course->countEpisodes($course->id) }} Lessons</span>
{{--                                <div class="course-rating">--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="far fa-star"></i>--}}
{{--                                    <span>(4.0)</span>--}}
{{--                                </div>--}}
                            </div>
                            <h4 class="course-title" style="text-align:right">
                                <a href="{{ route('frt.crs.enrollNow', $course->id) }}">{{ $courseTranslations[$course->id]->title }}</a>
                            </h4>
                            <p class="course-text" style="text-align:right">
                                {{ \Illuminate\Support\Str::limit(strip_tags($courseTranslations[$course->id]->description), 100) }}
                            </p>
                            <div class="course-bottom">
                                <div class="course-bottom-left">
                                    <span><i class="far fa-users"></i> {{ $course->registered_users }} Seats</span>
                                    <span><i class="far fa-clock"></i> {{ $course->total_hours ?? 'N/A' }} Hours</span>
                                </div>
                                <span class="course-price" style="color:white">
                                @if($course->price == 0)
                                    Free
                                @else
                                    ${{ $course->price }}
                                @endif
                        </span>
                            </div>
                            @include('layouts.includes.inputs.enroll-in', ['course'=>$course])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <div class="row">
                @php
                    $token = request()->cookie('user_token');
                    $userToken = null;
                    if ($token) {
                        $userToken = \DB::table('user_access_tokens')
                            ->where('token', $token)
                            ->where('expires_at', '>', now())
                            ->first();
                    }
                @endphp

                @foreach($courses as $course)
                <div class="col-md-6 col-lg-4">
                    <div class="course-item wow fadeInUp" data-wow-delay=".25s">
                        <div class="course-img">
{{--                            <span class="course-tag"><i class="far fa-bookmark"></i> {{ $course->title }}</span>--}}
                            <img src="{{ env('URL_ADMIN') }}/{{ $course->image_url ?? '/assets/img/course/default.jpg' }}" alt="{{ $course->title }}">
                            @if ($course->course_private == 1)
                                @if ($userToken || auth()->check())
                                    <i class="fas fa-lock-open ms-2 text-success" title="Private Course - Access Granted"></i>
                                @else
                                    <i class="fas fa-lock ms-2 text-danger" title="Private Course - Access Denied"></i>
                                @endif
                            @endif
                            <a href="{{ route('frt.crs.enrollNow', $course->id) }}" class="btn"><i class="far fa-link"></i></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="course-meta-left"><i class="far fa-book"></i> {{ $course->countEpisodes($course->id) }} Lessons</span>
{{--                                <div class="course-rating">--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="fas fa-star"></i>--}}
{{--                                    <i class="far fa-star"></i>--}}
{{--                                    <span>(4.0)</span>--}}
{{--                                </div>--}}
                            </div>
                            <h4 class="course-title">
                                <a href="{{ route('frt.crs.enrollNow', $course->id) }}">{{ $course->title }}</a>
                            </h4>
                            <p class="course-text">
                                {{ \Illuminate\Support\Str::limit(strip_tags($course->description), 100) }}
                            </p>
                            <div class="course-bottom">
                                <div class="course-bottom-left">
                                    <span><i class="far fa-users"></i>
                                        @if($course->countEpisodes($course->id) !== 0)
                                            @if($course->isFree())
                                                {{ $course->calculateRegisteredFreeUsers($course->id) }} Students started learning
                                            @else
                                                {{ $course->registered_users }} Students registered
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </span>
                                    <br>
                                    <span><i class="far fa-clock"></i>
                                         @if($course->countEpisodes($course->id) !== 0)
                                            {{ $course->calculateTotalEpisodeTimes($course->id) ?? 'N/A' }} Hours
                                         @else
                                             -
                                         @endif
                                    </span>

                                </div>
                                <span class="course-price" style="color:white">
                            @if($course->isFree())
                                Free
                            @else
                                ${{ $course->price }}
                            @endif
                        </span>
                            </div>

                            <div class="course-buttons mt-3">
                               @include('layouts.includes.inputs.enroll-in', ['course'=>$course])
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
