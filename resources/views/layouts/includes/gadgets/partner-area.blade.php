<div class="partner-area bg pt-50 pb-50" style="background-color:white">
    <div class="container">
        <div class="partner-wrapper partner-slider owl-carousel owl-theme">
            @php
                $partners_ids = [];
            @endphp

            @foreach($partners as $partner)
                @if(!is_null($partner->partner_image))
                    @if (!in_array($partner->id, $partners_ids))
                        <div class="partner-item">
                            <a href="{{ $partner->partner_link ?? '#' }}">
                                <img src="{{ env('URL_ADMIN') }}/partners/{{ $partner->partner_image }}" alt="{{ $partner->partner_name }}">
                            </a>
                        </div>
                        @php
                            $partners_ids[] = $partner->id;
                        @endphp
                    @else
                        @continue
                    @endif
                @else
                    @continue
                @endif
            @endforeach
        </div>
    </div>
</div>
