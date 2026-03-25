@if(app()->getLocale() === 'ar')

@else
    @php
        $backgroundImage = env('URL_ADMIN') . "/counter/" . ($static_pages['counter_area_bg']->value ?? '');
        $realData = $static_pages['real_data']->value ?? '';
    @endphp

    <div class="counter-area pt-60 pb-60" style="background-image: url('{{ $backgroundImage }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ env('URL_ADMIN') }}/counter/{{ $static_pages['counter_box_one_icon']->value ?? '' }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="500" data-speed="3000">{{ $static_pages['counter_box_one_value']->value ?? '' }}</span>
                            <h6 class="title">+ {{ $static_pages['counter_box_one_title']->value ?? '' }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ env('URL_ADMIN') }}/counter/{{ $static_pages['counter_box_two_icon']->value ?? '' }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="1900" data-speed="3000">{{ $static_pages['counter_box_two_value']->value ?? '' }}</span>
                            <h6 class="title">+ {{ $static_pages['counter_box_two_title']->value ?? '' }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ env('URL_ADMIN') }}/counter/{{ $static_pages['counter_box_three_icon']->value ?? '' }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="750" data-speed="3000">{{ $static_pages['counter_box_three_value']->value ?? '' }}</span>
                            <h6 class="title">+ {{ $static_pages['counter_box_three_title']->value ?? '' }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ env('URL_ADMIN') }}/counter/{{ $static_pages['counter_box_four_icon']->value ?? '' }}" alt="">
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="30" data-speed="3000">{{ $static_pages['counter_box_four_value']->value ?? '' }}</span>
                            <h6 class="title">+ {{ $static_pages['counter_box_four_title']->value ?? '' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif