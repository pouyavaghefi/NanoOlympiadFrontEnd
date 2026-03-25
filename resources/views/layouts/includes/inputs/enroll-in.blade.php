@php
    $isFree = $course->price == 0;
    $isPrivate = $course->course_private == 1;

    $token = request()->cookie('user_token');
    $userToken = null;
    if ($token) {
        $userToken = \DB::table('user_access_tokens')
            ->where('token', $token)
            ->where('expires_at', '>', now())
            ->first();
    }
@endphp

@if ($isPrivate)
    @if($userToken || auth()->check())
        <a href="{{ env('URL_PANEL') }}/courses" class="theme-btn d-block mb-2">
            Go to My Courses Dashboard
            <i class="fas fa-arrow-right-long ms-2"></i>
        </a>
    @else
        <a href="javascript:void(0);" class="theme-btn disabled d-block mb-2" title="Private Course">
            Private Course Only
            <i class="fas fa-lock ms-2"></i>
        </a>

        <button type="button" class="theme-btn-outline d-block" onclick="showPrivateCourseGuide()">
            Why is this course private?
            <i class="fas fa-question-circle ms-2"></i>
        </button>
    @endif

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
