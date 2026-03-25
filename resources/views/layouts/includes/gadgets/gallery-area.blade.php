<div class="gallery-area py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">
                        <i class="{{ $static_pages['gallery_icon'] ?? 'far fa-book-open-reader' }}"></i>
                        {{ $static_pages['gallery_header'] ?? '' }}
                    </span>
                    <h2 class="site-title">
                        {{ $static_pages['gallery_title'] ?? '' }}
                        <span>{{ $static_pages['gallery_span'] ?? '' }}</span>
                    </h2>
                    <p>{{ $static_pages['gallery_description'] ?? '' }}</p>
                </div>
            </div>
        </div>

        <div class="row popup-gallery">
            @for ($i = 1; $i <= 6; $i++)
                <div class="col-md-4 wow fadeInUp" data-wow-delay="{{ 0.25 * $i }}s">
                    <div class="gallery-item">
                        <div class="gallery-img">
                            <img src="/assets/img/gallery/0{{ $i }}.jpg" alt="">
                        </div>
                        <div class="gallery-content">
                            <a class="popup-img gallery-link" href="/assets/img/gallery/0{{ $i }}.jpg"><i class="fal fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <br>
