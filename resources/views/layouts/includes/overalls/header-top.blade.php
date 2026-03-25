@if(app()->getLocale() === 'ar')
    @if($static_pages['show_quick']->value !== "on")
    @php
    $socialLinks = [
    $static_pages['fa-facebook-f']->value ?? null,
    $static_pages['fa-instagram']->value ?? null,
    $static_pages['fa-youtube']->value ?? null,
    $static_pages['fa-whatsapp']->value ?? null,
    $static_pages['fa-udemy']->value ?? null,
    ];
    $hasSocialLinks = collect($socialLinks)->filter()->isNotEmpty();
    @endphp
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrap">
                <div class="header-top-left">
                    <div class="header-top-social">
                        @if($hasSocialLinks)
                        <span>Follow Us: </span>
                        @endif
                        @isset($static_pages['fa-facebook-f']->value)
                        <a href="{{ $static_pages['fa-facebook-f']->value }}"><i class="fab fa-facebook-f"></i></a>
                        @endisset

                        @isset($static_pages['fa-instagram']->value)
                        <a href="{{ $static_pages['fa-instagram']->value }}"><i class="fab fa-instagram"></i></a>
                        @endisset

                        @isset($static_pages['fa-youtube']->value)
                        <a href="{{ $static_pages['fa-youtube']->value }}"><i class="fab fa-youtube"></i></a>
                        @endisset

                        @isset($static_pages['fa-whatsapp']->value)
                        <a href="{{ $static_pages['fa-whatsapp']->value }}"><i class="fab fa-whatsapp"></i></a>
                        @endisset

                        @isset($static_pages['fa-udemy']->value)
                        <a href="{{ $static_pages['fa-udemy']->value }}"><i class="fas fa-graduation-cap"></i></a>
                        @endisset
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-contact">
                        <ul>
                            @if(!is_null($static_pages['fa-location-dot']->value))
                            <li>
                                <a href="#"><i class="far fa-location-dot"></i> {{ $static_pages['fa-location-dot']->value ?? '25/B Milford Road, New York' }}</a>
                            </li>
                            @endif
                            @if(!is_null($static_pages['fa-envelopes']->value))
                            <li>
                                <a href="mailto:{{ $static_pages['fa-envelopes']->value ?? 'info@example.com' }}"><i class="far fa-envelopes"></i> {{ $static_pages['fa-envelopes']->value ?? 'info@example.com' }}</a>
                            </li>
                            @endif
                            @if(!is_null($static_pages['fa-phone-volume']->value))
                            <li>
                                <a href="tel:{{ $static_pages['fa-phone-volume']->value ?? '+21236547898' }}"><i class="far fa-phone-volume"></i> {{ $static_pages['fa-phone-volume']->value ?? '+2 123 654 7898' }}</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@else
    @if($static_pages['show_quick'] !== "on")
        @php
        $socialLinks = [
            $static_pages['fa-facebook-f']->value ?? null,
            $static_pages['fa-instagram']->value ?? null,
            $static_pages['fa-youtube']->value ?? null,
            $static_pages['fa-whatsapp']->value ?? null,
            $static_pages['fa-udemy']->value ?? null,
        ];
        $hasSocialLinks = collect($socialLinks)->filter()->isNotEmpty();
        @endphp
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrap">
                    <div class="header-top-left">
                        <div class="header-top-social">
                            @if($hasSocialLinks)
                            <span>Follow Us: </span>
                            @endif
                            @isset($static_pages['fa-facebook-f']->value)
                            <a href="{{ $static_pages['fa-facebook-f']->value }}"><i class="fab fa-facebook-f"></i></a>
                            @endisset

                            @isset($static_pages['fa-instagram']->value)
                            <a href="{{ $static_pages['fa-instagram']->value }}"><i class="fab fa-instagram"></i></a>
                            @endisset

                            @isset($static_pages['fa-youtube']->value)
                            <a href="{{ $static_pages['fa-youtube']->value }}"><i class="fab fa-youtube"></i></a>
                            @endisset

                            @isset($static_pages['fa-whatsapp']->value)
                            <a href="{{ $static_pages['fa-whatsapp']->value }}"><i class="fab fa-whatsapp"></i></a>
                            @endisset

                            @isset($static_pages['fa-udemy']->value)
                            <a href="{{ $static_pages['fa-udemy']->value }}"><i class="fas fa-graduation-cap"></i></a>
                            @endisset
                        </div>
                    </div>
                    <div class="header-top-right">
                        <div class="header-top-contact">
                            <ul>
                                @if(!is_null($static_pages['fa-location-dot']->value))
                                <li>
                                    <a href="#"><i class="far fa-location-dot"></i> {{ $static_pages['fa-location-dot']->value ?? '25/B Milford Road, New York' }}</a>
                                </li>
                                @endif
                                @if(!is_null($static_pages['fa-envelopes']->value))
                                <li>
                                    <a href="mailto:{{ $static_pages['fa-envelopes']->value ?? 'info@example.com' }}"><i class="far fa-envelopes"></i> {{ $static_pages['fa-envelopes']->value ?? 'info@example.com' }}</a>
                                </li>
                                @endif
                                @if(!is_null($static_pages['fa-phone-volume']->value))
                                        <li>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $static_pages['fa-phone-volume']->value ?? '21236547898') }}" target="_blank">
                                                <img src="{{ asset('assets/img/socials/wa-png-Nazok.png') }}" alt="WhatsApp" style="height: 28px;">
                                            </a>
                                        </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

