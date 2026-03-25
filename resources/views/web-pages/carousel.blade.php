<div class="modern-carousel-container">
    <div class="slick-carousel">
        @for($i = 1; $i <= 8; $i++)
            <div class="carousel-slide">
                <img src="{{ asset('/carousel/images/slider/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.jpg') }}"
                     alt="Slide {{ $i }}"
                     class="carousel-image" />
            </div>
        @endfor
    </div>
</div>
