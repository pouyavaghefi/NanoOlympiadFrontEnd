<div class="hero-section">
    <div class="hero-slider owl-carousel owl-theme">
        @forelse ($sliders as $slider)
            <div class="hero-single" style="background: url({{ env('URL_ADMIN') }}/storage/{{ $slider->slide_image }})">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-lg-7">
                            <div class="hero-content">
                                <h6 class="hero-sub-title">
                                    <a href="{{ env('URL_ADMIN') }}/{{ $slider->slide_subtitle }}" style="color:#FDA31B">
                                        {{ $slider->slide_subtitle }}
                                    </a>
                                </h6>
                                <h1 class="hero-title">{{ $slider->slide_title }}</h1>
                                <p>{{ $slider->slide_description }}</p>
                                <div class="hero-btn">
                                    @if($slider->button1_text)
                                        <a target="_blank" href="{{ $slider->button1_link }}" class="theme-btn">{{ $slider->button1_text }}<i class="fas fa-arrow-right-long"></i></a>
                                    @endif
                                    @if($slider->button2_text)
                                        <a target="_blank" href="{{ $slider->button2_link }}" class="theme-btn theme-btn2"><i class="fas fa-arrow-right-long"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            @if (app()->getLocale() === 'ar')
                @php
                    $heroIndexHeading = DB::table('localizations')->where('key', 'hero-index-heading')->where('language_id', 5)->value('value');
                    $heroIndexSubheading = DB::table('localizations')->where('key', 'hero-index-subheading')->where('language_id', 5)->value('value');
                    $heroIndexDesc = DB::table('localizations')->where('key', 'hero-index-desc')->where('language_id', 5)->value('value');
                @endphp
                <div class="hero-single" style="background: url(/assets/slider/slide.jpg)">
                    <div class="container" dir="rtl">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="hero-content" style="text-align: right;">
                                    <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                        <i class="far fa-book-open-reader"></i> {{ $heroIndexHeading }}
                                    </h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        {{ $heroIndexSubheading }}
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        {{ $heroIndexDesc }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="hero-single" style="background: url(/assets/slider/slide.jpg)">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-lg-7">
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                        <i class="far fa-book-open-reader"></i>Welcome To Nano Olympiad!
                                    </h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        International Nanotechnology Olympiad
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        International Nanotechnology Olympiad (INO) is a global competition among university students from different involved countries being held consistently in member economies.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforelse
    </div>
</div>
