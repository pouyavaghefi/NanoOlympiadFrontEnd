@php
$cta_img = env('URL_ADMIN')."/cta/".$static_pages['cta_bg_image'];
@endphp
<div class="cta-area" style="background-image: url({{ $cta_img }});">
    <div class="container">
        <div class="cta-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-5 ms-lg-auto">
                    <div class="cta-content">
                        <h1>{{ $static_pages['cta_title'] ?? '' }}</h1>
                        <p>{{ $static_pages['cta_paragraph'] ?? '' }}</p>
                        <div class="cta-btn">
                            <a href="{{ $static_pages['cta_button_link'] ?? '' }}" class="theme-btn">{{ $static_pages['cta_button_name'] ?? '' }}<i
                                    class="fas fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
