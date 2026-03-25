@if(app()->getLocale() === 'ar')
<div class="department-area bg py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">
                        {{ $static_pages['department_header']->department_translation ?? $static_pages['department_header']->value ?? '' }}
                         <i class="far fa-book-open-reader"></i>
                    </span>
                    <h2 class="site-title">{{ $static_pages['department_title']->department_translation ?? $static_pages['department_title']->value ?? '' }}</h2>
                    <p>{{ $static_pages['department_description']->department_translation ?? $static_pages['department_description']->value ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="department-slider owl-carousel owl-theme">
            <!-- Department Item 1 -->
            <div class="department-item">
                <div class="department-icon">
                    <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_one']->value ?? '' }}" alt="">
                </div>
                <div class="department-info" style="text-align:right">
                    <h4 class="department-title">
                        <a href="{{ $static_pages['department_link_one']->value ?? '' }}">
                            {{ $static_pages['department_title_one']->department_translation ?? $static_pages['department_title_one']->value ?? '' }}
                        </a>
                    </h4>
                    <p>{{ $static_pages['department_description_one']->department_translation ?? $static_pages['department_description_one']->value ?? '' }}</p>
                    <div class="department-btn">
                        <a href="{{ $static_pages['department_link_one']->value ?? '' }}">
                            <i class="fas fa-arrow-right-long"></i>
                            اقرأ المزيد
                        </a>
                    </div>
                </div>
            </div>

            <!-- Department Item 2 -->
            <div class="department-item">
                <div class="department-icon">
                    <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_two']->value ?? '' }}" alt="">
                </div>
                <div class="department-info" style="text-align:right">
                    <h4 class="department-title">
                        <a href="{{ $static_pages['department_link_two']->value ?? '' }}">
                            {{ $static_pages['department_title_two']->department_translation ?? $static_pages['department_title_two']->value ?? '' }}
                        </a>
                    </h4>
                    <p>{{ $static_pages['department_description_two']->department_translation ?? $static_pages['department_description_two']->value ?? '' }}</p>
                    <div class="department-btn">
                        <a href="{{ $static_pages['department_link_two']->value ?? '' }}">
                            <i class="fas fa-arrow-right-long"></i>
                            اقرأ المزيد
                        </a>
                    </div>
                </div>
            </div>

            <!-- Department Item 3 -->
            <div class="department-item">
                <div class="department-icon">
                    <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_three']->value ?? '' }}" alt="">
                </div>
                <div class="department-info" style="text-align:right">
                    <h4 class="department-title">
                        <a href="{{ $static_pages['department_link_three']->value ?? '' }}">
                            {{ $static_pages['department_title_three']->department_translation ?? $static_pages['department_title_three']->value ?? '' }}
                        </a>
                    </h4>
                    <p>{{ $static_pages['department_description_three']->department_translation ?? $static_pages['department_description_three']->value ?? '' }}</p>
                    <div class="department-btn">
                        <a href="{{ $static_pages['department_link_three']->value ?? '' }}">
                            <i class="fas fa-arrow-right-long"></i>
                            اقرأ المزيد
                        </a>
                    </div>
                </div>
            </div>

            <!-- Department Item 4 -->
            <div class="department-item">
                <div class="department-icon">
                    <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_four']->value ?? '' }}" alt="">
                </div>
                <div class="department-info" style="text-align:right">
                    <h4 class="department-title">
                        <a href="{{ $static_pages['department_link_four']->value ?? '' }}">
                            {{ $static_pages['department_title_four']->department_translation ?? $static_pages['department_title_four']->value ?? '' }}
                        </a>
                    </h4>
                    <p>{{ $static_pages['department_description_four']->department_translation ?? $static_pages['department_description_four']->value ?? '' }}</p>
                    <div class="department-btn">
                        <a href="{{ $static_pages['department_link_four']->value ?? '' }}">
                            <i class="fas fa-arrow-right-long"></i>
                            اقرأ المزيد
                        </a>
                    </div>
                </div>
            </div>

            <!-- Department Item 5 -->
            <div class="department-item">
                <div class="department-icon">
                    <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_five']->value ?? '' }}" alt="">
                </div>
                <div class="department-info" style="text-align:right">
                    <h4 class="department-title">
                        <a href="{{ $static_pages['department_link_five']->value ?? '' }}">
                            {{ $static_pages['department_title_five']->department_translation ?? $static_pages['department_title_five']->value ?? '' }}
                        </a>
                    </h4>
                    <p>{{ $static_pages['department_description_five']->department_translation ?? $static_pages['department_description_five']->value ?? '' }}</p>
                    <div class="department-btn">
                        <a href="{{ $static_pages['department_link_five']->value ?? '' }}">
                            <i class="fas fa-arrow-right-long"></i>
                            اقرأ المزيد
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="department-area bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"><i class="far fa-book-open-reader"></i>{{ $static_pages['department_header']->value ?? '' }}</span>
                        <h2 class="site-title">{{ $static_pages['department_title']->value ?? '' }}</h2>
                        <p>{{ $static_pages['department_description']->value ?? '' }}</p>
                    </div>
                </div>
            </div>
            <div class="department-slider owl-carousel owl-theme">
                <!-- Department Item 1 -->
                <div class="department-item">
                    <div class="department-icon">
                        <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_one']->value ?? '' }}" alt="">
                    </div>
                    <div class="department-info">
                        <h4 class="department-title"><a href="{{ $static_pages['department_link_one']->value ?? '' }}">{{ $static_pages['department_title_one']->value ?? '' }}</a></h4>
                        <p>{{ $static_pages['department_description_one']->value ?? '' }}</p>
                        <div class="department-btn">
                            <a href="{{ $static_pages['department_link_one']->value ?? '' }}">Read More<i class="fas fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Department Item 2 -->
                <div class="department-item">
                    <div class="department-icon">
                        <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_two']->value ?? '' }}" alt="">
                    </div>
                    <div class="department-info">
                        <h4 class="department-title"><a href="{{ $static_pages['department_link_two']->value ?? '' }}">{{ $static_pages['department_title_two']->value ?? '' }}</a></h4>
                        <p>{{ $static_pages['department_description_two']->value ?? '' }}</p>
                        <div class="department-btn">
                            <a href="{{ $static_pages['department_link_two']->value ?? '' }}">Read More<i class="fas fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Department Item 3 -->
                <div class="department-item">
                    <div class="department-icon">
                        <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_three']->value ?? '' }}" alt="">
                    </div>
                    <div class="department-info">
                        <h4 class="department-title"><a href="{{ $static_pages['department_link_three']->value ?? '' }}">{{ $static_pages['department_title_three']->value ?? '' }}</a></h4>
                        <p>{{ $static_pages['department_description_three']->value ?? '' }}</p>
                        <div class="department-btn">
                            <a href="{{ $static_pages['department_link_three']->value ?? '' }}">Read More<i class="fas fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Department Item 4 -->
                <div class="department-item">
                    <div class="department-icon">
                        <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_four']->value ?? '' }}" alt="">
                    </div>
                    <div class="department-info">
                        <h4 class="department-title"><a href="{{ $static_pages['department_link_four']->value ?? '' }}">{{ $static_pages['department_title_four']->value ?? '' }}</a></h4>
                        <p>{{ $static_pages['department_description_four']->value ?? '' }}</p>
                        <div class="department-btn">
                            <a href="{{ $static_pages['department_link_four']->value ?? '' }}">Read More<i class="fas fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Department Item 5 -->
                <div class="department-item">
                    <div class="department-icon">
                        <img src="{{ env('URL_ADMIN') }}/departed/{{ $static_pages['department_icon_five']->value ?? '' }}" alt="">
                    </div>
                    <div class="department-info">
                        <h4 class="department-title"><a href="{{ $static_pages['department_link_five']->value ?? '' }}">{{ $static_pages['department_title_five']->value ?? '' }}</a></h4>
                        <p>{{ $static_pages['department_description_five']->value ?? '' }}</p>
                        <div class="department-btn">
                            <a href="{{ $static_pages['department_link_five']->value ?? '' }}">Read More<i class="fas fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
