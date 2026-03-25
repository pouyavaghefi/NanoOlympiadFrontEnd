@if ($private)
    <a href="javascript:void(0);" class="theme-btn disabled" title="Private Course">
        Private Course Only
        <i class="fas fa-lock ms-2"></i>
    </a>
@elseif ($price == 0)
    <a href="{{ route('frt.crs.enrollNow', $courseId) }}" class="theme-btn">
        Start Learning For Free
        <i class="fas fa-arrow-right-long"></i>
    </a>
@else
    <a href="{{ route('frt.crs.enrollNow', $courseId) }}" class="theme-btn">
        Enroll Now
        <i class="fas fa-arrow-right-long"></i>
    </a>
@endif
