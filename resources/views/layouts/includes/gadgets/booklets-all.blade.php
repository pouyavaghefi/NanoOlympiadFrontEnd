<div class="course-area py-120" dir="ltr">
    <div class="container">
        @if (app()->getLocale() === 'ar')
            @php
                $courseHeading = DB::table('localizations')->where('key', 'course-courses-heading')->where('language_id', 5)->value('value');
                $courseSubheading = DB::table('localizations')->where('key', 'course-courses-subheading')->where('language_id', 5)->value('value');
                $courseDesc = DB::table('localizations')->where('key', 'course-courses-desc')->where('language_id', 5)->value('value');
            @endphp
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center" style="text-align: right;">
                        <span class="site-title-tagline">{{ $courseHeading }}<i class="far fa-book-open-reader"></i></span>
                        <h2 class="site-title">{{ $courseSubheading }}</h2>
                        <p>{{ $courseDesc }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @php
                                $cover = asset('assets/covers/' . preg_replace('/\.pdf$/i', '.jpg', $book->source));
                            @endphp
                            <img src="{{ $cover }}" class="card-img-top img-fluid" alt="{{ $book->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $book->name }}</h5>
                                <p class="card-text">{{ $book->short_description ?? '' }}</p>
                                <div class="mt-auto">
                                    <a href="{{ env('APP_URL') }}/courses/book-lets/{{ $book->slug }}" class="btn btn-primary w-100">
                                        📖 @lang('words.visit_book')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">Our Booklets<i class="far fa-book-open-reader"></i></span>
                        <h2 class="site-title">Let's Check Our <span>Booklets</span></h2>
                        <p>Explore more or visit our digital library</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @php
                                $cover = asset('assets/covers/' . preg_replace('/\.pdf$/i', '.jpg', $book->source));
                            @endphp
                            <img src="{{ $cover }}" class="card-img-top img-fluid" alt="{{ $book->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $book->name }}</h5>
                                <p class="card-text">{{ $book->short_description ?? '' }}</p>
                                <div class="mt-auto">
                                    <a href="{{ env('APP_URL') }}/courses/book-lets/{{ $book->slug }}" class="btn btn-primary w-100">
                                        📖 @lang('Visit Book')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

{{--            <div class="row mt-5">--}}
{{--                <div class="col-12 text-center">--}}
{{--                    <a target="_blank" href="{{ route('frt.crs.bookshelf') }}" class="btn btn-digital-library">--}}
{{--                        <i class="fas fa-book-open"></i>--}}
{{--                        @if(app()->getLocale() === 'ar')--}}
{{--                            دخول المكتبة الرقمية--}}
{{--                        @else--}}
{{--                            Enter Digital Library--}}
{{--                        @endif--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}

            <style>
                .btn-digital-library {
                    background: linear-gradient(135deg, #3a7bd5, #00d2ff);
                    border: none;
                    border-radius: 50px;
                    padding: 15px 40px;
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: white;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                    transition: all 0.3s ease;
                    position: relative;
                    overflow: hidden;
                }

                .btn-digital-library:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
                    color: white;
                }

                .btn-digital-library:active {
                    transform: translateY(1px);
                }

                .btn-digital-library i {
                    margin-right: 8px;
                }
            </style>        @endif
    </div>
</div>
