<div class="feature-area fa-negative">
    <div class="col-xl-9 ms-auto">
        <div class="feature-wrapper">
            @if(app()->getLocale() === 'ar')
                <div class="row g-4">
                    @if(!is_null($static_pages['feature_four_name']->value))
                        <div class="col-md-6 col-lg-3">
                            <div class="feature-item">
                                <span class="count">04</span>
                                <div class="feature-icon">
                                    <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_four_icon']->value ?? '' }}" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title" style="text-align:right">{{ $static_pages['feature_four_name']->value ?? '' }}</h4>
                                    <p style="text-align:right">{!! $static_pages['feature_four_desc']->value !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!is_null($static_pages['feature_three_name']->value))
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">03</span>
                            <div class="feature-icon">
                                <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_three_icon']->value ?? '' }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title" style="text-align:right">{{ $static_pages['feature_three_name']->value ?? '' }}</h4>
                                <p style="text-align:right">{!! $static_pages['feature_three_desc']->value !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(!is_null($static_pages['feature_two_name']->value))
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">02</span>
                            <div class="feature-icon">
                                <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_two_icon']->value ?? '' }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title" style="text-align:right">{{ $static_pages['feature_two_name']->value ?? '' }}</h4>
                                <p style="text-align:right">{!! $static_pages['feature_two_desc']->value !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(!is_null($static_pages['feature_one_name']->value))
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <span class="count">01</span>
                            <div class="feature-icon">
                                <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_one_icon']->value ?? '' }}" alt="">
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title" style="text-align:right">{{ $static_pages['feature_one_name']->value ?? '' }}</h4>
                                <p style="text-align:right">{!! $static_pages['feature_one_desc']->value !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            @else
                    <div class="row g-4">
                        @if(!empty($static_pages['feature_one_name']->value))
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-item">
                                    <span class="count">01</span>
                                    <div class="feature-icon">
                                        <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_one_icon']->value ?? '' }}" alt="">
                                    </div>
                                    <div class="feature-content">
                                        <h4 class="feature-title">{{ $static_pages['feature_one_name']->value ?? '' }}</h4>
                                        <p>{!! $static_pages['feature_one_desc']->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($static_pages['feature_two_name']->value))
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-item">
                                    <span class="count">02</span>
                                    <div class="feature-icon">
                                        <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_two_icon']->value ?? '' }}" alt="">
                                    </div>
                                    <div class="feature-content">
                                        <h4 class="feature-title">{{ $static_pages['feature_two_name']->value ?? '' }}</h4>
                                        <p>{!! $static_pages['feature_two_desc']->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!empty($static_pages['feature_three_name']->value))
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-item">
                                    <span class="count">03</span>
                                    <div class="feature-icon">
                                        <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_three_icon']->value ?? '' }}" alt="">
                                    </div>
                                    <div class="feature-content">
                                        <h4 class="feature-title">{{ $static_pages['feature_three_name']->value ?? '' }}</h4>
                                        <p>{!! $static_pages['feature_three_desc']->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                            @if(!empty($static_pages['feature_four_name']->value))
                                <div class="col-md-6 col-lg-3">
                                    <div class="feature-item">
                                        <span class="count">04</span>
                                        <div class="feature-icon">
                                            <img src="{{ env('URL_ADMIN') }}/features/{{ $static_pages['feature_four_icon']->value ?? '' }}" alt="">
                                        </div>
                                        <div class="feature-content">
                                            <h4 class="feature-title">{{ $static_pages['feature_four_name']->value ?? '' }}</h4>
                                            <p>{!! $static_pages['feature_four_desc']->value !!}</p>

                                            <!-- Minimal Awesome Button -->
                                            <div class="text-center mt-4">
                                                <a href="https://ino-official.org/Scoring" class="minimal-awesome-btn">
                                                    <span>Discover More</span>
                                                    <svg viewBox="0 0 13 10" height="10px" width="15px">
                                                        <path d="M1,5 L11,5"></path>
                                                        <polyline points="8 1 12 5 8 9"></polyline>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <style>
                                .minimal-awesome-btn {
                                    display: inline-flex;
                                    align-items: center;
                                    gap: 8px;
                                    font-size: 1rem;
                                    font-weight: 600;
                                    padding: 0.75rem 1.5rem;
                                    color: #f12711;
                                    background-color: transparent;
                                    border: 2px solid #f12711;
                                    border-radius: 50px;
                                    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                                    position: relative;
                                    overflow: hidden;
                                    text-decoration: none;
                                }

                                .minimal-awesome-btn svg {
                                    stroke: #f12711;
                                    stroke-width: 2;
                                    fill: none;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                                }

                                .minimal-awesome-btn::before {
                                    content: '';
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background: linear-gradient(135deg, rgba(241,39,17,0.1) 0%, rgba(245,175,25,0.05) 100%);
                                    transform: translateX(-100%);
                                    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
                                    z-index: -1;
                                }

                                .minimal-awesome-btn:hover {
                                    color: white;
                                    background-color: #f12711;
                                    transform: translateY(-2px);
                                    box-shadow: 0 5px 15px rgba(241, 39, 17, 0.3);
                                }

                                .minimal-awesome-btn:hover svg {
                                    stroke: white;
                                    transform: translateX(3px);
                                }

                                .minimal-awesome-btn:hover::before {
                                    transform: translateX(0);
                                }
                            </style>
                    </div>
                </div>

            @endif
        </div>
    </div>
</div>
