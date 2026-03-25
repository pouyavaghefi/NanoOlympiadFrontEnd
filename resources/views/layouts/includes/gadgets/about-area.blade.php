@if (app()->getLocale() === 'ar')
    <div class="about-area py-120 {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                        <div class="about-img">
                            <div class="row g-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img class="img-1" src="{{ env('URL_ADMIN') }}/{{ $static_pages['aboutus_first_image']->value ?? '' }}" alt="">
                                        <div class="about-experience mt-4">
                                            <div class="about-experience mt-4">
                                                <div class="about-experience-icon">
                                                    <a href="{{ env('APP_URL') }}/dl/broshor-ino1.pdf"><img src="{{ env('APP_URL') }}/assets/img/icon/{{ $static_pages['aboutus_badge_icon']->value ?? '' }}" alt="{{ $static_pages['aboutus_badge_icon']->value ?? '' }}"></a>
                                                </div>
                                                <b class="text-start">&nbsp; {{ $static_pages['aboutus_badge_text']->value ?? '' }}</b>
                                            </div>
                                            <b class="text-start">&nbsp; {{ $static_pages['aboutus_badge_text']->value ?? '' }}</b>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img class="img-2" src="{{ env('URL_ADMIN') }}/{{ $static_pages['aboutus_second_image']->value ?? '' }}" alt="">
                                        <img class="img-3 mt-4" src="{{ env('URL_ADMIN') }}/{{ $static_pages['aboutus_third_image']->value ?? '' }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline" style="float:right">

                                {{ $static_pages['aboutus_header']->value ?? '' }}
                                <i class="{{ $static_pages['aboutus_header_icon']->value ?? '' }}"></i>
                            </span>
                            <h2 class="site-title" style="text-align: right;float:right">
                                {{ $static_pages['aboutus_title']->value ?? '' }}
                            </h2>
                            </br>
                        </div>
                        <p class="about-text" style="text-align: right">
                            {{ $static_pages['aboutus_paragraph']->value ?? '' }}
                            </p>
                            <div class="about-content">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="{{ env('URL_ADMIN') }}/about/{{ $static_pages['aboutus_secondary_icon_1']->value ?? '' }}" alt="">
                                            </div>
                                            <div class="about-item-content">
                                                <h5 style="text-align: right">{{ $static_pages['aboutus_secondary_title_1']->value ?? '' }}</h5>
                                                <p style="text-align: right">{{ $static_pages['aboutus_secondary_paragraph_1']->value ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="{{ env('APP_URL') }}/assets/img/icon/{{ $static_pages['aboutus_secondary_icon_1']->value ?? '' }}" alt="">
                                            </div>
                                            <div class="about-item-content">
                                                <h5 style="text-align: right">{{ $static_pages['aboutus_secondary_title_2']->value ?? '' }}</h5>
                                                <p style="text-align: right">{{ $static_pages['aboutus_secondary_paragraph_2']->value ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="about-quote">
                                            <i class="far fa-quote-right"></i>
                                            <p style="text-align: right">{{ $static_pages['aboutus_extra_note']->value ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!is_null($static_pages['aboutus_link_url']->value ?? ''))
                                <div class="about-bottom">
                                    @if(!is_null($static_pages['aboutus_call_number']->value ?? ''))
                                        <div class="about-phone">
                                            <div class="icon"><i class="fal fa-headset"></i></div>
                                            <div class="number">
                                                <span>Call Now</span>
                                                <h6><a href="tel:{{ $static_pages['aboutus_call_number']->value ?? '' }}">{{ $static_pages['aboutus_call_number']->value ?? '' }}</a></h6>
                                            </div>
                                        </div>
                                    @endif
                                    <a style="text-align:right" href="{{ $static_pages['aboutus_link_url']->value ?? '' }}" class="theme-btn">{{ $static_pages['aboutus_link_name']->value ?? '' }}<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="about-area py-120">
                <div class="container">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                                <div class="about-img">
                                    <div class="row g-4">
                                        <div class="col-md-6 position-relative">
                                            <img class="img-1" src="{{ env('URL_ADMIN') }}/{{ $static_pages['aboutus_first_image']->value ?? '' }}" alt="">
                                            <a href="{{ env('APP_URL') }}/dl/broshor-ino1.pdf" class="clickable-div">
                                                <div class="about-experience mt-4">
                                                    <div class="about-experience-icon">
                                                        <a href="{{ env('APP_URL') }}/dl/broshor-ino1.pdf"><img src="{{ env('APP_URL') }}/assets/img/icon/{{ $static_pages['aboutus_badge_icon']->value ?? '' }}" alt="{{ $static_pages['aboutus_badge_icon']->value ?? '' }}"></a>
                                                    </div>
                                                    <b class="text-start">&nbsp; {{ $static_pages['aboutus_badge_text']->value ?? '' }}</b>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-md-6">
                                            <img class="img-2" src="{{ env('URL_ADMIN') }}/{{ $static_pages['aboutus_second_image']->value ?? '' }}" alt="">
                                            <img class="img-3 mt-4" src="{{ env('URL_ADMIN') }}/{{ $static_pages['aboutus_third_image']->value ?? '' }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                                <div class="site-heading mb-3">
                                    <span class="site-title-tagline"><i class="{{ $static_pages['aboutus_header_icon']->value ?? '' }}"></i> {{ $static_pages['aboutus_header']->value ?? '' }}</span>
                                    <h2 class="site-title">
                                        {{ $static_pages['aboutus_title']->value ?? '' }}
                                    </h2>
                                </div>
                                <p class="about-text">
                                    {{ $static_pages['aboutus_paragraph']->value ?? '' }}
                                </p>
                                <div class="about-content">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="about-item">
                                                <div class="about-item-icon">
                                                    <img src="{{ env('APP_URL') }}/assets/img/icon/{{ $static_pages['aboutus_secondary_icon_1']->value ?? '' }}" alt="">
                                                </div>
                                                <div class="about-item-content">
                                                    <h5>{{ $static_pages['aboutus_secondary_title_1']->value ?? '' }}</h5>
                                                    <p>{{ $static_pages['aboutus_secondary_paragraph_1']->value ?? '' }}</p>
                                                </div>
                                            </div>
                                            <div class="about-item">
                                                <div class="about-item-icon">
                                                    <img src="{{ env('APP_URL') }}/assets/img/icon/{{ $static_pages['aboutus_secondary_icon_2']->value ?? '' }}" alt="">
                                                </div>
                                                <div class="about-item-content">
                                                    <h5>{{ $static_pages['aboutus_secondary_title_2']->value ?? '' }}</h5>
                                                    <p>{{ $static_pages['aboutus_secondary_paragraph_2']->value ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="about-quote">
                                                <p>{{ $static_pages['aboutus_extra_note']->value ?? '' }}</p>
                                                <i class="far fa-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!is_null($static_pages['aboutus_link_url']->value ?? ''))
                                    <div class="about-bottom">
                                        <a href="{{ $static_pages['aboutus_link_url']->value ?? '' }}" class="theme-btn">{{ $static_pages['aboutus_link_name']->value ?? '' }}<i
                                                    class="fas fa-arrow-right-long"></i></a>
                                        @if(!is_null($static_pages['aboutus_call_number']->value ?? ''))
                                            <div class="about-phone">
                                                <div class="icon"><i class="fal fa-headset"></i></div>
                                                <div class="number">
                                                    <span>Call Now</span>
                                                    <h6>
                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $static_pages['aboutus_call_number']->value ?? '') }}" target="_blank">
                                                            <img src="{{ asset('assets/img/socials/wa-png-Nazok.png') }}" alt="WhatsApp" style="height: 32px;">
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endif